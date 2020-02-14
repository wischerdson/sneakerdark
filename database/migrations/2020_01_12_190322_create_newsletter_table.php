<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsletterTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('newsletter', function (Blueprint $table) {
			$table->increments('id');
			$table->bigInteger('customer_id')->unsigned()->nullable();
			$table->string('email');

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
		Schema::dropIfExists('newsletter');
	}
}
