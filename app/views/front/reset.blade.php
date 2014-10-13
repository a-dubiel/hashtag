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
				
				<div class="content-popup">
					<div class="popup-intro">
						<h3>Nowe hasło</h3>
						<p>Wypełnij pola poniżej aby utworzyć nowe hasło.</a></p>
					</div>
					<form action="{{ URL::to('/password/reset') }}" method="POST" class="form-auth">
					    <input type="hidden" name="token" value="{{ $token }}">
					    <input type="email" name="email" class="input-default" placeholder="E-mail">
					    <input type="password" name="password"  class="input-default" placeholder="Nowe hasło">
					    <input type="password" name="password_confirmation"  class="input-default" placeholder="Powtórz nowe hasło">
					    <input type="submit" value="Resetuj hasło" class="btn-default btn-green btn-block btn-lg btn-submit">
					</form>
				</div>
		
		</div>
	</div>
</div>


@stop