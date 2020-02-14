<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductViewsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_views', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('product_id')->unsigned();
			$table->bigInteger('customer_id')->unsigned();
			$table->integer('views')->unsigned();
			$table->integer('created_at')->unsigned();
			$table->integer('updated_at')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('product_views');
	}
}
