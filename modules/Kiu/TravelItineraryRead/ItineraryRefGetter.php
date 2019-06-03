<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 29/10/15
 * Time: 10:05 AM
 */

namespace Modules\Kiu\TravelItineraryRead;


class ItineraryRefGetter
{
    public static function get($data)
    {
        $ItineraryRef = self::_getItineraryRef($data);
        
        return $ItineraryRef;
    }

    private static function _getItineraryRef($data)
    {
        if(array_key_exists("@attributes", $data))
        {
            $ItinRef = new \stdClass();

            if(array_key_exists('Type', $data->{"@attributes"}))
                $ItinRef->Type = $data->{"@attributes"}->Type;

            if(array_key_exists('ID', $data->{"@attributes"}))
                $ItinRef->ID = $data->{"@attributes"}->ID;

            return $ItinRef;
        }
    }
}