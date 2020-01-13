<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('review', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned()->nullable();
			$table->integer('customer_id')->unsigned()->nullable();
			$table->string('author', 64)->nullable();
			$table->text('text')->nullable();
			$table->enum('rating', ['1', '2', '3', '4', '5']);
			$table->integer('created_at');

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
		Schema::dropIfExists('review');
	}
}
