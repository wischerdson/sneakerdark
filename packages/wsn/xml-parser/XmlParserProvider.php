<?php

namespace Wsn\XmlParser;

use Illuminate\Support\ServiceProvider;

class XmlParserProvider extends ServiceProvider
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
