<?php
namespace Modules\Users\Views;

use Mars\Mvc\View;

class Login extends View
{
    /**
     * Displays the login form
     */
    public function form()
    {
        $this->document->title->set($this->__('title'));

        return ['model' => $this->model];
    }
}
