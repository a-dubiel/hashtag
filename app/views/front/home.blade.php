@extends('front.master')

@section('content')

<header class="board-top home-top">
	<div class="container">
		<nav class="nav-user">
			<ul>
				@if(Auth::check() )
					@if(isset($avatar))
						<li><a href="#" data-dropdown="#dropdown-1" class="user-dropdown"><div class="user-avatar">{{ $avatar }}</div><div class="username"><span class="hidden-xs">{{ $username }}</span> <i class="fa fa-caret-down"></i></div></a></li>
					@else
						<li><a href="#" data-dropdown="#dropdown-1" class="user-dropdown"><div class="user-avatar"><i class="fa fa-user"></i></div><div class="username"><span class="hidden-xs">{{ $username }}</span> <i class="fa fa-caret-down"></i></div></a></li>
					@endif
						<li><a class="btn-default btn-sm btn-green hidden-xs" href="{{ URL::to('/konto/tablice') }}">Dodaj Tablicę</a></li>
				@else
					<li><a class="btn-default btn-link-secondary-home js-login-popup" href="#"><span class="hidden-xs">Zaloguj</span><span class="visible-xs"><i class="fa fa-navicon fa-2x"></i></span></a></li>
					<li><a class="btn-default btn-sm btn-green js-login-popup hidden-xs" href="#">Dodaj Tablicę</a></li>
				@endif			
			</ul>
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
	<div class="home-section-intro">
		<h2>Pokochasz to</h2>
		<p>Znajdź posty oznaczone hasztagiem i zobacz je w piękny i przejrzysty sposób.</p>
	</div>
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 home-section">
			<div class="home-section-icon"><img src="{{ URL::to('/images/connected.svg') }}" class="svg svg-network-big" /></div>
			<h4>Wszystko w jednym</h4>
			<p>Stwórz swoją tablicę, znajdź i zarządzaj wszystkimi postami z popularnych sieci społecznościowych takich jak Facebook, Instagram, Twitter, Google czy Vine. </p>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-4 home-section">
			<div class="home-section-icon"><img src="{{ URL::to('/images/audience.svg') }}" class="svg svg-audience" /></div>
			<h4>Poznaj społeczność</h4>
			<p>Twoja tablica to miejsce gdzie znajdziesz ludzi z całego świata o tych samych zainteresowaniach, celach, upodobaniach lub poglądach.</p>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-4 home-section">
			<div class="home-section-icon"><img src="{{ URL::to('/images/hasztag.svg') }}" class="svg svg-hasztag" /></div>
			<h4>Siła hasztaga</h4>
			<p>Żaden zabieg marketingowy nie jest tak uniwersalny, prosty i szybki. Hasztag skutecznie dociera do użytkowników każdej sieci społecznościowej.</p>
		</div>
		
	</div>
</div>

<div class="container add-bottom">
	<div class="row">
		<div class="col-lg-7 col-md-7 col-sm-6 home-section">
			<img src="{{ URL::to('/images/macs.svg') }}" class="" />
		</div>
		<div class="col-lg-5 col-md-5 col-sm-6 home-section home-section-left">
			<h4>Dla wszystkich</h4>
			<p>Desktop, tablet czy komórka - nie ma różnicy. Nie ważne z jakiego urządzenia korzystasz, nasz serwis dostoswany jest do najpopularniejszych urządzeń i przeglądarek (oprócz IE8 i poniżej). Lubimy optymalizację i wydajność, więc dołożyliśmy wielkich starań, żeby oddać Ci najwyższej jakości produkt.</p>
			<a href="" class="btn-default btn-green-inverted">Jak to robimy?</a>
		</div>
	</div>
</div>

<div class="home-gallery">
	<div class="container">
		<div class="home-section-intro add-bottom">
		<h2>Przykładowe tablice</h2>
		<p>Zobacz jakie mamy możliwości.</p>
	</div>
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4">
				<a href="{{ URL::to('/wroclaw/szukaj') }}" class="gallery-item">
					<img src="{{ URL::to('/images/wroclaw-screen.jpg')}}" alt="wroclaw" />
					<span class="hashtag">#wroclaw</span>
				</a>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 gallery-item">
				<a href="{{ URL::to('/instafood/szukaj') }}" class="gallery-item">
					<img src="{{ URL::to('/images/instafood-screen.jpg')}}">
					<span class="hashtag">#instafood</span>	
				</a>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 gallery-item">
				<a href="{{ URL::to('/reprezentacjapolski/szukaj') }}" class="gallery-item">
					<img src="{{ URL::to('/images/poland-screen.jpg')}}">
					<span class="hashtag">#reprezentacjapolski</span>
				</a>
			</div>
			
		</div>
	</div>
</div>



<div class="container">

	<div class="home-section-intro">
		<h2>Konto Pro</h2>
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
			<p>Wyróżnij się. Każda tablica posiada swój avatar oraz tło, które możesz zmienić wedle życzenia.</p>
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
	<p>Podoba się? Załóż swoją pierwszą tablicę za darmo!</p>
	@if(Auth::check())
		<a href="{{ URL::to('/konto/tablice') }}" class="btn-default btn-lg btn-white-inverted">Dodaj tablicę</a>
	@else
		<a href="{{ URL::to('/zarejestruj') }}" class="btn-default btn-lg btn-white-inverted">Zarejestruj się</a>
	@endif
	
</div>

@if(Auth::check())
    <div id="dropdown-1" class="dropdown dropdown-tip dropdown-anchor-right">
        <ul class="dropdown-menu">
            <li><a href="{{ URL::to('/konto')}}"><i class="fa fa-cog"></i> Konto</a></li>
            <li><a href="{{ URL::to('/wyloguj')}}"><i class="fa fa-sign-out"></i> Wyloguj</a></li>      
            @if($user->boardConfig()->count() > 0 )
                <li class="divider"></li>
                @foreach($user->boardConfig()->get() as $board )
                    <li><a href="{{ URL::to("/".$board->board()->first()->hashtag."/".$board->board()->first()->id )}}"><i class="fa fa-th"></i> #{{ $board->board()->first()->hashtag }}</a></li>
                @endforeach
            @endif
        </ul>
    </div>
@endif

@stop