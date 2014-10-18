<div class="content-popup animated bounceInDown">
	<div class="popup-intro">
		<h3>Zarejestruj się</h3>
		<p>Masz już konto? <a href="{{ URL::to('/zaloguj') }}" class="js-login-popup">Zaloguj się!</a></p>
	</div>
	<a class="btn-default btn-social-auth btn-instagram btn-green btn-block btn-lg" href="{{ route('social-login', array('instagram')) }}?onsuccess={{ $url }}&onerror=/zaloguj">Połącz przez Instagram</a>
	<a class="btn-default btn-social-auth btn-facebook btn-green btn-block btn-lg" href="{{ route('social-login', array('facebook')) }}?onsuccess={{ $url }}&onerror=/zaloguj">Połącz przez Facebook</a>
	<a class="btn-default btn-social-auth btn-twitter btn-green btn-block btn-lg" href="{{ route('social-login', array('twitter')) }}?onsuccess={{ $url }}&onerror=/zaloguj">Połącz przez Twitter</a>
	<hr />
	<p class="form-note">Rejestrując się w naszym serwisie akceptujesz <a href="{{ URL::to('/regulamin') }}">regulamin</a></p>
</div>