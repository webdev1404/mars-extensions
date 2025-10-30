<div id="contact-us-form">
	<article>
		<form action="{{ $app.url }}" method="post">
			@csrf
			<input type="hidden" name="action" value="send" />

			<div class="form-fields">
				<div class="form-field">
					<label for="email">{{ email }}</label>
					<input type="email" id="email" name="email" value="{{ $model.email }}" required />
				</div>
				<div class="form-field">
					<label for="from">{{ from }}</label>
					<input type="text" id="from" name="from" value="{{ $model.from }}" required />
				</div>
				<div class="form-field">
					<label for="subject">{{ subject }}</label>
					<input type="text" id="subject" name="subject" value="{{ $model.subject }}" required />
				</div>
				<div class="form-field">
					<label for="message">{{ message }}</label>
					<textarea name="message" id="message" required>{{ $model.message }}</textarea>
				</div>
				<div class="form-field">
					<input type="submit" value="{{ send }}" />
				</div>

				{! $app.captcha.output() !}
			</div>

		</form>
	</article>
</div>