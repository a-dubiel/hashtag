<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubscriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscriptions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('is_recurring')->default(1);
			$table->integer('is_active')->default(1);
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email');
			$table->text('address');
			$table->string('zip');
			$table->string('state');
			$table->string('city');
			$table->string('company_name');
			$table->bigInteger('company_id');
			$table->text('company_address');
			$table->string('company_zip');
			$table->string('company_state');
			$table->string('company_city');
			$table->timestamp('expires_at');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('subscriptions');
	}

}
