<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstagrampostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('instagram_posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('board_id');
			$table->integer('post_id');
			$table->integer('user_id');
			$table->string('username');
			$table->string('caption');
			$table->string('user_img_url');
			$table->string('img_url');
			$table->string('video_url');
			$table->string('post_type');
			$table->string('vendor')->default('instagram');
			$table->timestamp('date_created');
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
		Schema::drop('instagram_posts');
	}

}
