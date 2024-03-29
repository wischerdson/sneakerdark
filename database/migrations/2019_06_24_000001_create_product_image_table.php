<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImageTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_image', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->string('src')->nullable();
			$table->string('supplier_src')->nullable();
			$table->boolean('prohibit_changes')->default(false);
			$table->integer('created_at')->unsigned();
			$table->integer('updated_at')->unsigned();

			$table->foreign('product_id')->references('id')->on('product');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('pictures');
	}
}
