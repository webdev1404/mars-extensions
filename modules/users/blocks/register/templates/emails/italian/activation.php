@data("subject", "Attiva il tuo account su $config.site_name")
Saluti {{ $user.username }},

Grazie per esserti registrato su {{ $config.site_name }}. Per attivare il tuo account, clicca sul link qui sotto:

<a href="{{ $activation_link }}">{{ $activation_link }}</a>

Se non hai richiesto la registrazione di un account, ignora questa email.

Cordiali saluti,  
Il Team di {{ $config.site_name }}