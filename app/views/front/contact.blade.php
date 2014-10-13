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
			<ul>
				@if(Auth::check() )
					@if(isset($avatar))
						<li><a href="#" data-dropdown="#dropdown-1" class="user-dropdown"><div class="user-avatar">{{ $avatar }}</div><div class="username"><span class="hidden-xs">{{ $username }}</span> <i class="fa fa-caret-down"></i></div></a></li>
					@else
						<li><a href="#" data-dropdown="#dropdown-1" class="user-dropdown"><div class="user-avatar"><i class="fa fa-user"></i></div><div class="username"><span class="hidden-xs">{{ $username }}</span> <i class="fa fa-caret-down"></i></div></a></li>
					@endif
						<li><a class="btn-default btn-sm btn-green-inverted hidden-xs" href="{{ URL::to('/konto/tablice') }}">Dodaj Tablicę</a></li>
				@else
					<li><a class="btn-default btn-link-secondary js-login-popup" href="#"><span class="hidden-xs">Zaloguj</span><span class="visible-xs"><i class="fa fa-navicon fa-2x"></i></span></a></li>
					<li><a class="btn-default btn-sm btn-green-inverted js-login-popup hidden-xs" href="#">Dodaj Tablicę</a></li>
				@endif			
			</ul>
		</nav>
	</div>
</header>

<div class="container">
	<div class="page-with-padding">
		<h1>Kontakt</h1>

	</div>
</div>



@if(Auth::check())
    <div id="dropdown-1" class="dropdown dropdown-tip dropdown-anchor-right">
        <ul class="dropdown-menu">
            <li><a href="{{ URL::to('/konto')}}"><i class="fa fa-cog"></i> Konto</a></li>
            <li><a href="{{ URL::to('/wyloguj')}}"><i class="fa fa-sign-out"></i> Wyloguj</a></li>      
            @if($user->boardConfig()->count() > 0 )
                <li class="divider"></li>
                @foreach($user->boardConfig()->get() as $board )
                    <li><a href="{{ URL::to("/".$board->board()->first()->hashtag."/".$board->board()->first()->id )}}"><i class="fa fa-th"></i> #{{ $board->board()->first()->hashtag }}</a></li>
                @endforeach
            @endif
        </ul>
    </div>
@endif





@stop