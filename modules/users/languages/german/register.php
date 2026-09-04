<?php

return [
    'title' => "Registrierung",
    'username' => "Benutzername",
    'email' => "E-Mail",
    'password' => "Passwort",
    'password_confirm' => "Passwort bestätigen",
    'submit' => "Registrieren",

    'success' => "Sie haben sich erfolgreich registriert. Bitte prüfen Sie Ihre E-Mail für Anweisungen zur Aktivierung Ihres Kontos.",

    'agreement.title' => "Registrierungsvereinbarung",
    'agreement.link' => "Ich habe die Allgemeinen Geschäftsbedingungen zur Registrierung gelesen und akzeptiere sie.",

    'registration_closed.title' => "Registrierung geschlossen",

    'resend_activation.link' => "Aktivierungscode erneut senden",
    'resend_activation.title' => "Aktivierungscode erneut senden",
    'resend_activation.submit' => "Aktivierungscode erneut senden",
    'resend_activation.success' => "Wenn ein Konto mit der angegebenen E-Mail existiert und noch nicht aktiviert wurde, wurde eine neue Aktivierungs-E-Mail gesendet. Bitte überprüfen Sie Ihren Posteingang.",

    'activation.success' => "Ihr Konto wurde erfolgreich aktiviert. Sie können sich jetzt <a href=\"{$app->url->route('users.login')}\">anmelden</a>.",
    'activation.failed' => "Die Kontoaktivierung ist fehlgeschlagen. Der Aktivierungsschlüssel ist ungültig oder abgelaufen. Bitte fordern Sie auf der <a href=\"{$app->url->route('users.register.resend_activation')}\">Seite für Aktivierung erneut senden</a> eine neue Aktivierungs-E-Mail an.",

    'err.username' => "Bitte geben Sie den Benutzernamen ein",
    'err.username.invalid' => "Der Benutzername ist ungültig. Er muss zwischen 5 und 100 Zeichen lang sein und darf nur Buchstaben, Zahlen, Unterstriche und Punkte enthalten.",
    'err.username.exists' => "Der Benutzername ist bereits vergeben. Bitte wählen Sie einen anderen.",
    'err.email' => "Bitte geben Sie die E-Mail ein",
    'err.email.invalid' => "Die E-Mail ist ungültig",
    'err.email.exists' => "Die E-Mail ist bereits registriert. Bitte verwenden Sie eine andere E-Mail.",
    'err.password' => "Bitte geben Sie das Passwort ein",
    'err.password.invalid' => "Das Passwort ist ungültig. Es muss zwischen 6 und 100 Zeichen lang sein und eine Mischung aus Buchstaben, Zahlen und Sonderzeichen enthalten.",
    'err.password.mismatch' => "Die Passwörter stimmen nicht überein",
    'err.agreement' => "Sie müssen den Registrierungsbedingungen zustimmen, um fortzufahren",

    'err.activation.params' => "Ungültige Aktivierungsparameter",
];
