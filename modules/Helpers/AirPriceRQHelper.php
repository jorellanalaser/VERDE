<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 24/08/16
 * Time: 08:26 PM
 */

namespace Modules\Helpers;


class AirPriceRQHelper
{
    public function __construct()
    {    }

    public function data_json($_data, $_ADT)
    {
        $data = [
            'OriginDestinationInfo' => $this->_getRoutes($_data),
            'AirTravelerAvail'  => [
                'ADT'   => $_ADT
            ]
        ];

        return json_encode( $data );
    }

    private function _getRoutes($_data)
    {
        $routes = [];

        foreach ($_data as $route)
        {
            $routes[] = [
                'Segments' => $this->_getSegments($route)
            ];
        }

        return $routes;
    }

    private function _getSegments($_data)
    {
        $json = [];

        $segments = [];
        $booking_class = null;

        if(!is_null($_data))
        {
            if(property_exists($_data, 'segment'))
                $segments = $_data->segment;
            elseif(property_exists($_data, 'Segments'))
                $segments = $_data->Segments;

            foreach ($segments as $segment)
            {
                $json[] = [
                    'DepartureDateTime' => $segment->DepartureDateTime,
                    'ArrivalDateTime'   => $segment->ArrivalDateTime,
                    'FlightNumber'      => $segment->FlightNumber,
                    'DepartureAirport'  => $segment->DepartureAirport,
                    'ArrivalAirport'    => $segment->ArrivalAirport,
                    'Airline'           => $segment->Airline,
                    'ResBookDesigCode'  => (property_exists($segment, 'ResBookDesigCode')) ? $segment->ResBookDesigCode : $_data->booking_class
                ];
            }
        }

        return $json;
    }
}