@extends('front.master')

@section('content')
<script type="text/javascript">
	var hashtag = '{{ $board->hashtag }}';
	var board_id = '{{ $board->id }}';
	var refresh_interval = '{{ $board->config()->first()->refresh_interval }}';
	var refresh_count = '{{ $board->config()->first()->refresh_count }}';
	var base = '{{ URL::to('/')}}';
	var is_logged_in = <?php echo ( Auth::check() ? 'true' : 'false' ); ?>;
	var is_live = <?php echo ( ($board->config()->first()->live == 1) ? 'true' : 'false' ); ?>;

</script>

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

@if($layout == 'with-cover' && !is_null($board->cover_file_name))
	<div style="background-image: url('{{ $board->cover->url('standardCrop') }}')" class="board-cover"></div>
@endif

<div class="container content-board">
<ul class="board-links hidden-xs">
	@if($board->fb_user != '')
		<li><a href="https://www.facebook.com/{{ $board->fb_user }}" target="_blank"><i class="fa fa-facebook"></i>/{{$board->fb_user }}</a></li>
	@endif
	@if($board->insta_user != '')
		<li><a href="https://www.instagram.com/{{ $board->insta_user }}" target="_blank"><i class="fa fa-instagram"></i>/{{ $board->insta_user }}</a></li>
	@endif
	@if($board->tw_user != '')
		<li><a href="https://www.twitter.com/{{ $board->tw_user }}" target="_blank"><i class="fa fa-twitter"></i>/{{ $board->tw_user }}</a></li>
	@endif
	@if($board->google_user != '')
		<li><a href="https://plus.google.com/{{ $board->google_user }}" target="_blank"><i class="fa fa-google-plus"></i></a></li>
	@endif
	@if($board->website_url != '')
		<li><a href="{{ $board->website_url }}" target="_blank"><i class="fa fa-external-link" ></i>www</a></li>
	@endif
</ul>
@if(!is_null($board->avatar_file_name))
	<div class="board-avatar">
		<img src="{{ $board->avatar->url('thumbCrop') }}" alt="" />
	</div>
@endif
<h1>#{{ $board->hashtag }}</h1>
<header class="board-info clearfix">
	<div class="filters-container clearfix">
		<nav>
			<ul class="filters">
				@if($board->config()->first()->live == 1)
					<li><span class="span-live pull-left"><i class="fa fa-circle fa-pulse"></i> Live</span></li>
				@else
					<li><a class="check-new inactive pull-left" href="#">Nowe posty <span>0</span></a></li>
				@endif						
				
					
				@if($board->config()->first()->has_fb != -1)
					<li><a class="filter filter-facebook" href="#" data-filter=".post-facebook"><i class="fa fa-facebook"></i></a></li>
				@endif
				@if($board->config()->first()->has_insta != -1)
					<li><a class="filter filter-instagram" href="#" data-filter=".post-instagram"><i class="fa fa-instagram"></i></a></li>
				@endif
				@if($board->config()->first()->has_tw != -1)
					<li><a class="filter filter-twitter" href="#" data-filter=".post-twitter"><i class="fa fa-twitter"></i></a></li>
				@endif
				@if($board->config()->first()->has_google != -1)
					<li><a class="filter filter-google-plus" href="#" data-filter=".post-google-plus"><i class="fa fa-google-plus"></i></a></li>
				@endif
				@if($board->config()->first()->has_vine != -1)
					<li><a class="filter filter-vine" href="#" data-filter=".post-vine"><i class="fa fa-vine"></i></a></li>
				@endif
				
				<li><a class="board-share pull-right js-share" href="#"><i class="fa fa-share"></i></a></li>
					@if(isset($user) && $board->config()->first()->user_id == $user->id)
						<li><a class="board-settings pull-right" href="{{ URL::to("/konto/tablica/$board->hashtag/$board->id/ustawienia") }}"><i class="fa fa-cog"></i></a></li>
					@endif
			</ul>
		</nav>
	</div>
	<div class="pull-left">
		<div class="board-description hidden-xs">
			<div class="board-description-wrapper">
				@if($board->description != '')
					<p class="board-description-data">{{ $board->description }}</p>
				@else
					<p class="board-description-data">Co oznacza ten hashtag?</p>
				@endif

				@if($board->description != '')
					@if(isset($user) && $board->config()->first()->user_id == $user->id)
						<a href="#" class="btn-default btn-link-primary btn-text js-update-description">Edytuj opis</a>
					@elseif($board->config()->first()->user_id == 0)
						<a href="#" class="btn-default btn-link-primary btn-text js-update-description">Edytuj opis</a>
					@endif
				@else
					<a href="#" class="btn-default btn-link-primary btn-text js-update-description">Edytuj opis</a>
				@endif
			</div>
		</div>	
	</div>
</header>
<div class="clearfix"></div>

<div id="posts">
	<div class="board-loading"><i class="fa fa-circle-o-notch fa-spin"></i></div>
</div>
<a href="#" class="load-more">Pokaż Więcej</a>


</div>
@if(Auth::check())
 @include('user.user-dropdown')
@endif


@stop
