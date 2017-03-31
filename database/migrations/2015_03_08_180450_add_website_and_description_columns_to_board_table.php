<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWebsiteAndDescriptionColumnsToBoardTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('boards', function(Blueprint $table)
		{
            $table->text('description')->after('board');
            $table->string('website')->after('description');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('boards', function(Blueprint $table)
		{
            $table->dropColumn(['description', 'website']);
		});
	}

}
