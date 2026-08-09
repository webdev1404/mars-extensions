<?php
namespace Modules\Users\Models;

use Mars\Mvc\Models\Entity;
use Modules\Users\User;

class Forgot extends Entity
{
    /**
     * @internal
     */
    protected static array $validation_rules = [
        'password_clean' => 'req|password',
    ];

    /**
     * @internal
     */
    protected static array $validation_error_strings = [
        'password_clean' => ['req' => 'forgot.err.password', 'password' => 'forgot.err.password.invalid'],
    ];

    /**
     * @internal
     */
    public string $password_clean = '';

    /**
     * @internal
     */
    public string $password_confirm = '';

    /**
     * Updates the user's password
     * @param User $user The user object
     * @return bool True if the password was updated successfully, false otherwise
     */
    public function updatePassword(User $user) : bool
    {
        if (!$this->validate()) {
            return false;
        }

        return $user->updatePassword($this->password_clean);
    }

    /**
     * Validates the forgot password data
     * @return bool True if data is valid, false otherwise
     */
    public function validate(array|object $data = []) : bool
    {
        $ok = true;
        if (!parent::validate()) {
            $ok = false;
        }

        if ($this->password_clean != $this->password_confirm) {
            $this->errors->add($this->__('forgot.err.password.mismatch'));
            $ok = false;
        }

        return $ok;
    }
}
