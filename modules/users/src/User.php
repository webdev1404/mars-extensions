<?php
/**
* The User Class
* @package Mars
*/

namespace Modules\Users;

use Mars\App;
use Mars\Item;

/**
 * The User Class
 * Encapsulates methods for working with users
 */
class User extends Item
{
    /**
     * @internal
     */
    protected static array $validation_rules = [
        'username' => 'req|username:5:100',
        'email' => 'req|email',
        'password' => 'req|password'
    ];

    /**
     * @var string $password_clean The clean password
     */
    public string $password_clean = '';

    /**
     * @internal
     */
    protected static string $table = 'users';

    /**
     * @internal
     */
    protected static string $table_activation_tokens = 'users_activation_tokens';

    /**
     * @internal
     */
    protected static string $table_password_reset_tokens = 'users_password_reset_tokens';

    /**
     * @internal
     */
    protected static array $ignore = ['password_clean'];

    /**
     * @internal
     */
    public function validate(array|object $data = []) : bool
    {
        if (!parent::validate($data)) {
            return false;
        }

        $ok = true;
        if (!$this->id) {
            //check for existing username and email
            $username_exists = $this->db->exists($this->getTable(), ['username_crc32' => crc32(strtolower($this->username)), 'username' => $this->username]);
            if ($username_exists) {
                $this->errors->add(App::__('module.users:register.err.username.exists', ['{FIELD}' => 'username']), 'username', 'username.exists');

                $ok = false;
            }
            
            $email_exists = $this->db->exists($this->getTable(), ['email_crc32' => crc32(strtolower($this->email)), 'email' => $this->email]);
            if ($email_exists) {
                $this->errors->add(App::__('module.users:register.err.email.exists', ['{FIELD}' => 'email']), 'email', 'email.exists');
                
                $ok = false;
            }
        }

        return $this->plugins->run('user.validate', $ok, $this);
    }

    /**
     * @internal
     */
    protected function prepare()
    {
        parent::prepare();

        $this->plugins->run('user.prepare', $this);
    }

    /**
     * @internal
     */
    protected function process()
    {
        $this->username_crc32 = crc32(strtolower($this->username));
        $this->email_crc32 = crc32(strtolower($this->email));

        if ($this->password_clean) {
            $this->password = $this->app->hasher->getPassword($this->password_clean);
        }

        $this->plugins->run('user.process', $this);
    }

    /**
     * @internal
     */
    protected function processInsert()
    {
        $this->status = 1;
        $this->activated = 0;
        $this->uuid = $this->app->id->getUuid();
        $this->uuid_crc32 = crc32($this->uuid);
        $this->registration_timestamp = time();
        $this->registration_ip = ['function' => 'INET6_ATON', 'value' => $this->app->ip];
    }

    /**
     * @internal
     */
    public function insert() : int
    {
        $this->plugins->run('user.insert.before', $this);

        $ret = parent::insert();

        $this->plugins->run('user.insert.after', $ret, $this);

        return $ret;
    }

    /**
     * @internal
     */
    public function update() : int
    {
        $this->plugins->run('user.update.before', $this);

        $ret = parent::update();

        $this->plugins->run('user.update.after', $ret, $this);

        return $ret;
    }

    /**
     * @internal
     */
    public function save() : int
    {
        $this->plugins->run('user.save.before', $this);

        $ret = parent::save();

        $this->plugins->run('user.save.after', $ret, $this);

        return $ret;
    }

    /**
     * Creates an activation key for the user and saves it in the database
     * @return string The activation key
     */
    public function getActivationToken() : string
    {
        $this->db->delete(static::$table_activation_tokens, ['user_id' => $this->id]);

        $token = $this->app->random->getString(32);

        $activation_data = [
            'user_id' => $this->id,
            'token' => $this->app->hasher->getToken($token),
            'expires_at' => time() + ($this->app->config->users->activation->expires_hours * 3600)
        ];
        
        $this->db->insert(static::$table_activation_tokens, $activation_data);

        return $token;
    }

    /**
     * Activates the user account
     * @param string $key The activation key
     */
    public function activate(string $key) : bool
    {
        if (!$this->id) {
            return false;
        }

        if ($this->activated) {
            return true;
        }

        $row = $this->db->selectRow(static::$table_activation_tokens, ['user_id' => $this->id]);
        if (!$row) {
            return false;
        }

        //has the token expired?
        if ($row->expires_at < time()) {
            return false;
        }

        //is the key valid?
        if (!$this->app->hasher->verifyToken($key, $row->token)) {
            return false;
        }

        $this->db->delete(static::$table_activation_tokens, ['user_id' => $this->id]);

        $this->activated = 1;

        $this->plugins->run('user.activate', $this);

        return $this->save();
    }

    /**
     * @internal
     */
    public function getRowByName(string $name) : ?object
    {
        return $this->db->selectRow($this->getTable(), ['uuid' => $name, 'uuid_crc32' => crc32($name)]);
    }

    /**
     * Loads a user by username
     * @param string $username The username
     * @return static
     */
    public function loadByUsername(string $username) : static
    {
        $data = $this->db->selectRow($this->getTable(), ['username_crc32' => crc32(strtolower($username)), 'username' => $username]);

        if (!$data) {
            return $this;
        }

        return $this->load($data, true);
    }

    /**
     * Loads a user by email
     * @param string $email The email
     * @return static
     */
    public function loadByEmail(string $email) : static
    {
        $data = $this->db->selectRow($this->getTable(), ['email_crc32' => crc32(strtolower($email)), 'email' => $email]);

        if (!$data) {
            return $this;
        }

        return $this->load($data, true);
    }

    /**
     * Creates a password reset key for the user and saves it in the database
     * @return string The password reset key
     */
    public function getPasswordResetToken() : string
    {
        $this->db->delete(static::$table_password_reset_tokens, ['user_id' => $this->id]);

        $token = $this->app->random->getString(32);

        $data = [
            'user_id' => $this->id,
            'token' => $this->app->hasher->getToken($token),
            'expires_at' => time() + ($this->app->config->users->forgot->password->expires_hours * 3600)
        ];

        $this->db->insert(static::$table_password_reset_tokens, $data);

        return $token;
    }

    /**
     * Verifies the password reset token for the user
     * @param string $token The password reset token
     * @param int|null $expired_at The timestamp to check for expiration, defaults to current time
     * @return bool True if the token is valid, false otherwise
     */
    public function verifyPasswordResetToken(string $token, ?int $expired_at = null) : bool
    {
        if (!$this->id) {
            return false;
        }

        $row = $this->db->selectRow(static::$table_password_reset_tokens, ['user_id' => $this->id]);
        if (!$row) {
            return false;
        }

        //has the token expired?
        $expired_at ??= time();
        if ($row->expires_at < $expired_at) {
            return false;
        }

        //is the key valid?
        if (!$this->app->hasher->verifyToken($token, $row->token)) {
            return false;
        }

        return true;
    }

    /**
     * Updates the user's password and deletes the password reset token
     * @param string $new_password The new password
     * @return bool True if the password was updated successfully, false otherwise
     */
    public function updatePassword(string $new_password) : bool
    {
        $this->password_clean = $new_password;

        if (!$this->save()) {
            return false;
        }

        $this->db->delete(static::$table_password_reset_tokens, ['user_id' => $this->id]);

        return true;
    }
}
