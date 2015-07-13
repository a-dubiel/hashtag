@extends('user.master')

@section('content')

<div class="container">
	<h1>Konto</h1>
	<nav class="nav-account">
		<ul>
			<li><a href="{{ URL::to('/konto') }}">Ustawienia</a></li>
			<li><a class="active" href="{{ URL::to('/konto/tablice') }}">Tablice</a></li>
			@if($user->level == 1 )
			<li><a href="{{ URL::to('/konto/pro') }}" class="btn-get-pro">Konto Pro</a></li>
			@else
			<li><a href="{{ URL::to('/konto/pro/subskrypcja') }}">Konto Pro</a></li>
			@endif
		</ul>
	</nav>
	<div class="account-content clearfix">
		<div class="account-module-info">
			<h3>Nowa tablica</h3>
			<p>Dodaj nową tablicę.</p>
		</div>
		
		<div class="account-user-module board-settings-wrapper board-add-wrapper">
		{{ Form::open(array('method' => 'post', 'url' => '/board/add', 'class' => '', 'files' => true )) }}

			<div class="board-setting">
				<label class="setting-description">Hasztag</label>
				<div class="input-wrapper">
					<div class="input-prepend">
	                    <div class="input-icon">
	                        <span>#</span>
	                    </div>
	                    <div class="input-with-icon">
	                        <input type="text" class="input-default @if ($errors->has('hashtag'))has-error @endif" name="hashtag" placeholder="hasztag" value="{{ Input::old('hashtag') }}">
	                        @if ($errors->has('hashtag')) <p class="help-block">{{ $errors->first('hashtag') }}</p> @endif
	                    </div>
	                </div>
                </div>
			</div>

			<div class="board-setting">
				<label class="setting-description">Opis</label>
				<div class="input-wrapper">
					<textarea maxlength="100" class="textarea-default board-description" name="description" id="">{{ Input::old('description') }}</textarea>
					<p class="input-info">Pozostało znaków: <span class="js-board-counter">160</span></p>
				</div>
			</div>

			<div class="board-setting">
				<label class="setting-description">Zdjęcie profilowe</label>
				<div class="input-wrapper">	
					<h4>Dodaj zdjęcie profilowe</h4>			
					<input type="file" name="avatar" id="">
					<p class="input-info">Format: JPEG, PNG, JPG. Max: 1 MB. Conajmniej: 300px x 300px.</p>
					@if ($errors->has('avatar')) <p class="help-block">{{ $errors->first('avatar') }}</p> @endif
				</div>
			</div>

			<div class="board-setting">
				<label class="setting-description">Tło tablicy</label>
				<div class="input-wrapper">	
					<h4>Dodaj tło</h4>				
					<input type="file" name="cover" id="">
					<p class="input-info">Format: JPEG, PNG, JPG. Max: 3 MB. Conajmniej: 1200px x 150px.</p>
					@if ($errors->has('cover')) <p class="help-block">{{ $errors->first('cover') }}</p> @endif
				</div>
			</div>
				
				<div class="board-setting">
					<label class="setting-description">Sieci</label>
						<div class="input-wrapper">
							<label><input type="checkbox" @if(Input::old('has_fb')) checked="checked" @endif name="has_fb" value="0"> Facebook</label>
							<label><input type="checkbox" @if(Input::old('has_insta')) checked="checked" @endif name="has_insta" value="0"> Instagram</label>
							<label><input type="checkbox" @if(Input::old('has_tw')) checked="checked" @endif name="has_tw" value="0"> Twitter</label>
							<label><input type="checkbox" @if(Input::old('has_google')) checked="checked" @endif name="has_google" value="0"> Google Plus</label>
							<label><input type="checkbox" @if(Input::old('has_vine')) checked="checked" @endif name="has_vine" value="0"> Vine</label>
						</div>
				</div>

				<div class="board-setting">
					<label class="setting-description">Profil Facebook</label>
					<div class="input-wrapper">
						<div class="input-prepend with-url">
		                    <div class="input-icon input-url">
		                        <span>http://www.facebook.com/</span>
		                    </div>
		                    <div class="input-with-icon">
		                        <input type="text" class="input-default" value="{{ Input::old('fb_user') }}" name="fb_user">
		                    </div>
		                </div>
	                </div>
				</div>

				<div class="board-setting">
					<label class="setting-description">Profil Instagram</label>
					<div class="input-wrapper">
						<div class="input-prepend with-url">
		                    <div class="input-icon input-url">
		                        <span>http://www.instagram.com/</span>
		                    </div>
		                    <div class="input-with-icon">
		                        <input type="text" class="input-default" value="{{ Input::old('insta_user') }}" name="insta_user">
		                    </div>
		                </div>
	                </div>
				</div>

				<div class="board-setting">
					<label class="setting-description">Profil Twitter</label>
					<div class="input-wrapper">
						<div class="input-prepend with-url">
		                    <div class="input-icon input-url">
		                        <span>http://www.twitter.com/</span>
		                    </div>
		                    <div class="input-with-icon">
		                        <input type="text" class="input-default" value="{{ Input::old('tw_user') }}" name="tw_user">
		                    </div>
		                </div>
	                </div>
				</div>

				<div class="board-setting">
					<label class="setting-description">Profil Google</label>
					<div class="input-wrapper">
						<div class="input-prepend with-url">
		                    <div class="input-icon input-url">
		                        <span>https://plus.google.com/</span>
		                    </div>
		                    <div class="input-with-icon">
		                        <input type="text" class="input-default" value="{{ Input::old('google_user') }}" name="google_user">
		                    </div>
		                </div>
	                </div>
				</div>

				<div class="board-setting">
					<label class="setting-description">Strona WWW</label>
					<div class="input-wrapper">
						<input type="url" class="input-default @if ($errors->has('website_url ')) has-error @endif" name="website_url" value="{{ Input::old('website_url') }}" placeholder="http://www.example.com">
						@if ($errors->has('website_url')) <p class="help-block">{{ $errors->first('website_url') }}</p> @endif
	                </div>
				</div>
				<hr />
				<div class="board-setting">
					<label class="setting-description">Filtr słów </label>
					<div class="input-wrapper">
						<input type="text" value="{{ Input::old('filter') }}" class="input-default" @if($user->level == 1 ) disabled="disabled" @endif name="filter">
						<p class="input-info">Niedozwolone słowa (oddziel przecinkiem)</p>
	                </div>
				</div>

				<div class="board-setting">
					<label class="setting-description">Filtr użytkowników </label>
					<div class="input-wrapper">
						<input type="text" value="{{ Input::old('banned_users') }}" @if($user->level == 1 ) disabled="disabled" @endif class="input-default" name="banned_users">
						<p class="input-info">Nazwy użytkowników zbanowanych (oddziel przecinkiem)</p>
	                </div>
				</div>

				<div class="board-setting">
					<label class="setting-description">Live </label>
					<div class="input-wrapper">
						<label class="label-inline"><input  @if($user->level == 1 ) disabled="disabled" @endif type="checkbox" name="live" @if(Input::old('live')) checked="checked" @endif value="1"> Włączone</label>
						<p class="input-info">Automatycznie dodawanie nowych postów</p>
	                </div>
				</div>

				<div class="board-setting">
					<label class="setting-description">Odświeżanie </label>
					<div class="input-wrapper">
						<input type="number" value="{{ Input::old('refresh_interval') }}" min="10" max="120" placeholder="10-120" class="input-default input-number @if ($errors->has('refresh_interval ')) has-error @endif" @if($user->level == 1 ) disabled="disabled" @endif name="refresh_interval">
						<p class="input-info">Automatyczne sprawdzanie nowych postów (w sekundach, domyślnie: 30)</p>
						@if ($errors->has('refresh_interval')) <p class="help-block">{{ $errors->first('refresh_interval') }}</p> @endif
	                </div>
				</div>

				<div class="board-setting">
					<label class="setting-description">Ilość odświeżeń </label>
					<div class="input-wrapper">
						<input type="number" value="{{ Input::old('refresh_count') }}" min="1" max="100" placeholder="1-100" class="input-default input-number @if ($errors->has('refresh_count ')) has-error @endif" @if($user->level == 1 ) disabled="disabled" @endif name="refresh_count">
						<p class="input-info">Ilość odświeżeń tablicy (domyślnie: 2)</p>
						@if ($errors->has('refresh_count')) <p class="help-block">{{ $errors->first('refresh_count') }}</p> @endif
	                </div>
				</div>
				<hr />
				<div class="board-setting">
					<label class="setting-description">Prezentacja </label>
					<div class="input-wrapper">
						<label class="label-inline"><input  @if($user->level == 1 ) disabled="disabled" @endif type="checkbox" name="presentation" @if(Input::old('presentation')) checked="checked" @endif value="1"> Włączone</label>
						<p class="input-info">Opis prezentacji</p>
	                </div>
				</div>

				<div class="board-setting">
				<label class="setting-description">Tło prezentacji</label>
				<div class="input-wrapper">	
					<h4>Dodaj tło prezentacji</h4>				
					<input type="file" name="presentation_cover" id="">
					<p class="input-info">Format: JPEG, PNG, JPG. Max: 4 MB. Conajmniej: 1200px szerokości</p>
					@if ($errors->has('presentation_cover')) <p class="help-block">{{ $errors->first('presentation_cover') }}</p> @endif
				</div>

				<div class="board-setting">
					<label class="setting-description">Kolor </label>
					<div class="input-wrapper">
						<label class="label-inline"><input  @if($user->level == 1 ) disabled="disabled" @endif type="text" class="input-default input-number" id="picker" name="color" value="{{ Input::old('color') }}"></label>
						<p class="input-info">Kolor linków i przycisków. Kliknij aby wybrać.</p>
	                </div>
				</div>
			</div>

				
				
				<input type="submit" class="btn-default btn-submit btn-lg btn-green" value="Dodaj">	

				{{ Form::close() }}	

	</div>
</div>

</div>

{{ Asset::add('js/libs/colpick.css') }}


@stop