<div class="content-popup animated bounceInDown">
	<div class="popup-intro">
		<h3>Zaloguj się</h3>
		<p>Nie masz konta? <a href="{{ URL::to('/zarejestruj ') }}" class="js-signup-popup">Zarejestruj się!</a></p>
	</div>
	<a class="btn-default btn-social-auth btn-facebook btn-green btn-block btn-lg" href="{{ route('social-login', array('facebook')) }}?onsuccess={{ $url }}&onerror=/zaloguj">Połącz przez Facebook</a>
	<hr />
	{{ Form::open(array('url' => '/auth/login', 'class' => 'form-auth')) }}
		<input type="email" id="email" name="email" class="input-default" placeholder="Twój E-mail">	
		<input type="password" id="password" name="password" class="input-default" placeholder="Hasło">
		<input type="submit" value="Zaloguj" class="btn-default btn-green btn-block btn-lg btn-submit">
		<input type="hidden" name="redirect" value="{{ $url }}">
		<a href="{{ URL::to('/niepamietam') }}" class="btn-sm-link">Nie pamiętam hasła</a>
	{{ Form::close() }}
	</form>
	
</div>