<?php

return [
    'email' => "Email",

    'username.title' => 'Recupera username',
    'username.submit' => "Invia username",
    'username.success' => "Se l'email inserita è associata a un account, il tuo username è stato inviato a quell'indirizzo email.",

    'password.title' => 'Recupera password',
    'password.submit' => "Invia password",
    'password.success' => "Se l'email inserita è associata a un account, un link per il reset della password è stato inviato a quell'indirizzo email.",

    'password.reset.title' => 'Reimposta password',
    'password.reset.password' => "Nuova password",
    'password.reset.password_confirm' => "Conferma password",
    'password.reset.submit' => "Reimposta password",
    'password.reset.success' => "La tua password è stata reimpostata correttamente. Ora puoi <a href=\"{$app->url->route('users.login')}\">accedere</a> con la tua nuova password.",

    'err.email' => "Inserisci la tua email",
    'err.email.invalid' => "L'email inserita non è valida",

    'err.password' => "Inserisci la tua password",
    'err.password.invalid' => "La password inserita non è valida. Deve avere una lunghezza compresa tra 6 e 100 caratteri e includere una combinazione di lettere, numeri e caratteri speciali.",
    'err.password.mismatch' => "Le password inserite non coincidono",
    'err.password.params' => "Parametri per il reset password non validi",
    'err.password.reset' => "Il link per il reset della password non è valido o è scaduto",
];
