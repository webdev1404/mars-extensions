@data.subject = "Conferma la tua nuova email su $config->site->name"

Ciao {{ $user->username }},

Hai richiesto di aggiornare la tua email su {{ $config->site->name }}. Per confermare il tuo nuovo indirizzo email, clicca sul link qui sotto:

<a href="{{ $confirm_url }}">{{ $confirm_url }}</a>

Distinti saluti,
Il team di {{ $config->site->name }}