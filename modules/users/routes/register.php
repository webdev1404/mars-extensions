<?php
$this->module([
    '*' => '/register',
    'fr' => '/inscription',
    'de' => '/registrierung',
    'it' => '/registrazione',
    'es' => '/registro',
], 'users', ['get' => 'register@form', 'post' => 'register@register' ], name: 'users.register');

$this->module([
    '*' => '/register/agreement',
    'fr' => '/inscription/conditions',
    'de' => '/registrierung/bedingungen',
    'it' => '/registrazione/accordo',
    'es' => '/registro/condiciones',
], 'users', 'register@registrationAgreement', name: 'users.register.agreement');

$this->module([
    '*' => '/register/activate/{uuid}/{token}',
    'fr' => '/inscription/activation/{uuid}/{token}',
    'de' => '/registrierung/aktivieren/{uuid}/{token}',
    'it' => '/registrazione/attivare/{uuid}/{token}',
    'es' => '/registro/activar/{uuid}/{token}',
], 'users', 'register@activate', name: 'users.register.activate');

$this->module([
    '*' => '/register/resend-activation',
    'fr' => '/inscription/renvoyer-activation',
    'de' => '/registrierung/aktivierung-erneut-senden',
    'it' => '/registrazione/rinvia-attivazione',
    'es' => '/registro/reenviar-activacion',
], 'users', ['get' => 'register@resendActivationForm', 'post' => 'register@resendActivationCode' ], name: 'users.register.resend_activation');
