<?php

namespace Wsn\XmlParser;

use Illuminate\Support\Facades\Facade as BaseFacade;

class Facade extends BaseFacade
{
	protected static function getFacadeAccessor()
	{
		return 'wsn.parser.xml';
	}
}