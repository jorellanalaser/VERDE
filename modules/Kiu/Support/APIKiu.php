<?php

namespace Modules\Kiu\Support;

use Illuminate\Support\Facades\Facade;
use Modules\Kiu\KiuWS;

class APIKiu extends Facade
{
	/**
    * Get the registered name of the component.
    *
    * @return string
    */
    protected static function getFacadeAccessor()
    {
        return KiuWS::class;
    }
}