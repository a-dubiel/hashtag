<?php

class HomeController extends BaseController {

	protected $layout = 'front.master';
	
	public function __construct() {
		parent::__construct();

		Asset::add('/js/libs/jquery.dropdown.js', 'footer');


	}
	
	public function showHome()
	{		
		$this->layout->content = View::make('front.home');
	}

	public function showSignUp() {
		$data['url'] = URL::to('/');
		$data['title'] = $this->layout->title = 'Zarejestruj się';
		$this->layout->content = View::make('front.page-signup', $data);
	}

	public function showLogin() {
		$data['url'] = URL::to('/');
		$data['title'] = $this->layout->title = 'Zaloguj się';
		$this->layout->content = View::make('front.page-login', $data);
	}

	public function showAboutUs() {

		if(Auth::check()) {
			$user = Auth::user();
			$data['username'] = preg_replace('/@.*?$/', '', $user->email);
			$data['user'] = $user;

			if(!is_null($user->provider()->first()) && ($user->provider()->first()->provider == 'facebook')) {
				$data['avatar'] = '<img src="http://graph.facebook.com/'.$user->provider()->first()->provider_id.'/picture?type=small" alt="avatar" />';
			}
		}

		$data['title'] = $this->layout->title = 'Informacje';
		$this->layout->content = View::make('front.about-us', $data);
	}

	public function showPricing() {
		
		if(Auth::check()) {
			$user = Auth::user();
			$data['username'] = preg_replace('/@.*?$/', '', $user->email);
			$data['user'] = $user;

			if(!is_null($user->provider()->first()) && ($user->provider()->first()->provider == 'facebook')) {
				$data['avatar'] = '<img src="http://graph.facebook.com/'.$user->provider()->first()->provider_id.'/picture?type=small" alt="avatar" />';
			}
		}

		$data['title'] = $this->layout->title = 'Oferta';
		$this->layout->content = View::make('front.pricing', $data);
	}

	public function showLegal() {

		if(Auth::check()) {
			$user = Auth::user();
			$data['username'] = preg_replace('/@.*?$/', '', $user->email);
			$data['user'] = $user;

			if(!is_null($user->provider()->first()) && ($user->provider()->first()->provider == 'facebook')) {
				$data['avatar'] = '<img src="http://graph.facebook.com/'.$user->provider()->first()->provider_id.'/picture?type=small" alt="avatar" />';
			}
		}

		$data['title'] = $this->layout->title = 'Regulamin';
		$this->layout->content = View::make('front.terms', $data);
	}

	public function showContact() {
		
		if(Auth::check()) {
			$user = Auth::user();
			$data['username'] = preg_replace('/@.*?$/', '', $user->email);
			$data['user'] = $user;

			if(!is_null($user->provider()->first()) && ($user->provider()->first()->provider == 'facebook')) {
				$data['avatar'] = '<img src="http://graph.facebook.com/'.$user->provider()->first()->provider_id.'/picture?type=small" alt="avatar" />';
			}
		}

		$data['title'] = $this->layout->title = 'Kontakt';
		$this->layout->content = View::make('front.contact', $data);
	}


}
