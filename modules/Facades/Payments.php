<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 18/08/16
 * Time: 08:34 PM
 */

namespace Modules\Facades;


use Illuminate\Support\Facades\Facade;

class Payments extends Facade
{
    protected static function  getFacadeAccessor()
    {
        return \Modules\Payments\PaymentsMod::class;
    }
}