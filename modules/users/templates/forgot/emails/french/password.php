@data.subject = "Réinitialisation du mot de passe pour $config->site->name"
Bonjour {{ $user->username }},

Nous avons reçu une demande de réinitialisation du mot de passe de votre compte.

Pour réinitialiser votre mot de passe, veuillez cliquer sur le lien ci-dessous :

<a href="{{ $reset_url }}">{{ $reset_url }}</a>

Si vous n'avez pas demandé cet e-mail, vous pouvez l'ignorer en toute sécurité. Aucune modification n'a été apportée à votre compte.

Cordialement,
L'équipe {{ $config->site->name }}
