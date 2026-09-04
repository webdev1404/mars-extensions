<?php
namespace Modules\Users\Models;

use Mars\Mvc\Models\Entity;

class Account extends Register
{
    /**
     * @internal
     */
    protected static array $validation_rules = [
        'username' => 'req|username:5:100',
        'email' => 'req|email',
        'password_current' => 'req',
    ];

    /**
     * @internal
     */
    protected static array $validation_error_strings = [
        'username' => ['req' => 'register.err.username', 'username' => 'register.err.username.invalid'],
        'email' => ['req' => 'register.err.email', 'email' => 'register.err.email.invalid'],
        'password_current' => ['req' => 'account.err.password.current'],
    ];

    /**
     * @internal
     */
    public string $password_current = '';

    /**
     * Updates the account information for the current user
     * @return bool True if the update is successful, false otherwise
     */
    public function update() : bool
    {
        if (!$this->validate()) {
            return false;
        }

        $bind_list = ['password_clean'];
        if (!$this->app->config->users->account->username->readonly) {
            $bind_list[] = 'username';
        }

        $this->app->user->bindList($bind_list, $this);
        if (!$this->app->user->update()) {
            $this->errors = $this->app->user->errors;

            return false;
        }

        return true;
    }

    /**
     * Validates the user data
     * @return bool True if data is valid, false otherwise
     */
    public function validate(array|object $data = []) : bool
    {
        $ok = true;
        if (!Entity::validate()) {
            $ok = false;
        }

        //verify if the current password is correct
        if ($this->password_current && !$this->app->user->verifyPassword($this->password_current)) {
            $this->errors->add($this->__('account.err.password.current.invalid'));
            $ok = false;
        }

        if ($this->password_clean) {
            if ($this->password_clean != $this->password_confirm) {
                $this->errors->add($this->__('register.err.password.mismatch'));
                $ok = false;
            }
        }

        return $ok;
    }

    /**
     * Checks if the email needs to be updated
     * @return bool True if the email needs to be updated, false otherwise
     */
    public function canUpdateEmail() : bool
    {
        if ($this->app->config->users->account->email->readonly) {
            return false;
        }

        if ($this->app->user->email == $this->email) {
            return false;
        }

        $email_exists = $this->app->db->exists('users', ['email_crc32' => crc32(strtolower($this->email)), 'email' => $this->email]);
        if ($email_exists) {
            $this->errors->add($this->__('register.err.email.exists', ['{FIELD}' => 'email']), 'email', 'email.exists');

            return false;
        }

        return true;
    }

    /**
     * Updates the email address for the current user using the provided token
     * @param string $token The email update token
     * @return bool True if the email update is successful, false otherwise
     */
    public function updateEmail(string $token) : bool
    {
        if (!$this->app->user->updateEmail($token)) {
            $this->errors = $this->app->user->errors;

            return false;
        }

        return true;
    }

    public function logout() : bool
    {
        return $this->app->user->logout();
    }
}
