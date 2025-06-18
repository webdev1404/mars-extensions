<?php
namespace Modules\ContactUs\Blocks\Form\Models;

use Mars\App;
use Mars\MVC\Models\Entity;

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
    ];

    public function send()
    {
        var_dump($this->parent->params);die;
        if (!$this->validate()) {
            return false;
        }
        
        //if (!isset($this->config->))

        /*$emails = [];
        if($venus->config->contact_emails)
        {
            $emails = explode(',', $venus->config->contact_emails);
            $emails = $venus->filter->trim($emails);
        }
        

        $subject = l('contact_us_str6') . $message_data['subject'];
        $message = 	$venus->text->parse($message_data['message']);

        $venus->plugins->run('contact_us_model_send', $subject, $message, $emails, $message_data);

        $venus->mail($emails, $subject, $message, $message_data['email'], $message_data['from']);
        */

        return true;
    }

    }