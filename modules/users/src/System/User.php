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

        return $this->app->security->verifyPassword($password, $this->password);
    }
}
