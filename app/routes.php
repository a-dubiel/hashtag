<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' =>'HomeController@showHome')); 

Route::get('/board/{hashtag}', array('uses' =>'AjaxController@show')); 

Route::get('/api/instagram/{hashtag}', array('uses' =>'AjaxController@getInstagramPosts')); 
Route::get('/api/instagram/more/{hashtag}/{id}', array('uses' =>'AjaxController@getMoreInstagramPosts')); 

Route::get('{query}/szukaj', array('uses' =>'BoardsController@showPublicBoard') ); 

Route::post('/szukaj', function() {
	// get input, take the first word, if there is a hashtag remove it and sanitze it
	$data = Input::get('query');
	$data = explode(' ', trim($data) );
	$result = preg_replace('/#([\w-]+)/i', '$1', $data[0]);
	$query = Sanitize::string($result);

	return Redirect::to($query.'/szukaj');
}); 