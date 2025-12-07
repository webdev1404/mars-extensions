<div id="register-form">
	<article>
		<form action="{{ $app.url }}" method="post">
			@csrf
			<input type="hidden" name="action" value="register" />

			<div class="form-fields">
				{{ $plugins.run('user_register_form_fields_before') }}

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
				
				@if ($config.user.register.registration.show_agreement)
				<div class="form-field agreement-field">
					<label for="agreement"></label>
					<input type="checkbox" id="agreement" name="agreement" required /> <a href="{{ $url.route('register.agreement') }}" target="_blank">{{ agreement_read }}</a>
				</div>
				@endif

				{{ $plugins.run('user_register_form_fields_after') }}
				
				<div class="form-field">
					<input type="submit" value="{{ register }}" />
				</div>

				{! $app.captcha.output() !}
			</div>

		</form>
	</article>
</div>