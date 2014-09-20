<?php

class AjaxController extends \Controller {



	/**
	 * Display a listing of the resource.
	 * GET /ajax
	 *
	 * @return Response
	 */
	public function index()
	{
		//

		
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /ajax/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /ajax
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /ajax/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($hashtag)
	{
		
		$board = DB::table('boards')->where('hashtag', '=' , $hashtag)->first();
		return Response::json($board);

	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /ajax/{id}/edit
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
	 * PUT /ajax/{id}
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
	 * DELETE /ajax/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function getInstagramPosts($hashtag) {
	
		$posts = array();

		$clientId = 'b13d92eda3a244e69daa44304a832de4';

 		$instagram = $this->file_get_contents_utf8('https://api.instagram.com/v1/tags/'.$hashtag.'/media/recent?client_id='.$clientId);
		$json = json_decode($instagram, true);

		$next = $json['pagination']['next_max_id'];
		
		foreach($json['data'] as $data) {

			$post['user_id'] = $data['caption']['from']['id'];
			$post['username'] = $data['caption']['from']['username'];
			$post['caption'] =  $data['caption']['text'];
			$post['post_id'] =  $data['id'];
			$post['vendor'] =  'instagram';
			$post['user_img_url'] = $data['caption']['from']['profile_picture'];

			
	
			$post['date_created'] = date("m-d-y H:i:s",$data['caption']['created_time']);
			

			if(isset($data['images']) && !isset($data['videos'])) {
				$post['img_url'] = $data['images']['standard_resolution']['url'];
				$post['post_type'] = 'image';
			}
			else if(isset($data['videos'])) {
				$post['img_url'] = $data['images']['standard_resolution']['url'];
				$post['video_url'] = $data['link'];
				$post['post_type'] = 'video';
			}

			array_push($posts, $post);
		}
		
		
		return Response::json(array('posts' => $posts, 'next_url' => $next));


	}

	public function getMoreInstagramPosts($hashtag,$id) {
	
		$posts = array();

		$clientId = 'b13d92eda3a244e69daa44304a832de4';

 		$instagram = $this->file_get_contents_utf8('https://api.instagram.com/v1/tags/'.$hashtag.'/media/recent?client_id='.$clientId.'&max_tag_id='.$id);
		$json = json_decode($instagram, true);

		$next = $json['pagination']['next_max_id'];
		
		foreach($json['data'] as $data) {

			$post['user_id'] = $data['caption']['from']['id'];
			$post['username'] = $data['caption']['from']['username'];
			$post['caption'] =  $data['caption']['text'];
			$post['post_id'] =  $data['id'];
			$post['vendor'] =  'instagram';
			$post['user_img_url'] = $data['caption']['from']['profile_picture'];
			$post['date_created'] = date('Y-m-d h:i:s',$data['caption']['created_time']);
			

			if(isset($data['images']) && !isset($data['videos'])) {
				$post['img_url'] = $data['images']['standard_resolution']['url'];
				$post['post_type'] = 'image';
			}
			else if(isset($data['videos'])) {
				$post['img_url'] = $data['images']['standard_resolution']['url'];
				$post['video_url'] = $data['link'];
				$post['post_type'] = 'video';
			}

			array_push($posts, $post);
		}
		
		
		return Response::json(array('posts' => $posts, 'next_url' => $next));


	}

	public function file_get_contents_utf8($fn) {
     $content = file_get_contents($fn);
      return mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
	}

}