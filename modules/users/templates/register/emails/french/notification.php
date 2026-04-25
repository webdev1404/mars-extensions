@data("subject", "Nouvelle inscription sur $config.site.name")
Salutations,

Un nouvel utilisateur s'est inscrit sur {{ $config.site.name }}. Voici les détails :

Nom d'utilisateur : {{ $user.username }}&nbsp;
Email : {{ $user.email }}&nbsp;

Cordialement,
L'équipe {{ $config.site.name }}