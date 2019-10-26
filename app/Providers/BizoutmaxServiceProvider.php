<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Helpers\Bizoutmax;

class BizoutmaxServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton(Bizoutmax::class, function () {
			return new Bizoutmax();
		});
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}
}
