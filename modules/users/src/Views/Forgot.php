<?php
namespace Modules\Users\Views;

use Mars\Mvc\View;

class Forgot extends View
{
    /**
     * Displays the forgot username form
     */
    public function formUsername()
    {
        $this->document->title->set($this->__('title'));
    }
}
