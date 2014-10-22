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
						<h3>Dokończ rejestrację</h3>
						<p>Potrzebujemy Twój E-mail</p>
					</div>
					
					{{ Form::open(array('url' => '/auth/login/complete', 'class' => 'form-auth')) }}
						<?php $session = Session::all(); ?>
						<input type="email" id="email" name="email" class="input-default @if ($errors->has('email'))has-error @endif" placeholder="Twój E-mail">
						@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif	
						@if(strtolower($session['mmanos']['social']['pending']['provider']) == 'instagram')
						<input type="hidden" name="provider" value="{{ strtolower($session['mmanos']['social']['pending']['provider']) }}">
						<input type="hidden" name="provider_id" value="{{ $session['mmanos']['social']['pending']['provider_id'] }}">
						<input type="hidden" name="first_name" value="{{ $session['mmanos']['social']['pending']['user_info']['first_name'] }}">
						<input type="hidden" name="last_name" value="{{ $session['mmanos']['social']['pending']['user_info']['last_name'] }}">
						<input type="hidden" name="access_token" value="{{ $session['mmanos']['social']['pending']['access_token']['token'] }}">
						<input type="hidden" name="profile_picture" value="{{$session['mmanos']['social']['pending']['access_token']['extra_params']['user']['profile_picture']}}">
						@elseif(strtolower($session['mmanos']['social']['pending']['provider']) == 'twitter')
	
							<input type="hidden" name="provider" value="{{ strtolower($session['mmanos']['social']['pending']['provider']) }}">
							<input type="hidden" name="provider_id" value="{{ $session['mmanos']['social']['pending']['provider_id'] }}">
							<input type="hidden" name="first_name" value="{{ $session['mmanos']['social']['pending']['user_info']['first_name'] }}">
							<input type="hidden" name="last_name" value="{{ $session['mmanos']['social']['pending']['user_info']['last_name'] }}">
							<input type="hidden" name="access_token" value="{{ $session['mmanos']['social']['pending']['access_token']['token'] }}">
							<input type="hidden" name="profile_picture" value="{{$session['mmanos']['social']['pending']['user_info']['profile_picture'] }}">
						@endif
						
					

						<input type="submit" value="Dokończ rejestrację" class="btn-default btn-green btn-block btn-lg btn-submit">
			
					{{ Form::close() }}
					</form>	
				</div>
		
		</div>
	</div>
</div>



@stop