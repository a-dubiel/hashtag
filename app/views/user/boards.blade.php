@extends('user.master')

@section('content')

<div class="container">
	<h1>Konto</h1>
	<nav class="nav-account">
		<ul>
			<li><a href="{{ URL::to('/konto') }}">Ustawienia</a></li>
			<li><a class="active" href="{{ URL::to('/konto/tablice') }}">Tablice</a></li>
			<!--
			@if($user->level == 1 )
			<li><a href="{{ URL::to('/konto/pro') }}" class="btn-get-pro">Konto Pro</a></li>
			@else
			<li><a href="{{ URL::to('/konto/pro/subskrypcja') }}">Konto Pro</a></li>
			@endif
			-->
		</ul>
	</nav>
	<div class="account-content clearfix">
		<div class="account-module-info">
			<h3>Tablice</h3>
			<p>Aktualnie wykorzystano: <span class="bold">{{ $boards->count() }} z {{ $max }}</span></p>
			<div class="account-bar">
				<div class="account-board-status" style="width:{{ $width }}%"></div>
			</div>
		</div>
		@if($boards->count() > 0)
		<table class="rwd-table">
		  <tr class="heading">
		    <th>Hasztag</th>
		    <th>Ustawienia</th>
		    <th>Promowane Posty</th>
		    <th>Aktywny</th>
		    <th>Link</th>
		    <th>Utworzono</th>
		    <th>Aktualizowano</th>
		  </tr>
			@foreach($boards->get() as $board)
			<tr>
				<td data-th="Hasztag">
					@if($board->config()->first()->is_active == 1 )
						<a class="hashtag" href="{{ URL::to("/$board->hashtag/$board->id") }}">#{{ $board->hashtag }}</a>
					@else
						<a class="hashtag not-active" href="#">#{{ $board->hashtag }}</a>
					@endif	
				</td>
			    <td data-th="Ustawienia"><a class="btn-default btn-sm btn-green-inverted" href="{{ URL::to("konto/tablica/$board->hashtag/$board->id/ustawienia") }}">Ustawienia</a></td>
			    <td data-th="Promowane Posty">
			    	@if($board->featuredPost()->count() > 0)
						<a class="btn-default btn-sm btn-green-inverted" href="{{ URL::to("konto/tablica/$board->hashtag/$board->id/promowane") }}"><i class="fa fa-star"></i> Zobacz Posty</a>
			    	@else
						Brak Postów
			    	@endif
			    </td>
			    <td data-th="Aktywny"><a class="board-setting-icon js-board-state" href="#">{{ ($board->config()->first()->is_active == 1 ) ? '<i class="fa green fa-check"></i>' : '<i class="fa red fa-times"></i>' }}</a></td>
			    <td data-th="Link">
			   	 	@if($board->config()->first()->is_active == 1 )
				    	<a class="board-setting-icon" href="{{ URL::to("/$board->hashtag/$board->id") }}"><i class="fa fa-external-link"></i></a>
			    	@endif
			    </td>
			    <td data-th="Utworzono"><abbr class="timeago" title="{{ $board->created_at }}">{{ $board->created_at }}</abbr></td>
			    <td data-th="Aktualizowano"><abbr class="timeago" title="{{ $board->updated_at }}">{{ $board->created_at }}</abbr></td>

		    </tr>
			@endforeach
		  @else
			<td>Nie masz jeszcze żadnych tablic.</td>
		  @endif
		</table>
		<div class="clearfix add-bottom"></div>
		<a href="{{ URL::to('/konto/tablica/dodaj')}}" class="btn-default btn-green btn-lg">Dodaj tablicę</a>

	</div>
</div>


@stop