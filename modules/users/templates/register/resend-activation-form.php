@title = register.resend_activation.title
@breadcrumbs = [register.title => users.register]

<div id="resend-activation-form">
    <article>
        <form action="{{ $url->route('users.register.resend_activation') }}" method="post">
            @csrf

            <div class="form-fields">
                {{ $plugins->run('user.register.resend.activation.form.fields.before') }}

                <div class="form-field">
                    <label for="email">{{ register.email }}</label>
                    <input type="email" id="email" name="email" value="" />
                </div>

                @if ($captcha->enabled && $config->users->registration->show_captcha)
                <div class="form-field">
                    <label for="captcha"></label>
                    {! $app->captcha->render() !}
                </div>
                @endif

                {{ $plugins->run('user.register.resend.activation.form.fields.after') }}

                <div class="form-field">
                    <input type="submit" data-ajax="true" value="{{ register.resend_activation.submit }}" />
                </div>

                {{ $plugins->run('user.register.resend.activation.form.submit.after') }}
            </div>

        </form>
    </article>
</div>