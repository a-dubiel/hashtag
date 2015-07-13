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
					<div class="terms-big"></div>
					<h1>Regulamin</h1>
				</div>
				<div class="col-lg-8 col-lg-offset-2 col-md-8 cold-md-offset-2 col-sm-8 col-sm-offset-2 content-terms">
					<h2>Korzystanie z Serwisu Hasztag.info</h2>


					<p><b>Informacje ogólne</b></p>
					<p>1. Operatorem i twórcą Serwisu Hasztag.info jest <a href="http://dubiel.me">Andrzej Dubiel, front-end developer</a></p>
					<p>2. Serwis funkcjonuje na zasadzie wyszukiwarki social media. Serwis przeszukuje serwisy social media na podstawie hasztagów, czyli uniwersalnych znaczników i pokazuje je użytkownikom w postaci tablic.
					<p>3. Ten regulamin określa zasady użytkowania tego Serwisu. Korzystając z funkcjonalności Serwisu, używając Serwisu, akceptujesz warunki regulaminu.</p>
					<p>4. Serwis realizuje funkcje pozyskiwania informacji o użytkownikach i ich zachowaniu w następujący sposób:<br />
						<ul>
							<li>a. Poprzez dobrowolnie wprowadzone w formularzach informacje.</li>
							<li>b. Poprzez zapisywanie w urządzeniach końcowych pliki cookie (tzw. "ciasteczka").</li>
							<li>c. Poprzez gromadzenie logów serwera</li>
						</ul>
					</p>
					<p><b>Zawartość Serwisu</b></p>
					<p>1. Serwis Hasztag.info, daje nieograniczony dostęp do niemoderowanych treści w postaci zdjęć, video, linków, postów, opinii i tym podobnych zamieszczonych na portalach społecznościowych.
					<p>2. Zawartości portalów społecznościowych (social media) nazywamy Treścią Tablicy. Treści Tablicy zawierają materiały z innych stron i serwisów social media, których właścicielem nie jest Serwis. Serwis nie ma kontroli oraz nie odpowiada za Treści Tablicy.</p>
					<p>3. Dodatkowo, Serwis nie ponosi odpowiedzialności za ewentualny brak moderacji oraz cenzury Treści Tablicy.</p>
					<p>4. Używając Serwisu, użytkownik zrzesza się roszczeń prawnych wobec Serwisu, Treści Tablicy, operatorów oraz twórców Serwisu.</p>
					<p>5. Używając Serwisu, użytkownik może zobaczyć Treści Tablicy pochodzące z różnych źródeł, za które Serwis nie jest odpowiedzialny oraz nie ma nad nimi kontroli. Serwis nie jest odpowiedzialny za zgodność treści, wartość mertytoryczną, bezpieczeństwo informacji.</p>
					<p>6. Serwis nie ponosi odpowiedzialności za ewentualne naruszenie praw autorskich, praw intelektualnych, praw własnościowych, lub innych praw związanych z Treścią Tablicy</p>
					<p>7. Używając serwisu, użytkownik jest narażony na treści często fałszywe, obraźliwe, szokujące i niecenzuralne. Serwis nie ma kontroli nad tego typu Zawartościami Tablicy i nie ponosi za nie odpowiedzialności.</p>
					
					 <h2>Polityka prywatności Serwisu Hasztag.info</h2>
					<p><b>Informacje w formularzach</b></p>
					
						<p>1. Serwis zbiera informacje podane dobrowolnie przez użytkownika.</p>
						<p>2. Serwis może zapisać ponadto informacje o parametrach połączenia (oznaczenie czasu, adres IP)</p>
						<p>3. Dane w formularzu nie są udostępniane podmiotom trzecim inaczej, niż za zgodą użytkownika.</p>
						<p>4. Dane podane w formularzu mogą stanowić zbiór potencjalnych klientów, zarejestrowany przez Operatora Serwisu w rejestrze prowadzonym przez Generalnego Inspektora Ochrony Danych Osobowych.</p>
						<p>5. Dane podane w formularzu są przetwarzane w celu wynikającym z funkcji konkretnego formularza, np w celu dokonania procesu obsługi zgłoszenia serwisowego lub kontaktu handlowego.</p>
						<p>6. Dane podane w formularzach mogą być przekazane podmiotom technicznie realizującym niektóre usługi – w szczególności dotyczy to przekazywania informacji o posiadaczu rejestrowanej domeny do podmiotów będących operatorami domen internetowych (przede wszystkim Naukowa i Akademicka Sieć Komputerowa j.b.r – NASK), serwisów obsługujących płatności lub też innych podmiotów, z którymi Operator Serwisu w tym zakresie współpracuje.</p>
				
					<p><b>Informacja o plikach cookies</b></p>
					<p>1. Serwis korzysta z plików cookies.</p>
					<p>2. Pliki cookies (tzw. „ciasteczka”) stanowią dane informatyczne, w szczególności pliki tekstowe, które przechowywane są w urządzeniu końcowym Użytkownika Serwisu i przeznaczone są do korzystania ze stron internetowych Serwisu. Cookies zazwyczaj zawierają nazwę strony internetowej, z której pochodzą, czas przechowywania ich na urządzeniu końcowym oraz unikalny numer.</p>
					<p>3. Podmiotem zamieszczającym na urządzeniu końcowym Użytkownika Serwisu pliki cookies oraz uzyskującym do nich dostęp jest operator Serwisu.</p>
					<p>4. Pliki cookies wykorzystywane są w następujących celach:</p>
					<ul>
					<li>a. tworzenia statystyk, które pomagają zrozumieć, w jaki sposób Użytkownicy Serwisu korzystają ze stron internetowych, co umożliwia ulepszanie ich struktury i zawartości;</li>
					<li>b. utrzymanie sesji Użytkownika Serwisu (po zalogowaniu), dzięki której Użytkownik nie musi na każdej podstronie Serwisu ponownie wpisywać loginu i hasła;</li>
					<li>c. określania profilu użytkownika w celu wyświetlania mu dopasowanych materiałów w sieciach reklamowych, w szczególności sieci Google.</li>
					</ul>
					<p>5. W ramach Serwisu stosowane są dwa zasadnicze rodzaje plików cookies: „sesyjne” (session cookies) oraz „stałe” (persistent cookies). Cookies „sesyjne” są plikami tymczasowymi, które przechowywane są w urządzeniu końcowym Użytkownika do czasu wylogowania, opuszczenia strony internetowej lub wyłączenia oprogramowania (przeglądarki internetowej). „Stałe” pliki cookies przechowywane są w urządzeniu końcowym Użytkownika przez czas określony w parametrach plików cookies lub do czasu ich usunięcia przez Użytkownika.
						<p>6. Oprogramowanie do przeglądania stron internetowych (przeglądarka internetowa) zazwyczaj domyślnie dopuszcza przechowywanie plików cookies w urządzeniu końcowym Użytkownika. Użytkownicy Serwisu mogą dokonać zmiany ustawień w tym zakresie. Przeglądarka internetowa umożliwia usunięcie plików cookies. Możliwe jest także automatyczne blokowanie plików cookies Szczegółowe informacje na ten temat zawiera pomoc lub dokumentacja przeglądarki internetowej.</p>
						<p>7. Ograniczenia stosowania plików cookies mogą wpłynąć na niektóre funkcjonalności dostępne na stronach internetowych Serwisu.
							<p>8. Pliki cookies zamieszczane w urządzeniu końcowym Użytkownika Serwisu i wykorzystywane mogą być również przez współpracujących z operatorem Serwisu reklamodawców oraz partnerów.</p>
							<p>9. Zalecamy przeczytanie polityki ochrony prywatności tych firm, aby poznać zasady korzystania z plików cookie wykorzystywane w statystykach: Polityka ochrony prywatności Google Analytics</p>
							<p>10. Pliki cookie mogą być wykorzystane przez sieci reklamowe, w szczególności sieć Google, do wyświetlenia reklam dopasowanych do sposobu, w jaki użytkownik korzysta z Serwisu. W tym celu mogą zachować informację o ścieżce nawigacji użytkownika lub czasie pozostawania na danej stronie.</p>
							<p>11. W zakresie informacji o preferencjach użytkownika gromadzonych przez sieć reklamową Google użytkownik może przeglądać i edytować informacje wynikające z plików cookies przy pomocy narzędzia <a href="https://www.google.com/ads/preferences/" target="_blank">dostępnego tutaj</a></p>
							<p><b>Logi serwera</b></p>
							<p>1. Informacje o niektórych zachowaniach użytkowników podlegają logowaniu w warstwie serwerowej. Dane te są wykorzystywane wyłącznie w celu administrowania serwisem oraz w celu zapewnienia jak najbardziej sprawnej obsługi świadczonych usług hostingowych.
								<p>2. Przeglądane zasoby identyfikowane są poprzez adresy URL. Ponadto zapisowi mogą podlegać:
								<ul>
									<li>a.	czas nadejścia zapytania</li>
									<li>b.	czas wysłania odpowiedzi</li>
									<li>c.	nazwę stacji klienta – identyfikacja realizowana przez protokół HTTP</li>
									<li>d.	informacje o błędach jakie nastąpiły przy realizacji transakcji HTTP</li>
									<li>e.	adres URL strony poprzednio odwiedzanej przez użytkownika (referer link) – w przypadku gdy przejście do Serwisu nastąpiło przez odnośnik</li>
									<li>f.	informacje o przeglądarce użytkownika</li>
									<li>g.	Informacje o adresie IP</li>
									</ul>
									<p>3. Dane powyższe nie są kojarzone z konkretnymi osobami przeglądającymi strony.</p>
									<p>4. Dane powyższe są wykorzystywane jedynie dla celów administrowania serwerem.</p>
									<p><b>Udostępnienie danych</b></p>
									<p>1. Dane podlegają udostępnieniu podmiotom zewnętrznym wyłącznie w granicach prawnie dozwolonych.</p>
									<p>2. Dane umożliwiające identyfikację osoby fizycznej są udostępniane wyłączenie za zgodą tej osoby.</p>
									<p>3. Operator może mieć obowiązek udzielania informacji zebranych przez Serwis upoważnionym organom na podstawie zgodnych z prawem żądań w zakresie wynikającym z żądania.</p>
									<p><b>Zarządzanie plikami cookies – jak w praktyce wyrażać i cofać zgodę?</b></p>
									<p>1. Jeśli użytkownik nie chce otrzymywać plików cookies, może zmienić ustawienia przeglądarki. Zastrzegamy, że wyłączenie obsługi plików cookies niezbędnych dla procesów uwierzytelniania, bezpieczeństwa, utrzymania preferencji użytkownika może utrudnić, a w skrajnych przypadkach może uniemożliwić korzystanie ze stron www</p>
									<p>2. W celu zarządzania ustawieniami cookies wybierz z listy poniżej przeglądarkę internetową/ system i postępuj zgodnie z instrukcjami:</p>
									<ul>
										<li><a href="http://support.microsoft.com/kb/196955" target="_blank">Internet Explorer</a></li>
										<li><a href="http://support.google.com/chrome/bin/answer.py?hl=pl&answer=95647" target="_blank">Chrome</a></li>
										<li><a href="http://support.apple.com/kb/PH5042" target="_blank">Safari</a></li>
										<li><a href="http://support.mozilla.org/pl/kb/W%C5%82%C4%85czanie%20i%20wy%C5%82%C4%85czanie%20obs%C5%82ugi%20ciasteczek" target="_blank">Firefox</a></li>
										<li><a href="http://help.opera.com/Windows/12.10/pl/cookies.html" target="_blank">Opera</a></li>
										<li><a href="http://support.google.com/chrome/bin/answer.py?hl=pl&answer=95647" target="_blank">Android</a></li>
										<li><a href="http://support.apple.com/kb/HT1677?viewlocale=pl_PL" target="_blank">Safari (iOS)</a></li>
										<li><a href="http://www.windowsphone.com/pl-pl/how-to/wp7/web/changing-privacy-and-other-browser-settings" target="_blank">Windows Phone</a></li>
										<li><a href="http://docs.blackberry.com/en/smartphone_users/deliverables/32004/Turn_off_cookies_in_the_browser_60_1072866_11.jsp" target="_blank">Blackberry</a></li>
									</ul>


								</div>
								<div class="clearfix"></div>

							</div>

						</div>

					</div>
				</div>


				@if(Auth::check())
				@include('user.user-dropdown')
				@endif





				@stop