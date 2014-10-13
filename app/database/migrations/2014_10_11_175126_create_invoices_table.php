<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoices', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('subscription_id');
			$table->integer('payment_id');
			$table->string('path');
			$table->string('token');
			$table->integer('type');
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
		Schema::drop('invoices');
	}

}
