@data.subject = "Votre nom d'utilisateur pour $config->site->name"
Bonjour,

Nous avons reçu une demande pour récupérer le nom d'utilisateur associé à cette adresse e-mail.

Votre nom d'utilisateur est : 

<strong>{{ $user->username }}</strong>

Vous pouvez utiliser ce nom d'utilisateur pour vous <a href="{{ $url->route('users.login') }}">connecter</a> à votre compte.

Si vous n'avez pas demandé cet e-mail, vous pouvez l'ignorer en toute sécurité. Aucune modification n'a été apportée à votre compte.

Cordialement,
L'équipe {{ $config->site->name }}