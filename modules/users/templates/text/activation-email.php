@data("subject", "Activate your account on $config.site_name")
Greetings {{ $user.username }},

Thank you for registering at {{ $config.site_name }}. To activate your account, please click the link below:

<a href="{{ $activation_link }}">{{ $activation_link }}</a>

If you did not register for an account, please ignore this email.

Best regards,
The {{ $config.site_name }} Team