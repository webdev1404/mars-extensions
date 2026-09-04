@data.subject = "La tua password è stata aggiornata su $config->site->name"

Ciao {{ $user->username }},

La tua password è stata aggiornata con successo su {{ $config->site->name }}.

<strong>Se non hai eseguito questa azione, contatta subito il supporto.</strong>

Cordiali saluti,
Il team di {{ $config->site->name }}
