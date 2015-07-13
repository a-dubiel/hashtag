<?php
class AjaxController extends \Controller {
	
	public function removeFeatured() {

		$user = Auth::user();
		$board = Board::find(Input::get('board_id'));
		$postId = Input::get('post_id');

		if($user->id == $board->config()->first()->user_id) {
			$post = FeaturedPost::where('board_id', '=', $board->id)->where('post_id', '=', $postId);
			$post->delete();

			return Response::json('deleted');
		}

	}

	public function postFeatured() {
		
		$user = Auth::user();
		$board = Board::find(Input::get('board_id'));
		$postId = Input::get('post_id');

		if($user->id == $board->config()->first()->user_id) {

			if($user->level == 1) {
				$featured = FeaturedPost::where('user_id', '=', $user->id);

				if($featured->count() < 5) {

					$check = FeaturedPost::where('post_id', '=', $postId)->count();

					if($check == 0) {

						FeaturedPost::create(array(
							'board_id'	=> Input::get('board_id'),
							'post_id'	=> Input::get('post_id'),
							'user_id'	=> $user->id,
							'html'		=> Input::get('post')
						));

						return Response::json('created');


					}
					else {
						return Response::json('already added');
					}

				}
				else {
					return Response::json('max');
				}
			}
			else if($user->level == 2) {

				$featured = FeaturedPost::where('user_id', '=', $user->id);

				if($featured->count() < 100) {

					$check = FeaturedPost::where('post_id', '=', $postId)->count();

					if($check == 0) {

						FeaturedPost::create(array(
							'board_id'	=> Input::get('board_id'),
							'post_id'	=> Input::get('post_id'),
							'user_id'	=> $user->id,
							'html'		=> Input::get('post')
						));

						return Response::json('created');


					}
					else {
						return Response::json('already added');
					}

				}
				else {
					return Response::json('max');
				}

			}


		//	return Response::json($input);
		}
		else {
			App:abort(404);
		}

		
	}

	public function postUpdateBoardDescription() {
		
		$board = Board::find(Input::get('board_id'));
		$desc = Input::get('description');

		if(strlen($desc) < 50) {
			$board->description = Input::get('description');
			$board->save();

			return Response::json($desc);
		}		
	}

	public function show($id)
	{
		$board = Board::find($id);
		return Response::json(array('board' => $board, 'config' => $board->config()->first() ));
	}

	public function showPopupShare() {
		$data['url'] = Input::get('path');
	 	return View::make('front.share', $data);
	}

	public function showPopupSignUp() {
		$data['url'] = Input::get('path');
	 	return View::make('front.signup', $data);
	}

	public function showPopupLogin() {
		$data['url'] = Input::get('path');
	 	return View::make('front.login', $data);
	}

	public function filterWords($string, $wordsArray) {
		foreach ($wordsArray as $word) {
		    if (strpos(strtolower($string), strtolower(trim($word))) !== FALSE) { 
		        return true; 
		    }
		}

	}

	public function checkIfFeatured($featuredPosts, $id) {
		foreach ($featuredPosts->get() as $post) {
			if($id == $post['post_id']) {
				return true;
			}
		}
	}

	public static function sslInstagramProfilePic($url) {

		if( preg_match("/http:\/\/images.ak.instagram.com/", $url) ) {
			$result = preg_replace("/http:\/\/images.ak.instagram.com/", "//distillery.s3.amazonaws.com", $url);
		}
		else if( preg_match("/http:\/\/photos-[a-z].ak.instagram.com\/hphotos-ak-[0-9a-z]/", $url) ) {
			$result = preg_replace("/http:\/\/photos-[a-z].ak.instagram.com/", "//origincache-frc.fbcdn.net", $url);
		}
		else {
			$result = str_replace( 'http://', '//', $url );
		}

		return $result;
	}

	/**
def sslify_instagram_cdn_url(url):
    """Intercept IG CDN urls and serve using a SSL-friendly CDN instead"""
    replace_prefixes = (
        ('^http://images.ak.instagram.com(.*)$', '//distillery.s3.amazonaws.com%s'),
        ('^http://distilleryimage([0-9]*).ak.instagram.com(.*)$', '//distilleryimage%s.s3.amazonaws.com%s'),
        ('^http://origincache-([a-z]*).fbcdn.net(.*)$', '//origincache-%s.fbcdn.net%s'),
        ('^http://distilleryimage([0-9]*).s3.amazonaws.com(.*)$', '//distilleryimage%s.s3.amazonaws.com%s'),
        ('^http://scontent-([a-z]).cdninstagram.com(.*)$', '//scontent-%s.cdninstagram.com%s'),
        ('^http://photos-[a-z].ak.instagram.com/hphotos-ak-[0-9a-z]{3,4}/(.*)$', '//origincache-frc.fbcdn.net/%s'),
    )
    for prefix, replacement in replace_prefixes:
        results = re.findall(prefix, url)
        if not results:
            continue
        return replacement % results[0]
    return url


*/

	public function postsToHtml($posts, $boardId = NULL, $featured = NULL) {


		$html = '';
		$base = URL::to('/');

		if(isset($boardId)) {
			$config = BoardConfig::where('board_id', '=', $boardId)->first();

			if(Auth::check()) {
				$user = Auth::user();
				if($user->id == $config->user_id) {
					$owned = true;
				}
			}
			
			if($config->filter != '') {
				$filter = explode(',', $config->filter);
			}
			if($config->banned_users != '') {
				$users = explode(',', $config->banned_users);
			}
		

			$featuredPosts = FeaturedPost::where('board_id', '=', $config->board_id);
			
			if($featured == true && $featuredPosts->count() > 0) {
				$hasFeatured = true;
				foreach ($featuredPosts->get() as $post) {
					$html .= $post['html'];
				}
			}	
		}


		shuffle($posts);
		
		foreach($posts as $post) {
			
			if(strlen($post['username']) > 0 ) {
				
				if(isset($filter) && $filter != '' && !empty($post['caption'])) {
					if($this->filterWords($post['caption'], $filter)) {
						continue;
					}
				}
				if(isset($users) && $users != '') {
					if (in_array($post['username'], $users )) {
						continue;
					}
				}
				
				if(isset($featured) && $featuredPosts->count() > 0) {
					if($this->checkIfFeatured($featuredPosts, $post['post_id'])) {
						continue;
					}
				}
				

				$html .= '<div data-post-id="'.$post['post_id'].'" class="post post-'.$post['vendor'].' post-type-'.$post['post_type'].'">';
				$html .= '<div class="filter filter-'.$post['vendor'].' pull-right"><i class="fa fa-'.$post['vendor'].'"></i></div>';
				$html .= '<div class="user-info pull-left">';	
				if($post['vendor'] == 'instagram') {
					$profilePic = $this->sslInstagramProfilePic($post['user_img_url']);
					$html .= '<img src="'.$profilePic.'" alt="" />';
				}
				else {
					$html .= '<img src="'. str_replace( 'http://', '//', $post['user_img_url'] ).'" alt="" />';
				}
				if($post['vendor'] == 'twitter') {
					$html .= '<a href="http://www.twitter.com/'.$post['username'].'" target="_blank" rel="nofollow">'.$post['username'].'</a>';
					$post['date_created'] = Carbon::createFromFormat('m-d-y H:i:s', $post['date_created'])->toIso8601String();
				}
				else if($post['vendor'] == 'instagram') {
					$html .= '<a href="http://www.instagram.com/'.$post['username'].'" target="_blank" rel="nofollow">'.$post['username'].'</a>';
					$post['date_created'] = Carbon::createFromFormat('m-d-y H:i:s', $post['date_created'])->toIso8601String();
				}
				else if($post['vendor'] == 'google-plus') {
					$html .= '<a href="https://plus.google.com/'.$post['user_id'].'" target="_blank" rel="nofollow">'.$post['username'].'</a>';
					$post['date_created'] = Carbon::parse($post['date_created'])->toIso8601String();
				}
				else if($post['vendor'] == 'facebook') {
					$html .= '<a href="http://facebook.com/profile.php?id='.$post['user_id'].'" target="_blank" rel="nofollow">'.$post['username'].'</a>';
					$post['date_created'] = Carbon::parse($post['date_created'])->toIso8601String();
				}
				else if($post['vendor'] == 'vine') {
					$html .= '<a href="https://vine.co/u/'.$post['user_id'].'" target="_blank" rel="nofollow">'.$post['username'].'</a>';
					$post['date_created'] = Carbon::createFromFormat('Y-m-d H:i:s', $post['date_created'])->toIso8601String();
				}

		
				
				$html .= '<p><abbr class="timeago" title="'.$post['date_created'].'">'.$post['date_created'].'</abbr></p>';
				$html .= '</div><div class="clearfix"></div>';
				if($post['post_type'] == 'image') {

					$post['img_url'] = str_replace( 'http://', '//', $post['img_url'] );

					if($post['vendor'] == 'instagram') {
						$html .= '<a href="'.$post['img_url'].'" class="image-link">';
						$html .= '<div class="post-img">';
						$html .= '<img src="'.$post['img_url'].'" alt="" />';
						$html .= '</div>';
						$html .= '</a>';
					}
					else if($post['vendor'] == 'twitter') {
						$html .= '<a href="'.$post['img_url'].'" class="image-link">';
						$html .= '<div class="post-img">';
						$html .= '<img src="'.$post['img_url'].'" alt="" />';
						$html .= '</div>';
						$html .= '</a>';
					}
					else {
						$html .= '<a href="'.$post['img_url'].'" class="image-link">';
						$html .= '<div class="post-img">';
						$html .= '<img src="'.$post['img_url'].'" alt="" />';
						$html .= '</div>';
						$html .= '</a>';
					}
				}
				else if($post['post_type'] == 'video') {

					$post['embed'] = str_replace( 'http://', '//', $post['embed'] );
					$post['img_url'] = str_replace( 'http://', '//', $post['img_url'] );

					if($post['vendor'] == 'facebook') {
						$html .= '<a href="'.$post['embed'].'" target="_blank" class="video-link" rel="nofollow">';
						$html .= '<div class="post-img">';
						$html .= '<i class="fa fa-play"></i>';
						$html .= '<img src="'.$post['img_url'].'" alt="" />';
						$html .= '</div>';
						$html .= '</a>';
					}
					else if($post['vendor'] == 'instagram') {
						$html .= '<a href="'.$post['img_url'].'" target="_blank" data-video="'.$post['embed'].'" class="video-link-popup" rel="nofollow">';
						$html .= '<div class="post-img">';
						$html .= '<i class="fa fa-play"></i>';
						$html .= '<img src="'.$post['img_url'].'" alt="" />';
						$html .= '</div>';
						$html .= '</a>';
					}
					else if($post['vendor'] == 'google-plus') {
						$html .= '<a href="'.$post['embed'].'" target="_blank" class="video-link" rel="nofollow">';
						$html .= '<div class="post-img">';
						$html .= '<i class="fa fa-play"></i>';
						$html .= '<img src="'.$post['img_url'].'" alt="" />';
						$html .= '</div>';
						$html .= '</a>';
					}
					else if($post['vendor'] == 'vine') {
						$html .= '<a href="'.$post['img_url'].'" target="_blank" data-video="'.$post['embed'].'" class="video-link-popup" rel="nofollow">';
						$html .= '<div class="post-img">';
						$html .= '<i class="fa fa-play"></i>';
						$html .= '<img src="'.$post['img_url'].'" alt="" />';
						$html .= '</div>';
						$html .= '</a>';
					}
					else {
						$html .= '<div class="post-img">';
						$html .= '<img src="'.$post['img_url'].'" alt="" />';
						$html .= '</div>';
					}
					
				}


				if(!empty($post['caption'])){
					$caption = preg_replace('/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', '', $post['caption']);
					$caption = $this->removeEmoji($caption);

					$html .= '<div class="post-description">';
					$html .= '<p>'.preg_replace('/#([^\s#]+)/', ' <a class="hashtag" href="'.$base.'/$1/szukaj">#$1</a>', $caption ).'</p>';
					$html .= '</div>';	
				}
				if(isset($owned) && $owned == true) {
					$html .= '<div class="featured-post"><a data-post-id="'.$post['post_id'].'" href="#" class="js-make-featured"><i class="fa fa-star"></i></a></div>';
				}
				$html .= '</div>';
			}

		}

			return $html;
	}




	public static function removeEmoji($text) {

	    $clean_text = "";

	    // Match Emoticons
	    $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
	    $clean_text = preg_replace($regexEmoticons, '', $text);

	    // Match Miscellaneous Symbols and Pictographs
	    $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
	    $clean_text = preg_replace($regexSymbols, '', $clean_text);

	    // Match Transport And Map Symbols
	    $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
	    $clean_text = preg_replace($regexTransport, '', $clean_text);

	    // Match Miscellaneous Symbols
	    $regexMisc = '/[\x{2600}-\x{26FF}]/u';
	    $clean_text = preg_replace($regexMisc, '', $clean_text);

	    // Match Dingbats
	    $regexDingbats = '/[\x{2700}-\x{27BF}]/u';
	    $clean_text = preg_replace($regexDingbats, '', $clean_text);

	    return $clean_text;
	}


	public function showBoardNew($id) {
		
		$endpoints = Input::get('endpoints');
		$posts = array();
		$client = new \GuzzleHttp\Client;
		$count = 0;
		$board = Board::find($id);
		$hashtag = $board->hashtag;
		$config = $board->config()->first();
		$instagramKey = Config::get('laravel-social::providers.instagram.client_id');
		$googleKey = 'AIzaSyDiywW3UvpbQ5aR7f_8tLVgNCzui7Gq6ek';
		$postCount = 10;
		$googleToken = $endpoints['google_token'];
		$instagramNextMaxId = $endpoints['instagram_max_id'];
		$instagramMinTagId = $endpoints['instagram_min_tag'];
		$twitterMaxId = $endpoints['twitter_max_id'];
		$twitterSinceId = $endpoints['twitter_since_id'];
		$facebookSinceId = $endpoints['facebook_since_id'];
		$facebookUntilId = $endpoints['facebook_until_id'];
		$vineSinceId = $endpoints['vine_since_id'];
		$googleSinceId = $endpoints['google_since_id'];


		if($config->has_vine != -1) {

			$vine = $client->get('https://api.vineapp.com/timelines/tags/'.$hashtag.'?limit=5');
			$vineCount = 0;
			$first = true;


			if($vine->getStatusCode() == 200 ) {
				$data = $vine->json();

				if ($data['data']['count'] !== 0) {
					foreach($data['data']['records'] as $item) {

						if($first) {
							if($vineSinceId != $item['postId']) {
								$vineSinceId = $item['postId'].'';
								$first = false;
								$post['vendor'] = 'vine';
						    	$post['post_id'] = $item['postId'];
						    	$post['user_id'] = $item['userId'];
								$post['username'] = $item['username'];
								$post['date_created'] = Carbon::parse( $item['created'])->addHours(2);
								$post['user_img_url'] = $item['avatarUrl'];
								$post['img_url'] = $item['thumbnailUrl'];
								$post['post_type'] = 'video';
								$post['url'] = $item['permalinkUrl'];
								$post['embed'] = $item['videoLowURL'];
								$post['caption'] = $item['description'];



								array_push($posts, $post);
								$count++;
								break;
						}
						$first = false;

					}
						
					}
				}
			}
		}
	

		if($config->has_insta != -1) {

			if(Auth::check()) {
				$user = Auth::user();
				$provider = SocialProvider::where('user_id','=',$user->id)->where('provider', '=', 'instagram')->first();

				if(is_null($provider)) {
					$instagram = $client->get('https://api.instagram.com/v1/tags/'.$hashtag.'/media/recent?count='.$postCount.'&client_id='.$instagramKey.'&min_tag_id='.$instagramMinTagId);
				}
				else {
					$token = $provider->access_token;
					$instagram = $client->get('https://api.instagram.com/v1/tags/'.$hashtag.'/media/recent?count='.$postCount.'&access_token='.$token.'&min_tag_id='.$instagramMinTagId);
				}	
			}
			else {
				$provider = SocialProvider::where('user_id','=',$config->user_id)->where('provider', '=', 'instagram')->first();
				if(is_null($provider)) {
					$instagram = $client->get('https://api.instagram.com/v1/tags/'.$hashtag.'/media/recent?count='.$postCount.'&client_id='.$instagramKey.'&min_tag_id='.$instagramMinTagId);
				}
				else {
					$token = $provider->access_token;
					$instagram = $client->get('https://api.instagram.com/v1/tags/'.$hashtag.'/media/recent?count='.$postCount.'&access_token='.$token.'&min_tag_id='.$instagramMinTagId);
				}	
			}

			
			if($instagram->getStatusCode() == 200 ) {
				$instagramData = $instagram->json();
				
				foreach($instagramData['data'] as $data) {
					if (strpos($data['caption']['text'],$hashtag) !== false) {
						$post['user_id'] = $data['caption']['from']['id'];
						$post['username'] = $data['caption']['from']['username'];
						$post['url'] = $data['link'];
						$str = $data['caption']['text'];
						$str = preg_replace('/@([\w-]+)/i', '', $str); // #@
						$post['caption'] = $str;  
						$post['post_id'] =  $data['id'];
						$post['vendor'] =  'instagram';
						$post['user_img_url'] = $data['caption']['from']['profile_picture'];	
						$post['date_created'] = date("m-d-y H:i:s",$data['created_time']);
						
						if(isset($data['images']) && !isset($data['videos'])) {
							$post['img_url'] = $data['images']['standard_resolution']['url'];
							$post['post_type'] = 'image';
						}
						else if(isset($data['videos'])) {
						//	dd($data['videos']);
							$post['img_url'] = $data['images']['standard_resolution']['url'];
							$post['embed'] = $data['videos']['standard_resolution']['url'];
							$post['post_type'] = 'video';
						}
						array_push($posts, $post);
						$count++;
					}
				}
				
				if(isset($instagramData['pagination']['next_max_id'])) {
					$instagramNextMaxId = $instagramData['pagination']['next_max_id'];
				}

				if(isset($instagramData['pagination']['min_tag_id'])) {
					$instagramMinTagId = $instagramData['pagination']['min_tag_id'];
				}

			}
			
		}

		if($config->has_tw != -1) {
			
			$first = true;
			$twitter = Twitter::getSearch(array('q' => '#'.$hashtag , 'include_entities' => 1, 'result_type' => 'recent', 'count' => $postCount, 'since_id' => $twitterSinceId ));

			if($twitter) {

			foreach($twitter->statuses as $tweet) {
				if(substr($tweet->text, 0, 2 ) !== "RT"){

					if($first) {	
						$twitterSinceId = $tweet->id.'';
						$first = false;
					}
					
					$post['vendor'] = 'twitter';
			    	$post['post_id'] = $tweet->id;
			    	$post['user_id'] = $tweet->user->id;
					$post['username'] = $tweet->user->screen_name;
					$post['user_img_url'] = $tweet->user->profile_image_url;
					
					if(isset($tweet->entities->media)) {		
						$post['img_url'] = $tweet->entities->media[0]->media_url;
						$post['post_type'] = 'image';
					}
					else {
						$post['post_type'] = 'text';
					}
					$str = $tweet->text;
					$str = preg_replace('/@([\w-]+)/i', '', $str);
					$post['caption'] = $str;
					$post['date_created'] = date("m-d-y H:i:s",strtotime($tweet->created_at));
					array_push($posts, $post);
					$count++;
					

				}
			}

				if(isset($twitter->search_metadata->next_results)) {
					$next = $twitter->search_metadata->next_results;
					parse_str($next, $arr);
					$twitterMaxId = $arr['?max_id'];		
				}
				else {
					$twitterMaxId = '';
				}
			}

		}

		if($config->has_fb == 999) {
			$facebook = Facebook::api('/search?type=post&limit='.$postCount.'&q=%23'.$hashtag.'&since='.$facebookSinceId);

			if($facebook) {
				
				foreach($facebook['data'] as $post) {

					$post['vendor'] = 'facebook';
			    	$post['post_id'] = $post['id'];
			    	//$post['url'] = $post['link'];
			    	$post['user_id'] = $post['from']['id'];
					$post['username'] = $post['from']['name'];
					$post['user_img_url'] = 'https://graph.facebook.com/'.$post['from']['id'].'/picture?type=small';
					if($post['type'] == 'photo') {		
						$post['img_url'] = $post['picture'];
						$post['post_type'] = 'image';
					}
					else if($post['type'] == 'video' && isset($post['picture'])) {
						$post['post_type'] = 'video';
						$post['img_url'] = $post['picture'];
						$post['embed'] = $post['link'];
					}
					else {
						$post['post_type'] = 'text';
					}
					if(isset($post['message'])) {		
						$post['caption'] = $post['message'];
					}
				
					$post['date_created'] = $post['created_time'];
					array_push($posts, $post);
					$count++;

				}

				if(isset($facebook['paging'])) {
					if(isset($facebook['paging']['previous'])) {
						$prev = $facebook['paging']['previous'];
						parse_str($prev, $arr);
						$facebookSinceId = $arr['since'];
					}
					if(isset($facebook['paging']['next'])) {
						$next = $facebook['paging']['next'];
						parse_str($next, $arr);
						$facebookUntilId = $arr['until'];
					}
					
				}


			}

		}




		if($count > 0) {
			

			$html = $this->postsToHtml($posts, $board->id);

		
			return Response::json(
				array(
					'posts' => $html,
					'endpoints' => array(
						'google_token' => $googleToken,
						'google_since_id' => $googleSinceId,
						'twitter_max_id' => $twitterMaxId,
						'twitter_since_id' => $twitterSinceId,
						'instagram_max_id' => $instagramNextMaxId,
						'instagram_min_tag' => $instagramMinTagId,
						'facebook_until_id' => $facebookUntilId,
						'facebook_since_id' => $facebookSinceId,
						'vine_since_id' => $vineSinceId
					),
					'count' => $count
				)
			);
		}
		else {
			return Response::json(array('message' => 'No posts'));
		}


	}

	public function showBoardMore($id) {
		
		$endpoints = Input::get('endpoints');
		$posts = array();
		$client = new \GuzzleHttp\Client;
		$count = 0;
		$board = Board::find($id);
		$hashtag = $board->hashtag;
		$config = $board->config()->first();
		$instagramKey = Config::get('laravel-social::providers.instagram.client_id');
		$googleKey = 'AIzaSyDiywW3UvpbQ5aR7f_8tLVgNCzui7Gq6ek';
		$postCount = 10;
		$googleToken = $endpoints['google_token'];
		$instagramNextMaxId = $endpoints['instagram_max_id'];
		$instagramMinTagId = $endpoints['instagram_min_tag'];
		$twitterMaxId = $endpoints['twitter_max_id'];
		$twitterSinceId = $endpoints['twitter_since_id'];
		$facebookSinceId = $endpoints['facebook_since_id'];
		$facebookUntilId = $endpoints['facebook_until_id'];
		$googleSinceId = $endpoints['facebook_until_id'];

		
		

		if($config->has_insta != -1) {
			if(!empty($instagramNextMaxId)) {

				if(Auth::check()) {
					$user = Auth::user();
					$provider = SocialProvider::where('user_id','=',$user->id)->where('provider', '=', 'instagram')->first();

					if(is_null($provider)) {
						$instagram = $client->get('https://api.instagram.com/v1/tags/'.$hashtag.'/media/recent?count='.$postCount.'&client_id='.$instagramKey.'&max_tag_id='.$instagramNextMaxId);
					}
					else {
						$token = $provider->access_token;
						$instagram = $client->get('https://api.instagram.com/v1/tags/'.$hashtag.'/media/recent?count='.$postCount.'&access_token='.$token.'&max_tag_id='.$instagramNextMaxId);
					}	
				}
				else {
					$provider = SocialProvider::where('user_id','=',$config->user_id)->where('provider', '=', 'instagram')->first();

					if(is_null($provider)) {
						$instagram = $client->get('https://api.instagram.com/v1/tags/'.$hashtag.'/media/recent?count='.$postCount.'&client_id='.$instagramKey.'&max_tag_id='.$instagramNextMaxId);
					}
					else {
						$token = $provider->access_token;
						$instagram = $client->get('https://api.instagram.com/v1/tags/'.$hashtag.'/media/recent?count='.$postCount.'&access_token='.$token.'&max_tag_id='.$instagramNextMaxId);
					}	
				}

				
				if($instagram->getStatusCode() == 200) {
					$instagramData = $instagram->json();
				
					foreach($instagramData['data'] as $data) {
						if (strpos($data['caption']['text'],$hashtag) !== false) {
							$post['user_id'] = $data['caption']['from']['id'];
							$post['username'] = $data['caption']['from']['username'];
							$post['url'] = $data['link'];
							$str = $data['caption']['text'];
							$str = preg_replace('/@([\w-]+)/i', '', $str); // #@
							$post['caption'] = $str;  
							$post['post_id'] =  $data['id'];
							$post['vendor'] =  'instagram';
							$post['user_img_url'] = $data['caption']['from']['profile_picture'];	
							$post['date_created'] = date("m-d-y H:i:s",$data['created_time']);
							
							if(isset($data['images']) && !isset($data['videos'])) {
								$post['img_url'] = $data['images']['standard_resolution']['url'];
								$post['post_type'] = 'image';
							}
							else if(isset($data['videos'])) {
							//	dd($data['videos']);
								$post['img_url'] = $data['images']['standard_resolution']['url'];
								$post['embed'] = $data['videos']['standard_resolution']['url'];
								$post['post_type'] = 'video';
							}
							array_push($posts, $post);
							$count++;
						}
					}
					
					if(isset($instagramData['pagination']['next_max_id'])) {
						$instagramNextMaxId = $instagramData['pagination']['next_max_id'];
					}

					if(isset($instagramData['pagination']['min_tag_id'])) {
						$instagramMinTagId = $instagramData['pagination']['min_tag_id'];
					}

				}

			}
			
		}

		if($config->has_tw != -1) {


			$first = true;
			$twitter = Twitter::getSearch(array('q' => '#'.$hashtag , 'include_entities' => 1, 'result_type' => 'recent', 'count' => $postCount, 'max_id' => $twitterMaxId ));

			if($twitter) {

			foreach($twitter->statuses as $tweet) {
				if(substr($tweet->text, 0, 2 ) !== "RT"){

					if($first) {
						$twitterSinceId = $tweet->id.'';
						$first = false;
					}
					
					$post['vendor'] = 'twitter';
			    	$post['post_id'] = $tweet->id;
			    	$post['user_id'] = $tweet->user->id;
					$post['username'] = $tweet->user->screen_name;
					$post['user_img_url'] = $tweet->user->profile_image_url;
					
					if(isset($tweet->entities->media)) {		
						$post['img_url'] = $tweet->entities->media[0]->media_url;
						$post['post_type'] = 'image';
					}
					else {
						$post['post_type'] = 'text';
					}
					$str = $tweet->text;
					$str = preg_replace('/@([\w-]+)/i', '', $str);
					$post['caption'] = $str;
					$post['date_created'] = date("m-d-y H:i:s",strtotime($tweet->created_at));
					array_push($posts, $post);
					$count++;
				}
			}

				if(isset($twitter->search_metadata->next_results)) {
					$next = $twitter->search_metadata->next_results;
					parse_str($next, $arr);
					$twitterMaxId = $arr['?max_id'];		
				}
				else {
					$twitterMaxId = '';
				}

			}

		}

		if($config->has_google != -1) {



			$google = $client->get('https://www.googleapis.com/plus/v1/activities?maxResults=2&query='.$hashtag.'&key='.$googleKey.'&pageToken='.$googleToken);
			$first = true;
			
			if($google->getStatusCode() == 200 ) {
				$data = $google->json();

				foreach($data['items'] as $item) {	

					if($first) {
						$googleSinceId = $item['id'].'';
						$first = false;
					}					
					
					$post['vendor'] = 'google-plus';
			    	$post['post_id'] = $item['id'];
			    	$post['user_id'] = $item['actor']['id'];
					$post['username'] = $item['actor']['displayName'];
					$post['date_created'] = $item['published'];
					$post['user_img_url'] = $item['actor']['image']['url'];
					$post['post_type'] = 'text';

					if(isset($item['object']['attachments'][0]['objectType'])) {

						if($item['object']['attachments'][0]['objectType'] == 'photo') {
							$post['img_url'] = $item['object']['attachments'][0]['fullImage']['url'];
							$post['post_type'] = 'image';
						}
						if($item['object']['attachments'][0]['objectType'] == 'video') {
							$post['img_url'] = $item['object']['attachments'][0]['image']['url'];
							$post['post_type'] = 'video';
							$post['embed'] = $item['object']['attachments'][0]['url'];
						}
						if($item['object']['attachments'][0]['objectType'] == 'article') {
							if(isset($item['object']['attachments'][0]['fullImage']['url'])) {
								$post['img_url'] = $item['object']['attachments'][0]['fullImage']['url'];
							}					
							$post['post_type'] = 'article';
							$post['article_url'] = $item['object']['attachments'][0]['url'];
						}
					}
					else {
						$post['post_type'] = 'text';
					}

					$post['caption'] = $item['title'];
					$post['url'] = $item['url'];
					array_push($posts, $post);
					$count++;
					
					
				}
			
			if(isset($data['nextPageToken'])) {
				$googleToken = $data['nextPageToken'];
			}
			
			

			}

		}

		if($config->has_fb == 999) {
			$facebook = Facebook::api('/search?type=post&limit='.$postCount.'&q=%23'.$hashtag.'&until='.$facebookUntilId);

			if($facebook) {
				
				foreach($facebook['data'] as $post) {

					$post['vendor'] = 'facebook';
			    	$post['post_id'] = $post['id'];
			    	//$post['url'] = $post['link'];
			    	$post['user_id'] = $post['from']['id'];
					$post['username'] = $post['from']['name'];
					$post['user_img_url'] = 'https://graph.facebook.com/'.$post['from']['id'].'/picture?type=small';
					if($post['type'] == 'photo') {		
						$post['img_url'] = $post['picture'];
						$post['post_type'] = 'image';
					}
					else if($post['type'] == 'video' && isset($post['picture'])) {
						$post['post_type'] = 'video';
						$post['img_url'] = $post['picture'];
						$post['embed'] = $post['link'];
					}
					else {
						$post['post_type'] = 'text';
					}
					if(isset($post['message'])) {		
						$post['caption'] = $post['message'];
					}
				
					$post['date_created'] = $post['created_time'];
					array_push($posts, $post);
					$count++;

				}

				if(isset($facebook['paging'])) {
					if(isset($facebook['paging']['previous'])) {
						$prev = $facebook['paging']['previous'];
						parse_str($prev, $arr);
						$facebookSinceId = $arr['since'];
					}
					if(isset($facebook['paging']['next'])) {
						$next = $facebook['paging']['next'];
						parse_str($next, $arr);
						$facebookUntilId = $arr['until'];
					}
					
				}


			}

		}


		//all done
		if($count > 0) {

			$html = $this->postsToHtml($posts, $board->id, false);

			return Response::json(
				array(
					'posts' => $html,
					'endpoints' => array(
						'google_token' => $googleToken,
						'twitter_max_id' => $twitterMaxId,
						'twitter_since_id' => $twitterSinceId,
						'instagram_max_id' => $instagramNextMaxId,
						'instagram_min_tag' => $instagramMinTagId,
						'facebook_until_id' => $facebookUntilId,
						'facebook_since_id' => $facebookSinceId
					),
					'count' => $count
				)
			);
		}
		else {
			return Response::json(array('message' => 'No posts'));
		}



	}

	public function showBoard($id) {

		$posts = array();
		$client = new \GuzzleHttp\Client;
		$count = 0;
		$board = Board::find($id);
		$hashtag = $board->hashtag;
		$config = $board->config()->first();
		$instagramKey = Config::get('laravel-social::providers.instagram.client_id');
		$googleKey = 'AIzaSyDiywW3UvpbQ5aR7f_8tLVgNCzui7Gq6ek';
		$postCount = 20;
		$googleToken = '';
		$instagramNextMaxId = '';
		$instagramMinTagId = '';
		$twitterMaxId = '';
		$twitterSinceId = '';
		$facebookSinceId = '';
		$facebookUntilId = '';
		$vineSinceId = '';
		$googleSinceId = '';

		if($config->has_insta != -1) {

			if(Auth::check()) {
				$user = Auth::user();
				$provider = SocialProvider::where('user_id','=',$user->id)->where('provider', '=', 'instagram')->first();

				if(is_null($provider)) {
					$instagram = $client->get('https://api.instagram.com/v1/tags/'.$hashtag.'/media/recent?count='.$postCount.'&client_id='.$instagramKey);
				}
				else {
					$token = $provider->access_token;
					$instagram = $client->get('https://api.instagram.com/v1/tags/'.$hashtag.'/media/recent?count='.$postCount.'&access_token='.$token);
				}	
			}
			else {
				$provider = SocialProvider::where('user_id','=',$config->user_id)->where('provider', '=', 'instagram')->first();

				if(is_null($provider)) {
					$instagram = $client->get('https://api.instagram.com/v1/tags/'.$hashtag.'/media/recent?count='.$postCount.'&client_id='.$instagramKey);
				}
				else {
					$token = $provider->access_token;
					$instagram = $client->get('https://api.instagram.com/v1/tags/'.$hashtag.'/media/recent?count='.$postCount.'&access_token='.$token);
				}	
			}

			if($instagram->getStatusCode() == 200 ) {
				$instagramData = $instagram->json();

				foreach($instagramData['data'] as $data) {
					if (strpos($data['caption']['text'],$hashtag) !== false) {
						$post['user_id'] = $data['caption']['from']['id'];
						$post['username'] = $data['caption']['from']['username'];
						$post['url'] = $data['link'];
						$str = $data['caption']['text'];
						$str = preg_replace('/@([\w-]+)/i', '', $str); // #@
						$post['caption'] = $str;  
						$post['post_id'] =  $data['id'];
						$post['vendor'] =  'instagram';
						$post['user_img_url'] = $data['caption']['from']['profile_picture'];	
						$post['date_created'] = date("m-d-y H:i:s",$data['created_time']);
						
						if(isset($data['images']) && !isset($data['videos'])) {
							$post['img_url'] = $data['images']['standard_resolution']['url'];
							$post['post_type'] = 'image';
						}
						else if(isset($data['videos'])) {
						//	dd($data['videos']);
							$post['img_url'] = $data['images']['standard_resolution']['url'];
							$post['embed'] = $data['videos']['standard_resolution']['url'];
							$post['post_type'] = 'video';
						}
						array_push($posts, $post);
						$count++;
					}
				}
				
				if(isset($instagramData['pagination']['next_max_id'])) {
					$instagramNextMaxId = $instagramData['pagination']['next_max_id'];
				}

				if(isset($instagramData['pagination']['min_tag_id'])) {
					$instagramMinTagId = $instagramData['pagination']['min_tag_id'];
				}

			}
			
		}

		if($config->has_fb == 9999) {
			$facebook = Facebook::api('/search?type=post&limit='.$postCount.'&q=%23'.$hashtag);

			if($facebook) {
				
				foreach($facebook['data'] as $post) {

					$post['vendor'] = 'facebook';
			    	$post['post_id'] = $post['id'];
			    	//$post['url'] = $post['link'];
			    	$post['user_id'] = $post['from']['id'];
					$post['username'] = $post['from']['name'];
					$post['user_img_url'] = 'https://graph.facebook.com/'.$post['from']['id'].'/picture?type=small';
					if($post['type'] == 'photo') {		
						$post['img_url'] = $post['picture'];
						$post['post_type'] = 'image';
					}
					else if($post['type'] == 'video' && isset($post['picture'])) {
						$post['post_type'] = 'video';
						$post['img_url'] = $post['picture'];
						$post['embed'] = $post['link'];
					}
					else {
						$post['post_type'] = 'text';
					}
					if(isset($post['message'])) {		
						$post['caption'] = $post['message'];
					}
				
					$post['date_created'] = $post['created_time'];
					array_push($posts, $post);
					$count++;

				}

				if(isset($facebook['paging'])) {
					if(isset($facebook['paging']['previous'])) {
						$prev = $facebook['paging']['previous'];
						parse_str($prev, $arr);
						$facebookSinceId = $arr['since'];
					}
					if(isset($facebook['paging']['next'])) {
						$next = $facebook['paging']['next'];
						parse_str($next, $arr);
						$facebookUntilId = $arr['until'];
					}
					
				}


			}

		}

		if($config->has_tw != -1) {


			$first = true;
			$twitter = Twitter::getSearch(array('q' => '#'.$hashtag , 'include_entities' => 1, 'result_type' => 'recent', 'count' => $postCount ));

			if($twitter) {

			foreach($twitter->statuses as $tweet) {
				if(substr($tweet->text, 0, 2 ) !== "RT"){

					if($first) {
						$twitterSinceId = $tweet->id .'';
						$first = false;
					}
					
					$post['vendor'] = 'twitter';
			    	$post['post_id'] = $tweet->id;
			    	$post['user_id'] = $tweet->user->id;
					$post['username'] = $tweet->user->screen_name;
					$post['user_img_url'] = $tweet->user->profile_image_url;
					
					if(isset($tweet->entities->media)) {		
						$post['img_url'] = $tweet->entities->media[0]->media_url;
						$post['post_type'] = 'image';
					}
					else {
						$post['post_type'] = 'text';
					}
					$str = $tweet->text;
					$str = preg_replace('/@([\w-]+)/i', '', $str);
					$post['caption'] = $str;
					$post['date_created'] = date("m-d-y H:i:s",strtotime($tweet->created_at));
					array_push($posts, $post);
					$count++;
				}
			}


				if(isset($twitter->search_metadata->next_results)) {
					$next = $twitter->search_metadata->next_results;
					parse_str($next, $arr);
					$twitterMaxId = $arr['?max_id'];		
				}
				else {
					$twitterMaxId = '';

				}

			}

		}

		

		if($config->has_google != -1) {

			$first = true;
			$google = $client->get('https://www.googleapis.com/plus/v1/activities?maxResults=2&query='.$hashtag.'&key='.$googleKey);

			if($google->getStatusCode() == 200 ) {
				$data = $google->json();

				foreach($data['items'] as $item) {

					if($first) {
						$googleSinceId = $item['id'].'';
						$first = false;
					}					
					
					$post['vendor'] = 'google-plus';
			    	$post['post_id'] = $item['id'];
			    	$post['user_id'] = $item['actor']['id'];
					$post['username'] = $item['actor']['displayName'];
					$post['date_created'] = $item['published'];
					$post['user_img_url'] = $item['actor']['image']['url'];
					$post['post_type'] = 'text';

					if(isset($item['object']['attachments'][0]['objectType'])) {

						if($item['object']['attachments'][0]['objectType'] == 'photo') {
							$post['img_url'] = $item['object']['attachments'][0]['fullImage']['url'];
							$post['post_type'] = 'image';
						}
						if($item['object']['attachments'][0]['objectType'] == 'video') {
							$post['img_url'] = $item['object']['attachments'][0]['image']['url'];
							$post['post_type'] = 'video';
							$post['embed'] = $item['object']['attachments'][0]['url'];
						}
						if($item['object']['attachments'][0]['objectType'] == 'article') {
							if(isset($item['object']['attachments'][0]['fullImage']['url'])) {
								$post['img_url'] = $item['object']['attachments'][0]['fullImage']['url'];
							}					
							$post['post_type'] = 'article';
							$post['article_url'] = $item['object']['attachments'][0]['url'];
						}
					}
					else {
						$post['post_type'] = 'text';
					}

					$post['caption'] = $item['title'];
					$post['url'] = $item['url'];
					array_push($posts, $post);
					$count++;
					
					
				}
			
			if(isset($data['nextPageToken'])) {
				$googleToken = $data['nextPageToken'];
			}
			
			

			}

		}

		if($config->has_vine != -1) {
			$vine = $client->get('https://api.vineapp.com/timelines/tags/'.$hashtag.'?limit=5');
			$vineCount = 0;
			$first = true;

			if($vine->getStatusCode() == 200 ) {
				$data = $vine->json();
				
				if ($data['data']['count'] !== 0) {
					foreach($data['data']['records'] as $item) {

						if($first) {
							$vineSinceId = $item['postId'].'';
							$first = false;
						}
						
						$post['vendor'] = 'vine';
				    	$post['post_id'] = $item['postId'];
				    	$post['user_id'] = $item['userId'];
						$post['username'] = $item['username'];
						$post['date_created'] = Carbon::parse( $item['created'])->addHours(2);
						$post['user_img_url'] = $item['avatarUrl'];
						$post['img_url'] = $item['thumbnailUrl'];
						$post['post_type'] = 'video';
						$post['url'] = $item['permalinkUrl'];
						$post['embed'] = $item['videoLowURL'];
						$post['caption'] = $item['description'];

						array_push($posts, $post);
						$count++;
						$vineCount++;
						if($vineCount == $postCount) {
							break;
						}
						
					}
				}
			}

		}
		
		if($count > 0) {

			$html = $this->postsToHtml($posts, $board->id, true);
			
			
			return Response::json(
				array(
					'posts' => $html,
					'endpoints' => array(
						'google_token' => $googleToken,
						'google_since_id' => $googleSinceId,
						'twitter_max_id' => $twitterMaxId,
						'twitter_since_id' => $twitterSinceId,
						'instagram_max_id' => $instagramNextMaxId,
						'instagram_min_tag' => $instagramMinTagId,
						'facebook_until_id' => $facebookUntilId,
						'facebook_since_id' => $facebookSinceId,
						'vine_since_id' => $vineSinceId,
				
					),
					'count' => $count
				)
			);
		}
		else {
			return Response::json(array('message' => 'No posts'));
		}


	}

}