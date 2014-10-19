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
					<div class="contact-big"></div>
					<h1>Halo?</h1>
					<p>Jeżeli masz ochotę się z nami skontaktować wypełnij ten formularz. Nie zapomnij podać swojego e-maila. Odpiszemy najszybciej jak tylko się da.</p>
				</div>
				<div class="clearfix"></div>
				
				<div class="col-lg-8 col-lg-offset-2 col-md-8 cold-md-offset-2 col-sm-8 col-sm-offset-2">
					<div class="contact-form row">
						{{ Form::open(array('method' => 'post', 'url' => '/contact/send')) }}
								<div class="col-lg-6 col-md-6 col-sm-6">
									<input type="text" name="name" class="input-default input-block " id="" placeholder="Imię i Nazwisko">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<input type="email" name="email" class="input-default input-block @if ($errors->has('email'))has-error @endif" id="" placeholder="E-mail">
									@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<textarea name="message" id="" cols="30" rows="10" class="textarea-default input-block" placeholder="Treść wiadomości"></textarea>
									<button type="submit" class="btn-default btn-submit btn-green btn-lg btn-block">Wyślij</button>
								</div>
						{{ Form::close() }}
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