@extends('user.master')

@section('content')

<div class="container">
	<h1>Konto</h1>
	<nav class="nav-account">
		<ul>
			<li><a class="active" href="{{ URL::to('/konto') }}">Ustawienia</a></li>
			<li><a href="{{ URL::to('/konto/tablice') }}">Tablice</a></li>
			<!--
			@if($user->level == 1 )
			<li><a href="{{ URL::to('/konto/pro') }}" class="btn-get-pro">Konto Pro</a></li>
			@else
			<li><a href="{{ URL::to('/konto/pro/subskrypcja') }}">Konto Pro</a></li>
			@endif
			-->
		</ul>
	</nav>
	<div class="account-content clearfix">
		<div class="account-user-info">
		
			@if($user->default_provider == 'facebook')
				@foreach($user->provider()->get() as $provider)
                    @if($provider->provider == 'facebook')
                    	<img src="https://graph.facebook.com/{{ $provider->provider_id }}/picture?type=large" alt="avatar" class="user-avatar-lg" />
                  	@endif
                @endforeach
            @elseif($user->default_provider == 'instagram')
                @foreach($user->provider()->get() as $provider)
                    @if($provider->provider == 'instagram')
                    	<img src="{{ $provider->profile_picture }}" alt="avatar" class="user-avatar-lg" /> 
                    @endif
                @endforeach
             @elseif($user->default_provider == 'twitter')
                @foreach($user->provider()->get() as $provider)
                    @if($provider->provider == 'twitter')
                    	<img src="{{ $provider->profile_picture }}" alt="avatar" class="user-avatar-lg" /> 
                    @endif
                @endforeach
             @else				
				<i class="fa fa-user"></i>
             @endif
                

			<h3>{{ $username }}</h3>
			
			<?php 
			/**
				if($user->level == 1) {
					echo '<span class="account-type account-basic">Konto Podstawowe</span>';
				}
				else if($user->level == 2) {
					echo '<span class="account-type account-pro">Konto Pro</span>';
				}
*/
			?>
			<hr />
		</div>
		@if(!is_null($user->subscription()->first()) && $user->subscription()->first()->is_active == 0)

		   <div class="alert alert-error add-bottom">
				<p>Twoja Subskrypcja jest nieaktywna. Mieliśmy problem z obciążeniem Twojej karty. Skontaktuj się ze swoim bankiem albo sprawdź swoje fundusze na karcie. Spróbujemy obciążyć Twoją kartę ponownie jutro. Do tego czasu wszystkie Twoje tablice pozostaną nieaktywne. Jeżeli chcesz zmienić kartę lub ustawienia płatności przejdź do ustawień subskrypcji.</p>
		   </div>
		@endif
		<div class="account-user-module">
			<h3>Aktualizuj E-mail</h3>
			{{ Form::open(array('url' => '/auth/update/email', 'class' => '', 'action' => 'post')) }}
				<input class="input-default @if ($errors->has('email'))has-error @endif" type="email" name="email" value="{{ $user->email }}" id="">
				@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif	
				<button type="submit" class="btn-default btn-green btn-submit btn-lg">Aktualizuj</button>
			{{ Form::close() }}
		</div>
		@if($providers->count() > 0)
			<div class="account-user-module">
				<h3>Połączone konta</h3>
			
					@foreach($providers as $provider)
						
						<div class="form-provider clearfix">
							<span>{{ $provider->provider }}</span>
							@if($user->default_provider == $provider->provider)
								<i class="fa fa-check green"></i>
							@endif
							<div class="pull-right">
								@if($user->default_provider != $provider->provider)
									<a href="{{ URL::to('/konto/login/ustaw/'.$provider->provider) }}" class="btn-default btn-sm btn-green-inverted">Ustaw Domyślne</a>
								@endif
								
								<a href="{{ URL::to('/konto/login/usun/'.$provider->provider) }}" class="btn-default btn-sm btn-red-inverted"><i class="fa fa-times"></i></a>
							</div>
						</div>	
				
					@endforeach
			</div>
		@else
			<div class="account-user-module">
				<h3>Zmień hasło</h3>
					{{ Form::open(array('url' => '/auth/update/password', 'class' => '', 'action' => 'post')) }}
						<input class="input-default @if ($errors->has('old_password'))has-error @endif" type="password" name="old_password" placeholder="Stare hasło">
						@if ($errors->has('old_password')) <p class="help-block">{{ $errors->first('old_password') }}</p> @endif	
						<input class="input-default @if ($errors->has('new_password'))has-error @endif" type="password" name="new_password" placeholder="Nowe hasło">
						@if ($errors->has('new_password')) <p class="help-block">{{ $errors->first('new_password') }}</p> @endif
						<input class="input-default @if ($errors->has('new_password_confirm'))has-error @endif" type="password" name="new_password_confirm" placeholder="Powtórz nowe hasło">
						@if ($errors->has('new_password_confirm')) <p class="help-block">{{ $errors->first('new_password_confirm') }}</p> @endif
						<input type="hidden" name="user_id" value="{{ $user->id }}">
						<button type="submit" class="btn-default btn-green btn-submit btn-lg">Aktualizuj</button>
					{{ Form::close() }}
			</div>
		@endif
		<div class="clearfix"></div>
	</div>
</div>


@stop