<?php

namespace Modules\Users\Controllers;

use Modules\Users\User;

class Register extends Users
{
    /**
     * @internal
     */
    public protected(set) string $model_class = \Modules\Users\Models\Register::class;

    /**
     * @internal
     */
    public protected(set) bool $accept_json = true;

    /**
     * @internal
     */
    public protected(set) array $targets = [
        'register' => 'form',
        'resendActivationCode' => 'resendActivationForm',
    ];

    /**
     * Displays the registration form
     */
    public function form()
    {
        if (!$this->config->users->registration->open) {
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
        if (!$this->config->users->registration->open) {
            return false;
        }

        $this->model->bindList(['username', 'email', 'password_clean', 'password_confirm', 'agreement']);

        if (!$this->canPost(
            $this->config->users->registration->captcha->show,
            $this->config->users->registration->throttle->enable ? 'users.register' : null,
            $this->config->users->registration->throttle->max_attempts,
            $this->config->users->registration->throttle->block_duration
        )) {
            return false;
        }

        if (!$this->model->register()) {
            $this->plugins->run('user.register.error', $this->model, $this);

            if ($this->model->errors->count() == 1 && $this->model->errors->hasCode('email.exists')) {
                // the email already exists and there are no other errors
                // send no indication to the user for security reasons, but resend the activation email if the email belongs to an unactivated account
                // if the account is already activated, send an email with the username and a password reset link

                if ($this->config->users->registration->notify->same_email) {
                    $user = $this->getUserByEmail($this->model->email);

                    if ($user) {
                        if (!$user->activated) {
                            $this->sendActivationEmail($user);
                        } else {
                            $this->sendAccountExistsEmail($user);
                        }
                    }
                }

                $this->app->message($this->__('register.success'));

                return;
            }

            $this->app->errors->set($this->model->errors->getExcept('email.exists'));

            return false;
        }

        $this->sendActivationEmail($this->model->user);
        $this->sendAdminNotificationEmail();

        $this->plugins->run('user.register.success', $this->model, $this);

        $this->app->message($this->__('register.success'));
    }

    /**
     * Handles registration closed scenario
     */
    protected function registrationClosed()
    {
        return $this->view->getTemplateByLanguage('text', 'registration-closed');
    }

    /**
     * Sends an email to the user with the activation link
     * @param User $user The user to send the email to
     */
    protected function sendActivationEmail(User $user)
    {
        $activation_url = $this->url->route('users.register.activate', ['uuid' => $user->uuid, 'token' => $user->getActivationToken()]);

        $email = $user->email;
        $body = $this->email->get('activation', ['user' => $user, 'activation_url' => $activation_url]);
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

        $this->plugins->run('user.register.send_account_exists_email', $email, $subject, $body, $this);

        $this->mail->send($email, $subject, $body);
    }

    /**
     * Sends notification email to admin about new registration
     */
    protected function sendAdminNotificationEmail()
    {
        if (!$this->config->users->registration->notify->enable) {
            return;
        }

        $emails = $this->config->users->registration->notify->emails;
        if (!$emails) {
            $emails = $this->config->site->emails;
        }

        $body = $this->email->get('notification', ['user' => $this->model->user]);
        $subject = $this->email->subject;

        $this->plugins->run('user.register.send_notification_email', $emails, $subject, $body, $this);

        $this->mail->send($emails, $subject, $body);
    }

    /**
     * Displays the registration agreement
     */
    public function registrationAgreement()
    {
        if (!$this->config->users->registration->open) {
            return $this->registrationClosed();
        }
        
        $this->view->renderByLanguage('text', 'registration-agreement');
    }

    /**
     * Displays the resend activation form
     */
    public function resendActivationForm()
    {
        $this->plugins->run('user.register.resend_activation_form', $this);
        
        $this->view->render('resend-activation-form');
    }

    /**
     * Handles the resend activation form submission
     */
    public function resendActivationCode()
    {
        if (!$this->canPost(
            $this->config->users->registration->captcha->show,
            $this->config->users->registration->throttle->enable ? 'users.register' : null,
            $this->config->users->registration->throttle->max_attempts,
            $this->config->users->registration->throttle->block_duration
        )) {
            return false;
        }

        if (!$this->validate(['email' => 'req|email'], ['email' => ['req' => 'register.err.email', 'email' => 'register.err.email.invalid']])) {
             $this->app->errors->set($this->errors);

            return false;
        }

        $user = $this->getUserByEmail($this->post->get('email'));
        if ($user) {
            if (!$user->activated) {
                $this->sendActivationEmail($user);
            }
        }

        $this->plugins->run('user.register.resend_activation_code', $user, $this);

        $this->app->messages->add($this->__('register.resend_activation.success'));

        return true;
    }

    /**
     * Handles account activation
     * @param string $uuid The user's UUID
     * @param string $token The activation token
     */
    public function activate(string $uuid, string $token)
    {
        if (!$uuid || !$token) {
            $this->app->error($this->__('register.err.activation.params'));

            return;
        }

        if (!$this->model->activate($uuid, $token)) {
            $this->plugins->run('user.activate.failed', $this->model, $this);

            $this->app->error($this->__('register.activation.failed'));

            return;
        }

        $this->plugins->run('user.activate.success', $this->model, $this);

        $this->app->message($this->__('register.activation.success'));
    }
}
