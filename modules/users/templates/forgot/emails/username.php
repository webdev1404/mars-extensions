@data.subject = "Your Username for $config->site->name"
Hello,

We received a request to recover the username associated with this email address.

Your username is: 

<strong>{{ $user->username }}</strong>

You can use this username to <a href="{{ $url->route('users.login') }}">sign in</a> to your account.

If you did not request this email, you can safely ignore it. No changes have been made to your account.

Best regards,
The {{ $config->site->name }} Team