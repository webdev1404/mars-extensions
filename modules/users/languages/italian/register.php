<?php

return [
    'title' => "Registrazione",
    'username' => "Nome utente",
    'email' => "Email",
    'password' => "Password",
    'password_confirm' => "Conferma password",
    'submit' => "Registrati",

    'success' => "Ti sei registrato con successo. Controlla la tua email per le istruzioni di attivazione dell'account.",

    'agreement.title' => "Accordo di registrazione",
    'agreement.link' => "Ho letto e accetto i termini e le condizioni di registrazione.",

    'registration_closed.title' => "Registrazione chiusa",

    'resend_activation.link' => "Invia nuovamente il codice di attivazione",
    'resend_activation.title' => "Invia nuovamente il codice di attivazione",
    'resend_activation.submit' => "Invia nuovamente il codice di attivazione",
    'resend_activation.success' => "Se esiste un account con l'email fornita e non è attivato, è stata inviata una nuova email di attivazione. Controlla la tua casella di posta.",

    'activation.success' => "Il tuo account è stato attivato correttamente. Ora puoi <a href=\"{$app->url->route('users.login')}\">accedere</a>.",
    'activation.failed' => "L'attivazione dell'account non è riuscita. Chiave di attivazione non valida o scaduta. Richiedi una nuova email di attivazione dalla <a href=\"{$app->url->route('users.register.resend_activation')}\">pagina di reinvio</a>.",

    'err.username' => "Inserisci il nome utente",
    'err.username.invalid' => "Il nome utente non è valido. Deve avere una lunghezza compresa tra 5 e 100 caratteri e può contenere solo lettere, numeri, underscores e punti.",
    'err.username.exists' => "Il nome utente è già stato utilizzato. Scegline un altro.",
    'err.email' => "Inserisci l'email",
    'err.email.invalid' => "L'email non è valida",
    'err.email.exists' => "L'email è già registrata. Utilizza un'altra email.",
    'err.password' => "Inserisci la password",
    'err.password.invalid' => "La password non è valida. Deve avere una lunghezza compresa tra 6 e 100 caratteri e includere una combinazione di lettere, numeri e caratteri speciali.",
    'err.password.mismatch' => "Le password non coincidono",
    'err.agreement' => "Devi accettare i termini e le condizioni di registrazione per procedere",

    'err.activation.params' => "Parametri di attivazione non validi",
];
