<?php
namespace Modules\Users\Models;

use Mars\Mvc\Models\Entity;

class Login extends Entity
{
    /**
     * @internal
     */
    protected static array $validation_rules = [
        'username' => 'req',
        'password' => 'req'
    ];

    /**
     * @internal
     */
    protected static array $validation_error_strings = [
        'username' => ['req' => 'login.err.username'],
        'password' => ['req' => 'login.err.password']
    ];

    /**
     * @internal
     */
    public string $username = '';

    /**
     * @internal
     */
    public string $password = '';

    /**
     * @internal
     */
    public bool $remember_me {
        get {
            if (isset($this->remember_me)) {
                return $this->remember_me;
            }

            $this->remember_me = $this->app->config->users->login->remember_me->checked;

            return $this->remember_me;
        }
    }

    /**
     * Handles the login process
     * @return bool True if login is successful, false otherwise
     */
    public function login() : bool
    {
        if (!$this->validate()) {
            return false;
        }

        $remember_me = $this->app->config->users->login->remember_me->show ? $this->remember_me : $this->app->config->users->login->remember_me->default;

        if (!$this->app->user->login($this->username, $this->password, $remember_me)) {
            $this->errors->add($this->__('login.err.invalid'));

            return false;
        }

        return true;
    }
}
