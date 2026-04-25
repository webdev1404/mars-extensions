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
     * @var string $activation_key The activation key generated when the user is registered
     */
    public string $activation_key = '';

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
    protected static array $ignore = ['password_clean', 'activation_key'];

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
            $username_exists = $this->app->db->exists($this->getTable(), ['username_crc32' => strtolower(crc32($this->username)), 'username' => $this->username]);
            if ($username_exists) {
                $this->errors->add(App::__(['err_username_exists', 'validate.unique'], ['{FIELD}' => 'username']), 'username', 'username.exists');

                $ok = false;
            }
            
            $email_exists = $this->app->db->exists($this->getTable(), ['email_crc32' => strtolower(crc32($this->email)), 'email' => $this->email]);
            if ($email_exists) {
                $this->errors->add(App::__(['err_email_exists', 'validate.unique'], ['{FIELD}' => 'email']), 'email', 'email.exists');
                
                $ok = false;
            }
        }

        return $this->app->plugins->run('user.validate', $ok, $this);
    }

    /**
     * Loads the users config
     */
    protected function loadConfig()
    {
        static $loaded = false;
        if ($loaded) {
            return;
        }

        $loaded = true;
        
        $this->app->modules->get('users')->loadConfig('user');
    }

    /**
     * @internal
     */
    protected function prepare()
    {
        parent::prepare();

        $this->app->plugins->run('user.prepare', $this);
    }

    /**
     * @internal
     */
    protected function process()
    {
        $this->username_crc32 = strtolower(crc32($this->username));
        $this->email_crc32 = strtolower(crc32($this->email));

        if ($this->password_clean) {
            $this->password = $this->app->security->hashPassword($this->password_clean);
        }

        $this->app->plugins->run('user.process', $this);
    }

    /**
     * @internal
     */
    protected function processInsert()
    {
        $this->status = 1;
        $this->activated = 0;
        $this->code = $this->app->random->getString(32);
        $this->code_crc32 = crc32($this->code);
        $this->registration_timestamp = time();
        $this->registration_ip = ['function' => 'INET6_ATON', 'value' => $this->app->ip];
    }

    /**
     * @internal
     */
    public function save() : int
    {
        $this->app->plugins->run('user.save.before', $this);

        $ret = parent::save();

        $this->app->plugins->run('user.save.after', $ret, $this);

        return $ret;
    }

    /**
     * @internal
     */
    public function insert() : int
    {
        $this->loadConfig();

        $id = parent::insert();
        if (!$id) {
            return $id;
        }

        $this->createActivationKey();

        return $id;
    }

    /**
     * Creates an activation key for the user and saves it in the database
     */
    public function createActivationKey()
    {
        $this->db->delete(static::$table_activation_tokens, ['user_id' => $this->id]);

        $this->activation_key = $this->app->random->getString(32);

        $activation_data = [
            'user_id' => $this->id,
            'token' => $this->app->security->getToken($this->activation_key),
            'expires_at' => time() + ($this->app->config->user->activation->expires_days * 3600 * 24)
        ];
        
        $this->app->db->insert(static::$table_activation_tokens, $activation_data);
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
        if (!$this->app->security->verifyToken($key, $row->token)) {
            return false;
        }

        $this->db->delete(static::$table_activation_tokens, ['user_id' => $this->id]);

        $this->activated = 1;

        $this->app->plugins->run('user.activate', $this);

        return $this->save();
    }

    /**
     * @internal
     */
    public function getRowByName(string $name) : ?object
    {
        return $this->db->selectRow($this->getTable(), ['code' => $name, 'code_crc32' => crc32($name)]);
    }

    /**
     * Loads a user by username
     * @param string $username The username
     * @return static
     */
    public function loadByUsername(string $username) : static
    {
        $data = $this->db->selectRow($this->getTable(), ['username_crc32' => strtolower(crc32($username)), 'username' => $username]);

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
        $data = $this->db->selectRow($this->getTable(), ['email_crc32' => strtolower(crc32($email)), 'email' => $email]);

        if (!$data) {
            return $this;
        }

        return $this->load($data, true);
    }
}
