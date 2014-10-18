<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pl"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title><?php echo (isset($title) ? $title . ' | hasztag.info ' : 'hasztag.info')?></title>
    <meta name="description" content="Social media w jednym miejscu" />
    <meta property="og:title" content="<?php echo (isset($title) ? $title . ' | hasztag.info ' : 'hasztag.info')?>"/>
    <meta property="og:image" content="{{ URL::to('/images/assets/logo.jpg') }}"/>
    <meta property="og:site_name" content="hasztag.info"/>
    <meta property="og:description" content="Social media w jednym miejscu."/>
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ Request::url() }}">
    <!-- icons -->
    <link rel="shortcut icon" href="/images/assets/ico/favicon.ico">
    <link rel="apple-touch-icon" sizes="57x57" href="/images/assets/ico/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/assets/ico/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/assets/ico/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/assets/ico/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/assets/ico/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/assets/ico/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/assets/ico/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/assets/ico/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/assets/ico/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="/images/assets/ico/favicon-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="/images/assets/ico/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="/images/assets/ico/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/images/assets/ico/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/images/assets/ico/favicon-32x32.png" sizes="32x32">
    <meta name="msapplication-TileColor" content="#00a300">
    <meta name="msapplication-TileImage" content="/images/assets/ico/mstile-144x144.png">
    <meta name="msapplication-config" content="/images/assets/ico/browserconfig.xml">	
	 <!-- css files -->
    {{ Asset::css() }} 
    <!-- js files (header) -->
    {{ Asset::js('header') }}
    {{ Asset::scripts('header') }}
    <!--[if lt IE 9]>
		{{ Asset::js('ie') }}
		{{ Asset::scripts('ie') }}  
	<![endif]-->
    <script src="//use.typekit.net/xel2rce.js"></script>
    <script>try{Typekit.load();}catch(e){}</script>
</head>
<body class="page page-with-padding">
    @if(Session::has('alert'))
        <?php $alert = Session::get('alert') ?>
         <div class="alert-top animated fadeInDownBig">
            <div class="alert alert-{{ $alert['type'] }}">
                <a href="#" class="js-close-alert"><i class="fa fa-times"></i></a>
                <p>{{ $alert['content'] }}</p>
            </div>
        </div>
    @endif
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
	@yield('content')

    @if(Auth::check())
        @include('user.user-dropdown')
    @endif
    @include('front.footer')

    <script type="text/javascript">
        var base = '{{ URL::to('/')}}';
        var is_logged_in = <?php echo ( Auth::check() ? 'true' : 'false' ); ?>;
    </script>
    {{ Asset::js('footer') }}
    {{ Asset::scripts('footer') }}  	
</body>
</html>