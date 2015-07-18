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
				<div class="fill-me">
					  <label for="fill">Your name</label>
					  <input type="text" name="fill" id="fill" value="" />
					</div>
				<input type="submit" value="Szukaj">
			{{ Form::close() }}
		</div>
		<nav class="nav-user">
			 @include('user.user-nav')
		</nav>
	</div>
</header>

<div class="container">
	<div class="page-with-padding">
		
		<div class="page-content page-about">
			
			<div class="row section-pricing">
				<div class="col-lg-8 col-lg-offset-2 col-md-8 cold-md-offset-2 col-sm-8 col-sm-offset-2 about-intro">
					<div class="logo-big"></div>
					<h1>Nasza oferta</h1>
					<p>Dla każdego coś dobrego. Poniżej zestawienie każdej z ofert. Plan podstawowy to doskonały początek. Jeżeli jednak masz większe potrzeby to zapoznaj się z ofertą Pro.</p>
				</div>
				<div class="clearfix"></div>
					<div class="col-lg-8 col-lg-offset-2 col-md-8 cold-md-offset-2 col-sm-8 col-sm-offset-2 add-bottom">
						
						<div class="row">
						<h3>Plan Pro</h3>
						<div class="col-lg-6 col-md-6 col-sm-6 home-section home-section-pro">
							<div class="home-section-icon"><img src="{{ URL::to('/images/filter.svg') }}" class="svg svg-filter" /></div>
							<h4>Administracja</h4>
							<p>Pełna kontrola nad Twoją tablicą. Filtruj treść postów oraz banuj niegrzecznych użytkowników.</p>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 home-section home-section-pro">
							<div class="home-section-icon"><img src="{{ URL::to('/images/live.svg') }}" class="svg svg-live" /></div>
							<h4>Live</h4>
							<p>Automatycznie, w ciągu kilku sekund najnowsze posty pojawią się na Twojej tablicy. Lubię to!</p>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 home-section home-section-pro">
							<div class="home-section-icon"><img src="{{ URL::to('/images/board.svg') }}" class="svg svg-board" /></div>
							<h4>Więcej Tablic</h4>
							<p>Lepiej jak jest więcej. Będąc posiadaczem konta Pro masz pięć dodatkowych tablic.</p>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 home-section home-section-pro">
							<div class="home-section-icon"><img src="{{ URL::to('/images/star.svg') }}" class="svg svg-star" /></div>
							<h4>Promowane Posty</h4>
							<p>Promowane posty to świetny sposób aby wyróżnić swoich ulubionych użytkowników.</p>
						</div>

						<div class="clearfix"></div>

						<div class="col-lg-6 col-md-6 col-sm-6 home-section home-section-pro">
							<div class="home-section-icon"><img src="{{ URL::to('/images/brand.svg') }}" class="svg svg-brand" /></div>
							<h4>Własny Branding</h4>
							<p>Wyróżnij się. Każda tablica posiada swój avatar, tło oraz kolory które możesz zmienić wedle życzenia.</p>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 home-section home-section-pro">
							<div class="home-section-icon"><img src="{{ URL::to('/images/presentation.svg') }}" class="svg svg-presentation" /></div>
							<h4>Prezentacja</h4>
							<p>Konferencja, impreza czy koncert. Wrzuć tablicę na duży ekran i pozwól uczestnikom na niej zainstnieć.</p>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 home-section home-section-pro">
							<div class="home-section-icon"><img src="{{ URL::to('/images/network.svg') }}" class="svg svg-network" /></div>
							<h4>Wybór Sieci</h4>
							<p>Ustaw z jakich sieci Twoja tablica ma pobierać posty. Facebook, Instagram, Twitter, Vine czy Google.</p>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 home-section home-section-pro">
							<div class="home-section-icon"><img src="{{ URL::to('/images/link.svg') }}" class="svg svg-link" /></div>
							<h4>Twoje Linki</h4>
							<p>Umieść na tablicy odnośniki do profili społecznościowych oraz strony internetowej.</p>
						</div>
						
					</div>

				</div>

				<div class="col-lg-8 col-lg-offset-2 col-md-8 cold-md-offset-2 col-sm-8 col-sm-offset-2 hidden-xs hidden-sm">
					<h3>Prezentacja</h3>
						<div class="row">
							<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 home-section home-section-pro">
								<p>Opcja prezentacji, czyli pełnoekranowa wersja tablicy to doskonały sposób aby zachęcić uczestników Twojej imprezy lub konferencji do udziału w wydarzeniu.</p>
							</div>
					</div>
					<div class="mac-background ">
						<div class="presentation-image"></div>
					</div>
					
				</div>
				
				<div class="col-lg-8 col-lg-offset-2 col-md-8 cold-md-offset-2 col-sm-8 col-sm-offset-2">
					<h3>Porównaj Plany</h3>
					<table class="table-pricing">
					  <tr class="heading">
					    <th>&nbsp;</th>
					    <th>Plan Podstawowy</th>
					    <th>Plan Pro</th>
					  </tr>
					  
					  <tr>
					  	<td>Ilość Tablic</td>
					  	<td>1</td>
					  	<td>5</td>
					  </tr>

					  <tr>
					  	<td>Promowane Posty</td>
					  	<td>5</td>
					  	<td>100</td>
					  </tr>

					  <tr>
					  	<td>Avatar i tło Tablicy</td>
					  	<td><i class="fa green fa-check"></i></td>
					  	<td><i class="fa green fa-check"></i></td>
					  </tr>

					  <tr>
					  	<td>Wybór sieci</td>
					  	<td><i class="fa green fa-check"></i></td>
					  	<td><i class="fa green fa-check"></i></td>
					  </tr>

					  <tr>
					  	<td>Linki do profilów</td>
					  	<td><i class="fa green fa-check"></i></td>
					  	<td><i class="fa green fa-check"></i></td>
					  	
					  </tr>

					  <tr>
					  	<td>Blokowanie użytkowników</td>
					  	<td><i class="fa red fa-times"></i></td>
					  	<td><i class="fa green fa-check"></i></td>
					  	
					  </tr>

					  <tr>
					  	<td>Moderacja słów</td>
					  	<td><i class="fa red fa-times"></i></td>
					  	<td><i class="fa green fa-check"></i></td>
					  	
					  </tr>

					  <tr>
					  	<td>Funkcja Live</td>
					  	<td><i class="fa red fa-times"></i></td>
					  	<td><i class="fa green fa-check"></i></td>
					  	
					  </tr>

					  <tr>
					  	<td>Automatyczne odświeżanie</td>
					  	<td><i class="fa red fa-times"></i></td>
					  	<td><i class="fa green fa-check"></i></td>
					  	
					  </tr>

					  <tr>
					  	<td>Funkcja Prezentacji</td>
					  	<td><i class="fa red fa-times"></i></td>
					  	<td><i class="fa green fa-check"></i></td>
					  	
					  </tr>

					  <tr>
					  	<td>Branding</td>
					  	<td><i class="fa red fa-times"></i></td>
					  	<td><i class="fa green fa-check"></i></td>
					  	
					  </tr>

					   <tr class="prices">
					  	<td></td>
					  	<td>0 zł</td>
					  	<td>
					  		79 zł/miesiąc
					  	</td>
					  	
					  </tr>
						
					 </table>
				</div>

				<div class="col-lg-8 col-lg-offset-2 col-md-8 cold-md-offset-2 col-sm-8 col-sm-offset-2">

				<div class="block-cta block-cta-white">
						<p>Załóż swoją pierwszą tablicę za darmo lub wykup Plan Pro!</p>
							<a href="{{ URL::to('/konto/tablice') }}" class="btn-default btn-lg btn-green-inverted">Dodaj tablicę</a>
							<a href="{{ URL::to('/konto/pro') }}" class="btn-default btn-lg btn-green">Wykup Plan Pro</a>
					</div>

				</div>

			</div>

		</div>

	</div>
</div>

@if(Auth::check())
   @include('user.user-dropdown')
@endif



@stop