<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBoardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('boards', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('hashtag');
			$table->string('description');
			$table->string('avatar');
			$table->string('cover');
			$table->string('fb_user');
			$table->string('tw_user');
			$table->string('insta_user');
			$table->string('google_user');
			$table->string('website_url');
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
		Schema::drop('boards');
	}

}
