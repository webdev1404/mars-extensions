@title = form.title
@breadcrumbs = form.title

<div id="contact-form">
    <article>
        <form action="{{ $url.route('contact.form') }}" method="post">
            @csrf

            <div class="form-fields">
                {{ $plugins->run('contact.form.fields.before') }}

                <div class="form-field">
                    <label for="name">{{ form.name }}</label>
                    <input type="text" id="name" name="name" value="{{ $model.name }}" required />
                </div>
                <div class="form-field">
                    <label for="email">{{ form.email }}</label>
                    <input type="email" id="email" name="email" value="{{ $model.email }}" required />
                </div>

                <div class="form-field">
                    <label for="phone">{{ form.phone }}</label>
                    <input type="tel" id="phone" name="phone" value="{{ $model.phone }}" placeholder="{{ form.optional }}" />
                </div>

                <div class="form-field">
                    <label for="message">{{ form.message }}</label>
                    <textarea id="message" name="message" required>{{ $model.message }}</textarea>
                </div>

                @if ($captcha->enabled && $config->contactUs->form->captcha->show)
                <div class="form-field">
                    <label for="captcha"></label>
                    {! $app->captcha->render() !}
                </div>
                @endif

                {{ $plugins->run('contact.form.fields.after') }}
                
                <div class="form-field">
                    <input type="submit" data-ajax="true" value="{{ form.submit }}" />
                </div>
            </div>

        </form>
    </article>
</div>