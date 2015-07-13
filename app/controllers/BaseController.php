<?php

class BaseController extends Controller {

	public function __construct(){
	 	//JS
	 	Asset::add('//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.min.js', 'header');
	 	Asset::add('/js/libs/cssua.min.js', 'header');
	 	Asset::add('//cdnjs.cloudflare.com/ajax/libs/pace/0.6.0/pace.min.js', 'header');
	 	Asset::add('//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js','footer');
	 	Asset::add('//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/0.9.9/jquery.magnific-popup.min.js', 'footer');
	 	Asset::add('//cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.4.0/jquery.timeago.min.js', 'footer');
	 	Asset::add('/js/libs/jquery.timeago-pl.js', 'footer');
	 	Asset::add('/js/libs/placeholder.js', 'footer');
	 	Asset::add('/js/scripts.js', 'footer');

	 	//CSS
	 	Asset::add('//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css', 'header');
	 	Asset::add('//cdnjs.cloudflare.com/ajax/libs/animate.css/3.1.1/animate.min.css', 'header');
	 	Asset::add('css/style.css', 'header');
	 	
	 	Asset::$secure = true;

	 }

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
