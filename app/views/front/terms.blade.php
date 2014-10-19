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
					<h1>Regulamin</h1>
					<p>Jeżeli masz ochotę się z nami skontaktować wypełnij ten formularz. Nie zapomnij podać swojego e-maila. Odpiszemy najszybciej jak tylko się da.</p>
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