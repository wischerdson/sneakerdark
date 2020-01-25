<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchHistoryTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('search_history', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('customer_id')->unsigned()->nullable();
			$table->string('query');
			$table->string('gender')->nullable();
			$table->integer('created_at')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('search_history');
	}
}
