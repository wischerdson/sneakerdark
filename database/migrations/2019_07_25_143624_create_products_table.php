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
			$table->string('supplier_url');
			$table->bigInteger('collection_id')->unsigned();
			$table->string('model');
			$table->text('description');
			$table->string('vendor');
			$table->integer('created_at')->unsigned();

			$table->foreign('collection_id')->references('id')->on('collections');
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
