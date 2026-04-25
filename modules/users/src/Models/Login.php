<?php
namespace Modules\Users\Models;

use Mars\App;
use Mars\Mvc\Models\Entity;
use Modules\Users\System\User;

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
        'username' => ['req' => 'err_username'],
        'password' => ['req' => 'err_password']
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
     * Handles the login process
     * @return bool True if login is successful, false otherwise
     */
    public function login() : bool
    {
        $user = new User;
        return $user->login($this->username, $this->password);
    }
}
