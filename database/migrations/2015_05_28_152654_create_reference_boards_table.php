<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenceBoardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reference_boards', function(Blueprint $table)
		{
			$table->integer('reference_id')->unsigned();
			$table->integer('board_id')->unsigned();
			$table->foreign('reference_id')->references('id')->on('references');
			$table->foreign('board_id')->references('id')->on('boards');
			$table->unique(['board_id', 'reference_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reference_boards');
	}

}
