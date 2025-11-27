<?php

//$router->block('/login', 'users', 'form');

$this->block([
    '*' => '/register',
    'fr' => '/inscription',
    'de' => '/registrierung',
    'it' => '/registrazione',
    'es' => '/registro',
], 'users', 'register', name: 'register');

//$this->block('/activate/{id}/{code}', 'users', 'register', ['action' => 'activate']);
