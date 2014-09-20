@extends('front.master')

@section('content')
<script type="text/javascript">
	var hashtag = '{{ $board->hashtag }}';
	var board_id = '{{ $board->id }}';
	var base = '{{ URL::to('/')}}';
</script>

<header class="board-top">
	<div class="container">
		<a href="{{ URL::to('/') }}" class="board-logo">hashtag.info</a>
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
		<nav class="nav-user pull-right">
			<ul>
				<li><a class="btn-default btn-link-secondary" href="">Zaloguj</a></li>
				<li><a class="btn-default btn-green" href="">Załóż Tablicę</a></li>
			</ul>
		</nav>
	</div>
</header>


<div class="container content-board">
<h1>#{{ $board->hashtag }}</h1>
<header class="board-info clearfix">
	<div class="pull-right">
		<nav>
			<ul class="filters">
				<li><a class="filter filter-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
				<li><a class="filter filter-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
				<li><a class="filter filter-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
				<li><a class="filter filter-google" href="#"><i class="fa fa-google-plus"></i></a></li>
				<li><a class="filter filter-vine" href="#"><i class="fa fa-vine"></i></a></li>
			</ul>
		</nav>
	</div>
	<div class="pull-left">
		<div class="board-description">
			<p>Co oznacza ten hashtag?</p>
			<a href="#" class="btn-default btn-link-primary btn-text">Dodaj opis</a>
		</div>	
	</div>
</header>

<div id="posts">
	
	

	
</div>
<a href="#" data-instagram-max-id="" class="load-more">More</a>
	

</div>



@stop
