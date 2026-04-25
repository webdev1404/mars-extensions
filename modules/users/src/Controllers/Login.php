<?php

namespace Modules\Users\Controllers;

use Mars\Mvc\Controller;

class Login extends Controller
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
        $this->loadLanguage();
    }
    
    /**
     * Displays the registration form
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
        $this->model->bindList(['username', 'password']);

        if (!$this->request->canPost()) {
            return false;
        }

        if (!$this->model->validate()) {
            $this->plugins->run('user.login.validation_error', $this->model, $this);
            
            return false;
        }

        if (!$this->model->login()) {
            $this->plugins->run('user.login.error', $this->model, $this);

            $this->errors->add($this->__('err_login'));

            return false;
        }
        
        $this->plugins->run('user.login.success', $this->model, $this);

        $this->app->message($this->__('success'));
    }
}
