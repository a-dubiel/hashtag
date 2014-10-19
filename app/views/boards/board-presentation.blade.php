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

@if(!is_null($board->presentation_cover_file_name))

<style type="text/css">

html {

 background: url('{{ $board->presentation_cover->url('standard') }}') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

body {
	background:none;
}

h1 {
	color:#fff !important;
}

@if(!is_null($board->config()->first()->color != ''))

.user-info a,
.hashtag,
.board-loading {
	color:#{{ $board->config()->first()->color }};
}

.load-more {
	background-color: #{{ $board->config()->first()->color }};
}

.load-more:hover {
	background-color: #{{ $board->config()->first()->color }};
}

@endif





</style>


@endif



<div class="container content-board">
<a href="{{URL::to('/')}}" class="logo-presentation">hasztag.info</a>
<ul class="filters">
										
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
				
				
			</ul>
<h1>#{{ $board->hashtag }}</h1>

<div class="clearfix"></div>

<div id="posts" class="posts-container">
	<div class="board-loading"><i class="fa fa-circle-o-notch fa-spin"></i></div>
</div>
<a href="#" class="load-more">Pokaż Więcej</a>


</div>
@if(Auth::check())
 @include('user.user-dropdown')
@endif


@stop
