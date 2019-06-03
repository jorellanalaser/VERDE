<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 15/10/15
 * Time: 11:13 AM
 */

namespace Modules\Kiu\AirPrice;


use Modules\Kiu\InfoGetters\Fare;
use Modules\Kiu\InfoGetters\Itinerary;

class KIU_AirPriceRS
{

    public function __construct($data)
    {
        $this->_data = $data;

        $this->AirPrice = new \stdClass();

        $this->_organize($this->AirPrice);
        //dd($this);
    }

    public function getAirPrice()
    {
        return $this->AirPrice;
    }

    private function _organize()
    {
        foreach($this->_data as $key => $value)
        {

            if($key == '@attributes')
            {
                $this->_attr_identifier($value, $this->AirPrice);
            }
            elseif($key == 'PricedItineraries')
            {
                $this->_getPricedItineraries($this->_data, $this->AirPrice);
            }
            elseif($key == 'Error')
            {
                $this->_getError($value, $this->AirPrice);
            }
        }
    }

    private function _getPricedItineraries($data, $Obj)
    {
        if(array_key_exists('PricedItineraries', $data))
        {
            if(array_key_exists('PricedItinerary', $data->PricedItineraries))
            {
                if(array_key_exists('AirItinerary', $data->PricedItineraries->PricedItinerary))
                {
                    $Obj->Itinerary = new \stdClass();

                    $Itinerary = new Itinerary($data->PricedItineraries->PricedItinerary->AirItinerary->OriginDestinationOptions);

                    $Obj->Itinerary->Flights = $Itinerary->get();

                }

                if(array_key_exists('AirItineraryPricingInfo', $data->PricedItineraries->PricedItinerary))
                {
                    $Obj->Fares = new \stdClass();

                    $Fares = new Fare($data->PricedItineraries->PricedItinerary->AirItineraryPricingInfo);

                    $Obj->Fares->PricedInfo = $Fares->get();
                }
            }
        }

    }

    private function _attr_identifier($data, $Obj)
    {
        if(array_key_exists('EchoToken', $data))
        {
            $Obj->Common = new \stdClass();

            $Obj->Common = $data;
        }

        return null;
    }

    private function _getError($data, $Obj)
    {
        $Obj->Error = $data;
    }
}