<?php

$this->module([
    '*' => '/forgot-username',
    'fr' => '/mot-d-identifiant-oublie',
    'de' => '/benutzername-vergessen',
    'it' => '/nome-utente-dimenticato',
    'es' => '/nombre-de-usuario-olvidado',
], 'users', ['get' => 'forgot@formUsername', 'post' => 'forgot@forgotUsername' ], name: 'users.forgot.username');

$this->module([
    '*' => '/forgot-password',
    'fr' => '/mot-de-passe-oublie',
    'de' => '/passwort-vergessen',
    'it' => '/password-dimenticata',
    'es' => '/contrasena-olvidada',
], 'users', ['get' => 'forgot@formPassword', 'post' => 'forgot@forgotPassword' ], name: 'users.forgot.password');

$this->module([
    '*' => '/reset-password/{uuid}/{token}',
    'fr' => '/reinitialiser-mot-de-passe/{uuid}/{token}',
    'de' => '/passwort-zurucksetzen/{uuid}/{token}',
    'it' => '/reimposta-password/{uuid}/{token}',
    'es' => '/restablecer-contrasena/{uuid}/{token}',
], 'users', ['get' => 'forgot@formResetPassword', 'post' => 'forgot@resetPassword' ], name: 'users.forgot.password.reset');
