@data("subject", "New registration on $config.site.name")
Greetings,

A new user has registered on {{ $config.site.name }}. Here are the details:

Username: {{ $user.username }}&nbsp;
Email: {{ $user.email }}&nbsp;

Best regards,
The {{ $config.site.name }} Team