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
		<nav class="nav-user">
			@include('user.user-nav')
		</nav>
	</div>
</header>

<div class="container">
	<div class="page-with-padding">
		<div class="page-content page-about">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 col-md-8 cold-md-offset-2 col-sm-8 col-sm-offset-2 about-intro">
					<div class="logo-big"></div>
					<h1>Hasztag w nowym wcieleniu</h1>
					<p>Hasztag.info jest nowym sposbem aby odkryć media społecznościowe. Media, które tak dobrze znasz i bez których nie potrafisz się obejść.</p>
				</div>
				<div class="clearfix"></div>
				
				<div class="col-lg-8 col-lg-offset-2 col-md-8 cold-md-offset-2 col-sm-8 col-sm-offset-2 about-section">
					<h3>Nasza misja</h3>

					
					<p>Nasz cel to umożliwienie zgromadzenia informacji z wielu serwisów w jednym. Hasztag, to prosty zabieg który pozwala na dotarcie do większej ilości platform. Nasz serwis to świetne rozwiązanie dla organizacji, firm lub marek które cenią sobie społeczność którą budują wokół siebie oraz ludzi którzy do niej należą.</p>

					<p>Dzięki naszej technologii łatwiej oraz szybciej zbudujesz społeczność swojej marki oraz skupisz ludzi, których łączą te same pasję, poglądy i cele. Hasztag.info to świetne rozwiązanie w różnego akcjach marketingowych i nie tylko. Nasz serwis pozwala Ci zgromadzić wszystkie najnowsze posty w jednym miejscu. Daje to ci dostęp do większej ilości użytkowników a niżeli jakakolwiek akcja promocyjna na indywidualnej platformie.</p>
					

				</div>

				<div class="col-lg-8 col-lg-offset-2 col-md-8 cold-md-offset-2 col-sm-8 col-sm-offset-2 about-section">
					<img src="{{ URL::to('/images/macs.svg') }}" class="" />
					<h3>Jak to robimy?</h3>

					
					<p>Wszystkie serwisy społecznościowe łączy jeden wspólny mianownik - hasztagi. Nasz serwis przeszukuje te serwisy oraz w kilka sekund odnajduje posty oznaczone danym hasztagiem. Znalezione informacje prezentuje w piękny i przystępny sposób w postaci interaktywnych tablic.</p>
					
					
					<p>Żaden mechanizm mediów społecznościowych nie ma w sobie tyle skuteczności, piękna i prostoty co hasztagi. Jedno słowo, które potrafi stworzyć społeczności, wyznaczyć trend lub rozpocząć rewolucję. Słowo, które potrafi połączyć lub poróżnić ludzi.</p>

				</div>


			<div class="row">
						<div class="col-lg-8 col-lg-offset-2 col-md-8 cold-md-offset-2 col-sm-8 col-sm-offset-2 about-section">
		
					<h3>Dodatkowe funkcje tablic</h3>
					</div>
		
						<div class="col-lg-4 col-lg-offset-2 col-md-4 cold-md-offset-2 col-sm-8 col-sm-offset-2 home-section home-section-pro">
							<div class="home-section-icon"><img src="{{ URL::to('/images/filter.svg') }}" class="svg svg-filter" /></div>
							<h4>Administracja</h4>
							<p>Pełna kontrola nad Twoją tablicą. Filtruj treść postów oraz banuj niegrzecznych użytkowników.</p>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-6 home-section home-section-pro">
							<div class="home-section-icon"><img src="{{ URL::to('/images/live.svg') }}" class="svg svg-live" /></div>
							<h4>Live</h4>
							<p>Automatycznie, w ciągu kilku sekund najnowsze posty pojawią się na Twojej tablicy. Lubię to!</p>
						</div>

						<div class="col-lg-4 col-lg-offset-2 col-md-4 cold-md-offset-2 col-sm-8 col-sm-offset-2 home-section home-section-pro">
							<div class="home-section-icon"><img src="{{ URL::to('/images/board.svg') }}" class="svg svg-board" /></div>
							<h4>Więcej Tablic</h4>
							<p>Lepiej jak jest więcej. Zakładając konto masz pięć tablic.</p>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-4 home-section home-section-pro">
							<div class="home-section-icon"><img src="{{ URL::to('/images/star.svg') }}" class="svg svg-star" /></div>
							<h4>Promowane Posty</h4>
							<p>Promowane posty to świetny sposób aby wyróżnić swoich ulubionych użytkowników.</p>
						</div>

						<div class="clearfix"></div>

						<div class="col-lg-4 col-lg-offset-2 col-md-4 cold-md-offset-2 col-sm-8 col-sm-offset-2 home-section home-section-pro">
							<div class="home-section-icon"><img src="{{ URL::to('/images/brand.svg') }}" class="svg svg-brand" /></div>
							<h4>Własny Branding</h4>
							<p>Wyróżnij się. Każda tablica posiada swój avatar, tło oraz kolory które możesz zmienić wedle życzenia.</p>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-6 home-section home-section-pro">
							<div class="home-section-icon"><img src="{{ URL::to('/images/presentation.svg') }}" class="svg svg-presentation" /></div>
							<h4>Prezentacja</h4>
							<p>Konferencja, impreza czy koncert. Wrzuć tablicę na duży ekran i pozwól uczestnikom na niej zainstnieć.</p>
						</div>

						<div class="col-lg-4 col-lg-offset-2 col-md-4 cold-md-offset-2 col-sm-8 col-sm-offset-2 home-section home-section-pro">
							<div class="home-section-icon"><img src="{{ URL::to('/images/network.svg') }}" class="svg svg-network" /></div>
							<h4>Wybór Sieci</h4>
							<p>Ustaw z jakich sieci Twoja tablica ma pobierać posty. Facebook, Instagram, Twitter, Vine czy Google.</p>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-6 home-section home-section-pro">
							<div class="home-section-icon"><img src="{{ URL::to('/images/link.svg') }}" class="svg svg-link" /></div>
							<h4>Twoje Linki</h4>
							<p>Umieść na tablicy odnośniki do profili społecznościowych oraz strony internetowej.</p>
						</div>
						
					</div>

			<div class="block-cta block-cta-white">
				<p>Załóż swoją pierwszą tablicę!</p>
				@if(Auth::check())
				<a href="{{ URL::to('/konto/tablice') }}" class="btn-default btn-lg btn-green-inverted">Dodaj tablicę</a>
				@else
				<a href="{{ URL::to('/zarejestruj') }}" class="btn-default btn-lg btn-green-inverted">Zarejestruj się</a>
				@endif
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