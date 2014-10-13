<?php

class RemindersController extends BaseController {

	protected $layout = 'front.master';

	public function __construct() {
		parent::__construct();

		Asset::add('/js/libs/jquery.dropdown.js', 'footer');


	}

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('front.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{

		$rules = array(						
			'email'			=> 'exists:users|email',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			$messages = $validator->messages();
			return Redirect::to("/niepamietam")->withInput(Input::flash())->withErrors($validator)->with('alert', array('type' => 'error', 'content' => 'Błąd! Sprawdź wszystkie pola.'));
		}
		else {
	
			switch ($response = Password::remind(Input::only('email'), function($message){  $message->subject('[hasztag.info] Restuj hasło'); } ))
			{
				case Password::INVALID_USER:
					return Redirect::back()->with('alert', array('type' => 'error', 'content' => 'Błąd! E-mail nie został wysłany.'));

				case Password::REMINDER_SENT:
					return Redirect::to('/')->with('alert', array('type' => 'success', 'content' => 'E-mail został wysłany. Sprawdź skrzynkę!'));
			}
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('front.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('alert', array('type' => 'error', 'content' => 'Błąd! Sprawdź wszystkie pola.'));

			case Password::PASSWORD_RESET:
				return Redirect::to('/')->with('alert', array('type' => 'success', 'content' => 'Hasło zostało zmienione!'));;
		}
	}

}
