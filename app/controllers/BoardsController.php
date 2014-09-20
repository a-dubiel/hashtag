<?php

class BoardsController extends \BaseController {

	protected $layout = 'boards.master';
	
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get instagram posts
	 *
	 * @return Response
	 */
	public function showPublicBoard($query)
	{	
		Asset::add('//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.0.0/isotope.pkgd.min.js', 'footer');	
		Asset::add('//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.0.4/jquery.imagesloaded.min.js', 'footer');
		Asset::add('//cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.4.0/jquery.timeago.min.js', 'footer');
	
		Asset::add('/js/posts.js', 'footer');
		//check if board exists
		$board = DB::table('boards')->where('hashtag', '=',$query)->where('is_public', '=', 1)->first();

	
		
		
		if(!$board) {
			// the board does not exists, create a public one with default settings
			$newBoard = new Board;
			$newBoard->hashtag = $query;
			$newBoard->has_facebook = 1;
			$newBoard->refresh = 60;
			$newBoard->posts_per_page = 20;
			$newBoard->has_twitter = 1;
			$newBoard->has_instagram = 1;
			$newBoard->has_google = 1;
			$newBoard->has_flickr = 1;
			$newBoard->has_vine = 1;
			$newBoard->is_public = 1;
			$newBoard->is_active = 1;
			$newBoard->save();

			$board = Board::find($newBoard->id);
		}
		

		$data['board'] = $board;
		$data['title'] = $this->layout->title = $board->hashtag;
		$data['bodyClass'] = $this->layout->bodyClass = $board->hashtag;
		$this->layout->content = View::make('boards.index', $data);
	}
	/**
	 * Get instagram posts
	 *
	 * @return Response
	 */
	public function getInstagramPosts()
	{
		
	}

	/**
	 * Display a listing of the resource.
	 * GET /boards
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /boards/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /boards
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /boards/{id}
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
	 * GET /boards/{id}/edit
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
	 * PUT /boards/{id}
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
	 * DELETE /boards/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}