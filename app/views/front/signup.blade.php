<div class="content-popup animated bounceInDown">
	<div class="popup-intro">
		<h3>Zarejestruj się</h3>
		<p>Masz już konto? <a href="{{ URL::to('/zaloguj') }}" class="js-login-popup">Zaloguj się!</a></p>
	</div>
	<a class="btn-default btn-social-auth btn-instagram btn-green btn-block btn-lg" href="{{ route('social-login', array('instagram')) }}?onsuccess={{ $url }}&onerror=/zaloguj">Połącz przez Instagram</a>
	<a class="btn-default btn-social-auth btn-facebook btn-green btn-block btn-lg" href="{{ route('social-login', array('facebook')) }}?onsuccess={{ $url }}&onerror=/zaloguj">Połącz przez Facebook</a>
	<hr />
	{{ Form::open(array('url' => '/auth/signup', 'class' => 'form-auth', 'action' => 'post')) }}
		<input type="email" id="email" name="email" class="input-default" placeholder="Twój E-mail">	
		<input type="password" id="password" name="password" class="input-default" placeholder="Hasło">
		<input type="password" id="password" name="password_confirm" class="input-default" placeholder="Potwierdź hasło">
		<input type="hidden" name="redirect" value="{{ $url }}">
		<input type="submit" value="Zarejestruj" class="btn-default btn-green btn-block btn-lg btn-submit">
	{{ Form::close() }}
</div>