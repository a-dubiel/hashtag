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
			<div class="board-top-links">
				@if($board->config()->first()->is_active == 1)
					<a href="{{ URL::to("$board->hashtag/$board->id") }}" class="btn-default btn-sm btn-green-inverted pull-right">Zobacz Tablicę</a>
				@endif
				@if($board->config()->first()->presentation == 1)
					<a href="{{ URL::to("$board->hashtag/$board->id/live") }}" class="btn-default btn-sm btn-green-inverted pull-right add-right">Zobacz Prezentację</a>
				@endif
			</div>
			<h3>#{{ $board->hashtag }}</h3>
			<p>Tutaj możesz zmienić ustawienia tej tablicy.</p>

		</div>
		
		<div class="account-user-module board-settings-wrapper">

		{{ Form::open(array('method' => 'post', 'url' => '/board/update', 'class' => '', 'files' => true )) }}

			<div class="board-setting">
				<label class="setting-description">Hasztag</label>
				<div class="input-wrapper">
					<div class="input-prepend">
	                    <div class="input-icon">
	                        <span>#</span>
	                    </div>
	                    <div class="input-with-icon">
	                        <input type="text" class="input-default @if ($errors->has('hashtag'))has-error @endif" name="hashtag" placeholder="hasztag" value={{ $board->hashtag }}>
	                        @if ($errors->has('hashtag')) <p class="help-block">{{ $errors->first('hashtag') }}</p> @endif
	                    </div>
	                </div>
                </div>
			</div>

			<div class="board-setting">
				<label class="setting-description">Opis</label>
				<div class="input-wrapper">
					<textarea maxlength="100" class="textarea-default board-description" name="description" id="">{{ $board->description }}</textarea>
					<p class="input-info">Pozostało znaków: <span class="js-board-counter">160</span></p>
				</div>
			</div>

			<div class="board-setting">
				<label class="setting-description">Zdjęcie profilowe</label>

				<div class="input-wrapper">	
					@if(is_null($board->avatar_file_name))
						<span class="no-data">Brak zdjęcia profilowego. Dodaj je!</span>
					@else
						<div class="board-avatar">
							<img src="{{ $board->avatar->url('thumbCrop') }}" alt="" />
						</div>
						<label><input type="checkbox" name="delete_avatar" value="1" id=""> Usuń zdjęcie profilowe</label>
					@endif
					<h4>Zmień zdjęcie profilowe</h4>			
					<input type="file" name="avatar" id="">
					<p class="input-info">Format: JPEG, PNG, JPG. Max: 1 MB. Conajmniej: 300px x 300px.</p>
					@if ($errors->has('avatar')) <p class="help-block">{{ $errors->first('avatar') }}</p> @endif
				</div>
			</div>

			<div class="board-setting">
				<label class="setting-description">Tło tablicy</label>
				<div class="input-wrapper">
					@if(is_null($board->cover_file_name))
						<span class="no-data">Brak tła. Dodaj je!</span>
					@else
					<div class="board-cover">
						<img src="{{ $board->cover->url('standardCrop') }}" alt="" />		
					</div>
					<label><input type="checkbox" name="delete_cover" value="1" id=""> Usuń tło</label>
					@endif
					<h4>Zmień tło</h4>				
					<input type="file" name="cover" id="">
					<p class="input-info">Format: JPEG, PNG, JPG. Max: 3 MB. Conajmniej: 1200px x 150px.</p>
					@if ($errors->has('cover')) <p class="help-block">{{ $errors->first('cover') }}</p> @endif
				</div>
			</div>
				
				<div class="board-setting">
					<label class="setting-description">Sieci</label>
						<div class="input-wrapper">
							<label><input type="checkbox" @if($config->has_fb == 0) checked="checked" @endif name="has_fb" value="0"> Facebook</label>
							<label><input type="checkbox" @if($config->has_insta == 0) checked="checked" @endif name="has_insta" value="0"> Instagram</label>
							<label><input type="checkbox" @if($config->has_tw == 0) checked="checked" @endif name="has_tw" value="0"> Twitter</label>
							<label><input type="checkbox" @if($config->has_google == 0) checked="checked" @endif name="has_google" value="0"> Google Plus</label>
							<label><input type="checkbox" @if($config->has_vine == 0) checked="checked" @endif name="has_vine" value="0"> Vine</label>
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
		                        <input type="text" class="input-default" value="{{ $board->fb_user }}" name="fb_user">
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
		                        <input type="text" class="input-default" value="{{ $board->insta_user }}" name="insta_user">
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
		                        <input type="text" class="input-default" value="{{ $board->tw_user }}" name="tw_user">
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
		                        <input type="text" class="input-default" value="{{ $board->google_user }}" name="google_user">
		                    </div>
		                </div>
	                </div>
				</div>

				<div class="board-setting">
					<label class="setting-description">Strona WWW</label>
					<div class="input-wrapper">
						<input type="url" class="input-default @if ($errors->has('website_url')) has-error @endif" name="website_url" value="{{ $board->website_url }}" placeholder="http://www.example.com">
						@if ($errors->has('website_url')) <p class="help-block">{{ $errors->first('website_url') }}</p> @endif
	                </div>
				</div>
				<hr />
				<div class="board-setting">
					<label class="setting-description">Filtr słów @if($user->level == 1 ) <span class="pro">Pro</span> @endif</label>
					<div class="input-wrapper">
						<input type="text" value="{{ $config->filter }}" class="input-default" @if($user->level == 1 ) disabled="disabled" @endif name="filter">
						<p class="input-info">Niedozwolone słowa (oddziel przecinkiem)</p>
	                </div>
				</div>

				<div class="board-setting">
					<label class="setting-description">Filtr użytkowników @if($user->level == 1 ) <span class="pro">Pro</span> @endif</label>
					<div class="input-wrapper">
						<input type="text" value="{{ $config->banned_users }}" @if($user->level == 1 ) disabled="disabled" @endif class="input-default" name="banned_users">
						<p class="input-info">Nazwy użytkowników zbanowanych (oddziel przecinkiem)</p>
	                </div>
				</div>

				<div class="board-setting">
					<label class="setting-description">Live @if($user->level == 1 ) <span class="pro">Pro</span> @endif</label>
					<div class="input-wrapper">
						<label class="label-inline"><input  @if($user->level == 1 ) disabled="disabled" @endif type="checkbox" name="live" @if($config->live == 1) checked="checked" @endif value="1"> Włączone</label>
						<p class="input-info">Automatycznie dodawanie nowych postów</p>
	                </div>
				</div>

				<div class="board-setting">
					<label class="setting-description">Odświeżanie @if($user->level == 1 ) <span class="pro">Pro</span> @endif</label>
					<div class="input-wrapper">
						<input type="number" @if($config->refresh_interval != 30 ) value="{{ $config->refresh_interval }}" @endif min="10" max="120" placeholder="10-120" class="input-default input-number @if ($errors->has('refresh_interval ')) has-error @endif" @if($user->level == 1 ) disabled="disabled" @endif name="refresh_interval">
						<p class="input-info">Automatyczne sprawdzanie nowych postów (w sekundach, domyślnie: 30)</p>
						@if ($errors->has('refresh_interval')) <p class="help-block">{{ $errors->first('refresh_interval') }}</p> @endif
	                </div>
				</div>

				<div class="board-setting">
					<label class="setting-description">Ilość odświeżeń @if($user->level == 1 ) <span class="pro">Pro</span> @endif</label>
					<div class="input-wrapper">
						<input type="number" @if($config->refresh_count != 2 ) value="{{ $config->refresh_count }}"  @endif min="1" max="100" placeholder="1-100" class="input-default input-number @if ($errors->has('refresh_count ')) has-error @endif" @if($user->level == 1 ) disabled="disabled" @endif name="refresh_count">
						<p class="input-info">Ilość odświeżeń tablicy (domyślnie: 2)</p>
						@if ($errors->has('refresh_count')) <p class="help-block">{{ $errors->first('refresh_count') }}</p> @endif
	                </div>
				</div>
				<hr />
				<div class="board-setting">
					<label class="setting-description">Prezentacja @if($user->level == 1 ) <span class="pro">Pro</span> @endif</label>
					<div class="input-wrapper">
						<label class="label-inline"><input  @if($user->level == 1 ) disabled="disabled" @endif type="checkbox" name="presentation" @if($config->presentation == 1) checked="checked" @endif value="1"> Włączone</label>
						<p class="input-info">Opis prezentacji</p>
	                </div>
				</div>

				<div class="board-setting">
				<label class="setting-description">Tło prezentacji</label>
				<div class="input-wrapper">
					@if(is_null($board->presentation_cover_file_name))
						<span class="no-data">Brak tła. Dodaj je!</span>
					@else
					<div class="board-cover">
						<img src="{{ $board->presentation_cover->url('standard') }}" alt="" />		
					</div>
					<label><input type="checkbox" name="delete_presentation_cover" value="1" id=""> Usuń tło</label>
					@endif
					<h4>Zmień tło</h4>				
					<input type="file" name="presentation_cover" id="">
					<p class="input-info">Format: JPEG, PNG, JPG. Max: 4 MB. Conajmniej: 1200px szerokości</p>
					@if ($errors->has('presentation_cover')) <p class="help-block">{{ $errors->first('presentation_cover') }}</p> @endif
				</div>

				<div class="board-setting">
					<label class="setting-description">Kolor @if($user->level == 1 ) <span class="pro">Pro</span> @endif</label>
					<div class="input-wrapper">
						<label class="label-inline"><input  @if($user->level == 1 ) disabled="disabled" @endif type="text" class="input-default input-number @if ($errors->has('color')) has-error @endif" id="picker" name="color" value="{{ $config->color }}"></label>
						<p class="input-info">Kolor linków i przycisków. Kliknij aby wybrać.</p>
						@if ($errors->has('color')) <p class="help-block">{{ $errors->first('color') }}</p> @endif
	                </div>
				</div>
			</div>
				
				<input type="hidden" name="board_id" value="{{ $board->id }}">

				<input type="submit" class="btn-default btn-submit btn-lg btn-green" value="Aktualizuj">	

				{{ Form::close() }}

				<hr />

				{{ Form::open(array('method' => 'post', 'url' => '/board/change/status', 'class' => 'form-inline' )) }}
					<input type="hidden" name="board_id" value="{{ $board->id }}">
					@if($board->config()->first()->is_active == 1)
						<input type="hidden" name="activate" value="0">
						<button type="submit" class="btn-submit btn-link btn-lg btn-default btn-gray-inverted"><i class="fa fa-times"></i> Deaktywuj</button>
					@else
						<input type="hidden" name="activate" value="1">
						<button type="submit" class="btn-submit btn-link btn-lg btn-default btn-green-inverted"><i class="fa fa-check"></i> Aktywuj</button>
					@endif
				{{ Form::close() }}

				{{ Form::open(array('method' => 'post', 'url' => '/board/delete', 'class' => 'form-inline' )) }}
					<input type="hidden" name="board_id" value="{{ $board->id }}">
					<button type="submit" class="js-confirm btn-submit btn-link btn-lg btn-default btn-red-inverted"><i class="fa fa-trash-o"></i> Usuń Tablicę</button>
		
				{{ Form::close() }}





	</div>
</div>

</div>

{{ Asset::add('js/libs/colpick.css') }}


	
	



@stop