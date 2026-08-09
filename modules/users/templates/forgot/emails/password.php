@data.subject = "Password Reset for $config->site->name"
Hello {{ $user->username }},

We received a request to reset the password for your account.

To reset your password, please click the link below:

<a href="{{ $reset_url }}">{{ $reset_url }}</a>

If you did not request this email, you can safely ignore it. No changes have been made to your account.

Best regards,
The {{ $config->site->name }} Team
