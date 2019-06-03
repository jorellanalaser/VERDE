<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 29/10/15
 * Time: 02:32 PM
 */

namespace Modules\Kiu\TravelItineraryRead;


class ItineraryInfoGetter
{
    public static function get($data)
    {
        $Itinerary = self::_getItineraryInfo($data);

        return $Itinerary;
    }

    private static function _getItineraryInfo($data)
    {
        $Itinerary = new \stdClass();

        if(array_key_exists('ReservationItems', $data))
            $Itinerary->Items = self::_getReservationItems($data->ReservationItems);

        if(array_key_exists('ItineraryPricing', $data))
            $Itinerary->Pricing = self::_getItineraryPricing($data->ItineraryPricing);

        if(array_key_exists('SpecialRequestDetails', $data))
            $Itinerary->SpecialRequest = self::_getSpecialRequestDetails($data->SpecialRequestDetails);

        if(array_key_exists('Ticketing', $data))
            $Itinerary->Ticketing = self::_getTicketing($data->Ticketing);

        return $Itinerary;
    }

    private static function _getReservationItems($data)
    {
        if(array_key_exists('Item', $data))
        {
            if(array_key_exists("@attributes", $data->Item))
                return self::_getResItem($data->Item);
            else
                return self::_getResItems($data->Item);
        }
    }

    private static function _getResItems($data)
    {
        $Items = null;

        for($itemID = 0; $itemID < count($data); $itemID++)
        {
            $Items[$itemID] = self::_getResItem($data[$itemID]);
        }

        return $Items;
    }

    private static function _getResItem($data)
    {
        $Res = new \stdClass();

        $Res->RPH = $data->{"@attributes"}->ItinSeqNumber;

        if(array_key_exists('Air', $data))
        {
            if(array_key_exists('Reservation', $data->Air))
            {
                $Res->Reservation = $data->Air->Reservation->{"@attributes"};

                $Res->Reservation->DepartureAirport = $data->Air->Reservation->DepartureAirport->{"@attributes"}->LocationCode;

                $Res->Reservation->ArrivalAirport = $data->Air->Reservation->ArrivalAirport->{"@attributes"}->LocationCode;

                $Res->Reservation->Airline = $data->Air->Reservation->MarketingAirline;
            }
        }

        return $Res;
    }

    private static function _getItineraryPricing($data)
    {
        $Pricing = new \stdClass();

        if(array_key_exists("@attributes", $data))
            if(array_key_exists('ItemRPHList', $data->{"@attributes"}))
                $Pricing->ItemsPRHList = $data->{"@attributes"}->ItemRPHList;

        if(array_key_exists('Cost', $data))
            $Pricing->Cost = self::_getPricingCost($data->Cost);

        if(array_key_exists('Taxes', $data))
            $Pricing->Taxes = self::_getTaxes($data->Taxes);

        return $Pricing;
    }

    private static function _getPricingCost($data)
    {
        $Cost = new \stdClass();

        if(array_key_exists("@attributes", $data))
        {
            if(array_key_exists('AmountBeforeTax', $data->{"@attributes"}))
                $Cost->AmountBeforeTax = $data->{"@attributes"}->AmountBeforeTax;

            if(array_key_exists('AmountAfterTax', $data->{"@attributes"}))
                $Cost->AmountAfterTax = $data->{"@attributes"}->AmountAfterTax;
        }

        return $Cost;
    }

    private static function _getTaxes($data)
    {
        if(array_key_exists("@attribures", $data->Tax))
        {
            return self::_getTax($data->Tax);
        }
        else
        {
            $Taxes = null;

            for($taxID = 0; $taxID < count($data->Tax); $taxID++)
            {
                $Taxes[$taxID] = self::_getTax($data->Tax[$taxID]);
            }

            return $Taxes;
        }
    }

    private static function _getTax($data)
    {
        if(array_key_exists("@attributes", $data))
        {
            $Tax = new \stdClass();

            if(array_key_exists('TaxCode', $data->{"@attributes"}))
                $Tax->Code = $data->{"@attributes"}->TaxCode;

            if(array_key_exists('Amount', $data->{"@attributes"}))
                $Tax->Amount = $data->{"@attributes"}->Amount;

            if(array_key_exists('CurrencyCode', $data->{"@attributes"}))
                $Tax->Currency = $data->{"@attributes"}->CurrencyCode;

            return $Tax;
        }
    }

    private static function _getSpecialRequestDetails($data)
    {

    }

    private static function _getTicketing($data)
    {
        $Ticketing = new \stdClass();

        if(array_key_exists("@attributes", $data))
        {
            if(array_key_exists('TicketingStatus', $data->{"@attributes"}))
                $Ticketing->Status = $data->{"@attributes"}->TicketingStatus;

            if(array_key_exists('TicketTimeLimit', $data->{"@attributes"}))
                $Ticketing->TimeLimit = $data->{"@attributes"}->TicketTimeLimit;
        }

        if(array_key_exists('TicketAdvisory', $data))
            $Ticketing->Advisory = $data->TicketAdvisory;

        return $Ticketing;
    }
}