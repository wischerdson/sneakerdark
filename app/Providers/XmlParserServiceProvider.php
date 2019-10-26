<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Helpers\XmlParser;

class XmlParserServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton(XmlParser::class, function () {
			return new XmlParser();
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
