<div id="register-form">
    <article>
        <form action="{{ $app.url }}" method="post">
            @csrf

            <div class="form-fields" id="register-form-fields">
                {{ $plugins.run('user.register.form.fields.before') }}

                <div class="form-field">
                    <label for="username">{{ username }}</label>
                    <input type="text" id="username" name="username" value="{{ $model.username }}" required />
                </div>
                <div class="form-field">
                    <label for="email">{{ email }}</label>
                    <input type="email" id="email" name="email" value="{{ $model.email }}" required />
                </div>
                <div class="form-field">
                    <label for="password_clean">{{ password }}</label>
                    <input type="password" id="password_clean" name="password_clean" required />
                </div>
                <div class="form-field">
                    <label for="password_confirm">{{ password_confirm }}</label>
                    <input type="password" id="password_confirm" name="password_confirm" required />
                </div>

                @if ($config.user.registration.show_captcha)
                <div class="form-field">
                    <label for="captcha"></label>
                    {! $app.captcha.output() !}
                </div>
                @endif

                {{ $plugins.run('user.register.form.fields.after') }}

                <div class="form-field agreement-field">
                    <label for="agreement"></label>
                    @if ($config.user.registration.show_agreement)
                    <input type="checkbox" id="agreement" name="agreement" required /> <a href="{{ $url.route('users.register.agreement') }}" data-modal="#" target="_blank">{{ agreement }}</a>
                    | 
                    @endif
                    <a href="{{ $url.route('users.register.resend_activation') }}">{{ resend_activation_link }}</a>
                </div>
                

                {{ $plugins.run('user.register.form.submit.before') }}
                
                <div class="form-field">
                    <input type="submit" data-submit="true" value="{{ register }}" />
                </div>

                {{ $plugins.run('user.register.form.submit.after') }}
            </div>

        </form>
    </article>
</div>