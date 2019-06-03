<?php
/**
 * Created by SublimeText 3
 * User: plopez
 * Date: 10/06/17
 * Time: 09:41 PM
 */

namespace Modules\Kiu\InfoGetters;


class Itinerary
{
    private $_itinerary;

    private  $_OriginDestinationOptions;

    public function __construct($OriginDestinationOptions)
    {
        // Crea Objeto de respuesta
        //dd($OriginDestinationOptions);
        $this->_itinerary = new \stdClass();

        $this->_OriginDestinationOptions = $OriginDestinationOptions;

    }

    public function get()
    {
        $this->_getOriginDestinationOptions($this->_itinerary);

        if(array_key_exists('Flights', $this->_itinerary))
            return $this->_itinerary->Flights;
    }

    /**
     * Verifica si exiten vuelos, llama a la funcion _getFlighSegment  (JCCV)
     * @param $data
     * @param $i
     */
    private function _getOriginDestinationOptions($Obj)
    {
        // Si existe el objeto de vuelos

        if(array_key_exists('OriginDestinationOption', $this->_OriginDestinationOptions))
        {
            // Un vuelo
            if(array_key_exists('FlightSegment', $this->_OriginDestinationOptions->OriginDestinationOption))
            {
                $Obj->Flights[0] = $this->_getFlight($this->_OriginDestinationOptions->OriginDestinationOption);
            }
            else // Mas de un vuelo
                $this->_getFlights($this->_OriginDestinationOptions->OriginDestinationOption, $Obj);
        }
    }

    /**
     * Recorrido de Vuelos.
     * Llama a la funcion _getFlight por cada vuelo encontrado.
     * @param $data
     * @param $Obj
     */
    private function _getFlights($data, $Obj)
    {

        for($flightID = 0; $flightID < count($data); $flightID++)
        {
            $Obj->Flights[$flightID] = $this->_getFlight($data[$flightID]);
        }
    }

    /**
     * Obtiene datos del vuelo, si hay mas de un segmento llama a la funcion
     * _getFlightSegments, si hay un solo segmento llama a la funcion
     * _getFlightSegment.
     * @param $data
     * @param $Obj
     */
    private function _getFlight($data)
    {
        $Obj = [];

        if(array_key_exists('@attributes', $data->FlightSegment))   // Un Segmento
            $Obj[0] = $this->_getFlightSegment($data->FlightSegment);
        else                                            // Mas de un vuelo
            $Obj = $this->_getFlightSegments($data->FlightSegment);

        return $Obj;

    }

    /**
     * Recorrido de segmentos de vuelo.
     * Llama al metodo _getFlightSegments por cada segmento encontrado.
     * @param $data
     * @param $Obj
     */
    private function _getFlightSegments($data)
    {
        for($segmentID = 0; $segmentID < count($data); $segmentID++)
        {
            $Obj[$segmentID] = $this->_getFlightSegment($data[$segmentID]);
        }

        return $Obj;
    }

    /**
     * Obtiene datos del segmento de vuelo.
     * Agrega los datos al objeto de respuesta.
     * @param $data
     * @param $Obj
     */
    private function _getFlightSegment($data)
    {
        if(array_key_exists('@attributes',$data))
        {
            $Obj = new \stdClass();

            $Obj->DepartureDateTime = $data->{"@attributes"}->DepartureDateTime;

            $Obj->ArrivalDateTime   = $data->{"@attributes"}->ArrivalDateTime;

            $Obj->FlightNumber      = $data->{"@attributes"}->FlightNumber;

            $Obj->DepartureAirport  = $data->DepartureAirport->{"@attributes"}->LocationCode;

            $Obj->ArrivalAirport    = $data->ArrivalAirport->{"@attributes"}->LocationCode;

            $this->_getStopQuantity($data->{"@attributes"}, $Obj);

            $this->_getJourneyDuration($data->{"@attributes"}, $Obj);

            $this->_getEquipment($data, $Obj);

            $this->_getAirline($data, $Obj);

            $this->_getMeal($data, $Obj);

            $Obj->Cabin = $this->_getCabins($data);

            $Obj->BookingClass = $this->_getBookingClasses($data);
            
            return $Obj;

        }
    }

    private function _getStopQuantity($data, $Obj)
    {
        if(array_key_exists('StopQuantity', $data))
        {
            $Obj->StopQuantity      = $data->StopQuantity;
        }
    }

    private function _getJourneyDuration($data, $Obj)
    {
        if(array_key_exists('JourneyDuration', $data))
        {
            $Obj->JourneyDuration      = $data->JourneyDuration;
        }
    }

    private function _getEquipment($data, $Obj)
    {
        if(array_key_exists('Equipment', $data))
        {
            $Obj->Equipment      = $data->Equipment->{"@attributes"}->AirEquipType;
        }
    }

    private function _getAirline($data, $Obj)
    {
        if(array_key_exists('MarketingAirline', $data))
        {
            // AirAvail
            if(array_key_exists('CompanyShortName', $data->MarketingAirline->{"@attributes"}))
                $Obj->Airline      = $data->MarketingAirline->{"@attributes"}->CompanyShortName;

            // AirPrice, AirBook
            if(array_key_exists('Code', $data->MarketingAirline->{"@attributes"}))
                $Obj->Airline      = $data->MarketingAirline->{"@attributes"}->Code;
            //dd($data);
        }
    }

    private function _getMeal($data, $Obj)
    {
        if(array_key_exists('Meal', $data))
        {
            $Obj->Meal      = $data->Meal->{"@attributes"}->MealCode;
        }
    }

    private function _getCabins($data)
    {
        if(array_key_exists('MarketingCabin', $data))
        {
            if(array_key_exists('@attributes', $data->MarketingCabin))
            {
                return $this->_getCabin($data->MarketingCabin);
            }else{

                for($cabinID = 0; $cabinID < count($data->MarketingCabin); $cabinID++)
                {
                    $Cabins[$cabinID] = $this->_getCabin($data->MarketingCabin[$cabinID]);
                }

                return $Cabins;
            }
        }
    }

    private function _getCabin($data)
    {
        $Cabin          = new \stdClass();

        $Cabin->Type    = $data->{"@attributes"}->CabinType;

        $Cabin->RPH     = $data->{"@attributes"}->RPH;

        return $Cabin;
    }

    /**
     * Obtiene datos de clases y cantidad de disponibilidad.
     * Retorna stdClass.
     * @param $data
     * @return null|\stdClass
     */
    private function _getBookingClasses($data, $Obj = null)
    {
        // AirAvail
        if(array_key_exists('BookingClassAvail', $data))
        {
            $Obj = [];

            if(array_key_exists('@attributes', $data->BookingClassAvail))
            {
                $Obj[0] = $this->_getBookingClass($data->BookingClassAvail);
            }
            else
            {
                for($bookingID = 0; $bookingID < count($data->BookingClassAvail); $bookingID++)
                {
                    $Obj[$bookingID] = $this->_getBookingClass($data->BookingClassAvail[$bookingID]);
                }
            }    
        return $Obj;
        }

        // AirPrice, AirBook
        if(array_key_exists('ResBookDesigCode', $data->{"@attributes"}))
        {
            return $data->{"@attributes"}->ResBookDesigCode;
        }
    }

    private function _getBookingClass($data)
    {
        $BookingClass = new \stdClass();

        $BookingClass->ResBookDesigCode     = $data->{"@attributes"}->ResBookDesigCode;
        $BookingClass->ResBookDesigQuantity = $data->{"@attributes"}->ResBookDesigQuantity;
        $BookingClass->RPH                  = $data->{"@attributes"}->RPH;

        return $BookingClass;
    }
}
