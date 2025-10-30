<?php

namespace Modules\ContactUs\Blocks\Form\Controllers;

use Mars\Mvc\Controller;

class Form extends Controller
{
    /**
     * Displays the contact form
     */
    public function form()
    {
        $this->plugins->run('contact_us_form', $this->model);

        $this->view->render();
    }

    /**
     * Sends the contact form
     */
    public function send()
    {
        $this->accept_json = true;
        
        $this->model->bind();

        if (!$this->request->canPost()) {
            return false;
        }

        if (!$this->model->validate()) {
            $this->plugins->run('contact_us_send_error', $this->model);

            return false;
        }

        $this->sendEmail();

        $this->plugins->run('contact_us_send_success', $this->model);

        $this->messages->add($this->__('success'));

        $this->model->reset();

        return true;
    }

    /**
     * Sends an email to the admin notifying about the new contact us message
     */
    protected function sendEmail()
    {
        $emails = $this->getEmails();
        if (!$emails) {
            throw new \Exception('No contact emails configured. Please set the contact emails in the config or in the block settings.');
        }

        $subject = $this->__('title', ['{SITE_NAME}' => $this->app->config->site_name]);
        $template = $this->parent->path . '/templates/mail.php';

        $this->plugins->run('contact_us_send_email', $emails, $subject, $template, $this);

        $this->app->mail->sendTemplate($emails, $subject, $template, ['sender' => $this->model], ['from' => $this->model->email, 'from_name' => $this->model->from]);

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
            $emails = $this->config->contact_emails ?? ($this->config->site_emails ?? []);
        }

        return $this->app->array->get($emails);
    }
}
