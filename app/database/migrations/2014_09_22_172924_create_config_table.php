<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfigTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('boards_config', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('board_id');
			$table->integer('user_id')->default(0);
			$table->integer('refresh_interval')->default(30);
			$table->integer('refresh_count')->default(2);
			$table->integer('is_active')->default(1);
			$table->integer('has_fb')->default(0);
			$table->integer('has_tw')->default(0);
			$table->integer('has_vine')->default(0);
			$table->integer('has_insta')->default(0);
			$table->integer('has_google')->default(0);
			$table->integer('live')->default(0);
			$table->string('banned_users');
			$table->string('filter');
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
		Schema::drop('config');
	}

}
