@title = forgot.password.reset.title
@breadcrumbs = [forgot.password.title => users.forgot.password]

<div id="forgot-reset-password-form">
    <article>
        <form action="{{ $app->url }}" method="post">
            @csrf

            <div class="form-fields">
                {{ $plugins->run('user.forgot.reset.password.form.fields.before') }}

                <div class="form-field">
                    <label for="password_clean">{{ forgot.password.reset.password }}</label>
                    <input type="password" id="password_clean" name="password_clean" required />
                </div>
                <div class="form-field">
                    <label for="password_confirm">{{ forgot.password.reset.password_confirm }}</label>
                    <input type="password" id="password_confirm" name="password_confirm" required />
                </div>

                @if ($captcha->enabled && $config->users->forgot->captcha->show)
                <div class="form-field">
                    <label for="captcha"></label>
                    {! $app->captcha->render() !}
                </div>
                @endif

                {{ $plugins->run('user.forgot.reset.password.form.fields.after') }}

                @if ($is_valid)
                <div class="form-field">
                    <input type="submit" data-ajax="true" value="{{ forgot.password.reset.submit }}" />
                </div>
                @endif

                {{ $plugins->run('user.forgot.reset.password.form.submit.after') }}
            </div>

        </form>
    </article>
</div>
