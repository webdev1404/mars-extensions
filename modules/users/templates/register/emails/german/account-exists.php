@data.subject = "Registrierungsversuch auf $config->site->name erkannt"

Hallo {{ $user->username }},

Jemand (wahrscheinlich Sie) hat versucht, sich mit dieser E-Mail-Adresse zu registrieren. Wenn das nicht Sie waren, ist keine Aktion erforderlich – Ihr Konto ist sicher.

Wenn Sie Ihr Passwort vergessen haben, nutzen Sie diesen <a href="{{ $url->route('users.forgot.password') }}">Link zum Zurücksetzen</a>.

Mit freundlichen Grüßen,
Das Team von {{ $config->site->name }}