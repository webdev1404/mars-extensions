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
     * Sends the contact us message to the configured emails
     */
    public function send()
    {
        if (!$this->validate()) {
            return false;
        }

        $emails = $this->getEmails();
        if (!$emails) {
            throw new \Exception('No contact emails configured. Please set the contact emails in the config or in the block settings.');
        }

        $subject = $this->app->lang->get('title', ['{SITE_NAME}' => $this->app->config->site_name]);
        $template = $this->parent->path . '/templates/mail.php';
        
        $this->plugins->run('contact_us_model_send', $emails, $subject, $template, $this);

        $this->app->mail->sendTemplate($emails, $subject, $template, ['sender' => $this], ['from' => $this->email, 'from_name' => $this->from]);

        return true;
    }

    /**
     * Returns the emails where the contact us messages will be sent
     * @return array The emails
     */
    protected function getEmails(): array
    {
        $emails = $this->parent->params['emails'] ?? [];
        if (!$emails) {
            $emails = $this->config->contact_emails ?? [];
        }

        return $this->app->array->get($emails);
    }
}
