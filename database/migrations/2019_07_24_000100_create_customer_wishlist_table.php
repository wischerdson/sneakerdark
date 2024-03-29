<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerWishlistTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_wishlist', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('product_id')->unsigned();
			$table->bigInteger('customer_id')->unsigned();
			$table->integer('created_at')->unsigned();
			$table->integer('deleted_at')->unsigned()->nullable();

			$table->foreign('product_id')->references('id')->on('product');
			$table->foreign('customer_id')->references('id')->on('customer');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('customer_wishlist');
	}
}
