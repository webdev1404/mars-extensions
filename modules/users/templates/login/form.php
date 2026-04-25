<div id="login-form">
    <article>
        <form action="{{ $app.url }}" method="post">
            @csrf
            <input type="hidden" name="action" value="login" />

            <div class="form-fields">
                {{ $plugins.run('user.login.form.fields.before') }}

                <div class="form-field">
                    <label for="username">{{ username }}</label>
                    <input type="text" id="username" name="username" value="{{ $model.username }}" />
                </div>
                <div class="form-field">
                    <label for="password">{{ password }}</label>
                    <input type="password" id="password" name="password" />
                </div>
                <div class="form-field">
                    <label for="forgot-links"></label>
                    <a href="{{ $url.route('users.forgot.username') }}">{{ forgot_username }}</a> | 
                    <a href="{{ $url.route('users.forgot.password') }}">{{ forgot_password }}</a>
                </div>

                {{ $plugins.run('user.login.form.fields.after') }}
                
                <div class="form-field">
                    <input type="submit" value="{{ login }}" />
                </div>

                {! $app.captcha.output() !}
            </div>

        </form>
    </article>
</div>