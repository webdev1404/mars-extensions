@data.subject = "Tentativo di registrazione rilevato su $config->site->name"

Ciao {{ $user->username }},

Qualcuno (possibilmente tu) ha tentato di registrarsi con questo indirizzo email. Se non sei stato tu, non è necessaria alcuna azione – il tuo account è al sicuro.

Se hai dimenticato la password, usa questo <a href="{{ $url->route('users.forgot.password') }}">link di reset</a>.

Cordiali saluti,
Il team di {{ $config->site->name }}