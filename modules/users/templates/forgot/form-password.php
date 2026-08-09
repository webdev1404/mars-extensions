@title = forgot.password.title
@breadcrumbs = forgot.password.title

<div id="forgot-password-form">
    <article>
        <form action="{{ $url->route('users.forgot.password') }}" method="post">
            @csrf

            <div class="form-fields">
                {{ $plugins->run('user.forgot.password.form.fields.before') }}

                <div class="form-field">
                    <label for="email">{{ register.email }}</label>
                    <input type="email" id="email" name="email" value="" required />
                </div>

                <div class="form-field">
                    <label for="forgot-links"></label>
                    <a href="{{ $url->route('users.login') }}">{{ links.login }}</a> | 
                    <a href="{{ $url->route('users.forgot.username') }}">{{ links.forgot.username }}</a>
                </div>

                @if ($captcha->enabled && $config->users->forgot->captcha->show)
                <div class="form-field">
                    <label for="captcha"></label>
                    {! $app->captcha->render() !}
                </div>
                @endif

                {{ $plugins->run('user.forgot.password.form.fields.after') }}

                <div class="form-field">
                    <input type="submit" data-ajax="true" value="{{ forgot.password.submit }}" />
                </div>

                {{ $plugins->run('user.forgot.password.form.submit.after') }}
            </div>

        </form>
    </article>
</div>