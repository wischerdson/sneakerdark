<?php

use Illuminate\Database\Seeder;

class CollectionsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$data = [
			'collections' => [
				
			]
		];

		foreach ($data as $key => $value) {
			DB::table($key)->insert($value);
		}
	}
}
