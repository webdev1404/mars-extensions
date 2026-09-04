@title = account.title
@breadcrumbs = account.title

@if ($config->users->account->logout->show)
<div id="account-logout">
    <a href="javascript:moduleUsers.logout('{{ $url->get('users.logout') | js }}')" class="button">{{ account.logout }}</a>
</div>
@endif

<h2>{{ account.hello }}</h2>

<div id="account-form">
    <article>
        <form action="{{ $url->get('users.account') }}" method="post">
            @csrf

            <div class="form-fields" id="account-form-fields">
                {{ $plugins->run('user.account.form.fields.before') }}

                <div class="form-field">
                    <label for="username">{{ register.username }}</label>
                    <input type="text" id="username" name="username" value="{{ $model->username }}" {{ $html->isReadonly($config->users->account->username->readonly) }} required />
                </div>
                <div class="form-field">
                    <label for="email">{{ register.email }}</label>
                    <input type="email" id="email" name="email" value="{{ $model->email }}" {{ $html->isReadonly($config->users->account->email->readonly) }} required />
                </div>
                <div class="form-field">
                    <label for="password_clean">{{ account.password_new }}</label>
                    <input type="password" id="password_clean" name="password_clean" />
                </div>
                <div class="form-field">
                    <label for="password_confirm">{{ account.password_new_confirm }}</label>
                    <input type="password" id="password_confirm" name="password_confirm" />
                </div>
                <div class="form-field">
                    <label for="password_confirm">{{ account.password_current }}</label>
                    <input type="password" id="password_current" name="password_current" required />
                </div>

                @if ($captcha->enabled && $config->users->account->captcha->show)
                <div class="form-field">
                    <label for="captcha"></label>
                    {! $app->captcha->render() !}
                </div>
                @endif

                {{ $plugins->run('user.account.form.fields.after') }}

                {{ $plugins->run('user.account.form.submit.before') }}
                
                <div class="form-field">
                    <input type="submit" data-ajax="true" data-reset="false" value="{{ account.submit }}" />
                </div>

                {{ $plugins->run('user.account.form.submit.after') }}
            </div>

        </form>
    </article>
</div>
