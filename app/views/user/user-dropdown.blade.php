<?php $user = Auth::user() ?>
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