<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 18/08/16
 * Time: 08:34 PM
 */

namespace Modules\Facades;


use Illuminate\Support\Facades\Facade;

class ToBlock extends Facade
{
    protected static function  getFacadeAccessor()
    {
        return \Modules\Security\ToBlock::class;
    }
}