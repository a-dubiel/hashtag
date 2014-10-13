@extends('front.master')

@section('content')

<header class="board-top">
	<div class="container">
		<a href="{{ URL::to('/') }}" class="logo-main">hashtag.info</a>
		<div class="board-top-search">
			{{ Form::open(array('url' => 'szukaj')) }}
				<div class="input-prepend">
					<div class="input-icon">
						<i class="fa fa-search"></i>
					</div>
					<div class="input-with-icon">
						<input type="text" class="input-default" name="query" placeholder="Wpisz dowolny hasztag">
					</div>
				</div>
				<input type="submit" value="Szukaj">
			{{ Form::close() }}
		</div>
		<nav class="nav-user hidden-xs">
			<ul>
				<li><a class="btn-default btn-link-secondary js-login-popup" href="#">Zaloguj</a></li>
				<li><a class="btn-default btn-sm btn-green-inverted js-login-popup" href="#">Dodaj Tablicę</a></li>
			</ul>
		</nav>
	</div>
</header>



<div class="container page-board page-auth-forms">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
				
				<div class="content-popup @if($errors->any()) animated shake @endif">
					<div class="popup-intro">
						<h3>Zaloguj się</h3>
						<p>Nie masz konta? <a href="{{ URL::to('/zarejestruj ') }}">Zarejestruj się!</a></p>
					</div>
					<a class="btn-default btn-social-auth btn-facebook btn-green btn-block btn-lg" href="{{ route('social-login', array('facebook')) }}?onsuccess={{ $url }}&onerror=/login">Połącz przez Facebook</a>
					<hr />
					{{ Form::open(array('url' => '/auth/login', 'class' => 'form-auth')) }}
						<input type="email" id="email" name="email" class="input-default @if ($errors->has('email'))has-error @endif" placeholder="Twój E-mail">
						@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif		
						<input type="password" id="password" name="password" class="input-default @if ($errors->has('password'))has-error @endif" placeholder="Hasło">
						@if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
						<label class="remember-me"><input type="checkbox" name="remember" value="1" id=""> Zapamiętaj mnie</label>
						<input type="submit" value="Zaloguj" class="btn-default btn-green btn-block btn-lg btn-submit">
						<a href="{{ URL::to('/niepamietam') }}" class="btn-sm-link">Nie pamiętam hasła</a>
					{{ Form::close() }}
					</form>	
				</div>
		
		</div>
	</div>
</div>



@if(Auth::check())
<div id="dropdown-1" class="dropdown dropdown-tip dropdown-anchor-right">
	<ul class="dropdown-menu">
		<li><a href="{{ URL::to('/konto')}}"><i class="fa fa-cog"></i> Konto</a></li>
		<li><a href="{{ URL::to('/wyloguj')}}"><i class="fa fa-sign-out"></i> Wyloguj</a></li>		
		<li class="divider"></li>
		<li><a href="{{ URL::to('/wyloguj')}}"><i class="fa fa-th"></i> #wroclaw</a></li>
	</ul>
</div>
@endif


@stop