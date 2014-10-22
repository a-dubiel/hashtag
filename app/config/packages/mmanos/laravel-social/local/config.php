<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Social Providers Controller Route
	|--------------------------------------------------------------------------
	|
	| Specify the route path to use for the SocialController.
	| Leave empty to disable the route.
	|
	*/

	'route' => 'auth/social',

	/*
	|--------------------------------------------------------------------------
	| Providers Table
	|--------------------------------------------------------------------------
	|
	| Specify the name of the database table to use for linked providers.
	|
	*/

	'table' => 'user_providers',

	/*
	|--------------------------------------------------------------------------
	| Providers
	|--------------------------------------------------------------------------
	|
	| Specify the oauth service provider information for each service provider
	| you want enabled, to be used by the PHPoAuthLib package.
	|
	*/

	'providers' => array(

		'facebook' => array(
			'client_id'       => '329145523803567',
			'client_secret'   => '0bafd00320742fc22c8e0a67158fb249',
			'scope'           => array('email'),
			'fetch_user_info' => function ($service) {
				$result = json_decode($service->request('/me'), true);
				return array(
					'id'         => array_get($result, 'id'),
					'email'      => array_get($result, 'email'),
					'first_name' => array_get($result, 'first_name'),
					'last_name'  => array_get($result, 'last_name'),
					'default_provider' => 'facebook',
				);
			},
		),

		'instagram' => array(
			'client_id'       => 'b13d92eda3a244e69daa44304a832de4',
			'client_secret'   => '46b2d03387034352bf6bea2e778b3d71',
			'scope'           => array('basic'),
			'fetch_user_info' => function ($service) {

				$result = json_decode($service->request('users/self'), true);

				return array(
					'id'         => $result['data']['id'],
					'email'      => '',
					'first_name' => array_get(explode(' ', $result['data']['full_name']), 0),
					'last_name'  => array_get(explode(' ', $result['data']['full_name']), 1),
					'default_provider' => 'instagram'
				);
			}
		),

		'twitter' => array(
			'client_id'       => 'JzvZArs0oaCmljOxpAOfgjMlF',
			'client_secret'   => 'XZSB4B6JNKADFD0QVkOwLccPF5Qque8tOaeGJKJnzJ6KtbbNxh',
			'scope'           => array(),
			'fetch_user_info' => function ($service) {
				$result = json_decode($service->request('account/verify_credentials.json'), true);
				return array(
					'id'         => array_get($result, 'id'),
					'email'      => null,
					'first_name' => array_get(explode(' ', array_get($result, 'name')), 0),
					'last_name'  => array_get(explode(' ', array_get($result, 'name')), 1),
					'profile_picture' => array_get($result, 'profile_image_url_https')
				);
			},
		), 

	),

	/*
	|--------------------------------------------------------------------------
	| New User Validation
	|--------------------------------------------------------------------------
	|
	| Define the validation rules to apply against new user data.
	| This may be an array of validation rules or a Closure which returns a
	| Validator instance.
	|
	*/

	'user_validation' => array(
		'email'      => 'email|required',
		'first_name' => 'required',
	),

	/*
	|--------------------------------------------------------------------------
	| Create User Callback
	|--------------------------------------------------------------------------
	|
	| Use the given data to create and return a new user's id.
	|
	*/

	'create_user' => function ($data) {
		
		$user = User::where('email', '=', array_get($data, 'email'))->first();

		if(is_null($user)) {
			$user = new User;
			$user->email = array_get($data, 'email');
			$user->password = Hash::make(Str::random());
			$user->first_name = array_get($data, 'first_name');
			$user->last_name = array_get($data, 'last_name');
			$user->level = 1;
			$user->default_provider = array_get($data, 'default_provider');
			$user->save();
		}
		else {
			$user->save();
		}
		
		
		return $user->id;
	},

	/*
	|--------------------------------------------------------------------------
	| New User Failed Validation Redirect
	|--------------------------------------------------------------------------
	|
	| Define the action to redirect to if/when a new user fails the validation
	| rules. Defaults to a built-in "complete" action. Override to further
	| customize how this flow is handled.
	|
	*/

	'user_failed_validation_redirect' => 'auth.complete',

	/*
	|--------------------------------------------------------------------------
	| Error Flash Variable Name
	|--------------------------------------------------------------------------
	|
	| Define the variable name to use when flashing an error to session before
	| redirecting after an error is encountered.
	|
	*/

	'error_flash_var' => 'error',

	/*
	|--------------------------------------------------------------------------
	| Success Flash Variable Name
	|--------------------------------------------------------------------------
	|
	| Define the variable name to use when flashing a success to session before
	| redirecting after a social provider account was successfully connected.
	|
	*/

	'success_flash_var' => 'success',

);
