<div id="resend-activation-form">
    <article>
        <form action="{{ $app.url }}" method="post">
            @csrf

            <div class="form-fields">
                {{ $plugins.run('user.register.resend.activation.form.fields.before') }}

                <div class="form-field">
                    <label for="email">{{ email }}</label>
                    <input type="email" id="email" name="email" value="" required />
                </div>

                @if ($config.user.registration.show_captcha)
                <div class="form-field">
                    <label for="captcha"></label>
                    {! $app.captcha.output() !}
                </div>
                @endif

                {{ $plugins.run('user.register.resend.activation.form.fields.after') }}

                <div class="form-field">
                    <input type="submit" data-submit="true" value="{{ resend_activation_button }}" />
                </div>

                {{ $plugins.run('user.register.resend.activation.form.submit.after') }}
            </div>

        </form>
    </article>
</div>