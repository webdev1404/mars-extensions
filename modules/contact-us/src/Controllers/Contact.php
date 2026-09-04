<?php

namespace Modules\ContactUs\Controllers;

use Mars\Mvc\Controller;

class Contact extends Controller
{
    /**
     * @internal
     */
    public protected(set) string $model_class = \Modules\ContactUs\Models\Contact::class;

    /**
     * @internal
     */
    public protected(set) bool $accept_json = true;

    /**
     * @internal
     */
    public protected(set) array $targets = [
        'send' => 'form'
    ];
    
    /**
     * Displays the login form
     */
    public function form()
    {
        $this->plugins->run('contact.form', $this);

        $this->view->render();
    }

    /**
     * Handles the contact form submission
     */
    public function send()
    {
        $this->model->bindList(['name', 'email', 'phone', 'message']);

        if (!$this->canPost(
            $this->config->contactUs->form->captcha->show,
            $this->config->contactUs->form->throttle->enable ? 'contactUs.form' : null,
            $this->config->contactUs->form->throttle->max_attempts,
            $this->config->contactUs->form->throttle->block_duration
        )) {
            return false;
        }

        if (!$this->model->validate()) {
            $this->plugins->run('contact.form.error', $this->model, $this);

            $this->app->errors->set($this->model->errors);

            return false;
        }
        
        $this->plugins->run('contact.form.success', $this->model, $this);

        $this->sendEmail();

        $this->app->messages->add($this->__('form.success'));

        return true;
    }

    /**
     * Sends the email
     */
    protected function sendEmail()
    {
        $emails = $this->config->contactUs->form->emails;
        if (!$emails) {
            $emails = $this->config->site->emails;
        }

        $body = $this->email->get('message', ['message' => $this->model]);
        $subject = $this->email->subject;

        $this->plugins->run('contact.form.send', $emails, $subject, $body, $this);

        $this->mail->send($emails, $subject, $body, ['reply_to' => $this->model->email, 'reply_to_name' => $this->model->name]);
    }
}
