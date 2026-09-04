@data.subject = "Dein Benutzername für $config->site->name"
Hallo,

wir haben eine Anfrage erhalten, um den mit dieser E-Mail-Adresse verknüpften Benutzernamen wiederherzustellen.

Dein Benutzername lautet:

<strong>{{ $user->username }}</strong>

Du kannst diesen Benutzernamen verwenden, um dich auf deinem Konto <a href="{{ $url->route('users.login') }}">anzumelden</a>.

Wenn du diese E-Mail nicht angefordert hast, kannst du sie einfach ignorieren. Es wurden keine Änderungen an deinem Konto vorgenommen.

Mit freundlichen Grüßen,
Das Team von {{ $config->site->name }}