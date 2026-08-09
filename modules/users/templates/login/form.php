@title = login.title
@breadcrumbs = login.title

<div id="login-form">
    <article>
        <form action="{{ $url.route('users.login') }}" method="post">
            @csrf

            <div class="form-fields">
                {{ $plugins->run('user.login.form.fields.before') }}

                <div class="form-field">
                    <label for="username">{{ login.username }}</label>
                    <input type="text" id="username" name="username" value="{{ $model.username }}" />
                </div>
                <div class="form-field">
                    <label for="password">{{ login.password }}</label>
                    <input type="password" id="password" name="password" />
                </div>

                @if ($config->users->login->remember_me->show)
                <div class="form-field">
                    <label for="remember_me">{{ login.remember_me }}</label>
                    <input type="checkbox" id="remember_me" name="remember_me" value="1" {{ $html->checked($config->users->login->remember_me->checked) }} />
                </div>
                @endif

                <div class="form-field">
                    <label for="forgot-links"></label>
                    <a href="{{ $url.route('users.forgot.username') }}">{{ links.forgot.username }}</a> | 
                    <a href="{{ $url.route('users.forgot.password') }}">{{ links.forgot.password }}</a>
                </div>

                @if ($captcha->enabled && $config->users->login->captcha->show)
                <div class="form-field">
                    <label for="captcha"></label>
                    {! $app->captcha->render() !}
                </div>
                @endif

                {{ $plugins->run('user.login.form.fields.after') }}
                
                <div class="form-field">
                    <input type="submit" value="{{ login.submit }}" />
                </div>
            </div>

        </form>
    </article>
</div>