<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPresentationCoverFieldsToBoardsTable extends Migration {

	/**
	 * Make changes to the table.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::table('boards', function(Blueprint $table) {		
			
			$table->string('presentation_cover_file_name')->nullable();
			$table->integer('presentation_cover_file_size')->nullable();
			$table->string('presentation_cover_content_type')->nullable();
			$table->timestamp('presentation_cover_updated_at')->nullable();

		});

	}

	/**
	 * Revert the changes to the table.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('boards', function(Blueprint $table) {

			$table->dropColumn('presentation_cover_file_name');
			$table->dropColumn('presentation_cover_file_size');
			$table->dropColumn('presentation_cover_content_type');
			$table->dropColumn('presentation_cover_updated_at');

		});
	}

}
