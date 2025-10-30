<?php

namespace Modules\Users\Blocks\Register\Controllers;

use Mars\Mvc\Controller;

class Register extends Controller
{
    /**
     * @internal
     */
    public protected(set) string $default_method = 'form';

    /**
     * Displays the registration form
     */
    public function form()
    {
        $this->model->load();

        $this->plugins->run('user_register_form', $this->model);

        $this->view->render();
    }

    /**
     * Handles the registration form submission
     */
    public function register()
    {
        $this->accept_json = true;

        $this->model->bindList(['username', 'email', 'password_clean', 'password_confirm']);

        if (!$this->request->canPost()) {
            return false;
        }

        if (!$this->model->register()) {
            $this->plugins->run('user_register_error', $this->model);

            return false;
        }

        $this->sendEmail();

        $this->plugins->run('user_register_success', $this->model);

        $this->messages->add($this->__('success'));

        $this->model->reset();

        return true;
    }

    /**
     * Sends an email to the user with the activation link
     */
    protected function sendEmail()
    {
        $activation_link = $this->url->base->get('activate', ['id' => $this->model->user->id, 'code' => $this->model->user->activation_code]);

        $email = $this->model->user->email;
        $body = $this->view->getEmailTemplate('emails/activation', ['user' => $this->model->user, 'activation_link' => $activation_link]);
        $subject = $this->view->getData('subject');

        $this->plugins->run('user_register_send_email', $email, $subject, $body, $this);

        $this->mail->send($email, $subject, $body);
    }
}
