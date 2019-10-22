<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParametersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parameters', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('product_id')->unsigned();
			$table->string('key');
			$table->string('value');

			$table->foreign('product_id')->references('id')->on('products');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('parameters');
	}
}