<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Resetuj hasło</h2>

		<div>
			<p>Aby zresetować swoje hasło użyj formularza, który znajduje się pod tym linkiem: {{ URL::to('haslo/reset', array($token)) }}.<br/>
			Link wygaśnie za {{ Config::get('auth.reminder.expire', 60) }} minut.<br /></p>

			<h4>Jeżeli nie resetowałeś hasła możesz zignorować ten e-mail.</h4>

		</div>
	</body>
</html>
