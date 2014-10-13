<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CheckSubscriptions extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'command:subscriptions';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Check subscriptions.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{	
		$this->info('Started...');
		

		Subscription::chunk(200, function($subscriptions)
		{

			$accepted = 0;
			$declined = 0;


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

							$accepted++;

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

							$declined++;

			       			$payment = Payment::create(array(
								'user_id' => $subscription->user_id,
								'subscription_id' => $subscription->id,
								'is_success' => 0,
								'sale_id' => $status['error']['error_number']
							));

			       			Event::fire('deactivate.subscription', array($subscription->id, $payment->created_at));	
			      
			       		} 	

		       	}

		    }

		    $this->info('Accepted:' . $accepted);
		    $this->info('Declined:' . $declined);


		});



		$this->info('Done');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
