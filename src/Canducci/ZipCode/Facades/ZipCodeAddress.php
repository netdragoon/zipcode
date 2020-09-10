<?php

namespace Canducci\ZipCode\Facades;

use Illuminate\Support\Facades\Facade;

class ZipCodeAddress extends Facade
{

	/**
	 * Register Facade of Canducci\ZipCode\ZipCode
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{

		return 'Canducci\ZipCode\ZipCodeAddress';
	}
}
