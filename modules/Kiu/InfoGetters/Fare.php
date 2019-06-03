<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 23/10/15
 * Time: 01:23 PM
 */

namespace Modules\Kiu\InfoGetters;


class Fare
{
    private $_fares;

    private $_AirItineraryPricingInfo;

    public function __construct($data)
    {
        $this->_fares = new \stdClass();
        $this->_AirItineraryPricingInfo = $data;
    }

    public function get()
    {
        $this->_getPriceInfo($this->_fares);

        return $this->_fares;
    }

    private function _getPriceInfo($Obj)
    {
        foreach($this->_AirItineraryPricingInfo as $key => $value)
        {
            if($key == 'ItinTotalFare')
                $this->_getFares($value, $Obj);

            if($key == 'PTC_FareBreakdowns')
                $this->_getPTCFareBreakdowns($value, $Obj);
        }
    }

    private function _getFares($data, $Obj)
    {
        if(!array_key_exists('ItinTotalFare', $Obj))
            $Obj->ItinTotalFare = new \stdClass();

        foreach($data as $key => $value)
        {
            if($key == 'BaseFare')
                $this->_getBaseFare($data->BaseFare, $Obj->ItinTotalFare);

            if($key == 'Taxes')
                $this->_getTaxes($data->Taxes, $Obj->ItinTotalFare);

            if($key == 'TotalFare')
                $this->_getTotalFare($data->TotalFare, $Obj->ItinTotalFare);
        }
    }

    private function _getBaseFare($data, $Obj)
    {
        if(array_key_exists('@attributes', $data))
        {
            if(array_key_exists('Amount', $data->{"@attributes"}) && array_key_exists('CurrencyCode', $data->{"@attributes"}))
            {

                if(!array_key_exists('BaseFare', $Obj))
                    $Obj->BaseFare = new \stdClass();

                $Obj->BaseFare->Amount      = $data->{"@attributes"}->Amount;
                $Obj->BaseFare->Currency    = $data->{"@attributes"}->CurrencyCode;
            }
        }
    }

    private function _getTaxes($data, $Obj)
    {
        if(array_key_exists('Tax', $data))
        {
            for($taxID = 0; $taxID < count($data->Tax); $taxID++)
            {
                if(!array_key_exists('Taxes', $Obj))
                    $Obj->Taxes = new \stdClass();

                if(is_array($data->Tax))
                {
                    $Obj->Taxes->Tax[$taxID] = new \stdClass();

                    $Obj->Taxes->Tax[$taxID]->TaxCode  = $data->Tax[$taxID]->{"@attributes"}->TaxCode;
                    $Obj->Taxes->Tax[$taxID]->Amount   = $data->Tax[$taxID]->{"@attributes"}->Amount;
                    $Obj->Taxes->Tax[$taxID]->Currency = $data->Tax[$taxID]->{"@attributes"}->CurrencyCode;
                }
            }
        }
    }

    private function _getTotalFare($data, $Obj)
    {
        if(array_key_exists('@attributes', $data))
        {
            if(!array_key_exists('TotalFare', $Obj))
                $Obj->TotalFare = new \stdClass();

            $Obj->TotalFare->Amount       = $data->{"@attributes"}->Amount;
            $Obj->TotalFare->CurrencyCode = $data->{"@attributes"}->CurrencyCode;
        }
    }

    private function _getPTCFareBreakdowns($data, $Obj)
    {
        if(!array_key_exists('PTC_FareBreakdown', $Obj))
            $Obj->PTC_FareBreakdown = new \stdClass();

        if(array_key_exists('PassengerTypeQuantity', $data->PTC_FareBreakdown))
        {
            $Obj->PTC_FareBreakdown->Passengers[0] = new \stdClass();

            $this->_getPTCFareBreakdown($data->PTC_FareBreakdown, $Obj->PTC_FareBreakdown->Passengers[0]);
        }
        else
        {
            for($breakdownsID = 0; $breakdownsID < count($data->PTC_FareBreakdown); $breakdownsID++)
            {
                $Obj->PTC_FareBreakdown->Passengers[$breakdownsID] = new \stdClass();

                $this->_getPTCFareBreakdown($data->PTC_FareBreakdown[$breakdownsID], $Obj->PTC_FareBreakdown->Passengers[$breakdownsID]);
            }
        }

    }

    private function _getPTCFareBreakdown($data, $Obj)
    {
        foreach($data as $key => $value)
        {


            if($key == 'PassengerTypeQuantity')
            {
                $this->_getPassengerTypeQuantity($value, $Obj);

            }

            if($key == 'PassengerFare')
            {
                $this->_getBaseFare($value->BaseFare, $Obj);

                $this->_getTaxes($value->Taxes, $Obj);

            }
        }
    }

    private function _getPassengerTypeQuantity($data, $Obj)
    {

        if(array_key_exists('@attributes', $data))
        {
            $Obj->Code = $data->{"@attributes"}->Code;
            $Obj->Quantity = $data->{"@attributes"}->Quantity;
        }
    }
}