<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 4/09/16
 * Time: 06:51 PM
 */

namespace Modules\Helpers;


class TicketsUtilities
{

    public static function status($travelIR)
    {
        $ticketing = new \stdClass();
        $ticketing->status = trans('kiu.itineraries.status.cancel');
        $ticketing->code = null;
        $ticketing->timelimit = null;

        if(property_exists($travelIR, 'ItineraryInfo'))
        {
            if (property_exists($travelIR->ItineraryInfo, 'Ticketing'))
            {
                if(property_exists($travelIR->ItineraryInfo->Ticketing, 'Status'))
                {
                    $ticketing->code = $travelIR->ItineraryInfo->Ticketing->Status;

                    if($travelIR->ItineraryInfo->Ticketing->Status == 1)
                    {
                        $ticketing->status = trans('kiu.itineraries.status.booking');
                        $ticketing->timelimit = $travelIR->ItineraryInfo->Ticketing->TimeLimit;
                    }
                    else if($travelIR->ItineraryInfo->Ticketing->Status == 3)
                    {
                        $ticketing->status = trans('kiu.itineraries.status.emmited');
                        $ticketing->timelimit = null;
                    }
                    else if($travelIR->ItineraryInfo->Ticketing->Status == 5)
                    {
                        $ticketing->status = trans('kiu.itineraries.status.cancel');
                        $ticketing->timelimit = $travelIR->ItineraryInfo->Ticketing->TimeLimit;
                    }
                }
            }
        }

        return $ticketing;
    }
}