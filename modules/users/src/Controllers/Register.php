<?php

namespace Modules\Users\Controllers;

use Mars\Mvc\Controller;
use Modules\Users\User;

class Register extends Controller
{
    /**
     * @internal
     */
    public protected(set) string $default_method = 'form';

    /**
     * @internal
     */
    public protected(set) bool $accept_json = true;

    /**
     * Initializes the controller
     */
    protected function init()
    {
        $this->loadConfig('user');
        $this->loadLanguage();
    }
    
    /**
     * Displays the registration form
     */
    public function form()
    {
        if (!$this->config->user->registration->open) {
            return $this->registrationClosed();
        }

        $this->plugins->run('user.register.form', $this->model, $this);

        $this->view->render();
    }

    /**
     * Handles the registration form submission
     */
    public function register()
    {
        $this->model->bindList(['username', 'email', 'password_clean', 'password_confirm', 'agreement']);
        
        if (!$this->config->user->registration->open) {
            return false;
        }

        if (!$this->canPost(
            $this->config->user->registration->show_captcha,
            $this->config->user->registration->throttle->enable ? 'users.register' : null,
            $this->config->user->registration->throttle->max_attempts,
            $this->config->user->registration->throttle->block_duration
        )) {
            return false;
        }

        if (!$this->model->register()) {
            $this->plugins->run('user.register.error', $this->model, $this);

            if ($this->model->errors->count() == 1 && $this->model->errors->hasCode('email.exists')) {
                // the email already exists and there are no other errors
                // send no indication to the user for security reasons, but resend the activation email if the email belongs to an unactivated account
                // if the account is already activated, send an email with the username and a password reset link

                if ($this->config->user->registration->notify->same_email) {
                    $user = $this->model->getUserByEmail();

                    if ($user) {
                        if (!$user->activated) {
                            $user->createActivationKey();

                            $this->sendActivationEmail($user);
                        } else {
                            $this->sendAccountExistsEmail($user);
                        }
                    }
                }

                $this->app->message($this->__('success'));

                return;
            }

            $this->app->errors->set($this->model->errors->getExcept('email.exists'));

            return false;
        }

        $this->sendActivationEmail($this->model->user);
        $this->sendAdminNotificationEmail();

        $this->plugins->run('user.register.success', $this->model, $this);

        $this->app->message($this->__('success'));
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
     * @param User $user The user to send the email to
     */
    protected function sendActivationEmail(User $user)
    {
        $activation_link = $this->url->route('users.register.activate', ['code' => $user->code, 'key' => $user->activation_key]);

        $email = $user->email;
        $body = $this->email->get('activation', ['user' => $user, 'activation_link' => $activation_link]);
        $subject = $this->email->subject;

        $this->plugins->run('user.register.send.activation.email', $email, $subject, $body, $this);

        $this->mail->send($email, $subject, $body);
    }

    /**
     * Sends an email to the user notifying them of a registration attempt with an existing email
     * @param User $user The user to send the email to
     */
    protected function sendAccountExistsEmail(User $user)
    {
        $email = $user->email;
        $body = $this->email->get('account-exists', ['user' => $user]);
        $subject = $this->email->subject;

        $this->plugins->run('user.register.send.account.exists.email', $email, $subject, $body, $this);

        $this->mail->send($email, $subject, $body);
    }

    /**
     * Sends notification email to admin about new registration
     */
    protected function sendAdminNotificationEmail()
    {
        if (!$this->config->user->registration->notify->enable) {
            return;
        }

        $emails = $this->config->user->registration->notify->emails;
        if (!$emails) {
            $emails = $this->config->site->emails;
        }

        $body = $this->email->get('notification', ['user' => $this->model->user]);
        $subject = $this->email->subject;

        $this->plugins->run('user.register.send.notification.email', $emails, $subject, $body, $this);

        $this->mail->send($emails, $subject, $body);
    }

    /**
     * Displays the registration agreement
     */
    public function registrationAgreement()
    {
        if (!$this->config->user->registration->open) {
            return $this->registrationClosed();
        }
        
        $this->view->render();
    }

    /**
     * Displays the resend activation form
     */
    public function resendActivationForm()
    {
        $this->view->render(__METHOD__);
    }

    /**
     * Handles the resend activation form submission
     */
    public function resendActivationCode()
    {
        $this->model->bindList(['email']);

        if (!$this->canPost(
            $this->config->user->registration->show_captcha,
            $this->config->user->registration->throttle->enable ? 'users.register' : null,
            $this->config->user->registration->throttle->max_attempts,
            $this->config->user->registration->throttle->block_duration
        )) {
            return false;
        }

        $user = $this->model->getUserByEmail();
        if ($user) {
            if (!$user->activated) {
                $user->createActivationKey();

                $this->sendActivationEmail($user);
            }
        }

        $this->app->message($this->__('resend_activation_success'));
    }

    /**
     * Handles account activation
     * @param string $code The user's code
     * @param string $key The activation key
     */
    public function activate(string $code, string $key)
    {
        if (!$code || !$key) {
            $this->app->error($this->__('err_activation_params'));

            return;
        }

        if (!$this->model->activate($code, $key)) {
            $this->plugins->run('user.activate.failed', $this->model, $this);

            $this->app->error($this->__('activation_failed'));

            return;
        }

        $this->plugins->run('user.activate.success', $this->model, $this);

        $this->app->message($this->__('activation_success'));
    }
}