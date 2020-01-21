<?php

namespace Wsn\XmlParser;

use Illuminate\Support\ServiceProvider;

use Wsn\XmlParser\Document as XmlDocument;
use Wsn\XmlParser\Reader as XmlReader;

class XmlParserServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('wsn.parser.xml', function () {
			return new XmlDocument();
		});
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		
	}

	public function provides()
	{
		
	}
}
