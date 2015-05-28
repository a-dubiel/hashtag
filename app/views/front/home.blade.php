@extends('front.master')

@section('content')

<header class="board-top home-top">
	<div class="container">
		<nav class="nav-user">
			 @include('user.user-nav')
		</nav>
	</div>
</header>

<div class="home-intro" style="background-image: url({{ URL::to('/images/home-bg/'.$introImg) }})">
	<h1 class="home-logo">Hasztag.info</h1>

	<div class="home-search-wrapper">
		<div class="home-search">
			{{ Form::open(array('url' => 'szukaj')) }}			
				<div class="search-icon">
					<i class="fa fa-search"></i>
				</div>
				<div class="search-bar">
					<input type="text" name="query" placeholder="wpisz dowolny hasztag">
				</div>
				<input type="submit" value="Szukaj">
			{{ Form::close() }}
		</div>	
	</div>
</div>

<div class="block-trending hidden-xs">
	<div class="container">
		<p>popularne @foreach($popularHashtags as $hashtag) {{ $hashtag }} @endforeach</p>
	</div>
</div>


<div class="container add-bottom">
	<div class="text-center add-bottom">
		<img src="{{ URL::to('images/intro@2x.png') }}" class="intro-img" alt="">
	</div>
	<div class="home-section-intro">
		<h2 class="intro-title">Social Media w jednym miejscu</h2>
		<p class="intro-text add-bottom">Hasztag.info to nowy sposób aby odkryć media społecznościowe. To miejsce w którym w kilka sekund odnajdziesz posty oznaczone danym hasztagiem i przedstawisz je w postaci interaktywnych tablic. Każdą tablicę możesz dostosować do własnych potrzeb - przedstaw ją na stronie, w telefonie lub dużym ekranie.</p>	
		<div class="block-cta block-cta-white">
			<a href="{{ URL::to('/informacje') }}" class="btn-default btn-lg btn-green">Więcej informacji</a>
		</div>
	</div>	
</div>

<div class="home-gallery">
	<div class="container">
		<div class="home-section-intro add-bottom">
		<h2>Przykładowe tablice</h2>
		<p>Zobacz jak to działa.</p>
	</div>
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4">
				<a href="{{ URL::to('/wroclaw/szukaj') }}" class="gallery-item">
					<span class="hashtag">#wroclaw</span>
					<img src="{{ URL::to('/images/wroclaw-screen.jpg')}}" alt="wroclaw" />
				</a>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 gallery-item">
			
				<a href="{{ URL::to('/instafood/szukaj') }}" class="gallery-item">
					<span class="hashtag">#instafood</span>	
					<img src="{{ URL::to('/images/instafood-screen.jpg')}}">
				</a>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 gallery-item">
				<a href="{{ URL::to('/reprezentacjapolski/szukaj') }}" class="gallery-item">
					<span class="hashtag">#reprezentacjapolski</span>
					<img src="{{ URL::to('/images/poland-screen.jpg')}}">
				</a>
			</div>
			
		</div>
	</div>
</div>

<div class="container add-more-bottom">
	<div class="home-section-intro">
		<h2>Jak to działa?</h2>
		<p>Facebook, Instagram, Twitter, Google oraz Vine w jednym.</p>
	</div>
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 home-section">
			<div class="home-section-icon"><img src="{{ URL::to('/images/connected.svg') }}" class="svg svg-network-big" /></div>
			<h4>Wszystko w jednym</h4>
			<p>Facebook, Twitter czy Instagram? Nie ma różnicy. Znajdź wszystkie posty z popularnych sieci społecznościowych w jednym miejscu.</p>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 home-section">
			<div class="home-section-icon"><img src="{{ URL::to('/images/hasztag.svg') }}" class="svg svg-hasztag" /></div>
			<h4>Uniwersalne medium</h4>
			<p>Hasztag to wspólny mianownik social media. Mechanizm, który szybko i bezpośrednio łączy wszystkie sieci niezależnie od platformy.</p>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 home-section">
			<div class="home-section-icon"><img src="{{ URL::to('/images/presentation.svg') }}" class="svg svg-audience" /></div>
			<h4>Hasztag to społeczność</h4>
			<p>Żaden mechanizm mediów nie ma w sobie tyle skuteczności i prostoty co hasztagi. Jedno słowo, które potrafi wyznaczyć trend lub rozpocząć rewolucję.</p>
		</div>
	</div>

</div>



<div class="container">

	<div class="home-section-intro">
		<h2>Plan Pro</h2>
		<p>Dla bardziej wymagających hasztagowców mamy coś specjalnego.</p>
	</div>
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-3 home-section home-section-pro">
			<div class="home-section-icon"><img src="{{ URL::to('/images/filter.svg') }}" class="svg svg-filter" /></div>
			<h4>Administracja</h4>
			<p>Pełna kontrola nad Twoją tablicą. Filtruj treść postów oraz banuj niegrzecznych użytkowników.</p>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-3 home-section home-section-pro">
			<div class="home-section-icon"><img src="{{ URL::to('/images/live.svg') }}" class="svg svg-live" /></div>
			<h4>Live</h4>
			<p>Automatycznie, w ciągu kilku sekund najnowsze posty pojawią się na Twojej tablicy. Lubię to!</p>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-3 home-section home-section-pro">
			<div class="home-section-icon"><img src="{{ URL::to('/images/board.svg') }}" class="svg svg-board" /></div>
			<h4>Więcej Tablic</h4>
			<p>Lepiej jak jest więcej. Będąc posiadaczem konta Pro masz pięć dodatkowych tablic.</p>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-3 home-section home-section-pro">
			<div class="home-section-icon"><img src="{{ URL::to('/images/star.svg') }}" class="svg svg-star" /></div>
			<h4>Promowane Posty</h4>
			<p>Promowane posty to świetny sposób aby wyróżnić swoich ulubionych użytkowników.</p>
		</div>

		<div class="clearfix"></div>

		<div class="col-lg-3 col-md-3 col-sm-3 home-section home-section-pro">
			<div class="home-section-icon"><img src="{{ URL::to('/images/brand.svg') }}" class="svg svg-brand" /></div>
			<h4>Własny Branding</h4>
			<p>Wyróżnij się. Każda tablica posiada swój avatar, tło oraz kolory które możesz zmienić wedle życzenia.</p>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-3 home-section home-section-pro">
			<div class="home-section-icon"><img src="{{ URL::to('/images/presentation.svg') }}" class="svg svg-presentation" /></div>
			<h4>Prezentacja</h4>
			<p>Konferencja, impreza czy koncert. Wrzuć tablicę na duży ekran i pozwól uczestnikom na niej zainstnieć.</p>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-3 home-section home-section-pro">
			<div class="home-section-icon"><img src="{{ URL::to('/images/network.svg') }}" class="svg svg-network" /></div>
			<h4>Wybór Sieci</h4>
			<p>Ustaw z jakich sieci Twoja tablica ma pobierać posty. Facebook, Instagram, Twitter, Vine czy Google.</p>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-3 home-section home-section-pro">
			<div class="home-section-icon"><img src="{{ URL::to('/images/link.svg') }}" class="svg svg-link" /></div>
			<h4>Twoje Linki</h4>
			<p>Umieść na tablicy odnośniki do profili społecznościowych oraz strony internetowej.</p>
		</div>
		
	</div>
</div>


<div class="block-cta">
	<p>Załóż swoją pierwszą tablicę za darmo lub zapoznaj się z naszą ofertą.</p>
	@if(Auth::check())
		<a href="{{ URL::to('/konto/tablice') }}" class="btn-default btn-lg btn-white-inverted">Dodaj tablicę</a>
		<a href="{{ URL::to('/oferta') }}" class="btn-default btn-lg btn-white-inverted">Nasza oferta</a>
	@else
		<a href="{{ URL::to('/zarejestruj') }}" class="btn-default btn-lg btn-white-inverted">Zarejestruj się</a>
		<a href="{{ URL::to('/oferta') }}" class="btn-default btn-lg btn-white-inverted">Nasza oferta</a>
	@endif
</div>

@if(Auth::check())
   @include('user.user-dropdown')
@endif

@stop