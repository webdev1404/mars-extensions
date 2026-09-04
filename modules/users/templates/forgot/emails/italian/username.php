@data.subject = "Il tuo nome utente per $config->site->name"
Ciao,

Abbiamo ricevuto una richiesta per recuperare il nome utente associato a questo indirizzo email.

Il tuo nome utente è: 

<strong>{{ $user->username }}</strong>

Puoi utilizzare questo nome utente per <a href="{{ $url->route('users.login') }}">accedere</a> al tuo account.

Se non hai richiesto questa email, puoi ignorarla in tutta tranquillità. Non sono state apportate modifiche al tuo account.

Cordiali saluti,
Il team di {{ $config->site->name }}