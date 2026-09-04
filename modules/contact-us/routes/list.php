<?php

$this->module([
    '*' => '/contact',
    'fr' => '/nous-contacter',
    'de' => '/kontakt',
    'it' => '/contattaci',
    'es' => '/contacto',
], 'contact-us', ['get' => 'contact@form', 'post' => 'contact@send' ], name: 'contact.form');
