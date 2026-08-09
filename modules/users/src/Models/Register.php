<?php
namespace Modules\Users\Models;

use Mars\Mvc\Models\Entity;
use Modules\Users\User;

class Register extends Entity
{
    /**
     * @internal
     */
    protected static array $validation_rules = [
        'username' => 'req|username:5:100',
        'email' => 'req|email',
        'password_clean' => 'req|password',
        'agreement' => 'req'
    ];

    /**
     * @internal
     */
    protected static array $validation_error_strings = [
        'username' => ['req' => 'register.err.username', 'username' => 'register.err.username.invalid'],
        'email' => ['req' => 'register.err.email', 'email' => 'register.err.email.invalid'],
        'password_clean' => ['req' => 'register.err.password', 'password' => 'register.err.password.invalid'],
        'agreement' => ['req' => 'register.err.agreement'],
    ];

    /**
     * @internal
     */
    protected static string $table = 'users';

    /**
     * @internal
     */
    public string $username = '';

    /**
     * @internal
     */
    public string $email = '';

    /**
     * @internal
     */
    public string $password_clean = '';

    /**
     * @internal
     */
    public string $password_confirm = '';

    /**
     * @internal
     */
    public bool $agreement = false;

    /**
     * @internal
     */
    public ?User $user = null;

    /**
     * Handles the registration process
     * @return bool True if registration is successful, false otherwise
     */
    public function register() : bool
    {
        if (!$this->config->users->registration->show_agreement) {
            $this->setValidationRulesToSkip('agreement');
        }

        if (!$this->validate()) {
            return false;
        }

        $this->user = new User;
        $this->user->bindList(['username', 'email', 'password_clean'], $this);
        if (!$this->user->save()) {
            $this->errors = $this->user->errors;

            return false;
        }
        
        return true;
    }

    /**
     * Validates the registration data
     * @return bool True if data is valid, false otherwise
     */
    public function validate(array|object $data = []) : bool
    {
        $ok = true;
        if (!parent::validate()) {
            $ok = false;
        }

        if ($this->password_clean != $this->password_confirm) {
            $this->errors->add($this->__('register.err.password.mismatch'));
            $ok = false;
        }

        return $ok;
    }

    /**
     * Activates the user account
     * @param string $uuid The user's UUID
     * @param string $key The activation key
     * @return bool True if activation is successful, false otherwise
     */
    public function activate(string $uuid, string $key) : bool
    {
        $this->user = new User($uuid);
        return $this->user->activate($key);
    }
}
