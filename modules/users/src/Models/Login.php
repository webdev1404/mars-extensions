<?php
namespace Modules\Users\Models;

use Mars\App;
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
    public bool $remember_me = false;

    /**
     * Handles the login process
     * @return bool True if login is successful, false otherwise
     */
    public function login() : bool
    {
        var_dump($this->username, $this->password, $this->remember_me);
        if (!$this->validate()) {
            return false;
        }

        if (!$this->app->user->login($this->username, $this->password)) {
            $this->errors->add($this->__('login.err.invalid'));

            return false;
        }

        return true;
    }
}
