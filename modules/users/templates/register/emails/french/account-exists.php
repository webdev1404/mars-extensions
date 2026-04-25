@data("subject", "Tentative d'enregistrement de compte détectée sur $config.site.name")
Bonjour {{ $user->username }},

Quelqu'un (peut-être vous) a tenté de s'enregistrer avec cette adresse e-mail. Si ce n'était pas vous, aucune action n'est nécessaire – votre compte est sécurisé.

Si vous avez oublié votre mot de passe, utilisez ce <a href="{{ $url.route('users.forgot.password') }}">lien de réinitialisation</a>.

Cordialement,
L'équipe {{ $config.site.name }}