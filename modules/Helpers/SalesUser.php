<?php
/**
 * Created by SublimeText3.
 * User: Plopez
 * Date: 24/04/17
 * Time: 07:57 PM
 */

namespace Modules\Helpers;


use Illuminate\Support\Facades\Session;
use Torann\GeoIP\GeoIPFacade as GeoIP;
use GeoIp2\Record\Location;

class SalesUser
{
    public static function KiuTerminal($origin, $destination)
    {
        $location = GeoIP::getLocation(); //Comentar para Setear
        //Prueba de Seteo Tarifa
        //$location = ["isoCode" =>'US',];

        $airport = \Modules\Helpers\AirportHelper::origenInternacional($origin);
        $airportdes = \Modules\Helpers\AirportHelper::origenInternacional($destination);

        //dd($airport,$airportdes,$location,$origin, $destination);
        //dd($location);

           if((boolval($airport) == true || boolval($airportdes) == true ) == true && ($location['isoCode'] == 'VE'))
        {
            return $terminalid = config('odavila.Kiu_TerminalID');
            //dd($terminalid);
        }
        elseif(boolval($airport) == false && ($location['isoCode'] == 'VE'))
        {
            return $terminalid = config('odavila.Kiu_TerminalIDVE');
        }
        elseif($location['isoCode'] != 'VE')
        {
            return $terminalid = config('odavila.Kiu_TerminalID');
        }
        return $terminalid;
        //dd($terminalid);
    }

    public static function KiuTerminal1($origin, $destination)
    {
        $location = GeoIP::getLocation(); //Comentar para Setear
        //Prueba de Seteo Tarifa
        //$location = ["isoCode" =>'US',];

        $airport = \Modules\Helpers\AirportHelper::is_int($origin);
        $airportdes = \Modules\Helpers\AirportHelper::is_int($destination);
        //dd($airport);
        //dd($location);

           if((boolval($airport) == true || boolval($airportdes) == true ) == true && ($location['isoCode'] == 'VE'))
        {
            return $terminalid = config('odavila.Kiu_TerminalID');
        }
        elseif(boolval($airport) == false && ($location['isoCode'] == 'VE'))
        {
            return $terminalid = config('odavila.Kiu_TerminalIDVE');
        }
        elseif($location['isoCode'] != 'VE')
        {
            return $terminalid = config('odavila.Kiu_TerminalID');
        }
        //dd($terminalid);
        return $terminalid;
    }

    //Para crear el ISO-Country

    public static function KiuISOCountry($origin, $destination)
    {
        $location = GeoIP::getLocation(); //Comentar para Setear
        //Prueba de Seteo Tarifa
        //$location = ["isoCode" =>'US',];

        $airport = \Modules\Helpers\AirportHelper::origenInternacional($origin);
        $airportdes = \Modules\Helpers\AirportHelper::origenInternacional($destination);

        if((boolval($airport) == true || boolval($airportdes) == true ) && ($location['isoCode'] == 'VE'))
        {
            //dd($airport, $airportdes, $location, $origin, $destination);
            return $isocontry = config('odavila.Kiu_ISOCountry');
        }
        elseif(boolval($airport) == false && ($location['isoCode'] == 'VE'))
        {
            return $isocontry = config('odavila.Kiu_ISOCountryVE');
        }
        elseif($location['isoCode'] != 'VE')
        {
            return $isocontry = config('odavila.Kiu_ISOCountry');
        }
        return $isocontry;
    }

    public static function KiuISOCountry1($origin, $destination)
    {
        $location = GeoIP::getLocation(); //Comentar para Setear
        //Prueba de Seteo Tarifa
        //$location = ["isoCode" =>'US',];

        $airport = \Modules\Helpers\AirportHelper::is_int($origin);
        $airportdes = \Modules\Helpers\AirportHelper::is_int($destination);

        if((boolval($airport) == true || boolval($airportdes) == true ) && ($location['isoCode'] == 'VE'))
        {
            return $isocontry = config('odavila.Kiu_ISOCountry');
        }
        elseif(boolval($airport) == false && ($location['isoCode'] == 'VE'))
        {
            return $isocontry = config('odavila.Kiu_ISOCountryVE');
        }
        elseif($location['isoCode'] != 'VE')
        {
            return $isocontry = config('odavila.Kiu_ISOCountry');
        }
        return $isocontry;
        //dd($isocontry);
    }


}