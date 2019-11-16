<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Helpers\SneakerdarkImport;

class SneakerdarkImportServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton(SneakerdarkImport::class, function () {
			return new SneakerdarkImport();
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
