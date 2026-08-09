<?php
$this->module([
    '*' => '/account',
    'fr' => '/compte',
    'de' => '/konto',
    'it' => '/account',
    'es' => '/cuenta',
], 'users', ['get' => 'account@form', 'post' => 'account@register' ], name: 'users.account');
