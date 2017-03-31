<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFavoritesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_favorites', function(Blueprint $table)
		{
            $table->integer('user_id')->unsigned();
            $table->integer('reference_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('reference_id')->references('id')->on('references');
            $table->unique(['user_id', 'reference_id']);

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
		Schema::drop('user_favorites');
	}

}
