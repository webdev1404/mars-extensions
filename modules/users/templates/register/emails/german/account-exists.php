@data("subject", "Registrierungsversuch für $config.site.name erkannt")
Grüße {{ $user->username }},

Jemand (möglicherweise Sie) hat versucht, sich mit dieser E-Mail-Adresse zu registrieren. Falls Sie das nicht waren, ist keine Aktion erforderlich – Ihr Konto ist sicher.

Falls Sie Ihr Passwort vergessen haben, verwenden Sie diesen <a href="{{ $url.route('users.forgot.password') }}">Passwort-Zurücksetzen-Link</a>.

Mit freundlichen Grüßen,
Das {{ $config.site.name }} Team