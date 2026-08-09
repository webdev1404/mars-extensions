@title = register.title
@breadcrumbs = register.title

<div id="register-form">
    <article>
        <form action="{{ $url->get('users.register') }}" method="post">
            @csrf

            <div class="form-fields" id="register-form-fields">
                {{ $plugins->run('user.register.form.fields.before') }}

                <div class="form-field">
                    <label for="username">{{ register.username }}</label>
                    <input type="text" id="username" name="username" value="{{ $model->username }}" required />
                </div>
                <div class="form-field">
                    <label for="email">{{ register.email }}</label>
                    <input type="email" id="email" name="email" value="{{ $model->email }}" required />
                </div>
                <div class="form-field">
                    <label for="password_clean">{{ register.password }}</label>
                    <input type="password" id="password_clean" name="password_clean" required />
                </div>
                <div class="form-field">
                    <label for="password_confirm">{{ register.password_confirm }}</label>
                    <input type="password" id="password_confirm" name="password_confirm" required />
                </div>

                @if ($captcha->enabled && $config->users->registration->captcha->show)
                <div class="form-field">
                    <label for="captcha"></label>
                    {! $app->captcha->render() !}
                </div>
                @endif

                {{ $plugins->run('user.register.form.fields.after') }}

                <div class="form-field agreement-field">
                    <label for="agreement"></label>
                    @if ($config->users->registration->agreement->show)
                    <input type="checkbox" id="agreement" name="agreement" required /> <a href="{{ $url->get('users.register.agreement') }}" data-modal="#" target="_blank">{{ register.agreement.link }}</a>
                    | 
                    @endif
                    <a href="{{ $url->get('users.register.resend_activation') }}">{{ register.resend_activation.link }}</a>
                </div>
                

                {{ $plugins->run('user.register.form.submit.before') }}
                
                <div class="form-field">
                    <input type="submit" data-ajax="true" value="{{ register.submit }}" />
                </div>

                {{ $plugins->run('user.register.form.submit.after') }}
            </div>

        </form>
    </article>
</div>