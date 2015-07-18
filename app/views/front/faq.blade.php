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
						<div class="faq-big"></div>
						<h1>FAQ</h1>
						<p>Typowe odpowiedzi na częste pytania. Jeżeli nadal nie udało Ci się znaleźć odpowiedzi na jakieś pytanie to skontaktuj się znami mailowo. Formularz znajdziesz w dziale kontakt.</p>
				</div>
				<div class="clearfix"></div>

				<div class="col-lg-8 col-lg-offset-2 col-md-8 cold-md-offset-2 col-sm-8 col-sm-offset-2 about-section">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<h4>Użytkowanie serwisu</h4>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Jakie sieci społecznościowe oferujecie?</a>
								<div class="faq-content hide">
									<p>Facebook, Instagram, Twitter, Vine i Google Plus.</p>
								</div>
							</div>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Czemu moja tablica nie działa?</a>
								<div class="faq-content hide">
									<p>Ciężkie pytanie. Może być wiele przyczyn. Aby wyszukać posty, nasz serwis korzysta z API serwisów społecznościowych. Największe ograniczenia co do zapytań ma Instagram. Z tego powodu zalecamy logowanie do naszego serwisu poprzez właśnie ten serwis. </p>
								</div>
							</div>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Lorem ipsum dolor sit amet?</a>
								<div class="faq-content hide">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi sed corrupti porro tempora iste quisquam placeat autem, est, ad, veniam omnis magni sit soluta tenetur doloribus. Minus sapiente nemo reprehenderit.</p>
								</div>
							</div>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Lorem ipsum dolor sit amet?</a>
								<div class="faq-content hide">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi sed corrupti porro tempora iste quisquam placeat autem, est, ad, veniam omnis magni sit soluta tenetur doloribus. Minus sapiente nemo reprehenderit.</p>
								</div>
							</div>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Lorem ipsum dolor sit amet?</a>
								<div class="faq-content hide">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi sed corrupti porro tempora iste quisquam placeat autem, est, ad, veniam omnis magni sit soluta tenetur doloribus. Minus sapiente nemo reprehenderit.</p>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6">
							<h4>Kategoria pytań</h4>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Lorem ipsum dolor sit amet?</a>
								<div class="faq-content hide">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi sed corrupti porro tempora iste quisquam placeat autem, est, ad, veniam omnis magni sit soluta tenetur doloribus. Minus sapiente nemo reprehenderit.</p>
								</div>
							</div>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Lorem ipsum dolor sit amet?</a>
								<div class="faq-content hide">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi sed corrupti porro tempora iste quisquam placeat autem, est, ad, veniam omnis magni sit soluta tenetur doloribus. Minus sapiente nemo reprehenderit.</p>
								</div>
							</div>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Lorem ipsum dolor sit amet?</a>
								<div class="faq-content hide">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi sed corrupti porro tempora iste quisquam placeat autem, est, ad, veniam omnis magni sit soluta tenetur doloribus. Minus sapiente nemo reprehenderit.</p>
								</div>
							</div>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Lorem ipsum dolor sit amet?</a>
								<div class="faq-content hide">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi sed corrupti porro tempora iste quisquam placeat autem, est, ad, veniam omnis magni sit soluta tenetur doloribus. Minus sapiente nemo reprehenderit.</p>
								</div>
							</div>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Lorem ipsum dolor sit amet?</a>
								<div class="faq-content hide">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi sed corrupti porro tempora iste quisquam placeat autem, est, ad, veniam omnis magni sit soluta tenetur doloribus. Minus sapiente nemo reprehenderit.</p>
								</div>
							</div>
						</div>

						<div class="clearfix add-bottom"></div>

						<div class="col-lg-6 col-md-6 col-sm-6">
							<h4>Kategoria pytań</h4>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Lorem ipsum dolor sit amet?</a>
								<div class="faq-content hide">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi sed corrupti porro tempora iste quisquam placeat autem, est, ad, veniam omnis magni sit soluta tenetur doloribus. Minus sapiente nemo reprehenderit.</p>
								</div>
							</div>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Lorem ipsum dolor sit amet?</a>
								<div class="faq-content hide">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi sed corrupti porro tempora iste quisquam placeat autem, est, ad, veniam omnis magni sit soluta tenetur doloribus. Minus sapiente nemo reprehenderit.</p>
								</div>
							</div>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Lorem ipsum dolor sit amet?</a>
								<div class="faq-content hide">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi sed corrupti porro tempora iste quisquam placeat autem, est, ad, veniam omnis magni sit soluta tenetur doloribus. Minus sapiente nemo reprehenderit.</p>
								</div>
							</div>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Lorem ipsum dolor sit amet?</a>
								<div class="faq-content hide">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi sed corrupti porro tempora iste quisquam placeat autem, est, ad, veniam omnis magni sit soluta tenetur doloribus. Minus sapiente nemo reprehenderit.</p>
								</div>
							</div>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Lorem ipsum dolor sit amet?</a>
								<div class="faq-content hide">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi sed corrupti porro tempora iste quisquam placeat autem, est, ad, veniam omnis magni sit soluta tenetur doloribus. Minus sapiente nemo reprehenderit.</p>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6">
						<h4>Pytania różne</h4>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Czy Wasz ulubiony kolor to zielony?</a>
								<div class="faq-content hide">
									<p>Nie.</p>
								</div>
							</div>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Lorem ipsum dolor sit amet?</a>
								<div class="faq-content hide">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi sed corrupti porro tempora iste quisquam placeat autem, est, ad, veniam omnis magni sit soluta tenetur doloribus. Minus sapiente nemo reprehenderit.</p>
								</div>
							</div>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Lorem ipsum dolor sit amet?</a>
								<div class="faq-content hide">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi sed corrupti porro tempora iste quisquam placeat autem, est, ad, veniam omnis magni sit soluta tenetur doloribus. Minus sapiente nemo reprehenderit.</p>
								</div>
							</div>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Lorem ipsum dolor sit amet?</a>
								<div class="faq-content hide">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi sed corrupti porro tempora iste quisquam placeat autem, est, ad, veniam omnis magni sit soluta tenetur doloribus. Minus sapiente nemo reprehenderit.</p>
								</div>
							</div>
							<div class="faq-question">
								<a href="#" class="faq-item"><i class="fa fa-plus"></i> Lorem ipsum dolor sit amet?</a>
								<div class="faq-content hide">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi sed corrupti porro tempora iste quisquam placeat autem, est, ad, veniam omnis magni sit soluta tenetur doloribus. Minus sapiente nemo reprehenderit.</p>
								</div>
							</div>
						</div>
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