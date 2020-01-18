<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('collection', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('parent_id')->unsigned()->nullable();
			$table->integer('updated_at')->unsigned();
			$table->integer('created_at')->unsigned();

			//$table->foreign('parent_id')->references('id')->on('collection');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('collections');
	}
}
