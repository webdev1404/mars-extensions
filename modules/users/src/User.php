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
        'password_clean' => 'req|password'
    ];

    /**
     * @var int $status The status of the user (1 = enabled, 0 = disabled)
     */
    public int $status = 1;

    /**
     * @var int $activated Indicates whether the user is activated (1 = activated, 0 = not activated)
     */
    public int $activated = 0;

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
    protected static string $table_email_update_tokens = 'users_email_update_tokens';

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
        $check_username = true;
        $check_email = true;

        if ($this->id) {
            $data = $this->db->selectRow($this->getTable(), ['id' => $this->id]);

            if ($data->username == $this->username) {
                $check_username = false;
            }

            if ($data->email == $this->email) {
                $check_email = false;
            }
        }

        //check for existing username and email
        if ($check_username) {
            $username_exists = $this->db->exists($this->getTable(), ['username_crc32' => crc32(strtolower($this->username)), 'username' => $this->username]);
            if ($username_exists) {
                $this->errors->add(App::__('module.users:register.err.username.exists', ['{FIELD}' => 'username']), 'username', 'username.exists');

                $ok = false;
            }
        }

        if ($check_email) {
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

        if (!$this->password_clean) {
            //skip validation for password_clean if a password is not provided
            $this->setValidationRulesToSkip('password_clean');
        }

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
     * Verifies that the user's password matches the provided password
     * @param string $password The password to verify
     * @return bool True if the password matches, false otherwise
     */
    public function verifyPassword(string $password) : bool
    {
        if (!$this->id) {
            return false;
        }

        $password_stored = $this->db->selectResult($this->getTable(), 'password', ['id' => $this->id]);
        if (!$password_stored) {
            return false;
        }

        return $this->app->hasher->verifyPassword($password, $password_stored);
    }

    /**
     * Updates the user's password and deletes the password reset token
     * @param string $new_password The new password
     * @return bool True if the password was updated successfully, false otherwise
     */
    public function updatePassword(string $new_password) : bool
    {
        if (!$this->id) {
            return false;
        }

        $this->password_clean = $new_password;

        if (!$this->save()) {
            return false;
        }

        $this->db->delete(static::$table_password_reset_tokens, ['user_id' => $this->id]);

        return true;
    }

    /**
     * Creates an email update token for the user and saves it in the database
     * @param string $email The new email address
     * @return string The email update token
     */
    public function getEmailUpdateToken(string $email) : string
    {
        $this->db->delete(static::$table_email_update_tokens, ['user_id' => $this->id]);

        $token = $this->app->random->getString(32);

        $email_update_data = [
            'user_id' => $this->id,
            'new_email' => $email,
            'token' => $this->app->hasher->getToken($token),
            'expires_at' => time() + ($this->app->config->users->account->email->update->expires_hours * 3600)
        ];
        
        $this->db->insert(static::$table_email_update_tokens, $email_update_data);

        return $token;
    }

    /**
     * Updates the user's email
     * @param string $token The email update token
     * @return bool True if the email was updated successfully, false otherwise
     */
    public function updateEmail(string $token) : bool
    {
        if (!$this->id) {
            return false;
        }

        $row = $this->db->selectRow(static::$table_email_update_tokens, ['user_id' => $this->id]);
        if (!$row) {
            return false;
        }

        //has the token expired?
        if ($row->expires_at < time()) {
            return false;
        }

        //is the token valid?
        if (!$this->app->hasher->verifyToken($token, $row->token)) {
            return false;
        }

        $this->email = $row->new_email;

        if (!$this->save()) {
            return false;
        }

        $this->db->delete(static::$table_email_update_tokens, ['user_id' => $this->id]);

        return true;
    }
}
