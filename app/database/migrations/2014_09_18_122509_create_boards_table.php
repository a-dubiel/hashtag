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
			$table->integer('user_id');
			$table->string('hashtag');
			$table->string('description');
			$table->integer('refresh');
			$table->integer('posts_per_page');
			$table->string('avatar');
			$table->string('cover');
			$table->string('twitter_usr');
			$table->string('fb_usr');
			$table->string('instagram_usr');
			$table->string('google_usr');
			$table->string('website_url');
			$table->integer('has_twitter');
			$table->integer('has_facebook');
			$table->integer('has_instagram');
			$table->integer('has_google');
			$table->integer('has_vine');
			$table->integer('has_flickr');
			$table->integer('is_active');
			$table->integer('is_public');
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
