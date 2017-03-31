<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardTable extends Migration {

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
            $table->integer('manufacturer_id')->unsigned();
            $table->integer('mcu_id')->unsigned();
            $table->integer('board_family_id')->unsigned();
            $table->string('board');
            $table->bigInteger('views');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers');
            $table->foreign('mcu_id')->references('id')->on('mcus');
            $table->foreign('board_family_id')->references('id')->on('board_families');
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
