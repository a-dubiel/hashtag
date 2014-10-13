<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds'

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';

// Events

Event::listen('invoice.email', function($userId, $subscriptionId, $paymentId, $faktura = false)
{
	$data['user'] = User::find($userId);
	$data['subscription'] = Subscription::find($subscriptionId);
	$data['payment'] = Payment::find($paymentId);
	$id = str_random(10);

	$name = $faktura ? 'faktura' : 'rachunek';
	$path = '/system/docs/'.$name.'-hasztaginfo-'.$id.'.pdf';
	$savepath = public_path().$path;
	$template = $faktura ? 'docs.faktura' : 'docs.invoice';
	$pdf = PDF::loadView($template, $data )->setWarnings(false)->save($savepath);

	$invoice = Invoice::create(array(
		'user_id' => $data['user']->id,
		'subscription_id' => $data['subscription']->id,
		'payment_id' => $data['payment']->id,
		'path' => $path,
		'token' => $id,
		'type' => $faktura ? 2 : 1
	));

	$payment = Payment::find($paymentId);
	$payment->invoice_id = $invoice->id;
	$payment->save();

	$email = $data['subscription']->email;
	$data = [ 'path' => $savepath, 'email' => $email];
					
	Mail::later(5, 'emails.invoice', $data , function($message) use ($savepath, $email)
	{
	    $message->to($email)->subject('Rachunek hasztag.info');
	    $message->attach($savepath);
	});
    
});

Event::listen('deactivate.subscription', function($subscriptionId, $paymentDate)
{
	$subscription = Subscription::find($subscriptionId);
	$subscription->is_active = 0;
	$subscription->save();

	$configs = BoardConfig::where('user_id', '=', $subscription->user_id)->get();

	if($configs->count() > 0) {
		foreach($configs as $config) {
			$config->is_active = 0;
			$config->save();
		}
	}

	$lastPayment = Carbon::createFromTimeStamp(strtotime($paymentDate));

	$notifications = EmailNotification::where('subscription_id', '=', $subscription->id );

	$email = $subscription->email;

	if($notifications->count() == 0) {
		
		EmailNotification::create(array('subscription_id' => $subscription->id,  'user_id' => $subscription->user_id));
		
		Mail::later(5, 'emails.warning', array() , function($message) use ($email)
		{
	    	$message->to($email)->subject('Problem!');
		});
	}
	else{
		$lastTry = $notifications->orderBy('id', 'desc')->first()->created_at;
		$diff = $lastTry->diffInDays($lastPayment);

		if($diff == 3) {

			EmailNotification::create(array('subscription_id' => $subscription->id,  'user_id' => $subscription->user_id));

			Mail::later(5, 'emails.warning', array() , function($message) use ($email)
			{
		    	$message->to($email)->subject('Problem!');
			});

		}

	}

});


Event::listen('activate.subscription', function($subscriptionId) {

	$subscription = Subscription::find($subscriptionId);
	$expiration = Carbon::createFromTimeStamp(strtotime($subscription->expires_at));
	$user = User::find($subscription->user_id);
	$client = new Paylane\PayLaneRestClient('adubiel', 'dru9pra2');

	if($expiration->isToday() || $expiration->isPast()) {

   	$sale = $subscription->payment()->orderBy('id', 'desc')->first();
   	
   	if($sale->is_success == 2 || $sale->is_success == 1) {

   		if($sale->is_success == 2) {

       		$resale_params = array(
			    'id_authorization' => $sale->sale_id,
			    'amount'      => 149.00,
			    'currency'    => 'PLN',
			    'description' => 'Subskrypcja Hasztag.info',
			);

       		$status = $client->resaleByAuthorization($resale_params);
       	}
       	else if($sale->is_success == 1) {
       		
       		$params = array(
			    'id_sale'     => $sale->sale_id,
			    'amount'      => 149.00,
			    'currency'    => 'PLN',
			    'description' => 'Subskrypcja Hasztag.info',
			);

       		$status = $client->resaleBySale($params);
       	}
	
		if ($client->isSuccess()) {

			$payment = Payment::create(array(
				'user_id' => $subscription->user_id,
				'subscription_id' => $subscription->id,
				'sale_id' => $status['id_sale']
			));

			$subscription->expires_at = Carbon::now()->addDays(30);
			$subscription->is_active = 1;
			$subscription->save();

			$user = User::find($subscription->user_id);
			$user->level = 2;
			$user->save();

			$configs = BoardConfig::where('user_id', '=', $subscription->user_id)->get();

			if($configs->count() > 0) {
				foreach($configs as $config) {
					$config->is_active = 1;
					$config->save();
				}
			}

			EmailNotification::where('subscription_id', '=', $subscription->id )->delete();

			$faktura = $subscription->company_id == 0 ? false : true;

			Event::fire('invoice.email', array($subscription->user_id, $subscription->id, $payment->id, $faktura));
   		}

   	}

   }
});


Event::listen('subscriptions.check', function(){

	Subscription::chunk(200, function($subscriptions)
	{


			$client = new Paylane\PayLaneRestClient('adubiel', 'dru9pra2');

		    foreach ($subscriptions as $subscription)
		    {
		        $expiration = Carbon::createFromTimeStamp(strtotime($subscription->expires_at));

		       	if($expiration->isToday() || $expiration->isPast()) {

			       	$sale = $subscription->payment()->orderBy('id', 'desc')->where('is_success', '=', 1)->orWhere('is_success', '=', 2)->first();
			       	
			       		if($sale->is_success == 2) {

				       		$resale_params = array(
							    'id_authorization' => $sale->sale_id,
							    'amount'      => 149.00,
							    'currency'    => 'PLN',
							    'description' => 'Subskrypcja Hasztag.info',
							);

				       		$status = $client->resaleByAuthorization($resale_params);
				       	}
				       	else if($sale->is_success == 1) {
				       		
				       		$params = array(
							    'id_sale'     => $sale->sale_id,
							    'amount'      => 149.00,
							    'currency'    => 'PLN',
							    'description' => 'Subskrypcja Hasztag.info',
							);

				       		$status = $client->resaleBySale($params);
				       	}
					
						if ($client->isSuccess()) {

							$payment = Payment::create(array(
								'user_id' => $subscription->user_id,
								'subscription_id' => $subscription->id,
								'sale_id' => $status['id_sale']
							));

							$subscription->expires_at = Carbon::now()->addDays(30);
							$subscription->is_active = 1;
							$subscription->save();

							$user = User::find($subscription->user_id);
							$user->level = 2;
							$user->save();

							$configs = BoardConfig::where('user_id', '=', $subscription->user_id)->get();

							if($configs->count() > 0) {
								foreach($configs as $config) {
									$config->is_active = 1;
									$config->save();
								}
							}

							EmailNotification::where('subscription_id', '=', $subscription->id )->delete();

							$faktura = $subscription->company_id == 0 ? false : true;

							Event::fire('invoice.email', array($subscription->user_id, $subscription->id, $payment->id, $faktura));
			       		}
			       		else {

			

			       			$payment = Payment::create(array(
								'user_id' => $subscription->user_id,
								'subscription_id' => $subscription->id,
								'is_success' => 0
							));

			       			Event::fire('deactivate.subscription', array($subscription->id, $payment->created_at));	
			      
			       		} 	

		       	}

		    }

		    	echo 'Done';
		});


	
});
