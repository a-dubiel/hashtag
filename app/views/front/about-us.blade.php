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

					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<p>Stworzyliśmy narzędzie, które pomoże zbudować społeczności oraz pomoże je odnaleźć w zalewie informacji. Nasz cel numer jeden to umożliwienie ludziom o podobnych zainteresowaniach odnalezienie siebie nawzajem, bez względu na kanał przez jaki płyną informacje.</p>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6">
							<p>Nasz serwis to świetne rozwiązanie dla organizacji, firm lub marek które cenią sobie społeczność którą budują wokół siebie oraz ludzi którzy do niej należą. Dzięki naszej technologii łatwiej oraz szybciej zbudujesz społeczność swojej marki oraz skupisz ludzi, których łączą te same pasję, poglądy i cele. </p>
						</div>
					</div>

				</div>

				<div class="col-lg-8 col-lg-offset-2 col-md-8 cold-md-offset-2 col-sm-8 col-sm-offset-2 about-section">
					<img src="{{ URL::to('/images/macs.svg') }}" class="" />
					<h3>Jak to robimy?</h3>

					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<p>Wszystkie serwisy społecznościowe łączy jeden wspólny mianownik - hasztagi. Nasz serwis przeszukuje te serwisy oraz w kilka sekund odnajduje posty oznaczone danym hasztagiem. Znalezione informacje prezentuje w piękny i przystępny sposób w postaci interaktywnych tablic.</p>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
								<p>Żaden mechanizm mediów społecznościowycb nie ma w sobie tyle skuteczności, piękna i prostoty co hasztagi. Jedno słowo, które potrafi stworzyć społeczności, wyznaczyć trend lub rozpocząć rewolucję. Słowo, które potrafi połączyć lub poróżnić ludzi.</p>
						</div>

					</div>

					<div class="block-cta block-cta-white">
						<p>Załóż swoją pierwszą tablicę za darmo lub zapoznaj się z naszą ofertą.</p>
						@if(Auth::check())
							<a href="{{ URL::to('/konto/tablice') }}" class="btn-default btn-lg btn-green-inverted">Dodaj tablicę</a>
							<a href="{{ URL::to('/oferta') }}" class="btn-default btn-lg btn-green-inverted">Nasza oferta</a>
						@else
							<a href="{{ URL::to('/zarejestruj') }}" class="btn-default btn-lg btn-green-inverted">Zarejestruj się</a>
							<a href="{{ URL::to('/oferta') }}" class="btn-default btn-lg btn-green-inverted">Nasza oferta</a>
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