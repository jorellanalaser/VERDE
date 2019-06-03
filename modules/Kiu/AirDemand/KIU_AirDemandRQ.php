<?php
/**
 * Created by SublimetText2.
 * User: Plopez
 * Date: 14/11/16
 * Time: 09:50 PM
 */

namespace Modules\Kiu\AirDemand;

use Illuminate\Support\Facades\Config;
use Modules\Kiu\Support\Currency;
use Modules\Helpers\AirportHelper;
use Modules\Helpers\SalesUser;
use Torann\GeoIP\GeoIPFacade as GeoIP;
use Modules\Kiu\AirPrice\KIU_AirPriceRQ;

class KIU_AirDemandRQ
{
    use Currency;

    public function __construct($data)
    {
        $this->_data = $data;
        //dd($data);
    }

    public function getXml()
    {
        
        return $this->_xml();
    }

    private function _xml()
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
                <KIU_AirDemandTicketRQ EchoToken="1" TimeStamp="' . date('c') .'"
                Target="' . Config::get('odavila.Kiu_Target') . '" Version="3.0" SequenceNmbr="1" PrimaryLangID="en-us">
                    <POS>
                        <Source AgentSine="' . Config::get('odavila.Kiu_AgentSine') . '" ISOCountry="' . $this->_KiuISOCountry() . '"
                        ISOCurrency="' . $this->getCurrency() . '" TerminalID="' . $this->_KiuTerminal() . '">

                            <RequestorID Type="' . Config::get('odavila.Kiu_RequestorIDType') . '"/>
                            <BookingChannel Type="' . Config::get('odavila.Kiu_BookingChannelType') . '"/>
                        </Source>
                    </POS>
                    <DemandTicketDetail TourCode="' . $this->_getTourCode() . '">
                        <BookingReferenceID ID="' . $this->_getBookingRefID() . '">
                            <CompanyName Code="' . $this->_KiuCompany() . '"/>
                        </BookingReferenceID>
                        ' . $this->_getCommission() . '
                        ' . $this->_getPaymentData() . '
                        <Endorsement Info="' . $this->_getEndorsement() . '"/>
                    </DemandTicketDetail>
                </KIU_AirDemandTicketRQ>';
        dd($xml);
        return $xml;
        
    }

    private function _KiuCompany()
    {
        return AirportHelper::hasLocationCompany($this->_getBookingRefID());    
    }

    private function _KiuTerminal()
    {   
        $Origin1 = AirportHelper::DemandTerminalID($this->_getBookingRefID());
        //dd($Origin1);
        //AQui Busco en el Formulario Principal el Origen de la pantalla princial y obtengo el ID que identificamos. 
        return SalesUser::KiuTerminal1($Origin1['origen'], $Origin1['destino']);      
    }

    private function _KiuISOCountry()
    {   
        $Origin1 = AirportHelper::DemandTerminalID($this->_getBookingRefID());
        //dd($Origin1);
        //AQui Busco en el Formulario Principal el Origen de la pantalla princial y obtengo el ID que identificamos. 
        return SalesUser::KiuISOCountry1($Origin1['origen'], $Origin1['destino']);   
    }

    private function _getBookingRefID()
    {
        if(array_key_exists('BookingRefID', $this->_data))
                return $this->_data->BookingRefID;
    }

    private function _getAirline()
    {   
        
        if(array_key_exists('Airline', $this->_data))
            return $this->_data->Airline;
    }

    private function _getPaymentData()
    {
        if(array_key_exists('PaymentInfo', $this->_data))
        {
            $Payment = '<PaymentInfo ' .
                                    $this->_getPaymentData_Type($this->_data->PaymentInfo) . ' ' .
                                    $this->_getMiscellaneous($this->_data->PaymentInfo) . ' ' .
                                    $this->_getText($this->_data->PaymentInfo) .
                        '> ' .
                            $this->_getCreditCardInfo($this->_data->PaymentInfo) . ' ' .
                            $this->_getAddTax($this->_data->PaymentInfo) . '
                        </PaymentInfo>';

            return $Payment;
        }
    }

    private function _getPaymentData_Type($data)
    {
        if(array_key_exists('PaymentType', $data))
            return 'PaymentType="'. $data->PaymentType . '"';
    }

    private function _getCreditCardInfo($data)
    {
        if(array_key_exists('CreditCardInfo', $data))
        {
            $CardInfo = '<CreditCardInfo';

            if(array_key_exists('CardType', $data->CreditCardInfo))
            {
                $CardInfo .= ' CardType="'. $data->CreditCardInfo->CardType . '"';
            }

            if(array_key_exists('CardCode', $data->CreditCardInfo))
            {
                $CardInfo .= ' CardCode="'. $data->CreditCardInfo->CardCode . '"';
            }

            if(array_key_exists('CardNumber', $data->CreditCardInfo))
            {
                $CardInfo .= ' CardNumber="'. $data->CreditCardInfo->CardNumber . '"';
            }

            if(array_key_exists('SeriesCode', $data->CreditCardInfo))
            {
                $CardInfo .= ' SeriesCode="'. $data->CreditCardInfo->SeriesCode . '"';
            }

            if(array_key_exists('ExpireDate', $data->CreditCardInfo))
            {
                $CardInfo .= ' ExpireDate="'. $data->CreditCardInfo->ExpireDate . '"';
            }

            $CardInfo .= '/>';

            return $CardInfo;
        }
    }

    private function _getMiscellaneous($data)
    {
        if(array_key_exists('MiscellaneousCode', $data))
            return 'MiscellaneousCode="' . $data->MiscellaneousCode . '"';
    }

    private function _getText($data)
    {
        if(array_key_exists('Text', $data))
            return 'Text="' . $data->Text . '"';
    }

    private function _getAddTax($data)
    {
        if(array_key_exists('AddedTax', $data))
            return '<ValueAddedTax VAT="' . $data->AddedTax . '"/>';
    }

    private function _getCommission()
    {
        if(array_key_exists('Commission', $this->_data))
        {
            if(array_key_exists('Percent', $this->_data->Commission) && array_key_exists('CapAmount', $this->_data->Commission))
            {
                return '<Commission Percent="' . $this->_data->Commission->Percent . '" CapAmount="' . $this->_data->Commission->CapAmount . '" />';
            }
        }
    }

    private function _getEndorsement()
    {
        if(array_key_exists('Endorsement', $this->_data))
            return $this->_data->Endorsement;
    }

    private function _getTourCode()
    {
        if(array_key_exists('TourCode', $this->_data))
            return $this->_data->TourCode;
    }
    
}
