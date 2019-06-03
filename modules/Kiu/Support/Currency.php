<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 7/09/16
 * Time: 09:25 PM
 */

namespace Modules\Kiu\Support;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

trait Currency
{
    /**
     * @return mixed
     */
    public function getCurrency()
    {
        if(!Session::has('currency'))
            $currency = Config::get('odavila.Kiu_ISOCurrency');
        else
            $currency = Session::get('currency');

        return $currency;
    }
}