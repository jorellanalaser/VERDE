<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 28/10/15
 * Time: 02:00 PM
 */

namespace Modules\Kiu\TravelItineraryRead;

class KIU_TravelItineraryReadRS
{
    public function __construct($data, $xml = null)
    {
        $this->_data = $data;

        $this->_xml = $xml;

        $this->TravelItinRead = new \stdClass();
    }

    public function getTravelItinerary()
    {
        $this->_organize();

        return $this->TravelItinRead;
    }

    public function _organize()
    {
        foreach($this->_data as $key => $value)
        {
            if($key == '@attributes')
            {
                $this->_attr_identifier($value, $this->TravelItinRead);
            }
            elseif($key == 'TravelItinerary')
            {
                $this->_getTravelItinerary($this->_data->TravelItinerary, $this->TravelItinRead);
            }
            elseif ($key == 'ItineraryInfo')
            {
                $this->_getItineraryInfo($this->_data->ItineraryInfo, $this->TravelItinRead);
            }
            elseif($key == 'Error')
            {
                $this->_getError($value, $this->TravelItinRead);
            }
        }
    }

    private function _getTravelItinerary($data, $Obj)
    {
        foreach($data as $key => $value)
        {
            if($key == 'ItineraryRef')
                $Obj->ItineraryRef = ItineraryRefGetter::get($value);

            if($key == 'CustomerInfos')
                $Obj->CustomerInfo = CustomerInfosGetter::get($value);

            if($key == 'ItineraryInfo')
                $Obj->ItineraryInfo = ItineraryInfoGetter::get($value);

            if($key == 'Remarks')
                $this->_getRemarks($value, $Obj);
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

    private function _getremarks($data, $Obj)
    {
        $Obj->Remarks = $data;
    }

    private function _getItineraryInfo($data, $Obj)
    {
        if(property_exists($data, 'Ticketing'))
        {
            if(property_exists($data->Ticketing, 'TicketAdvisory'))
            {
                $Ticket = new \SimpleXMLElement($this->_xml);

                $Obj->TicketAdvisory = (string) $Ticket->ItineraryInfo->Ticketing->TicketAdvisory;

                return $Obj;
            }
        }
    }

    private function _getError($data, $Obj)
    {
        $Obj->Error = $data;
    }
}