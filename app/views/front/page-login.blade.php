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
					</div><div class="fill-me">
					  <label for="fill">Your name</label>
					  <input type="text" name="fill" id="fill" value="" />
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
					<a class="btn-default btn-social-auth btn-instagram btn-green btn-block btn-lg" href="{{ route('social-login', array('instagram')) }}?onsuccess={{ $url }}&onerror=/zaloguj">Połącz przez Instagram</a>
	<a class="btn-default btn-social-auth btn-facebook btn-green btn-block btn-lg" href="{{ route('social-login', array('facebook')) }}?onsuccess={{ $url }}&onerror=/zaloguj">Połącz przez Facebook</a>
	<a class="btn-default btn-social-auth btn-twitter btn-green btn-block btn-lg" href="{{ route('social-login', array('twitter')) }}?onsuccess={{ $url }}&onerror=/zaloguj">Połącz przez Twitter</a>
				</div>
		
		</div>
	</div>
</div>



@if(Auth::check())
   @include('user.user-dropdown')
@endif


@stop