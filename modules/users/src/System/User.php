<?php
/**
* The System User Class
* @package Mars
*/

namespace Modules\Users\System;

/**
 * The System User Class
 */
class User extends \Modules\Users\User
{
    /**
     * @var bool $is_logged Indicates whether the user is logged in
     */
    public bool $is_logged {
        get => (bool) $this->app->user->id;
    }

    /**
     * Logs a user by username and password
     * @param string $username The username
     * @param string $password The password
     * @return bool True if login is successful, false otherwise
     */
    public function login(string $username, string $password) : bool
    {
        $this->loadByUsername($username);
        if (!$this->id) {
            return false;
        }
var_dump($this->password);die;
        return $this->app->security->verifyPassword($password, $this->password);
    }
}
