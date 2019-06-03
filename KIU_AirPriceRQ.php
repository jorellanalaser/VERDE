<?php
/**
 * Created by SublimeText3.
 * User: Plopez
 * Date: 24/04/17
 * Time: 02:05 PM
 */

namespace Modules\Kiu\AirPrice;

use Illuminate\Support\Facades\Config;
use Modules\Kiu\Support\Currency;
use Modules\Helpers\SalesUser;
use Torann\GeoIP\GeoIPFacade as GeoIP;
use Illuminate\Support\Facades\Input;


/**
 * Construye XML de peticion al Webservice de Kiu
 * By Omar Davila
 */
class KIU_AirPriceRQ
{
    use Currency;

    private $_data;

    public function __construct($data)
    {
        $this->_data = $data;
        //dd($data);
    }

    public function getXML()
    {
        return $this->_xml();
    }

    private function _xml()
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
                <KIU_AirPriceRQ EchoToken="1" TimeStamp="' . date('c') .'"
                    Target="' . Config::get('odavila.Kiu_Target') . '" Version="3.0" SequenceNmbr="1" PrimaryLangID="en-us">

                    <POS>
                        <Source AgentSine="' . Config::get('odavila.Kiu_AgentSine') . '" PseudoCityCode="' . Config::get('odavila.Kiu_PseudoCityCode') . '" ISOCountry="' . $this->_KiuISOCountry() . '"
                        ISOCurrency="' . $this->getCurrency() . '" TerminalID="' . $this->_KiuTerminal() . '">
                            <RequestorID Type="' . Config::get('odavila.Kiu_RequestorIDType') . '"/>
                            <BookingChannel Type="' . Config::get('odavila.Kiu_BookingChannelType') . '"/>
                        </Source>
                    </POS>

                    <AirItinerary>
                        <OriginDestinationOptions>
                            ' . $this->_getOriginDestinationInformation() . '
                        </OriginDestinationOptions>
                    </AirItinerary>
                    <TravelerInfoSummary>
                        <AirTravelerAvail>
                            ' . $this->_getPassengerTypeQuantity() . '
                        </AirTravelerAvail>
                    </TravelerInfoSummary>
                </KIU_AirPriceRQ>';
        //dd($xml);       
        return $xml;
    }

    private function _KiuTerminal()
    {
        //AQui Busco en el Formulario Principal el Origen de la pantalla princial y obtengo el ID que identificamos. 
        $Origin1 = $this->_data->OriginDestinationInfo[0]->Segments[0]->DepartureAirport;
        $destination1 = $this->_data->OriginDestinationInfo[0]->Segments[0]->ArrivalAirport;
        //dd($Origin1);
        return SalesUser::KiuTerminal1($Origin1, $destination1);     
    }

    private function _KiuISOCountry()
    {   
        //AQui Busco en el Formulario Principal el Origen de la pantalla princial y obtengo el ID que identificamos. 
        $Origin1 = $this->_data->OriginDestinationInfo[0]->Segments[0]->DepartureAirport;
        $destination1 = $this->_data->OriginDestinationInfo[0]->Segments[0]->ArrivalAirport;
        return SalesUser::KiuISOCountry1($Origin1, $destination1);
    }

    private function _getOriginDestinationInformation()
    {
        if(array_key_exists('OriginDestinationInfo', $this->_data))
        {
            return $this->_getFlights($this->_data->OriginDestinationInfo);
        }
    }

    private function _getFlights($data)
    {
        $string = '';

        for($flightID = 0; $flightID < count($data); $flightID++)
        {
            $string  .= $this->_getFlight($data[$flightID]);
        }

        return $string;
    }

    private function _getFlight($data)
    {
        $string = '
            <OriginDestinationOption>
                ' . $this->_getSegments($data) . '
            </OriginDestinationOption>
        ';

        return $string;
    }

    private function _getSegments($data)
    {
        $string = '';

        for($segmentID = 0; $segmentID < count($data->Segments); $segmentID++)
        {
            $string .= $this->_getSegment($data->Segments[$segmentID]);
        }

        return $string;
    }

    private function _getSegment($data)
    {
        $string = '
            <FlightSegment DepartureDateTime="' . $data->DepartureDateTime . '" ArrivalDateTime="' . $data->ArrivalDateTime . '"
                FlightNumber="' . $data->FlightNumber . '" ResBookDesigCode="' . $data->ResBookDesigCode . '" >
                <DepartureAirport LocationCode="' . $data->DepartureAirport . '"/>
                <ArrivalAirport LocationCode="' . $data->ArrivalAirport . '"/>
                <MarketingAirline Code="' . $data->Airline . '"/>
            </FlightSegment>
        ';

        return $string;
    }

    private function _getPassengerTypeQuantity()
    {
        $string = '';

        foreach($this->_data->AirTravelerAvail as $Type => $Quantity)
        {
            $string .= '<PassengerTypeQuantity Code="' . $Type . '" Quantity="' . $Quantity . '"/>';
        }

        return $string;
    }
}