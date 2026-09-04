<?php

namespace Modules\Users\Controllers;

class Login extends Users
{
    /**
     * @internal
     */
    public protected(set) string $model_class = \Modules\Users\Models\Login::class;

    /**
     * @internal
     */
    public protected(set) bool $accept_json = true;

    /**
     * @internal
     */
    public protected(set) array $targets = [
        'login' => 'form'
    ];
    
    /**
     * Displays the login form
     */
    public function form()
    {
        $this->plugins->run('user.login.form', $this);

        $this->view->render();
    }

    /**
     * Handles the login form submission
     */
    public function login()
    {
        $this->model->bindList(['username', 'password', 'remember_me']);

        if (!$this->canPost(
            $this->config->users->login->captcha->show,
            $this->config->users->login->throttle->enable ? 'users.login' : null,
            $this->config->users->login->throttle->max_attempts,
            $this->config->users->login->throttle->block_duration
        )) {
            return false;
        }

        if (!$this->model->login()) {
            $this->plugins->run('user.login.error', $this->model, $this);

            $this->app->errors->set($this->model->errors);

            return false;
        }
        
        $this->plugins->run('user.login.success', $this->model, $this);

        // Redirect to the specified URL after successful login
        $this->app->redirect($this->config->users->login->redirect->url);
    }
}
