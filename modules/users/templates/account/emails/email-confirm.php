@data.subject = "Confirm your new email on $config->site->name"

Hello {{ $user->username }},

You have requested to update your email on {{ $config->site->name }}. To confirm your new email address, please click the link below:

<a href="{{ $confirm_url }}">{{ $confirm_url }}</a>

Best regards,
The {{ $config->site->name }} Team
