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





</style>


@endif



<div class="container content-board">
<a href="{{URL::to('/')}}" class="logo-presentation">hasztag.info</a>
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
