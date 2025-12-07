<?php
$this->module([
    '*' => '/register',
    'fr' => '/inscription',
    'de' => '/registrierung',
    'it' => '/registrazione',
    'es' => '/registro',
], 'users', 'register@form', name: 'register');


$this->module([
    '*' => '/register/agreement',
    'fr' => '/inscription/conditions',
    'de' => '/registrierung/bedingungen',
    'it' => '/registrazione/accordo',
    'es' => '/registro/condiciones',
], 'users', 'register@registrationAgreement', name: 'register.agreement');

$this->module([
    '*' => '/register/activate/{id}/{code}',
    'fr' => '/inscription/activation/{id}/{code}',
    'de' => '/registrierung/aktivieren/{id}/{code}',
    'it' => '/registrazione/attivare/{id}/{code}',
    'es' => '/registro/activar/{id}/{code}',
], 'users', 'register', ['action' => 'activate'], name: 'register.activate');