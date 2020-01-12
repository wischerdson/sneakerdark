<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeDescriptionTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attribute_description', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('attribute_id')->unsigned();
			$table->string('name', 64);

			$table->foreign('attribute_id')->references('id')->on('attribute');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('attribute_description');
	}
}
