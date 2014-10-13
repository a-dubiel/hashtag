@extends('user.master')

@section('content')

<div class="container">
	<h1>Konto</h1>
	<nav class="nav-account">
		<ul>
			<li><a href="{{ URL::to('/konto') }}">Ustawienia</a></li>
			<li><a class="active" href="{{ URL::to('/konto/tablice') }}">Tablice</a></li>
			@if($user->level == 1 )
			<li><a href="{{ URL::to('/konto/pro') }}" class="btn-get-pro">Konto Pro</a></li>
			@else
			<li><a href="{{ URL::to('/konto/pro/subskrypcja') }}">Konto Pro</a></li>
			@endif
		</ul>
	</nav>
	<div class="account-content clearfix">
		<div class="account-module-info">
			@if($board->config()->first()->is_active == 1)
				<a href="{{ URL::to("$board->hashtag/$board->id") }}" class="btn-default btn-sm btn-green-inverted pull-right">Zobacz Tablicę</a>
			@endif
			<h3>Promowane posty na tablicy #{{ $board->hashtag }}</h3>
			<p>Tutaj możesz usunąć promowane posty.</p>

		</div>
		
		<div class="user-owned featured-posts-wrapper">
			<div id="featured-posts">
				@foreach($posts->get() as $post)
					{{ $post['html'] }}
				@endforeach

			</div>
			<div class="clearfix"></div>
		</div>


		<script type="text/javascript">
				var board_id = '{{ $board->id }}';

		</script>


		

		
				



</div>


</div>





@stop