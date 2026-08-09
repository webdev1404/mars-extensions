<?php

namespace Modules\Users\Controllers;

use Mars\Mvc\Controller;
use Modules\Users\User;

abstract class Users extends Controller
{
    /**
     * 
     */
    protected function before()
    {
        if ($this->app->user->is_logged) {
            //$this->app->response->redirect($this->app->router->getUrl('home'));
        }
    }

    /**
     * Retrieves a user by UUID
     * @param string $uuid The UUID to search for
     * @return User|null The user if found, null otherwise
     */
    public function getUserByUuid(string $uuid) : ?User
    {
        $user = new User($uuid);
        
        return $user->exists() ? $user : null;
    }

    /**
     * Retrieves a user by email
     * @param string $email The email to search for
     * @return User|null The user if found, null otherwise
     */
    public function getUserByEmail(string $email) : ?User
    {
        $user = new User;
        $user->loadByEmail($email);
        
        return $user->exists() ? $user : null;
    }
}
