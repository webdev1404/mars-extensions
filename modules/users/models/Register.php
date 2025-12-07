<?php
namespace Modules\Users\Models;

use Mars\App;
use Mars\User;
use Mars\Mvc\Models\Item;

class Register extends Item
{
    /**
     * @internal
     */
    protected static array $validation_rules = [
        'password_clean' => 'req|password'
    ];

    /**
     * @internal
     */
    protected static array $validation_error_strings = [
        'username' => ['req' => 'err_username', 'username' => 'err_username_invalid'],
        'email' => ['req' => 'err_email', 'email' => 'err_email_invalid'],
        'password_clean' => ['req' => 'err_password', 'password' => 'err_password_invalid'],
    ];

    /**
     * @internal
     */
    protected static string $table = 'users';

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
    public User $user;

    /**
     * Handles the registration process
     */
    public function register()
    {
        $this->user = new User;
        $this->user->bindList(['username', 'email', 'password_clean'], $this);
        $this->user->setValidationRulesToSkip(['password']);
        $this->user->setValidationErrorStrings(static::$validation_error_strings);

        if (!$this->validate()) {
            return false;
        }

        if (!$this->user->save()) {
            $this->app->errors->add($this->user->errors);

            return false;
        }
        
        return true;
    }

    /**
     * @internal
     */
    public function validate(array|object $data = []) : bool
    {
        $ok = true;
        if (!$this->user->validate($data)) {
            $this->app->errors->add($this->user->errors);

            $ok = false;
        }

        if (!parent::validate()) {
            $ok = false;
        }

        if ($this->password_clean != $this->password_confirm) {
            $this->app->errors->add($this->__('err_password_mismatch'));
            $ok = false;
        }

        return $ok;
    }
}
