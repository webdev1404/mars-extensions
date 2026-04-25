<?php

namespace Modules\Users\Controllers;

use Mars\Mvc\Controller;

class Forgot extends Controller
{
    /**
     * @internal
     */
    public protected(set) bool $accept_json = true;

    public protected(set) bool $has_model = false;

    /**
     * Initializes the controller
     */
    protected function init()
    {
        $this->loadConfig('user');
        $this->loadLanguage('users', 'users');
        $this->loadLanguage();
    }
    
    /**
     * Displays the forgot username form
     */
    public function formUsername()
    {
        $this->view->render(__METHOD__);
    }
}
