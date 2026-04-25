@data("subject", "Nuova registrazione su $config.site.name")
Saluti,

Un nuovo utente si è registrato su {{ $config.site.name }}. Ecco i dettagli:

Nome utente: {{ $user.username }}&nbsp;
Email: {{ $user.email }}&nbsp;

Cordiali saluti,
Il team di {{ $config.site.name }}