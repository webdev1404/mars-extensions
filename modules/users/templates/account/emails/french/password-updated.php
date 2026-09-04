@data.subject = "Votre mot de passe a été mis à jour sur $config->site->name"

Bonjour {{ $user->username }},

Votre mot de passe a été mis à jour avec succès sur {{ $config->site->name }}. 

<strong>Si vous n'avez pas effectué cette action, veuillez contacter le support immédiatement.</strong>

Cordialement,
L'équipe {{ $config->site->name }}
