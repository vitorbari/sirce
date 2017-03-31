<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMcuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('mcus', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('manufacturer_id')->unsigned();
            $table->integer('mcu_family_id')->unsigned();
            $table->string('mcu');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers');
            $table->foreign('mcu_family_id')->references('id')->on('mcu_families');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('mcus');
	}

}
