<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('feedback', function (Blueprint $table) {
			$table->increments('id');
			$table->bigInteger('customer_id')->unsigned()->nullable();
			$table->string('username', 40);
			$table->string('email', 100);
			$table->text('message');
			$table->string('ip');
			$table->integer('created_at')->unsigned();

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
		Schema::dropIfExists('feedback');
	}
}
