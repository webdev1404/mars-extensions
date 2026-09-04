
<?php
$this->module([
    '*' => '/register',
    'fr' => '/inscription',
    'de' => '/registrierung',
    'it' => '/registrazione',
    'es' => '/registro',
], 'users', ['get' => 'register@form', 'post' => 'register@register' ], name: 'users.register', sitemap: false);

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
], 'users', 'register@activate', name: 'users.register.activate', sitemap: false);

$this->module([
    '*' => '/register/resend-activation',
    'fr' => '/inscription/renvoyer-activation',
    'de' => '/registrierung/aktivierung-erneut-senden',
    'it' => '/registrazione/rinvia-attivazione',
    'es' => '/registro/reenviar-activacion',
], 'users', ['get' => 'register@resendActivationForm', 'post' => 'register@resendActivationCode' ], name: 'users.register.resend_activation', sitemap: false);

$this->module([
    '*' => '/login',
    'fr' => '/connexion',
    'de' => '/anmeldung',
    'it' => '/accesso',
    'es' => '/iniciar-sesion',
], 'users', ['get' => 'login@form', 'post' => 'login@login' ], name: 'users.login', sitemap: false);

$this->module([
    '*' => '/forgot-username',
    'fr' => '/mot-d-identifiant-oublie',
    'de' => '/benutzername-vergessen',
    'it' => '/nome-utente-dimenticato',
    'es' => '/nombre-de-usuario-olvidado',
], 'users', ['get' => 'forgot@formUsername', 'post' => 'forgot@forgotUsername' ], name: 'users.forgot.username', sitemap: false);

$this->module([
    '*' => '/forgot-password',
    'fr' => '/mot-de-passe-oublie',
    'de' => '/passwort-vergessen',
    'it' => '/password-dimenticata',
    'es' => '/contrasena-olvidada',
], 'users', ['get' => 'forgot@formPassword', 'post' => 'forgot@forgotPassword' ], name: 'users.forgot.password', sitemap: false);

$this->module([
    '*' => '/reset-password/{uuid}/{token}',
    'fr' => '/reinitialiser-mot-de-passe/{uuid}/{token}',
    'de' => '/passwort-zurucksetzen/{uuid}/{token}',
    'it' => '/reimposta-password/{uuid}/{token}',
    'es' => '/restablecer-contrasena/{uuid}/{token}',
], 'users', ['get' => 'forgot@formResetPassword', 'post' => 'forgot@resetPassword' ], name: 'users.forgot.password.reset', sitemap: false);

$this->module([
    '*' => '/account',
    'fr' => '/compte',
    'de' => '/konto',
    'it' => '/account',
    'es' => '/cuenta',
], 'users', ['get' => 'account@form', 'post' => 'account@update' ], name: 'users.account', sitemap: false);

$this->module([
    '*' => '/account/confirm-email/{token}',
    'fr' => '/compte/confirmer-email/{token}',
    'de' => '/konto/email-bestaetigen/{token}',
    'it' => '/account/conferma-email/{token}',
    'es' => '/cuenta/confirmar-email/{token}',
], 'users', ['get' => 'account@confirmEmail'], name: 'users.account.confirm_email', sitemap: false);

$this->module([
    '*' => '/logout',
    'fr' => '/deconnexion',
    'de' => '/abmeldung',
    'it' => '/disconnessione',
    'es' => '/cerrar-sesion',
], 'users', 'account@logout', name: 'users.logout', sitemap: false);
