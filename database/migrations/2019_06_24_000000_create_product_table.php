<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product', function (Blueprint $table) {
			$table->increments('id');
			$table->string('sku', 40);
			$table->string('alias')->unique();
			$table->double('base_price', 7, 2);
			$table->double('price', 7, 2)->nullable();
			$table->tinyInteger('sale')->unsigned()->nullable();
			$table->integer('collection_id')->unsigned();
			$table->string('supplier_url');
			$table->string('image')->nullable();
			$table->boolean('shipping')->default(1);
			$table->integer('viewed')->unsigned()->default(0);
			$table->integer('instock')->unsigned()->nullable();
			$table->integer('minimum')->unsigned()->default(1);
			$table->boolean('visible')->default(1);
			$table->integer('created_at')->unsigned();
			$table->integer('updated_at')->unsigned();
			$table->boolean('delete_candidate')->default(false);
			$table->integer('deleted_at')->unsigned()->nullable();

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
		Schema::dropIfExists('products');
	}
}
