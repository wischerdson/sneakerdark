<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOptionValueTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_option_value', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('option_id')->unsigned();
			$table->integer('instock')->unsigned();
			$table->string('value');
			
			$table->foreign('option_id')->references('id')->on('option');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('product_option_value');
	}
}
