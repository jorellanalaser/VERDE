<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 18/08/16
 * Time: 08:23 PM
 */

namespace Modules\Helpers;

use Modules\Helpers\SalesUser;
use App\Http\Schemas\Configuration;

class BookingClass
{
    protected $booking;

    protected $paxs;

    /**
     * Filtrado de clases bloqueadas o sin disponibilidad de
     * asientos
     *
     * @param $_bookings
     * @param null $_paxs
     * @return array
     */
    public function cleaner($_bookings, $_paxs)
    {
        $_excludes = $this->excludes();

        $newBookings = [];

        if(!is_null($_excludes)) {   
            foreach ($_bookings as $booking) {
                 if (!in_array($booking->ResBookDesigCode, $_excludes->ALL)) {
                    if (!is_null($_paxs)) {
                        if (intval($booking->ResBookDesigQuantity) >= $_paxs) {
                            $newBookings[] = $booking;
                        }
                    } else
                        $newBookings[] = $booking;
                }
            }
	    // Array original de Kiu	
	    //dd($newBookings);
	   krsort($newBookings); //Cambio las Tarifas al Orden que deseams 
         //  dd($newBookings);
           return $newBookings;
           
        }
        else
            //dd($_bookings);
            return $_bookings;
    }

    private function excludes()
    {
        // $kiuterminal= Configuration::where('KiuTerminaliD', 'NET00QL000')
        //     ->first();

        // if(($kiuterminal->) == config('odavila.Kiu_TerminalIDVE'))
        // {
        //     $config = Configuration::where('key', 'booking')
        //     ->first();

        //     return $config;
        // }
        // elseif($location['isoCode'] != 'VE')
        // {
            
        //     return $terminalid = config('odavila.Kiu_TerminalID');
        // }
        // return $terminalid;

        $config = Configuration::where('key', 'booking')
            ->orderBy('id','DESC')
            ->first();

        if(!is_null($config)) {
            $data = json_decode($config->value);

            return $data->excludes;
        }
    }
}
