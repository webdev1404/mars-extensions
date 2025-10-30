<?php
namespace Modules\ContactUs\Blocks\Form\Views;

use Mars\Mvc\View;

class Form extends View
{
    /**
     * Displays the contact form
     */
    public function form()
    {
        $this->document->title->set($this->__('contact_us'));
    }
}
