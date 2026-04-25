@data("subject", "Account registration attempt detected on $config.site.name")
Greetings {{ $user->username }},

Someone (possibly you) attempted to register with this email address. If this wasn't you, no action is needed – your account is secure.

If you forgot your password, use this <a href="{{ $url.route('users.forgot.password') }}">reset link</a>.

Best regards,
The {{ $config.site.name }} Team