<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCustomerTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('customer', function (Blueprint $table) {
		    $table->integer('last_seen_at')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('customer')) {
			if (Schema::hasColumn('customer', 'last_seen_at')) {
				Schema::table('customer', function (Blueprint $table) {
				    $table->dropColumn(['last_seen_at']);
				});
			}
		}
	}
}
