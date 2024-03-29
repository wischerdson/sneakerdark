<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_account', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('customer_id')->unsigned();
            $table->string('first_name', 32);
            $table->string('last_name', 32);
            $table->string('email', 96);
            $table->text('password');
            $table->string('phone', 15);
            $table->integer('created_at')->unsigned();
            $table->integer('updated_at')->unsigned();

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
        Schema::dropIfExists('customer_info');
    }
}
