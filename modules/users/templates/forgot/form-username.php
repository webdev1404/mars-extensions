<div id="resend-activation-form">
    <article>
        <form action="{{ $app.url }}" method="post">
            @csrf

            <div class="form-fields">
                {{ $plugins.run('user.forgot.username.form.fields.before') }}

                <div class="form-field">
                    <label for="email">{{ email }}</label>
                    <input type="email" id="email" name="email" value="" required />
                </div>

                <div class="form-field">
                    <label for="forgot-links"></label>
                    <a href="{{ $url.route('users.login') }}">{{ users:link.login }}</a> | 
                    <a href="{{ $url.route('users.forgot.password') }}">{{ users:link.forgot_password }}</a>
                </div>

                @if ($config.user.forgot.show_captcha)
                <div class="form-field">
                    <label for="captcha"></label>
                    {! $app.captcha.output() !}
                </div>
                @endif

                {{ $plugins.run('user.forgot.username.form.fields.after') }}

                <div class="form-field">
                    <input type="submit" data-submit="true" value="{{ send }}" />
                </div>

                {{ $plugins.run('user.forgot.username.form.submit.after') }}
            </div>

        </form>
    </article>
</div>