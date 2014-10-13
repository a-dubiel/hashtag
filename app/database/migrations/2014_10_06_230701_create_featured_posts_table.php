<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeaturedPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('featured_posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('board_id');
			$table->integer('user_id');
			$table->string('post_id');
			$table->longText('html');
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
		Schema::drop('featured_posts');
	}

}
