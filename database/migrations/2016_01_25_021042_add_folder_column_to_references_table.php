<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFolderColumnToReferencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('references', function(Blueprint $table)
		{
			$table->string('directory')->nullable()->after('markdown');
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
			$table->dropColumn('directory');
		});
	}

}
