<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeProductTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product', function (Blueprint $table) {
			$table->integer('deleted_at')->unsigned()->nullable()->after('updated_at');
			// $table->boolean('deletion_candidate')->after('deleted_at')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('product', function (Blueprint $table) {
			$table->dropColumn(['gender', 'deleted_at', 'deletion_candidate']);
		});
	}
}
