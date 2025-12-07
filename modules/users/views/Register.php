<?php
namespace Modules\Users\Views;

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

    /**
     * Displays the registration closed message
     */
    public function registrationClosed()
    {
        $this->document->title->set($this->__('registration_closed_title'));

        return $this->getLanguageTemplate('text', 'registration-closed');
    }

    /**
     * Displays the registration agreement
     */
    public function registrationAgreement()
    {
        $this->document->title->set($this->__('agreement_title'));

        return $this->getLanguageTemplate('text', 'registration-agreement');
    }
}
