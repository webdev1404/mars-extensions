@data.subject = "Confirmez votre nouvel e-mail sur $config->site->name"

Bonjour {{ $user->username }},

Vous avez demandé à mettre à jour votre e-mail sur {{ $config->site->name }}. Pour confirmer votre nouvelle adresse e-mail, veuillez cliquer sur le lien ci-dessous :

<a href="{{ $confirm_url }}">{{ $confirm_url }}</a>

Cordialement,
L'équipe {{ $config->site->name }}