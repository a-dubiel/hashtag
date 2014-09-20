<?php

class BaseController extends Controller {

	public function __construct(){
	 	//JS
	 	Asset::add('//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.min.js', 'header');
	 	Asset::add('/js/libs/cssua.min.js', 'header');
	 	Asset::add('//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js','footer');
	 	Asset::add('/js/scripts.js', 'footer');

	 	
	 	
	 	//CSS
	 	Asset::add('//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css', 'header');
	 	Asset::add('css/style.css', 'header');

	 		 	
	 	//Asset::setDomain('//social.marcusa.co/riteaid/vday/aggr/laravel/public/');
	 }

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
