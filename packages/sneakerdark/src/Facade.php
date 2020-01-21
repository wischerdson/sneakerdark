<?php

namespace Sneakerdark;

use Illuminate\Support\Facades\Facade as BaseFacade;

class Facade extends BaseFacade
{
	protected static function getFacadeAccessor()
	{
		return 'sneakerdark.sdk';
	}
}