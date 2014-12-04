<?php

class BoardsController extends \BaseController {

	protected $layout = 'boards.master';
	
	public function __construct() {
		parent::__construct();
	}

	public function showBoard($query, $id = NULL, $presentation = NULL)
	{	
		Asset::add('//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.0.0/isotope.pkgd.min.js', 'footer');	
		Asset::add('//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.0.4/jquery.imagesloaded.min.js', 'footer');
		Asset::add('/js/libs/jquery.dropdown.js', 'footer');
	
		//Asset::add('/js/posts.js', 'footer');
		Asset::add('/js/posts-new.js', 'footer');
		//check if board exists

		if(isset($id)) {
			$board = Board::find($id);

			if(!is_null($board)) {
				if(($board->hashtag != $query) || ($board->config()->first()->user_id == 0) ) {
					App::abort(404);
				}
			}
			else {
				App::abort(404);
			}
		}
		else {		
			$board = Board::where('hashtag', '=', $query)->whereHas('config', function($q)
			{
			    $q->where('user_id', '=', 0 );

			})->first();

			if(is_null($board)) {
				$board = Board::create(array('hashtag' => $query ));
				$config = BoardConfig::create(array('board_id' => $board->id ));
			}
		}


		if($board->config()->first()->is_active == 1) {
			if(!is_null($board->cover_file_name)) {
				$data['layout'] = $this->layout->cover = 'with-cover';
			}
			else {
				$data['layout'] = $this->layout->cover = 'no-cover';
			}

			if(Auth::check()) {
				$user = Auth::user();
				$data['username'] = preg_replace('/@.*?$/', '', $user->email);
				$data['userBoards'] = Board::byUserId($user)->orderBy('created_at', 'asc')->get();
				$data['user'] = $user;

				if($user->id == $board->config()->first()->user_id) {
					$userOwned = true;
				}

				if(!is_null($user->provider()->first()) && ($user->provider()->first()->provider == 'facebook')) {
					$data['avatar'] = '<img src="http://graph.facebook.com/'.$user->provider()->first()->provider_id.'/picture?type=small" alt="avatar" />';
				}
			}

			if(Session::get('session-stat') != $board->id) {
				$stats = Stat::firstOrCreate(array('board_id' => $board->id))->increment('hits');
				Session::put('session-stat', $board->id);
			}
					
			$data['board'] = $board;
			$data['boardData'] = $this->layout->boardData = $board;
			$data['title'] = $this->layout->title = $board->hashtag;
			$data['bodyClass'] = $this->layout->bodyClass = $board->hashtag . (isset($userOwned) ? ' user-owned' : '');



			if(isset($presentation) && $presentation != 'live') {
				App::abort(404);
			}
			
			if(isset($id) && $presentation == 'live' && $board->config()->first()->presentation == 1) {
				$data['bodyClass'] = $this->layout->bodyClass = $board->hashtag . (isset($userOwned) ? ' user-owned' : ''). ' board-presentation';
				$this->layout->content = View::make('boards.board-presentation', $data);
			}
			else {
				$this->layout->content = View::make('boards.index', $data);
			}
			
		}
		else {
			App::abort(404);
		}
	}

}