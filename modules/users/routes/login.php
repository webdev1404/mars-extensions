<?php
$this->module([
    '*' => '/login',
    'fr' => '/connexion',
    'de' => '/anmeldung',
    'it' => '/accesso',
    'es' => '/iniciar-sesion',
], 'users', ['get' => 'login@form', 'post' => 'login@login' ], name: 'users.login');
