@data.subject = "Dein Passwort wurde auf $config->site->name aktualisiert"

Hallo {{ $user->username }},

Dein Passwort wurde auf {{ $config->site->name }} erfolgreich aktualisiert.

<strong>Wenn du diese Aktion nicht selbst durchgeführt hast, kontaktiere bitte umgehend den Support.</strong>

Mit freundlichen Grüßen,
Das {{ $config->site->name }}-Team
