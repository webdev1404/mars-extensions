<?php
/**
* The System User Class
* @package Mars
*/

namespace Modules\Users\System;

use Mars\App;

/**
 * The System User Class
 */
class User extends \Modules\Users\User
{
    /**
     * @internal
     */
    protected static string $table_login_tokens = 'users_login_tokens';

    /**
     * @internal
     */
    protected static string $cookie_remember_me = 'user-remember-me';

    /**
     * @var bool $is_logged Indicates whether the user is logged in
     */
    public bool $is_logged {
        get => (bool) $this->id;
    }

    /**
     * @internal
     */
    protected static array $ignore = ['is_logged', 'password_clean'];

    /**
     * Builds the System User object, initializing it with session data or a remember me cookie if available
     */
    public function __construct($data = 0, ?App $app = null)
    {
        parent::__construct($data, $app);

        $user = $this->app->session->get('user');

        if ($user) {
            $this->setProperties($user);
        } else {
            //do we have a remember me cookie?
            $cookie = $this->app->request->cookie->get(static::$cookie_remember_me);
            if ($cookie) {
                $this->readRememberMe($cookie);
            }
        }
    }

    /**
     * Logs a user by username and password
     * @param string $username The username
     * @param string $password The password
     * @param bool $remember_me Whether to remember the user for future logins
     * @return bool True if login is successful, false otherwise
     */
    public function login(string $username, string $password, bool $remember_me) : bool
    {
        $this->loadByUsername($username);

        if (!$this->id) {
            return false;
        }
        if (!$this->status || !$this->activated) {
            return false;
        }
        if (!$this->app->hasher->verifyPassword($password, $this->password)) {
            return false;
        }

        $this->setSession();
  
        if ($remember_me) {
            $this->setRememberMe();
        }

        return true;
    }

    /**
     * Sets the session data for the user
     */
    protected function setSession()
    {
        $user = $this->getProperties($this);
        unset($user['password']);

        $this->app->session->regenerateId();
        $this->app->session->set('user', $user);
    }

    /**
     * Sets a "remember me" cookie for the user and stores the corresponding token in the database
     * @param int $id The token ID, defaults to 0 (new token)
     */
    protected function setRememberMe(int $id = 0)
    {
        $selector = $this->app->random->getString();
        $validator = $this->app->random->getString();

        $hashed_validator = $this->app->hasher->getToken($validator);

        $now = time();
        $expires_at = $now + $this->app->config->users->login->remember_me->duration;

        $data = [
            'user_id' => $this->id,
            'selector' => $selector,
            'selector_crc32' => crc32($selector),
            'token' => $hashed_validator,
            'expires_at' => $expires_at,
            'updated_at' => $now,
            'ip' => ['function' => 'INET6_ATON', 'value' => $this->app->ip],
            'user_agent' => $this->app->user_agent,
        ];
        
        if ($id) {
            $this->db->updateById(static::$table_login_tokens, $data, $id);
        } else {
            $data['created_at'] = $now;

            $this->db->insert(static::$table_login_tokens, $data);
        }

        $this->app->response->cookie->set(static::$cookie_remember_me, $selector . ':::' . $validator, $expires_at, secure: true, httponly: true);
    }

    /**
     * Reads the "remember me" cookie and attempts to log in the user automatically if the cookie is valid
     * @param string $cookie The value of the "remember me" cookie
     */
    protected function readRememberMe(string $cookie)
    {
        $parts = explode(':::', $cookie, 2);
        if (count($parts) != 2) {
            $this->deleteRememberMe();
            return;
        }

        $now = time();
        [$selector, $validator] = $parts;

        $data = $this->db->selectRow(static::$table_login_tokens, ['selector' => $selector, 'selector_crc32' => crc32($selector)]);
        if (!$data) {
            //invalid selector
            $this->deleteRememberMe();
            return;
        }

        if ($data->expires_at < $now) {
            //token has expired
            $this->deleteRememberMe($data->id);
            return;
        }

        if (!$this->app->hasher->verifyToken($validator, $data->token)) {
            //invalid validator
            $this->deleteRememberMe($data->id);
            return;
        }

        $user = $this->db->selectRow($this->getTable(), ['id' => $data->user_id]);
        if (!$user) {
            //user not found
            $this->deleteRememberMe($data->id);
            return;
        }

        if (!$user->status || !$user->activated) {
            //user is not active or not activated
            $this->deleteRememberMe($data->id);
            return;
        }
        
        //delete the expired login tokens for this user
        $this->db->delete(static::$table_login_tokens, ['user_id' => $user->id, 'expires_at' => ['value' => $now, 'operator' => '<']]);

        //set the session data
        $user = (array) $user;
        $user['loaded'] = true;
        unset($user['password']);

        $this->app->session->regenerateId();
        $this->app->session->set('user', $user);

        $this->setProperties($user);

        $this->setRememberMe($data->id);
    }

    /**
     * Deletes the "remember me" cookie and deletes the corresponding token from the database, if an ID is provided
     * @param int $id The token ID
     */
    protected function deleteRememberMe(int $id = 0)
    {
        $this->app->response->cookie->delete(static::$cookie_remember_me);

        if ($id) {
            $this->db->delete(static::$table_login_tokens, ['id' => $id]);
        }
    }

    /**
     * @internal
     */
    public function update() : int
    {
        $this->plugins->run('app.user.update.before', $this);
        
        $ret = parent::update();

        if (!$ret) {
            return $ret;
        }

        $this->setSession();

        $this->plugins->run('app.user.update.after', $this);

        return $ret;
    }

    /**
     * @internal
     */
    public function updateEmail(string $token) : bool
    {
        $ret = parent::updateEmail($token);

        if (!$ret) {
            return $ret;
        }

        $this->setSession();

        return true;
    }

    /**
     * Logs out the user
     */
    public function logout() : bool
    {
        if (!$this->id) {
            return true;
        }

        $this->app->session->unset('user');
        $this->deleteRememberMe();
        
        return true;
    }
}
