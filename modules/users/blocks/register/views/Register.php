<?php
namespace Modules\Users\Blocks\Register\Views;

use Mars\Mvc\View;

class Register extends View
{
    /**
     * Displays the registration form
     */
    public function form()
    {
        $this->document->title->set($this->__('title'));
    }
}
