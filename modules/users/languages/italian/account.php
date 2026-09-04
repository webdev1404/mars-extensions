<?php

return [
    'title' => "Account",
    'logout' => "Disconnetti",
    'hello' => "Ciao {$app->user->username},",
    'password_new' => "Nuova password",
    'password_new_confirm' => "Conferma nuova password",
    'password_current' => "Password attuale",
    'submit' => "Aggiorna",

    'success' => "Il tuo account è stato aggiornato con successo",
    'success.email' => "Il tuo account è stato aggiornato con successo. Controlla la tua email per confermare il nuovo indirizzo email.",
    'success.email.confirmed' => "Il tuo indirizzo email è stato aggiornato con successo.",

    'err.password.current' => "Inserisci la tua password attuale.",
    'err.password.current.invalid' => "La tua password attuale non è corretta",

    'err.email.params' => "Parametri per l'aggiornamento dell'email non validi",
    'err.email.failed' => "Aggiornamento dell'email fallito. Il token per l'aggiornamento dell'email non è valido o è scaduto. Prova ad aggiornare nuovamente il tuo indirizzo email.",
];
