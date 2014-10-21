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

Route::get('/pdf', function(){

	$data['user'] = User::find(11);
	$data['subscription'] = Subscription::find(10);
	$data['payment'] = Payment::find(34);

	//$pdf = PDF::loadView('docs.faktura', $data);

	return View::make('docs.faktura', $data);
	
	//return $pdf->stream();

});

Route::get('/', function(){

	dd(App::environment());

});

//sitewide
//Route::get('/', array('uses' =>'HomeController@showHome')); 
Route::get('/informacje', array('uses' =>'HomeController@showAboutUs')); 
Route::get('/faq', array('uses' =>'HomeController@showFaq')); 
Route::get('/kontakt', array('uses' =>'HomeController@showContact')); 
Route::get('/regulamin', array('uses' =>'HomeController@showLegal')); 
Route::get('/oferta', array('uses' =>'HomeController@showPricing')); 
Route::post('/contact/send', array('uses' =>'HomeController@postContactForm')); 
Route::get('/robots.txt', array('uses' => 'HomeController@generateRobots'));

// auth
Route::get('/konto/login/ustaw/{provider}', array('before' => 'auth', 'uses' =>'UserController@getUpdateProvider')); 
Route::get('/konto/login/usun/{provider}', array('before' => 'auth', 'uses' =>'UserController@getDeleteProvider')); 
Route::post('/auth/login/complete', array('uses' =>'UserController@postCompleteForm')); 
Route::get('/zarejestruj/dokoncz', array('as' => 'auth.complete', 'uses' =>'UserController@getCompleteForm')); 
Route::get('/pro/payment/update', array('before' => 'auth', 'uses' =>'UserController@postPaymentUpdateCard')); 
Route::post('/pro/subscription/delete', array('before' => 'auth', 'uses' =>'UserController@postSubscriptionDelete')); 
Route::post('/pro/subscription/downgrade', array('before' => 'auth', 'uses' =>'UserController@postSubscriptionDowngrade')); 
Route::get('/konto/pro/subskrypcja/rezygnuj', array('before' => 'auth', 'uses' =>'UserController@showSubscriptionDelete')); 
Route::post('/pro/subscription/update', array('before' => 'auth', 'uses' =>'UserController@postSubscriptionUpdate')); 
Route::get('/konto/pro/subskrypcja/edytuj', array('before' => 'auth', 'uses' =>'UserController@showSubscriptionUpdate')); 
Route::get('/konto/pro/subskrypcja', array('before' => 'auth', 'uses' =>'UserController@showSubscription')); 
Route::get('/pro/payment', array('before' => 'auth', 'uses' =>'UserController@postPayment')); 
Route::get('/konto/pro/platnosci', array('before' => 'auth', 'uses' =>'UserController@showProPayment')); 
Route::get('/konto/pro', array('before' => 'auth', 'uses' =>'UserController@showPro')); 
Route::get('/konto/tablica/{hashtag}/{id}/promowane', array('before' => 'auth', 'uses' =>'UserController@showBoardFeatured'));
Route::post('/password/reset/', array('before' => 'guest','uses' => 'RemindersController@postReset' ));
Route::get('/haslo/reset/{token}', array('before' => 'guest','uses' => 'RemindersController@getReset' ));
Route::post('/auth/password/remind', array('before' => 'guest','uses' => 'RemindersController@postRemind'));
Route::get('/niepamietam', array('before' => 'guest','uses' => 'RemindersController@getRemind' ));
Route::post('/board/change/status' , array('before' => 'auth', 'uses' => 'UserController@postChangeBoardStatus' ));
Route::post('/board/delete' , array('before' => 'auth', 'uses' => 'UserController@postDeleteBoard' ));
Route::post('/board/update', array('before' => 'auth', 'uses' =>'UserController@postUpdateBoard'));
Route::post('/board/add', array('before' => 'auth', 'uses' =>'UserController@postAddBoard')); 
Route::get('/konto/tablica/dodaj', array('before' => 'auth', 'uses' =>'UserController@showAddBoard')); 
Route::get('/konto/tablica/{hashtag}/{id}/ustawienia', array('before' => 'auth', 'uses' =>'UserController@showBoardSettings'));
Route::post('/auth/update/password', array('before' => 'auth', 'uses' => 'UserController@updatePassword'));
Route::post('/auth/update/email', array('before' => 'auth', 'uses' => 'UserController@updateEmail'));
Route::get('/konto', array('before' => 'auth', 'uses' =>'UserController@index')); 
Route::get('/konto/tablice', array('before' => 'auth', 'uses' =>'UserController@showBoards')); 
Route::get('/zarejestruj', array('before' => 'guest', 'uses' =>'HomeController@showSignUp')); 
Route::get('/zaloguj', array('before' => 'guest', 'uses' =>'HomeController@showLogin')); 
Route::post('/popup/login', array('uses' => 'AjaxController@showPopupLogin'));
Route::post('/popup/signup', array('before' => 'guest', 'uses' => 'AjaxController@showPopupSignUp'));
Route::post('/auth/signup', array('before' => 'guest','uses' => 'UserController@store'));
Route::post('/auth/login', array('uses' => 'UserController@login'));
Route::get('/wyloguj', function(){
	Session::flush();
	Auth::logout();
	return Redirect::to('/');
});


// boards
Route::post('/board/post/featured/remove', array('before' => 'auth', 'uses' => 'AjaxController@removeFeatured'));
Route::post('/board/post/featured', array('before' => 'auth', 'uses' => 'AjaxController@postFeatured'));
Route::post('/popup/share', array('uses' => 'AjaxController@showPopupShare'));
Route::post('/board/update/description' , array('uses' => 'AjaxController@postUpdateBoardDescription' ));
Route::get('/show/board/{id}', array('uses' =>'AjaxController@showBoard')); 
Route::post('/show/board/more/{id}', array('uses' =>'AjaxController@showBoardMore'));
Route::post('/show/board/new/{id}', array('uses' =>'AjaxController@showBoardNew'));
Route::get('{hashtag}/{id}/{presentation}', array('uses' =>'BoardsController@showBoard') ); 
Route::get('{query}/szukaj', array('uses' =>'BoardsController@showBoard') ); 
Route::get('{hashtag}/{id}', array('uses' =>'BoardsController@showBoard') ); 

Route::post('/szukaj', function() {
	$data = Input::get('query');
	if(strlen($data) > 2) {
		$data = explode(' ', trim($data) );
		$result = preg_replace('/#([\w-]+)/i', '$1', $data[0]);
		$query = Sanitize::string($result);
		return Redirect::to($query.'/szukaj');
	}
	else {
		return Redirect::back()->with('alert', array('type' => 'error', 'content' => 'Ten hasztag jest za krótki.'));
	}
	
}); 