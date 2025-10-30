<?php

namespace Modules\ContactUs\Blocks\Form\Controllers;

use Mars\Mvc\Controller;

class Form extends Controller
{
    /**
     * Displays the contact form
     */
    public function form()
    {
        $this->plugins->run('contact_us_form', $this->model);

        $this->view->render();
    }

    /**
     * Sends the contact form
     */
    public function send()
    {
        //allow the form to be sent via AJAX, too
        $this->accept_json = true;
        
        $this->model->bind();

        if (!$this->model->send()) {
            $this->plugins->run('contact_us_send_error', $this->model);

            return false;
        }

        $this->messages->add($this->__('success'));

        $this->plugins->run('contact_us_send_success', $this->model);

        $this->model->reset();

        return true;
    }
}
