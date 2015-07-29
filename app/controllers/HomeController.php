<?php

class HomeController extends BaseController {

	protected $layout = 'front.master';
	
	public function __construct() {
		parent::__construct();

		Asset::add('/js/libs/jquery.dropdown.js', 'footer');


	}

	public function postContactForm() {

		$rules = array(		
			'email'		=> 'email|required',			
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			$messages = $validator->messages();
			return Redirect::to('/kontakt')->withInput(Input::flash())->withErrors($validator)->with('alert', array('type' => 'error', 'content' => 'Podaj właściwy e-mail'));
		}
		else {
			Contact::create(Input::all());

			$data['email'] = Input::all();

			Mail::later(5, 'emails.contact', $data, function($message)
			{
			    $message->to('andrzej.dubiel@gmail.com')->subject('[hasztag.info] Nowa wiadomość');
			});

			return Redirect::to('/')->with('alert', array('type' => 'success', 'content' => 'Wiadomość wysłana. Odezwiemy się wkrótce!'));

		}
	}
	
	public function showHome()
	{		
		if(Auth::check()) {
			$user = Auth::user();
			$data['username'] = preg_replace('/@.*?$/', '', $user->email);
			$data['user'] = $user;

			if(!is_null($user->provider()->first()) && ($user->provider()->first()->provider == 'facebook')) {
				$data['avatar'] = '<img src="http://graph.facebook.com/'.$user->provider()->first()->provider_id.'/picture?type=small" alt="avatar" />';
			}
		}
		$items = ['home-bg-1.jpg', 'home-bg-2.jpg', 'home-bg-3.jpg', 'home-bg-4.jpg', 'home-bg-5.jpg', 'home-bg-6.jpg', 'home-bg-7.jpg',
		'home-bg-8.jpg', 'home-bg-9.jpg', 'home-bg-10.jpg', 'home-bg-12.jpg', 'home-bg-13.jpg', 'home-bg-14.jpg', 'home-bg-15.jpg', 
		'home-bg-16.jpg', 'home-bg-17.jpg','home-bg-18.jpg', 'home-bg-19.jpg', 'home-bg-20.jpg', 'home-bg-21.jpg', 'home-bg-22.jpg', 'home-bg-23.jpg', 
		'home-bg-24.jpg', 'home-bg-25.jpg', 'home-bg-26.jpg', 'home-bg-27.jpg','home-bg-28.jpg', 'home-bg-29.jpg', 'home-bg-30.jpg', 'home-bg-32.jpg', 'home-bg-33.jpg', 'home-bg-34.jpg' ];
		
		$data['introImg'] = $items[array_rand($items)];
		$lastMonth = Carbon::now()->subMonth();
		$popular = Stat::where('created_at','>=', $lastMonth)->orderBy('hits', 'desc')->take(3)->get();
		$data['popularHashtags'] = [];
		
		foreach($popular as $post) {

			$hashtag = $post->board()->first()->hashtag;

			if($post->board()->first()->config()->first()->user_id == 0) {
				$url = $hashtag .'/szukaj';
			}
			else {
				$url = $hashtag .'/'.$post->board()->first()->id;
			}

			$href = '<a class="hashtag" href="'.URL::to('/').'/'.$url.'">#'.$hashtag.'</a>';
			array_push($data['popularHashtags'], $href);
		}

		$data['title'] = $this->layout->title = null;
		$cookie = Cookie::queue('cookie_accept', 'yes', 2628000);
		$this->layout->content = View::make('front.home', $data);
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

		$data['title'] = $this->layout->title = 'Informacje';
		$this->layout->content = View::make('front.about-us', $data);
	}

	public function showPricing() {

		$data['title'] = $this->layout->title = 'Oferta';
		$this->layout->content = View::make('front.pricing', $data);
	}

	public function showLegal() {

		$data['title'] = $this->layout->title = 'Regulamin';
		$this->layout->content = View::make('front.terms', $data);
	}

	public function showContact() {

		$data['title'] = $this->layout->title = 'Kontakt';
		$this->layout->content = View::make('front.contact', $data);
	}

	public function showFaq() {
		
		$data['title'] = $this->layout->title = 'FAQ';
		$this->layout->content = View::make('front.faq', $data);
	}

	public function generateRobots() {
		
		if (App::environment() == 'production')
    	{
	        Robots::addUserAgent('*');
	        Robots::addDisallow('/konto');
	        Robots::addDisallow('/*/szukaj');
	        Robots::addSitemap('/sitemapindex.xml');
	    } else {
	    		Robots::addUserAgent('*');
	        Robots::addDisallow('*');
	    }

	    return Response::make(Robots::generate(), 200, array('Content-Type' => 'text/plain'));
	}

	public function generateSitemap() {
		
		$lastMonth = Carbon::now()->subMonth();
		$popular = Stat::where('created_at','>=', $lastMonth)->orderBy('hits', 'desc')->take(50)->get();
		$data['popularHashtags'] = [];
		
		foreach($popular as $post) {

			$hashtag = $post->board()->first()->hashtag;

			if($post->board()->first()->config()->first()->user_id == 0) {
				$url = $hashtag .'/szukaj';
			}
			else {
				$url = $hashtag .'/'.$post->board()->first()->id;
			}

			$href = '<a class="hashtag" href="'.URL::to('/').'/'.$url.'">#'.$hashtag.'</a>';
			array_push($data['popularHashtags'], $url);
		}


	    $sitemap = App::make("sitemap");

	    if (!$sitemap->isCached())
	    {
	       $sitemap->add(URL::to('/'), date('c',time()), '1.0', 'daily');
		     $sitemap->add(URL::to('/informacje'), date('c',time()), '0.6', 'monthly');
		     $sitemap->add(URL::to('/kontakt'), date('c',time()), '0.5', 'monthly');
		     $sitemap->add(URL::to('/regulamin'), date('c',time()), '0.3', 'monthly');
		     foreach($data['popularHashtags'] as $link) {
			      $sitemap->add(URL::to($link), date('c',time()), '0.3', 'weekly');
		     }	       
	    }

	    return $sitemap->render('xml');

	}


}
