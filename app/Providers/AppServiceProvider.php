<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{

	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		/*\DB::listen(function ($query) {
            dump([
				'time' => $query->time,
				'sql' => $query->sql,
			]);
        }); */
		View::addExtension('svg', 'file');
	}
}
