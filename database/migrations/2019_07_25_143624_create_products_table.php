<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('title');
			$table->double('price', 7, 2);
			$table->bigInteger('article')->unsigned()->unique();
			$table->string('bizoutmax_url');
			$table->bigInteger('category_id')->unsigned();
			$table->string('model');
			$table->text('description');
			$table->string('vendor');

			$table->foreign('category_id')->references('id')->on('categories');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('products');
	}
}
