<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CollectionDescription extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('collection_description', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('collection_id')->unsigned();
			$table->string('name', 40);
			$table->string('description')->nullable();
			$table->string('image')->nullable();
			$table->string('url_alias');
			$table->string('meta_title');
			$table->string('meta_description')->nullable();

			$table->foreign('collection_id')->references('id')->on('collection');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}
}