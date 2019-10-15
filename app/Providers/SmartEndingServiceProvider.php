<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SmartEndingServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		require_once app_path('Helpers/SmartEndingHelper.php'); 
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
