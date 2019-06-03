<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 10/09/16
 * Time: 10:40 AM
 */

namespace Modules\Helpers;


use App\Http\Schemas\Airport;

class CabinHelper
{
    public static function has($cabin, $origin)
    {
        $airport = Airport::where('code', $origin)
            ->first();

        if(!is_null($airport))
        {
            $cabins = json_decode($airport->cabins);

            if(is_array($cabins))
            {
                return (in_array(strtolower($cabin), $cabins)) ? true : false;
            }
        }

        return false;
    }
}