<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersPersonalDataTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers_personal_data', function (Blueprint $table) {
			$table->integer('customer_id')->unsigned()->unique();
			$table->string('first_name');
			$table->string('last_name');
			$table->string('patronymic')->nullable();
			$table->string('email')->nullable();
			$table->string('phone')->nullable();
			$table->enum('gender', ['0', '1', '2']);
			$table->boolean('email_verified');
			$table->integer('last_seen')->unsigned();
			$table->integer('created_at')->unsigned();

			$table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('customers_personal_data');
	}
}
