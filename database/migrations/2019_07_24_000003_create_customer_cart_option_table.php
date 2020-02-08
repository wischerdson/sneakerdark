<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerCartOptionTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_cart_option', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('customer_cart_id')->unsigned();
			$table->integer('product_option_id')->unsigned()->nullable();

			$table->foreign('customer_cart_id')->references('id')->on('customer_cart');
			$table->foreign('product_option_id')->references('id')->on('product_option');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('customer_cart_option');
	}
}
