<?php
/**
 * Created by Sublimetext3.
 * User: Plopez
 * Date: 26/04/17
 * Time: 11:21 PM
 */

namespace Modules\Helpers;


use App\Http\Schemas\Airport;
use App\Http\Schemas\Booking;


class AirportHelper
{
    public static function idByCode($_code)
    {
        $airport = Airport::where('code', $_code)
            ->first();

        return (!is_null($airport)) ? $airport->id : $_code;
    }

    public static function cityByCode($_code)
    {
        $airport = Airport::where('code', $_code)
            ->first();

        return (!is_null($airport)) ? $airport->city : $_code;
    }

    public static function is_int($_code)
    {

        $airport = Airport::where('code', $_code)
            ->first();
        //dd($airport);
        return (!is_null($airport) ? $airport->int : false);        
    }

    public static function origenInternacional($_code)
    {

        $airport = Airport::where('id', $_code)
            ->first();
        //dd($airport);
        return (!is_null($airport) ? $airport->int : false);        
    }

    public static function hasLocation($booking_ref, $location)
    {
        $booking = Booking::where('booking_ref', $booking_ref)
            ->orderBy('id','DESC')
            ->first();

        if(!is_null($booking))
        {
            foreach ($booking->itineraries as $itinerary)
            {
                if($itinerary->origin == $location || $itinerary->destination == $location)
                    return true;
            }
        }

        return false;
    }

    public static function hasLocationCompany($booking_ref)
    {
        $booking = Booking::where('booking_ref', $booking_ref)
            ->orderBy('id','DESC')
            ->first();

        if(!is_null($booking))
        {
            foreach ($booking->itineraries as $itinerary)
            {
                if($itinerary->origin == 'MIA' || $itinerary->destination == 'MIA'){
                    return $location1 = config('odavila.Kiu_CompanyMIA');
                }
                  else{
                    return $location1 = config('odavila.Kiu_CompanyVE');
                  }   
            }
        return $location1;    
        }   
    }

    public static function DemandTerminalID($booking_ref)
    {
        $booking = Booking::where('booking_ref', $booking_ref)
            ->orderBy('id','DESC')
            ->first();

        if(!is_null($booking))
        {
            if ($booking->itineraries->count() == 2 && $booking->itineraries[1]->destination == $booking->itineraries[0]->origin ) {
                $ruta = [
                    'origen' => $booking->itineraries[0]->origin,
                    'destino' => $booking->itineraries[0]->destination,
                ];
                //dd($booking);
                return $ruta ;
            }
            else

                if ($booking->itineraries->count() == 2 && $booking->itineraries[1]->destination != "   " ) {
                    $ruta = [
                     'origen' => $booking->itineraries[0]->origin,
                     'destino' => $booking->itineraries[1]->destination,
                ];
                //dd($booking);
                return $ruta ;
            }
                else
            
                    if ($booking->itineraries->count() >= 3) {
                        $ruta = [
                        'origen' => $booking->itineraries[0]->origin,
                        'destino' => $booking->itineraries[1]->destination,
                    ];
                //dd($booking);

                    return $ruta ;
            }
                     else
                {
                    foreach ($booking->itineraries as $itinerary)
                {

                        $ruta = [
                        'origen' => $itinerary->origin,
                        'destino' => $itinerary->destination
                    ];
                    //dd($booking);
                return $ruta ;

                }
            }

         return $ruta;
        }
    }

    public static function OriginWAA($booking_ref,$userisocountry)
    {
        $booking = Booking::where('booking_ref', $booking_ref)
            ->first();

        if(!is_null($booking))
        {
            foreach ($booking->itineraries as $itinerary)
            {
                if( ($userisocountry['isoCode']) == 'US')
            {
                if(($itinerary->origin) == 'MIA' or ($itinerary->destination) == 'MIA')
                {
                    $layoutInt = 'US';
                    return $layoutInt;      
                }
                else
                {
                    $layoutInt = 'VE';
                    return $layoutInt;  
                }
                return $layoutInt;
            }
            else
            {
                $layoutInt = 'VE'; 
            }
            return $layoutInt;    
            }
        return $layoutInt;    
        }

          
    }

}