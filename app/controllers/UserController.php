<?php

class UserController extends \BaseController {

	protected $layout = 'user.master';

	public function __construct() {
		parent::__construct();

		Asset::add('//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.0.0/isotope.pkgd.min.js', 'footer');	
		Asset::add('//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.0.4/jquery.imagesloaded.min.js', 'footer');
		Asset::add('/js/admin.js', 'footer');
		Asset::add('/js/libs/jquery.dropdown.js', 'footer');

	}

	public function postPaymentUpdateCard()
	{	

		if(Auth::check()) {

			$rules = array(		
				'paylane_token'		=> 'required',				
			);

			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()) {
				$messages = $validator->messages();
				return Redirect::to('konto/pro/subskrypcja/edytuj')->withInput(Input::flash())->withErrors($validator)->with('alert', array('type' => 'error', 'content' => 'Błąd! Sprawdź wszystkie pola.'));
			}
			else {
				$client = new Paylane\PayLaneRestClient('adubiel', 'dru9pra2');
				$user = Auth::user();
				$subscription = Subscription::where('user_id', '=', $user->id)->first();

				$card_params = array(
				    'sale'     => array(
				        'amount'      => 1.00,
				        'currency'    => 'PLN',
				        'description' => 'Subskrypcja Hasztag.info'
				    ),
				    'customer' => array(
				        'name'    => $subscription->first_name.' '.$subscription->last_name,
				        'email'   => $subscription->email,
				        'ip'      => '127.0.0.1',
				      //  'ip'	  => Request::getClientIp(),
				        'address' => array (
				            'street_house' => $subscription->address,
				            'city'         => $subscription->city,
				            'state'        => $subscription->state,
				            'zip'          => $subscription->zip,
				            'country_code' => 'PL',
				        ),
				    ),
				    'card' => array(
				        'token' => Input::get('paylane_token')
				    ),
				);

			
			     $status = $client->cardAuthorizationByToken($card_params);
				
				if ($client->isSuccess()) {

					$payment = Payment::create(array(
						'user_id' => $user->id,
						'subscription_id' => $subscription->id,
						'sale_id' => $status['id_authorization'],
						'is_success' => 2
					));

					if($subscription->is_active == 0) {
						Event::fire('activate.subscription', array($subscription->id));	
						return Redirect::to('/konto/pro/subskrypcja')->with('alert', array('type' => 'success', 'content' => 'Karta zaktualizowana. Twoja subskrypcja jest teraz aktywna.'));
					}
					else {
						return Redirect::to('/konto/pro/subskrypcja')->with('alert', array('type' => 'success', 'content' => 'Karta zaktualizowana!'));	
					}
				}
				else {
					if(isset($status['error'])) {
						return Redirect::back()->with('alert', array('type' => 'error', 'content' => $status['error']['error_description']));						return Redirect::back()->with('alert', array('type' => 'error', 'content' => $status['error']['description']));					}
					else {
						return Redirect::back()->with('alert', array('type' => 'error', 'content' => 'Błąd! Coś poszło nie tak!'));	
					}
				}
			}

		}
				
	}

	public function postSubscriptionDelete() {
		if(Auth::check()) {
			$user = Auth::user();

			if($user->level == 2) {

			$configs = BoardConfig::where('user_id', '=', $user->id)->get();
					
			foreach($configs as $config) {
				$config->board()->first()->delete();
				$config->delete();
			}

			$subscription = Subscription::where('user_id', '=', $user->id);
			$subscription->delete();

			$user->level = 1;
			$user->save();

			return Redirect::to('/')->with('alert', array('type' => 'success', 'content' => 'Subskrypcja usunięta. Dziękujemy!'));
	
			}
		}
	}
	

	public function postSubscriptionDowngrade() {
		if(Auth::check()) {
			$user = Auth::user();

			if($user->level == 2) {

			$rules = array(					
				'board'		=> 'required'
			);

			$validator = Validator::make(Input::all(), $rules);

				if ($validator->fails()) {
					$messages = $validator->messages();
					return Redirect::to('/konto/pro/subskrypcja/rezygnuj')->withInput(Input::flash())->withErrors($validator)->with('alert', array('type' => 'error', 'content' => 'Błąd! Wybierz tablicę którą chcesz zachować.'));
				}
				else {
					if(Input::get('board') == 'all') {
						$configs = BoardConfig::where('user_id', '=', $user->id)->get();
					}
					else {
						$configs = BoardConfig::where('user_id', '=', $user->id)->where('board_id', '!=', Input::get('board'))->get();
					}
					

					foreach($configs as $config) {
						$config->board()->first()->delete();
						$config->delete();
					}

					$subscription = Subscription::where('user_id', '=', $user->id);
					$subscription->delete();

					$user->level = 1;
					$user->save();



					return Redirect::to('/konto')->with('alert', array('type' => 'success', 'content' => 'Konto zmienione na plan podstawowy.'));

				
				}

			}
		}
	}

	public function showSubscriptionDelete() {
		if(Auth::check()) {
			$user = Auth::user();

			if($user->level == 2) {
				$data['title'] = $this->layout->title = 'Rezygnuj';
				$data['user'] = $user;
				$data['boards'] = Board::byUserId($user)->orderBy('created_at', 'asc')->get();
				$data['subscription'] = Subscription::where('user_id', '=', $user->id)->first();
				$this->layout->content = View::make('user.subscription-delete', $data);
			}
			else {
				return Redirect::to('/konto/pro/')->with('alert', array('type' => 'error', 'content' => 'Nie wolno! Tylko dla użytkowników Pro!'));
			}
		}
	}



	public function postSubscriptionUpdate() {

		if(Auth::check()) {
			$user = Auth::user();

			if($user->level == 2) {

			$rules = array(					
				'first_name'		=> 'required',
				'last_name'  		=> 'required',
				'email'  			=> 'required|email',
				'address'  			=> 'required',
				'zip'  				=> 'required',
				'city'  			=> 'required',
				'state'  			=> 'required',
				'company_name'  	=> 'required_with:faktura',
				'company_id'  		=> 'required_with:faktura',
				'company_address'  	=> 'required_with:faktura',
				'company_zip'  		=> 'required_with:faktura',
				'company_city'  	=> 'required_with:faktura',
				'company_state'  	=> 'required_with:faktura',
			);

			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()) {
				$messages = $validator->messages();
				return Redirect::to('/konto/pro/subskrypcja/edytuj')->withInput(Input::flash())->withErrors($validator)->with('alert', array('type' => 'error', 'content' => 'Błąd! Sprawdź wszystkie pola.'));
			}
			else {

				$subscription = Subscription::where('user_id', '=', $user->id)->first();

				$subscription->first_name = Input::get('first_name');
				$subscription->last_name = Input::get('last_name');
				$subscription->email = Input::get('email');
				$subscription->address = Input::get('address');
				$subscription->zip = Input::get('zip');
				$subscription->city = Input::get('city');
				$subscription->state = Input::get('state');

				if(Input::has('faktura')) {
					$subscription->company_name = Input::get('company_name');
					$subscription->company_id = preg_replace('/\D/', '', Input::get('company_id'));
					$subscription->company_address = Input::get('company_address');
					$subscription->company_city = Input::get('company_city');
					$subscription->company_state = Input::get('company_state');
					$subscription->company_zip = Input::get('company_zip');
				}
				else {
					$subscription->company_name = '';
					$subscription->company_id = '';
					$subscription->company_address = '';
					$subscription->company_city = '';
					$subscription->company_state = '';
					$subscription->company_zip = '';
				}

				$subscription->save();

				return Redirect::to('/konto/pro/subskrypcja')->with('alert', array('type' => 'success', 'content' => 'Dane płatności zaktualizowane!'));

				}

			}
			else {
				return Redirect::to('/konto/pro/')->with('alert', array('type' => 'error', 'content' => 'Nie wolno! Tylko dla użytkowników Pro!'));
			}
		}
	}

	public function showSubscriptionUpdate() {

		Asset::add('/js/libs/paylane.js', 'header');
		
		if(Auth::check()) {
			$user = Auth::user();

			if($user->level == 2) {
				$data['title'] = $this->layout->title = 'Edutuj dane płatności';
				$data['user'] = $user;
				$data['subscription'] = Subscription::where('user_id', '=', $user->id)->first();
				$this->layout->content = View::make('user.subscription-edit', $data);
			}
			else {
				return Redirect::to('/konto/pro/')->with('alert', array('type' => 'error', 'content' => 'Nie wolno! Tylko dla użytkowników Pro!'));
			}
		}
	}

	public function showSubscription() {
		if(Auth::check()) {
			$user = Auth::user();

			if($user->level == 2) {
				$data['title'] = $this->layout->title = 'Subskrypcja';
				$data['user'] = $user;
				$data['subscription'] = Subscription::where('user_id', '=', $user->id);
				$data['payments'] = Payment::where('user_id', '=', $user->id)->orderBy('created_at', 'desc');
				$this->layout->content = View::make('user.subscription', $data);
			}
			else {
				return Redirect::to('/konto/pro/')->with('alert', array('type' => 'error', 'content' => 'Nie wolno! Tylko dla użytkowników Pro!'));
			}
		}
	}

	public function postPayment() {
		if(Auth::check()) {

			$rules = array(		
				'paylane_token'		=> 'required',				
				'first_name'		=> 'required',
				'last_name'  		=> 'required',
				'email'  			=> 'required|email',
				'address'  			=> 'required',
				'zip'  				=> 'required',
				'city'  			=> 'required',
				'state'  			=> 'required',
				'company_name'  	=> 'required_with:faktura',
				'company_id'  		=> 'required_with:faktura',
				'company_address'  	=> 'required_with:faktura',
				'company_zip'  		=> 'required_with:faktura',
				'company_city'  	=> 'required_with:faktura',
				'company_state'  	=> 'required_with:faktura',
			);

			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()) {
				$messages = $validator->messages();
				return Redirect::to('/konto/pro/platnosci')->withInput(Input::flash())->withErrors($validator)->with('alert', array('type' => 'error', 'content' => 'Błąd! Sprawdź wszystkie pola.'));
			}
			else {
				$user = Auth::user();
				$client = new Paylane\PayLaneRestClient('adubiel', 'dru9pra2');
				$card_params = array(
				    'sale'     => array(
				        'amount'      => 149.00,
				        'currency'    => 'PLN',
				        'description' => 'Subskrypcja Hasztag.info'
				    ),
				    'customer' => array(
				        'name'    => Input::get('first_name').' '.Input::get('last_name'),
				        'email'   => Input::get('email'),
				        'ip'      => '127.0.0.1',
				      //  'ip'	  => Request::getClientIp(),
				        'address' => array (
				            'street_house' => Input::get('address'),
				            'city'         => Input::get('city'),
				            'state'        => Input::get('state'),
				            'zip'          => Input::get('zip'),
				            'country_code' => 'PL',
				        ),
				    ),
				    'card' => array(
				        'token' => Input::get('paylane_token')
				    ),
				);

			
			    $status = $client->cardSaleByToken($card_params);
				
				if ($client->isSuccess()) {
					
					$subscription = Subscription::where('user_id', '=', $user->id);
					$faktura = false;
			
					if($subscription->count() > 0) {
						$subscription = $subscription->first();
						$subscription->user_id = $user->id;
						$subscription->is_active = 1;
						$subscription->first_name = Input::get('first_name');
						$subscription->last_name = Input::get('last_name');
						$subscription->email = Input::get('email');
						$subscription->address = Input::get('address');
						$subscription->zip = Input::get('zip');
						$subscription->city = Input::get('city');
						$subscription->state = Input::get('state');

						$subscription->expires_at = Carbon::now()->addDays(30);

						if(Input::has('faktura')) {
							$faktura = true;
							$subscription->is_active = 1;
							$subscription->company_name = Input::get('company_name');
							$subscription->company_id = preg_replace('/\D/', '', Input::get('company_id'));
							$subscription->company_address = Input::get('company_address');
							$subscription->company_city = Input::get('company_city');
							$subscription->company_state = Input::get('company_state');
							$subscription->company_zip = Input::get('company_zip');
						}

						$subscription->save();
					}
					else {
						$subscription = new Subscription;
						$subscription->user_id = $user->id;
						$subscription->first_name = Input::get('first_name');
						$subscription->last_name = Input::get('last_name');
						$subscription->email = Input::get('email');
						$subscription->address = Input::get('address');
						$subscription->zip = Input::get('zip');
						$subscription->city = Input::get('city');
						$subscription->state = Input::get('state');

						$subscription->expires_at = Carbon::now()->addDays(30);

						if(Input::has('faktura')) {
							$faktura = true;
							$subscription->company_name = Input::get('company_name');
							$subscription->company_id = preg_replace('/\D/', '', Input::get('company_id'));
							$subscription->company_address = Input::get('company_address');
							$subscription->company_city = Input::get('company_city');
							$subscription->company_state = Input::get('company_state');
							$subscription->company_zip = Input::get('company_zip');
						}

						$subscription->save();


					}

					$payment = Payment::create(array(
						'user_id' => $user->id,
						'subscription_id' => $subscription->id,
						'sale_id' => $status['id_sale'],
						'is_success' => 1
					));
					
					Event::fire('invoice.email', array($user->id, $subscription->id, $payment->id, $faktura));
					EmailNotification::where('subscription_id', '=', $subscription->id )->delete();
					
					$user->level = 2;
					$user->save();

					return Redirect::to('/konto/pro/subskrypcja')->with('alert', array('type' => 'success', 'content' => 'Dziękujemy! Płatność zaakceptowana.'));

				}
				else {

					if(isset($status['error'])) {
						return Redirect::back()->with('alert', array('type' => 'error', 'content' => $status['error']['error_description']));						return Redirect::back()->with('alert', array('type' => 'error', 'content' => $status['error']['description']));					}
					else {
						return Redirect::back()->with('alert', array('type' => 'error', 'content' => 'Błąd! Coś poszło nie tak!'));	
					}
				}

			}
		}
	}

	public function showProPayment()
	{	
		Asset::add('/js/libs/paylane.js', 'header');

			$user = Auth::user();
			$data['user'] = $user;

			if($user->level != 2) {
				$data['title'] = $this->layout->title = 'Płatności';
				$this->layout->user = $user;
				$this->layout->content = View::make('user.payment', $data);
			}
			else {
				return Redirect::to('/konto')->with('alert', array('type' => 'error', 'content' => 'Błąd!'));	
			}
			
		
	}

	public function showPro()
	{
		if(Auth::check()) {
			
			$user = Auth::user();
			$data['user'] = $user;
		
			$data['title'] = $this->layout->title = 'Pro';
			$this->layout->user = $user;
			$this->layout->content = View::make('user.pro', $data);
		}
	}

	public function showBoardFeatured($hashtag, $id) {


		
		if(Auth::check() && isset($hashtag) && isset($id)) {
			$user = Auth::user();
			$board = Board::find($id);
			$posts = FeaturedPost::where('board_id', '=', $id);

			if($board) {
				if($board->config()->first()->user_id == $user->id) {
					$data['user'] = $user;				
					$data['board'] = $board;
					$data['posts'] = $posts;
					$data['title'] = $this->layout->title = 'Promowane posty tablicy #'.$board->hashtag;
					$this->layout->content = View::make('user.featured-post', $data);
				}
				else {
					return Redirect::to('/konto')->with('alert', array('type' => 'error', 'content' => 'Błąd! Coś poszło nie tak.'));
				}
			}
			else {
				return Redirect::to('/konto')->with('alert', array('type' => 'error', 'content' => 'Błąd! Coś poszło nie tak.'));
			}
		}
		else {
			return Redirect::to('/')->with('alert', array('type' => 'error', 'content' => 'Błąd! Coś poszło nie tak.'));
		}

	}

	public function postChangeBoardStatus() {
		if(Auth::check()) {
			$config = BoardConfig::where('board_id', '=', Input::get('board_id') )->first();
			$user = Auth::user();
			if(Input::has('activate')) {	
				if($user->subscription()->first()->is_active == 1) {
					$config->is_active = Input::get('activate');
					$config->save();
					return Redirect::to('/konto/tablice')->with('alert', array('type' => 'success', 'content' => 'Tablica zaktualizowana!'));
				}
				else {
					return Redirect::to('/konto/tablice')->with('alert', array('type' => 'error', 'content' => 'Błąd! Twoja subskrypcja nie jest aktywna.'));
				}				
			}
			else {
				return Redirect::to('/konto/tablice')->with('alert', array('type' => 'error', 'content' => 'Błąd! Nie udało się zaktualizować tablicy.'));
			}


		}
	}

	public function postDeleteBoard() {
		if(Auth::check()) {
			$board = Board::find(Input::get('board_id'));
			$user = Auth::user();

			if($board->config()->first()->user_id == $user->id) {
				
				$board->config()->delete();
				$board->delete();
				
				return Redirect::to('/konto/tablice')->with('alert', array('type' => 'success', 'content' => 'Tablica usunięta!'));
				
			}
			else {
				return Redirect::to('/konto/tablice')->with('alert', array('type' => 'error', 'content' => 'Błąd! Nie udało się usunąć tablicy.'));
			}
			


		}
	}

	public function postUpdateBoard() {
		if(Auth::check()) {

			$user = Auth::user();
			$board = Board::find(Input::get('board_id'));

			if($board->config()->first()->user_id == $user->id) {	

				$rules = array(						
					'hashtag'			=> 'required|min:3',
					'avatar'  			=> 'mimes:jpg,jpeg,png|image|max:1024|image_size:>=300',
					'cover'  			=> 'mimes:jpg,jpeg,png|image|max:3072|image_size:>=1200,>=150',
					'website_url' 		=> 'url',
					'refresh_interval' 	=> 'integer|min:10|max:120',
					'refresh_count' 	=> 'integer|min:1|max:10'
				);

				$validator = Validator::make(Input::all(), $rules);

				if ($validator->fails()) {
					$messages = $validator->messages();
					return Redirect::to("/konto/tablica/$board->hashtag/$board->id/ustawienia")->withInput(Input::flash())->withErrors($validator)->with('alert', array('type' => 'error', 'content' => 'Błąd! Sprawdź wszystkie pola.'));
				}
				else {

					$data = Input::get('hashtag');
					$data = explode(' ', trim($data) );
					$result = preg_replace('/#([\w-]+)/i', '$1', $data[0]);
					$hashtag = Sanitize::string($result);				
					
					$board->hashtag = $hashtag;
					$board->description = Input::get('description');
					
					if(Input::hasFile('cover')) {
						$board->cover = Input::file('cover');
					}
					else if(Input::has('delete_cover')) {
						$board->cover = STAPLER_NULL;
					}
					
					if(Input::hasFile('avatar')) {
						$board->avatar = Input::file('avatar');
					}
					else if(Input::has('delete_avatar')) {
						$board->avatar = STAPLER_NULL;
					}
					
					$board->fb_user = Input::get('fb_user');
					$board->tw_user = Input::get('tw_user');
					$board->insta_user = Input::get('insta_user');
					$board->google_user = Input::get('google_user');
					$board->website_url = Input::get('website_url');

					$board->save();

					
					
					$fb = Input::has('has_fb') ? 0 : -1;
					$insta = Input::has('has_insta') ? 0 : -1;
					$tw = Input::has('has_tw') ? 0 : -1;
					$google = Input::has('has_google') ? 0 : -1;
					$vine = Input::has('has_vine') ? 0 : -1;

					$refreshInterval = Input::has('refresh_interval') ? Input::get('refresh_interval') : 30;
					$refreshCount = Input::has('refresh_count') ? Input::get('refresh_count') : 2;
					$bannedUsers = Input::has('banned_users') ? Input::get('banned_users') : '';
					$filter = Input::has('filter') ? Input::get('filter') : '';
					$live = Input::has('live') ? 1 : 0;

					$config = BoardConfig::where('board_id', '=', $board->id)->first();

					//dd($config);
					
					$config->has_fb = $fb;
					$config->has_insta = $insta;
					$config->has_tw = $tw;
					$config->has_google = $google;
					$config->has_vine = $vine;
					$config->refresh_interval = $refreshInterval;
					$config->refresh_count = $refreshCount;
					$config->live = $live;
					$config->banned_users = $bannedUsers;
					$config->filter = $filter;

					$config->save();

					return Redirect::to('/konto/tablice')->with('alert', array('type' => 'success', 'content' => 'Tablica zaktualizowana!'));

				}
			}
			else {
				App::abort(404);
			}

		}
	}

	

	public function showAddBoard() {
		if(Auth::check()) {
			
			$user = Auth::user();		
			$boardCount = BoardConfig::where('user_id', '=', $user->id)->count();
			//dd($boardCount);
			if($user->level == 1) {
				if($boardCount < 1) {
					$data['user'] = $user;
					$data['title'] = $this->layout->title = 'Dodaj tablicę';
					$this->layout->content = View::make('user.board-new', $data);	
				}
				else {
					return Redirect::to('/konto/tablice')->with('alert', array('type' => 'error', 'content' => 'Limit przekroczony! Zostań Pro i dodaj więcej tablic!'));
				}
			}
			else if($user->level == 2) {
				
				if($boardCount < 5) {
					$data['user'] = $user;
					$data['title'] = $this->layout->title = 'Dodaj tablicę';
					$this->layout->content = View::make('user.board-new', $data);	
				}
				else {
					return Redirect::to('/konto/tablice')->with('alert', array('type' => 'error', 'content' => 'Nie możesz dodać więcej tablic!'));
				}
			}

		}
	}


	public function showBoardSettings($hashtag, $id) {
		if(Auth::check() && isset($hashtag) && isset($id)) {
			$user = Auth::user();
			$board = Board::find($id);

			if($board) {
				if($board->config()->first()->user_id == $user->id) {
					$data['config'] = $board->config()->first();
					$data['board'] = $board;
					$data['user'] = $user;
					$data['title'] = $this->layout->title = 'Ustawienia #'.$board->hashtag;
					$this->layout->content = View::make('user.board-settings', $data);
				}
				else {
					return Redirect::to('/konto')->with('alert', array('type' => 'error', 'content' => 'Błąd! Coś poszło nie tak.'));
				}
			}
			else {
				return Redirect::to('/konto')->with('alert', array('type' => 'error', 'content' => 'Błąd! Coś poszło nie tak.'));
			}
		}
		else {
			return Redirect::to('/')->with('alert', array('type' => 'error', 'content' => 'Błąd! Coś poszło nie tak.'));
		}
	}

	public function postAddBoard() {
		if(Auth::check()) {

			$rules = array(						
				'hashtag'			=> 'required|min:3',
				'avatar'  			=> 'mimes:jpg,jpeg,png|image|max:1024|image_size:>=300',
				'cover'  			=> 'mimes:jpg,jpeg,png|image|max:3072|image_size:>=1200,>=150',
				'website_url' 		=> 'url',
				'refresh_interval' 	=> 'integer|min:10|max:120',
				'refresh_count' 	=> 'integer|min:1|max:10'
			);

			$user = Auth::user();

			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()) {
				$messages = $validator->messages();
				return Redirect::to('/konto/tablica/dodaj')->withInput(Input::flash())->withErrors($validator)->with('alert', array('type' => 'error', 'content' => 'Błąd! Sprawdź wszystkie pola.'));
			}
			else {

				$data = Input::get('hashtag');
				$data = explode(' ', trim($data) );
				$result = preg_replace('/#([\w-]+)/i', '$1', $data[0]);
				$hashtag = Sanitize::string($result);				

				$board = Board::create(array(
							'hashtag' => $hashtag,
							'description' => Input::get('description'),
							'avatar' => Input::file('avatar'),
							'cover' => Input::file('cover'),
							'fb_user' => Input::get('fb_user'),
							'tw_user' => Input::get('tw_user'),
							'insta_user' => Input::get('insta_user'),
							'google_user' => Input::get('google_user'),
							'website_url' => Input::get('website_url') 
						));

				$fb = Input::has('has_fb') ? 0 : -1;
				$insta = Input::has('has_insta') ? 0 : -1;
				$tw = Input::has('has_tw') ? 0 : -1;
				$google = Input::has('has_google') ? 0 : -1;
				$vine = Input::has('has_vine') ? 0 : -1;

				$refreshInterval = Input::has('refresh_interval') ? Input::get('refresh_interval') : 30;
				$refreshCount = Input::has('refresh_count') ? Input::get('refresh_count') : 2;
				$bannedUsers = Input::has('banned_users') ? Input::get('banned_users') : '';
				$filter = Input::has('filters') ? Input::get('filters') : '';
				$live = Input::has('live') ? 1 : 0;

			//	dd($live);

				$config = BoardConfig::create(array(
							'board_id' => $board->id,
							'user_id'  => $user->id,
							'has_fb' => $fb,
							'has_insta' => $insta,
							'has_tw' => $tw,
							'has_google' => $google,
							'has_vine' => $vine,
							'refresh_interval' => $refreshInterval,
							'refresh_count' => $refreshCount,
							'live' => $live,
							'banned_users' => $bannedUsers,
							'filter' => $filter
						));


				return Redirect::to('/konto/tablice')->with('alert', array('type' => 'success', 'content' => 'Tablica utworzona!'));

				
			}
		}
	}

	public function index()
	{
		if(Auth::check()) {
			
			$user = Auth::user();
			
			$data['user'] = $user;
			$data['boards'] = Board::byUserId($user)->orderBy('created_at', 'asc')->get();
			$data['providers'] = $user->provider();
			$data['username'] = preg_replace('/@.*?$/', '', $user->email);

			$data['title'] = $this->layout->title = 'Konto';
			$this->layout->content = View::make('user.index', $data);
		}
	}

	public function showBoards()
	{
		if(Auth::check()) {
			
			$user = Auth::user();
			$data['user'] = $user;
		
			$data['boards'] = Board::byUserId($user);

			if($user->level == 1) {
				$data['width'] = ($data['boards']->count() / 1) * 100;
				$data['max'] = 1;
			}
			else if($user->level == 2) {
				$data['width'] = ($data['boards']->count() / 5) * 100;
				$data['max'] = 5;
			}			

			$data['title'] = $this->layout->title = 'Tablice';
			$this->layout->user = $user;
			$this->layout->content = View::make('user.boards', $data);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /user/create
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}

	public function updatePassword() {
		$rules = array(						
			'old_password'	   => 'required',
			'new_password'         => 'required|min:5',
			'new_password_confirm' => 'required|same:new_password'
		);

		$user = Auth::user();

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			$messages = $validator->messages();
			
			return Redirect::to('/konto')->withErrors($validator)->with('alert', array('type' => 'error', 'content' => 'Błąd! Sprawdź wszystkie pola.'));
		}
		else {
			if($user->id == Input::get('user_id')) {
				$hashedPassword = Input::get('old_password');
				if (Hash::check($hashedPassword, $user->password )) {
					$user->password = Hash::make(Input::get('new_password'));
					$user->save();

					return Redirect::to('/konto')->withErrors($validator)->with('alert', array('type' => 'success', 'content' => 'Hasło zaktualizowane!'));
				}
				else {
					return Redirect::to('/konto')->withErrors($validator)->with('alert', array('type' => 'error', 'content' => 'Błąd! Hasło się nie zgadza.'));
				}
			}
			else {
				return Redirect::to('/konto')->withErrors($validator)->with('alert', array('type' => 'error', 'content' => 'Błąd! Sprawdź wszystkie pola.'));
			}
		}
	}

	public function updateEmail() {
		
		$rules = array(						
			'email' => 'required|email', 
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			$messages = $validator->messages();
			
			return Redirect::to('/konto')->withErrors($validator)->with('alert', array('type' => 'error', 'content' => 'Błąd! Sprawdź wszystkie pola.'));

		} else {

			$user = Auth::user();
			$user->email = Input::get('email');
			$user->save();
			
			return Redirect::to('/konto')->with('alert', array('type' => 'success', 'content' => 'E-mail zaktualizowany!'));
		}

	}

	public function login() {
		$rules = array(						
			'email'            => 'required|email', 	
			'password'         => 'required',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			$messages = $validator->messages();
			
			return Redirect::to('/zaloguj')->withErrors($validator)->with('alert', array('type' => 'error', 'content' => 'Błąd! Sprawdź wszystkie pola.'));

		} else {

			$remember = (Input::get('remember') == 1 ? true : false);

			if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')), $remember ))
			{
			    

			    if(Input::has('redirect')) {
					return Redirect::to(Input::get('redirect'))->with('alert', array('type' => 'success', 'content' => 'Witamy! Zostałeś pomyślnie zalogowany.'));
				}
				else {
					return Redirect::to('/')->with('alert', array('type' => 'success', 'content' => 'Witamy! Zostałeś pomyślnie zalogowany.'));
				}
			}
			else {
				return Redirect::to('/zaloguj')->with('alert', array('type' => 'error', 'content' => 'Błąd! Nie ma takiego konta. '));
			}


		}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /user
	 *
	 * @return Response
	 */
	public function store()
	{	
		$rules = array(						
			'email'            => 'required|email|unique:users,email', 	
			'password'         => 'required|min:5',
			'password_confirm' => 'required|same:password'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			$messages = $validator->messages();
			
			return Redirect::to('/zarejestruj')->withErrors($validator)->with('alert', array('type' => 'error', 'content' => 'Błąd! Sprawdź wszystkie pola.'));

		} else {

			$user = new User;
			$user->email    = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->level = 1;

			$user->save();

			Auth::loginUsingId($user->id);

			if(Input::has('redirect')) {
				return Redirect::to(Input::get('redirect'))->with('alert', array('type' => 'success', 'content' => 'Witamy! Zostałeś pomyślnie zarejestrowany i zalogowany.'));
			}
			else {
				return Redirect::to('/')->with('alert', array('type' => 'success', 'content' => 'Witamy! Zostałeś pomyślnie zarejestrowany i zalogowany.'));
			}

		}

	}

	/**
	 * Display the specified resource.
	 * GET /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /user/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}