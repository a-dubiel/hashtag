<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>hasztag.info</title>
    <meta name="description" content="description" />
    <meta name="keywords" content="keywords here" />		
	 <!-- css files -->
    {{ Asset::css() }} 
    <!-- js files (header) -->
    {{ Asset::js('header') }}
    {{ Asset::scripts('header') }}
    <!--[if lt IE 9]>
		{{ Asset::js('ie') }}
		{{ Asset::scripts('ie') }}  
	<![endif]-->
</head>
<body class="page">
	@yield('content')
	<!-- js scripts -->
    {{ Asset::js('footer') }}
    {{ Asset::scripts('footer') }}  	
</body>
</html>