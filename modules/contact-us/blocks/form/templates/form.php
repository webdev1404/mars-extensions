@global ('title', 'contact_us')

<div id="contact-us">
	<article>
		<form action="{{ $app.url }}" method="post">
			<input type="hidden" name="action" value="send" />

			<table>
				<tr>
					<td><label for="email">{{ email }}</label></td>
					<td><input type="email" id="email" name="email" value="{{ $model.email }}" /></td>
				</tr>
				<tr>
					<td><label for="from">{{ from }}</label></td>
					<td><input type="text" id="from" name="from" value="{{ $model.from }}" /></td>
				</tr>
				<tr>
					<td><label for="subject">{{ subject }}</label></td>
					<td><input type="text" id="subject" name="subject" value="{{ $model.subject }}" /></td>
				</tr>
				<tr>
					<td><label for="message">{{ message }}</label></td>
					<td><textarea name="message" id="message">{{ $model.message }}</textarea>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="{{ send }}" /></td>
				</tr>

				{! $app.captcha.output() !}
			</table>

		</form>
	</article>
</div>