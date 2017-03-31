<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('components', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('component_category_id')->unsigned();
			$table->integer('manufacturer_id')->unsigned()->nullable();
            $table->string('component');
			$table->bigInteger('views');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('component_category_id')->references('id')->on('component_categories');
			$table->foreign('manufacturer_id')->references('id')->on('manufacturers');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('components');
	}

}
