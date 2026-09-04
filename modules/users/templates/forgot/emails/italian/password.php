@data.subject = "Reimpostazione password per $config->site->name"
Ciao {{ $user->username }},

Abbiamo ricevuto una richiesta per reimpostare la password del tuo account.

Per reimpostare la password, clicca sul link qui sotto:

<a href="{{ $reset_url }}">{{ $reset_url }}</a>

Se non hai richiesto questa email, puoi ignorarla in tutta sicurezza. Nessuna modifica è stata apportata al tuo account.

Cordiali saluti,
Il team di {{ $config->site->name }}
