<ul>
    @if(Auth::check())
        <?php $user = Auth::user() ?>
        @if($user->provider->count() > 0)
            @if($user->default_provider == 'facebook')
                <li><a href="#" data-dropdown="#dropdown-1" class="user-dropdown"><div class="user-avatar"><img src="http://graph.facebook.com/{{$user->provider()->first()->provider_id}}/picture?type=small" alt="avatar" /></div><div class="username hidden-xs">{{ preg_replace('/@.*?$/', '', $user->email) }}</div> <i class="fa fa-caret-down"></i></a></li>
            @elseif($user->default_provider == 'instagram')
                @foreach($user->provider()->get() as $provider)
                    @if($provider->provider == 'instagram')
                        <li><a href="#" data-dropdown="#dropdown-1" class="user-dropdown"><div class="user-avatar"><img src="{{ $provider->profile_picture }}" alt="avatar" /></div><div class="username hidden-xs">{{ preg_replace('/@.*?$/', '', $user->email) }}</div> <i class="fa fa-caret-down"></i></a></li>
                    @endif
                @endforeach    
            @elseif($user->default_provider == 'twitter')
                @foreach($user->provider()->get() as $provider)
                    @if($provider->provider == 'twitter')
                        <li><a href="#" data-dropdown="#dropdown-1" class="user-dropdown"><div class="user-avatar"><i class="fa fa-twitter"></i></div><div class="username hidden-xs">{{ preg_replace('/@.*?$/', '', $user->email) }}</div> <i class="fa fa-caret-down"></i></a></li>
                    @endif
                @endforeach    
            @endif
            
        @else
            <li><a href="#" data-dropdown="#dropdown-1" class="user-dropdown"><div class="user-avatar"><i class="fa fa-user"></i></div><div class="username hidden-xs">{{ preg_replace('/@.*?$/', '', $user->email) }}  <i class="fa fa-caret-down"></i></div></a></li>
        @endif
            <li><a class="btn-default btn-sm btn-green-inverted hidden-xs" href="{{ URL::to('/konto/tablice') }}">Dodaj Tablicę</a></li>
   @else
        <li><a class="btn-default btn-link-secondary js-login-popup" href="#"><span class="hidden-xs">Zaloguj</span><span class="visible-xs"><i class="fa fa-navicon fa-2x"></i></span></a></li>
        <li><a class="btn-default btn-sm btn-green-inverted js-login-popup hidden-xs" href="#">Dodaj Tablicę</a></li>
    @endif
</ul>