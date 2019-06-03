<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 22/03/16
 * Time: 11:55 AM
 */

namespace Modules\Kiu\AirDemand;


class KIU_AirDemandRS
{
    public function __construct($data)
    {
        $this->_data = $data;

        $this->AirDemand = new \stdClass();

        $this->_organize();
    }

    public function getAirDemand()
    {
        return $this->AirDemand;
    }

    private function _organize()
    {
        foreach($this->_data as $key => $value)
        {
            if($key == '@attributes')
            {
                $this->_attr_identifier($value, $this->AirDemand);
            }
            elseif($key == 'BookingReferenceID')
            {
                $this->BookingReference($value, $this->AirDemand);
            }
            elseif ($key == 'TicketItemInfo')
            {
                $this->TicketItemInfo($value, $this->AirDemand);
            }
            elseif($key == 'Error')
            {
                $this->_getError($value, $this->AirDemand);
            }
        }
    }

    private function BookingReference($data, $Obj)
    {
        $Obj->BookingReference = new \stdClass();

        if(property_exists($data, '@attributes'))
        {
            $Obj->BookingReference->ID = $data->{"@attributes"}->ID;
        }

        if(property_exists($data, 'CompanyName'))
        {
            if(property_exists($data->CompanyName, '@attributes'))
            {
                $Obj->BookingReference->Airline = $data->CompanyName->{"@attributes"}->Code;
            }
        }

        return $Obj;
    }

    private function TicketItemInfo($data, $Obj)
    {
        $Obj->Tickets = [];

        if(is_array($data))
        {
            $Obj->Tickets = $this->Tickets($data);
        }
        else
        {
            $Obj->Tickets[0] = $this->Ticket($data);
        }

        $Obj;
    }

    private function Tickets($data)
    {
        $Tkts = [];

        for($t = 0; $t < count($data); $t++)
        {
            $Tkts[$t] = $this->Ticket($data[$t]);
        }

        return $Tkts;
    }

    private function Ticket($data)
    {
        $Tkt = new \stdClass();

        if(property_exists($data, '@attributes'))
        {
            $Tkt->Tkt = new \stdClass();
            $Tkt->Tkt->TicketNumber     = $data->{"@attributes"}->TicketNumber;
            $Tkt->Tkt->Type             = $data->{"@attributes"}->Type;
            $Tkt->Tkt->ItemNumber       = $data->{"@attributes"}->ItemNumber;
            $Tkt->Tkt->TotalAmount      = $data->{"@attributes"}->TotalAmount;
            $Tkt->Tkt->CommissionAmount = $data->{"@attributes"}->CommissionAmount;
            $Tkt->Tkt->PaymentType      = $data->{"@attributes"}->PaymentType;
        }

        if(property_exists($data, 'PassengerName'))
        {
            $Tkt->Paxs = new \stdClass();
            $Tkt->Paxs->GivenName   = $data->PassengerName->GivenName;
            $Tkt->Paxs->Surname     = $data->PassengerName->Surname;
        }

        return $Tkt;
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