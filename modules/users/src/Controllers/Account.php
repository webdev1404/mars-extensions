<?php

namespace Modules\Users\Controllers;

class Account extends Users
{
    /**
     * @internal
     */
    public protected(set) string $model_class = \Modules\Users\Models\Account::class;

    /**
     * @internal
     */
    public protected(set) bool $accept_json = true;

    /**
     * @internal
     */
    public protected(set) array $targets = [
        'update' => 'form'
    ];

    /**
     * @internal
     */
    protected function before()
    {
        if (!$this->app->user->is_logged) {
            $this->app->redirect($this->url->get('users.login'));
        }
    }
    
    /**
     * Displays the account form
     */
    public function form()
    {
        $this->flashes();

        $this->model->bindList(['username', 'email'], $this->app->user);
        
        $this->plugins->run('user.account.form', $this);

        $this->view->render();
    }

    /**
     * Handles the account form submission
     */
    public function update()
    {
        $this->model->bindList(['username', 'email', 'password_clean', 'password_confirm', 'password_current']);

        if (!$this->canPost(
            $this->config->users->account->captcha->show,
            $this->config->users->account->throttle->enable ? 'users.account' : null,
            $this->config->users->account->throttle->max_attempts,
            $this->config->users->account->throttle->block_duration
        )) {
            return false;
        }

        if (!$this->model->update()) {
            $this->app->errors->set($this->model->errors);
            
            return false;
        }

        // If the password was updated, send a notification email
        if ($this->model->password_clean) {
            $this->sendPasswordUpdatedEmail();
        }

        if ($this->model->canUpdateEmail()) {
            //get the email token and send the email

            $this->sendEmailConfirmation();
            
            $this->app->messages->add($this->__('account.success.email'));

            return true;
        } else {
            if (count($this->model->errors)) {
                $this->app->errors->set($this->model->errors);
            }
        }

        $this->app->messages->add($this->__('account.success'));

        return true;
    }

    /**
     * Sends a notification email to the user after they update their password
     */
    protected function sendPasswordUpdatedEmail()
    {
        if (!$this->config->users->account->password->change->notification) {
            return;
        }

        $email = $this->app->user->email;
        $body = $this->email->get('password-updated', ['user' => $this->app->user]);
        $subject = $this->email->subject;

        $this->plugins->run('user.account.send.password.updated.email', $email, $subject, $body, $this);

        $this->mail->send($email, $subject, $body);
    }

    /**
     * Sends an email confirmation to the user after they update their email address
     */
    protected function sendEmailConfirmation()
    {
        $confirm_url = $this->url->route('users.account.confirm_email', ['token' => $this->app->user->getEmailUpdateToken($this->model->email)]);

        $email = $this->app->user->email;
        $body = $this->email->get('email-confirm', ['user' => $this->app->user, 'confirm_url' => $confirm_url]);
        $subject = $this->email->subject;

        $this->plugins->run('user.account.send.email', $email, $subject, $body, $this);

        $this->mail->send($email, $subject, $body);
    }

    /**
     * Handles the email confirmation after the user updates their email address
     * @param string $token The email update token
     */
    public function confirmEmail(string $token)
    {
        if (!$token) {
            $this->app->error($this->__('account.err.email.params'));

            return;
        }

        if (!$this->model->updateEmail($token)) {
            $this->plugins->run('user.account.update.email.failed', $this->model, $this);

            $this->app->errors->add($this->__('account.err.email.failed'));

            return $this->go('form');
        }

        $this->plugins->run('user.account.update.email.success', $this->model, $this);

        return $this->redirect('users.account', 'message', $this->__('account.success.email.confirmed'));
    }

    /**
     * Logs out the current user
     */
    public function logout()
    {
        $this->app->user->logout();

        return $this->app->redirect($this->config->users->account->logout->url);
    }
}
