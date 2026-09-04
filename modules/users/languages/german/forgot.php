<?php

return [
    'email' => "E-Mail",

    'username.title' => 'Benutzername vergessen',
    'username.submit' => "Benutzernamen senden",
    'username.success' => "Wenn die eingegebene E-Mail einer Kontoverbindung zugeordnet ist, wurde Ihr Benutzername an diese E-Mail-Adresse gesendet.",

    'password.title' => 'Passwort vergessen',
    'password.submit' => "Passwort senden",
    'password.success' => "Wenn die eingegebene E-Mail einer Kontoverbindung zugeordnet ist, wurde ein Link zum Zurücksetzen des Passworts an diese E-Mail-Adresse gesendet.",

    'password.reset.title' => 'Passwort zurücksetzen',
    'password.reset.password' => "Neues Passwort",
    'password.reset.password_confirm' => "Passwort bestätigen",
    'password.reset.submit' => "Passwort zurücksetzen",
    'password.reset.success' => "Ihr Passwort wurde erfolgreich zurückgesetzt. Sie können sich jetzt mit Ihrem neuen Passwort <a href=\"{$app->url->route('users.login')}\">anmelden</a>.",

    'err.email' => "Bitte geben Sie Ihre E-Mail ein",
    'err.email.invalid' => "Die eingegebene E-Mail ist ungültig",

    'err.password' => "Bitte geben Sie Ihr Passwort ein",
    'err.password.invalid' => "Das eingegebene Passwort ist ungültig. Es sollte zwischen 6 und 100 Zeichen lang sein und eine Mischung aus Buchstaben, Zahlen und Sonderzeichen enthalten.",
    'err.password.mismatch' => "Die eingegebenen Passwörter stimmen nicht überein",
    'err.password.params' => "Ungültige Parameter zum Zurücksetzen des Passworts",
    'err.password.reset' => "Der Link zum Zurücksetzen des Passworts ist ungültig oder abgelaufen",
];
