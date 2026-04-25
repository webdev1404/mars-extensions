<?php

$this->module([
    '*' => '/forgot-password',
    'fr' => '/mot-de-passe-oublie',
    'de' => '/passwort-vergessen',
    'it' => '/password-dimenticata',
    'es' => '/contrasena-olvidada',
], 'users', ['get' => 'forgot@formPassword', 'post' => 'forgot@forgotPassword' ], name: 'users.forgot.password');

$this->module([
    '*' => '/forgot-username',
    'fr' => '/mot-d-identifiant-oublie',
    'de' => '/benutzername-vergessen',
    'it' => '/nome-utente-dimenticato',
    'es' => '/nombre-de-usuario-olvidado',
], 'users', ['get' => 'forgot@formUsername', 'post' => 'forgot@forgotUsername' ], name: 'users.forgot.username');
