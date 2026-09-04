@data.subject = "Attiva il tuo account su $config->site->name"

Ciao {{ $user->username }},

Grazie per esserti registrato su {{ $config->site->name }}. Per attivare il tuo account, fai clic sul link qui sotto:

<a href="{{ $activation_url }}">{{ $activation_url }}</a>

Se non ti sei registrato per un account, ignora questa email.

Cordiali saluti,
Il team di {{ $config->site->name }}