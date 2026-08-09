<?php

namespace Modules\Users\Controllers;

use Modules\Users\User;

class Forgot extends Users
{
    /**
     * @internal
     */
    public protected(set) string $model_class = \Modules\Users\Models\Forgot::class;

    /**
     * @internal
     */
    public protected(set) bool $accept_json = true;

    /**
     * @internal
     */
    public protected(set) array $targets = [
        'forgotUsername' => 'formUsername',
        'forgotPassword' => 'formPassword'
    ];
    
    /**
     * Displays the forgot username form
     */
    public function formUsername()
    {
        $this->plugins->run('user.forgot.username.form', $this);

        $this->view->render('form-username');
    }

    /**
     * Handles the forgot username request
     */
    public function forgotUsername()
    {
        if (!$this->canPost(
            $this->config->users->forgot->captcha->show,
            $this->config->users->forgot->throttle->enable ? 'users.forgot' : null,
            $this->config->users->forgot->throttle->max_attempts,
            $this->config->users->forgot->throttle->block_duration
        )) {
            return false;
        }

        if (!$this->validate(['email' => 'req|email'], ['email' => ['req' => 'forgot.err.email', 'email' => 'forgot.err.email.invalid']])) {
            $this->app->errors->set($this->errors);

            return false;
        }

        $user = $this->getUserByEmail($this->post->get('email'));
        if ($user) {
            $this->sendForgotUsernameEmail($user);
        }

        $this->plugins->run('user.forgot.username', $user, $this);

        $this->app->messages->add($this->__('forgot.username.success'));

        return true;
    }

    /**
     * Sends the forgot username email to the user
     * @param User $user The user
     */
    protected function sendForgotUsernameEmail(User $user)
    {
        $email = $user->email;
        $body = $this->email->get('username', ['user' => $user]);
        $subject = $this->email->subject;

        $this->plugins->run('user.forgot.username.send_email', $email, $subject, $body, $this);

        $this->mail->send($email, $subject, $body);
    }

    /**
     * Displays the forgot password form
     */
    public function formPassword()
    {
        $this->plugins->run('user.forgot.password.form', $this);

        $this->view->render('form-password');
    }

    /**
     * Handles the forgot password request
     */
    public function forgotPassword()
    {
        if (!$this->canPost(
            $this->config->users->forgot->captcha->show,
            $this->config->users->forgot->throttle->enable ? 'users.forgot' : null,
            $this->config->users->forgot->throttle->max_attempts,
            $this->config->users->forgot->throttle->block_duration
        )) {
            return false;
        }

        if (!$this->validate(['email' => 'req|email'], ['email' => ['req' => 'forgot.err.email', 'email' => 'forgot.err.email.invalid']])) {
            $this->app->errors->set($this->errors);

            return false;
        }

        $user = $this->getUserByEmail($this->post->get('email'));
        if ($user) {
            $this->sendForgotPasswordEmail($user);
        }

        $this->plugins->run('user.forgot.password', $user, $this);

        $this->app->messages->add($this->__('forgot.password.success'));

        return true;
    }

    /**
     * Sends the forgot password email to the user
     * @param User $user The user
     */
    protected function sendForgotPasswordEmail(User $user)
    {
        $reset_url = $this->url->route('users.forgot.password.reset', ['uuid' => $user->uuid, 'token' => $user->getPasswordResetToken()]);

        $email = $user->email;
        $body = $this->email->get('password', ['user' => $user, 'reset_url' => $reset_url]);
        $subject = $this->email->subject;

        $this->plugins->run('user.forgot.password.send_email', $email, $subject, $body, $this);

        $this->mail->send($email, $subject, $body);
    }

    /**
     * Shows the reset password form
     * @param string $uuid The user's UUID
     * @param string $token The activation token
     */
    public function formResetPassword(string $uuid, string $token)
    {
        if (!$uuid || !$token) {
            $this->app->error($this->__('forgot.err.password.params'));

            return;
        }

        $user = $this->getUserByUuid($uuid);
        if (!$user) {
            $this->app->error($this->__('forgot.err.password.params'));

            return;
        }

        $is_valid = $user->verifyPasswordResetToken($token);
        if (!$is_valid) {
            $this->app->errors->add($this->__('forgot.err.password.reset'));
        }

        $this->plugins->run('user.forgot.password.form.reset', $user, $is_valid, $this);

        $this->view->render('form-reset-password', ['user' => $user, 'is_valid' => $is_valid]);
    }

    /**
     * Handles the password reset request
     * @param string $uuid The user's UUID
     * @param string $token The password reset token
     */
    public function resetPassword(string $uuid, string $token)
    {
        if (!$this->canPost(
            $this->config->users->forgot->captcha->show,
            $this->config->users->forgot->throttle->enable ? 'users.forgot' : null,
            $this->config->users->forgot->throttle->max_attempts,
            $this->config->users->forgot->throttle->block_duration
        )) {
            return $this->formResetPassword($uuid, $token);
        }

        if (!$uuid || !$token) {
            return $this->formResetPassword($uuid, $token);
        }

        $user = $this->getUserByUuid($uuid);
        if (!$user) {
            return $this->formResetPassword($uuid, $token);
        }

        $is_valid = $user->verifyPasswordResetToken($token, time() + $this->config->users->forgot->password->expires->grace_period);
        if (!$is_valid) {
            return $this->formResetPassword($uuid, $token);
        }

        $this->model->bindList(['password_clean', 'password_confirm']);
        
        if (!$this->model->updatePassword($user)) {
            $this->plugins->run('user.forgot.password.failed', $this->model, $this);

            $this->app->errors->set($this->model->errors);

            return $this->formResetPassword($uuid, $token);
        }

        $this->plugins->run('user.forgot.password.success', $this->model, $this);

        $this->app->message($this->__('forgot.password.reset.success'));
    }
}
