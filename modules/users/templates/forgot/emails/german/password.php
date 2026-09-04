@data.subject = "Passwort zurücksetzen für $config->site->name"
Hallo {{ $user->username }},

Wir haben eine Anfrage zum Zurücksetzen des Passworts für dein Konto erhalten.

Um dein Passwort zurückzusetzen, klicke bitte auf den Link unten:

<a href="{{ $reset_url }}">{{ $reset_url }}</a>

Wenn du diese E-Mail nicht angefordert hast, kannst du sie einfach ignorieren. Es wurden keine Änderungen an deinem Konto vorgenommen.

Mit freundlichen Grüßen,
Das {{ $config->site->name }}-Team
