<?php

return [
    'title' => "Konto",
    'logout' => "Abmelden",
    'hello' => "Hallo {$app->user->username},",
    'password_new' => "Neues Passwort",
    'password_new_confirm' => "Neues Passwort bestätigen",
    'password_current' => "Aktuelles Passwort",
    'submit' => "Aktualisieren",

    'success' => "Dein Konto wurde erfolgreich aktualisiert",
    'success.email' => "Dein Konto wurde erfolgreich aktualisiert. Bitte prüfe deine E-Mail, um die neue E-Mail-Adresse zu bestätigen.",
    'success.email.confirmed' => "Deine E-Mail-Adresse wurde erfolgreich aktualisiert.",

    'err.password.current' => "Bitte gib dein aktuelles Passwort ein.",
    'err.password.current.invalid' => "Dein aktuelles Passwort ist falsch",

    'err.email.params' => "Ungültige E-Mail-Update-Parameter",
    'err.email.failed' => "E-Mail-Update fehlgeschlagen. Das E-Mail-Update-Token ist ungültig oder abgelaufen. Bitte versuche, deine E-Mail-Adresse erneut zu aktualisieren.",
];
