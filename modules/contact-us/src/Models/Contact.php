<?php
namespace Modules\ContactUs\Models;

use Mars\Mvc\Models\Entity;

class Contact extends Entity
{
    /**
     * @internal
     */
    protected static array $validation_rules = [
        'name' => 'req',
        'email' => 'req|email',
        'message' => 'req'
    ];

    /**
     * @internal
     */
    protected static array $validation_error_strings = [
        'name' => ['req' => 'form.err.name'],
        'email' => ['req' => 'form.err.email', 'email' => 'form.err.email.invalid'],
        'message' => ['req' => 'form.err.message']
    ];

    /**
     * @internal
     */
    public string $name = '';

    /**
     * @internal
     */
    public string $email = '';

    /**
     * @internal
     */
    public string $phone = '';

    /**
     * @internal
     */
    public string $message = '';
}
