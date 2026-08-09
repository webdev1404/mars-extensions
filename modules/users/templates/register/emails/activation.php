@data.subject = "Activate your account on $config->site->name"

Hello {{ $user->username }},

Thank you for registering at {{ $config->site->name }}. To activate your account, please click the link below:

<a href="{{ $activation_url }}">{{ $activation_url }}</a>

If you did not register for an account, please ignore this email.

Best regards,
The {{ $config->site->name }} Team