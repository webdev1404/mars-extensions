@data.subject = "Your password has been updated on $config->site->name"

Hello {{ $user->username }},

Your password has been successfully updated on {{ $config->site->name }}. 

<strong>If you did not perform this action, please contact support immediately.</strong>

Best regards,
The {{ $config->site->name }} Team

