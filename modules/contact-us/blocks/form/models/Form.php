<?php
namespace Modules\ContactUs\Blocks\Form\Models;

use Mars\App;
use Mars\Mvc\Models\Entity;

class Form extends Entity
{
    public string $name = '';
    public string $email = '';
    public string $from = '';
    public string $subject = '';
    public string $message = '';

    /**
     * @internal
     */
    protected static array $validation_rules = [
        'email' => 'req|email',
        'from' => 'req',
        'subject' => 'req',
        'message' => 'req',
        'captcha' => 'captcha'
    ];

    /**
     * @internal
     */
    protected static array $validation_error_strings = [
        'email' => ['req' => 'err_email', 'email' => 'err_email_invalid'],
        'from' => ['req' => 'err_from'],
        'subject' => ['req' => 'err_subject'],
        'message' => ['req' => 'err_message'],
        'captcha' => ['captcha' => 'err_captcha']
    ];
}
