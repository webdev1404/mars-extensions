<?php

namespace Modules\Users\Controllers;

use Mars\Mvc\Controller;

class Register extends Controller
{
    /**
     * @internal
     */
    public protected(set) string $default_method = 'form';

    /**
     * Initializes the controller
     */
    protected function init()
    {
        $this->loadConfig();
        $this->loadLanguage();
    }
    
    /**
     * Displays the registration form
     */
    public function form()
    {
        if ($this->config->user->register->registration->closed) {
            return $this->registrationClosed();
        }

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
        if ($this->config->user->register->registration->closed) {
            return false;
        }

        if (!$this->model->register()) {
            $this->plugins->run('user_register_error', $this->model);

            return false;
        }

        $this->sendEmail();

        //// !!!! Send email to admins about new registration !!!!

        $this->plugins->run('user_register_success', $this->model);

        $this->app->message($this->__('success'));

        return;
    }

    /**
     * Handles registration closed scenario
     */
    protected function registrationClosed()
    {       
        $this->view->render(__METHOD__);
    }

    /**
     * Sends an email to the user with the activation link
     */
    protected function sendEmail()
    {
        $activation_link = $this->url->base->get(['activate', $this->model->user->id, $this->model->user->activation_code]);

        $email = $this->model->user->email;
$email = 'razvan@localhost.com';        
        $body = $this->view->getEmailTemplate('emails/activation', ['user' => $this->model->user, 'activation_link' => $activation_link]);
        $subject = $this->view->getData('subject');

        $this->plugins->run('user_register_send_email', $email, $subject, $body, $this);

        $this->mail->send($email, $subject, $body);
    }

    /**
     * Displays the registration agreement
     */
    public function registrationAgreement()
    {
        if ($this->config->user->register->registration->closed) {
            return $this->registrationClosed();
        }

        $this->view->render();
    }

    /**
     * Handles account activation
     * @param int $id User ID
     * @param string $code Activation code
     */
    public function activate(int $id, string $code)
    {
        if (!$id || !$code) {
            $this->app->error($this->__('err_activation_params'));

            return;
        }

        $this->model->load($id);
        if (!$this->model->id) {
            //invalid user id
            $this->app->error($this->__('err_activation_params'));

            return;
        }
        if ($this->model->activated) {
            //already activated
            $this->app->message($this->__('activation_success'));

            return;
        }
die("wwww");

        if (!$this->model->activate($id, $code)) {
            /*$this->app->message($this->__('err_activation_failed'), 'error');

            $this->view->render();

            return;*/
        }

        $this->app->message($this->__('activation_success'));

        $this->view->render();
    }
}
