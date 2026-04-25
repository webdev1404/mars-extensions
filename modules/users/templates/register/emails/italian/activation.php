@data("subject", "Attiva il tuo account su $config.site.name")
Saluti {{ $user.username }},

Grazie per esserti registrato su {{ $config.site.name }}. Per attivare il tuo account, fai clic sul link sottostante:

<a href="{{ $activation_link }}">{{ $activation_link }}</a>

Se non ti sei registrato per un account, ignora questa email.

Cordiali saluti,
Il team di {{ $config.site.name }}