<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPublisedAtToReferencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('references', function(Blueprint $table)
		{
			$table->timestamp('published_at')->nullable()->after('views');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('references', function(Blueprint $table)
		{
			$table->dropColumn('published_at');
		});
	}

}
