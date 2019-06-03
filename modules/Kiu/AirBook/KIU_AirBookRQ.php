<?php
/**
 * Created by SublimeText3.
 * User: plopez
 * Date: 26/04/17
 * Time: 15:34 PM
 */

namespace Modules\Kiu\AirBook;
use Modules\Helpers\AirportHelper;
use Illuminate\Support\Facades\Config;
use Modules\Kiu\Support\Currency;
use Modules\Helpers\SalesUser;

/**
 * Class KIU_AirBookRQ
 * Construye XML de peticion al Webservice de Kiu
 * By Pedro Lòpez
 */
class KIU_AirBookRQ
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
                <KIU_AirBookRQ EchoToken="1" TimeStamp="' . date('c') .'"
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

                <TravelerInfo>
                    ' . $this->_getTravelerInfo() . '
                    ' . $this->_SpecialService() . '
                </TravelerInfo>
                <Ticketing TicketTimeLimit="' . Config::get('odavila.Kiu_TimeLimit') . '" />
                </KIU_AirBookRQ>';
                //dd($xml);
        return $xml;
    }

    private function _SpecialService()
    {
        $string = '
                <SpecialReqDetails>
                    <SpecialServiceRequests>
                       ' . $this->_SpecialServiceRequest($this->_data->TravelerInfo) . '    
                    </SpecialServiceRequests>
                </SpecialReqDetails>
        ';
        return $string;
    }

    private function _SpecialServiceRequest($data)
    {
        if(array_key_exists('AirTraveler', $data))
        {
            $string = ' ';
            
             for ($i = 1; $i <= count($data->AirTraveler); $i++)
             {
                 $string .= '
                         <SpecialServiceRequest ServiceQuantity="1" SSRCode="CKIN" Status="NN" TravelerRefNumberRPHList="0' . $i . '">
                             <Airline Code="' . $this->_data->AirItinerary->OriginDestinationInfo[0]->Segments[0]->Airline . '"/>
                             <Text>PSGR DEBE FIRMAR VOUCHER</Text>
                         </SpecialServiceRequest>
                 ';
             }
            return $string;
        }    
    }

    function _SegmentsFlight()
    {
        $varSegments = $this->_data->AirItinerary->OriginDestinationInfo[0]->Segments;
        end( $varSegments );
        return key( $varSegments );
    } 

    private function _KiuTerminal()
    {
        //AQui Busco en el Formulario Principal el Origen de la pantalla princial y obtengo el ID que identificamos. 
        //$data1 = $this->_data;
        $Origin1 = $this->_data->AirItinerary->OriginDestinationInfo[0]->Segments[0]->DepartureAirport;
        $destination1 = $this->_data->AirItinerary->OriginDestinationInfo[0]->Segments[$this->_SegmentsFlight()]->ArrivalAirport;
        //dd($Origin1); 
        //OriginDestinationInfo
        return SalesUser::KiuTerminal1($Origin1, $destination1);     
    }

    private function _KiuISOCountry()
    {   
        //AQui Busco en el Formulario Principal el Origen de la pantalla princial y obtengo el ID que identificamos. 
        $Origin1 = $this->_data->AirItinerary->OriginDestinationInfo[0]->Segments[0]->DepartureAirport;
        $destination1 = $this->_data->AirItinerary->OriginDestinationInfo[0]->Segments[$this->_SegmentsFlight()]->ArrivalAirport;
        return SalesUser::KiuISOCountry1($Origin1, $destination1);
    }

    private function _getOriginDestinationInformation()
    {
        if(array_key_exists('AirItinerary', $this->_data))
        {
            if(array_key_exists('OriginDestinationInfo', $this->_data->AirItinerary))
            {
                return $this->_getFlights($this->_data->AirItinerary->OriginDestinationInfo);
            }
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

    private  function _getTravelerInfo()
    {
        if(array_key_exists('TravelerInfo', $this->_data))
        {
            return $this->_getAirTraveler($this->_data->TravelerInfo);
        }
    }

    private function _getAirTraveler($data)
    {
        if(array_key_exists('AirTraveler', $data))
        {
            $string = '';

            foreach($data->AirTraveler as $Pax)
            {
                $string .= '<AirTraveler PassengerTypeCode="' . $Pax->PassengerType . '" ' . $this->_getBirthDate($Pax) . '>
                                <PersonName>
                                    ' . $this->_getNamePrefix($Pax) . '
                                    <GivenName>' . strtoupper($Pax->PersonName->GivenName) . '</GivenName>
                                    ' . $this->_getMiddleName($Pax) . '
                                    <Surname>' . strtoupper($Pax->PersonName->Surname) . '</Surname>
                                </PersonName>

                                ' . $this->_getPaxTlf($Pax) . '

                                ' . $this->_getAddress($Pax) . '

                                ' . $this->_getEmail($Pax) . '

                                ' . $this->_getPaxID($Pax) . '

                                ' . $this->_getCustoLoyalty($Pax) . '

                                ' . $this->_getTSAInfo($Pax) . '
                                
                                <TravelerRefNumber RPH="' . $Pax->TravelerRefNumber . '"/>
                            </AirTraveler>
                            ';
            }
            return $string;

        }
    }

    private function _getNamePrefix($Pax)
    {
        if(array_key_exists('NamePrefix', $Pax->PersonName))
            return '<NamePrefix>' . strtoupper($Pax->PersonName->NamePrefix) . '</NamePrefix>';
    }

    private function _getMiddleName($Pax)
    {
        if(array_key_exists('MiddleName', $Pax->PersonName))
            return '<MiddleName>' . strtoupper($Pax->PersonName->MiddleName) . '</MiddleName>';
    }

    private function _getBirthDate($Pax)
    {
        if(array_key_exists('TSAInfo', $Pax))
        {
            return 'BirthDate="' . $Pax->TSAInfo->BirtfDate . '"';
        }
    }

    private function _getTSAInfo($Pax)
    {   
            if(array_key_exists('TSAInfo', $Pax))
            {    
                    $string = '<TSAInfo>
                                    <BirthDate>' . $Pax->TSAInfo->BirtfDate . '</BirthDate>
                                    <Gender>' . $Pax->TSAInfo->Gender . '</Gender>
                                    <DocExpireDate>' . $Pax->TSAInfo->DocExpireDate . '</DocExpireDate>
                                    <DocIssueCountry>' . $Pax->TSAInfo->DocIssueCountry . '</DocIssueCountry>
                                    <BirthCountry>' . $Pax->TSAInfo->BirthCountry .'</BirthCountry>
                                    <TSADocType>' . $Pax->TSAInfo->TSADocType . '</TSADocType>
                                    <TSADocID>' . $Pax->TSAInfo->TSADocID . '</TSADocID>
                                </TSAInfo>'; 
                    return $string;
            }
          return false;
    }

    private function _getPaxTlf($data)
    {
        if(array_key_exists('Telephone', $data))
        {
            $string = '';

            foreach($data->Telephone as $Tlf)
            {
                $string .= '<Telephone AreaCityCode="' . $Tlf->AreaCityCode . '" PhoneNumber="' . $Tlf->PhoneNumber . '"/>';
            }

            return $string;
        }

    }

    private function _getAddress($data)
    {
        if(array_key_exists('Address', $data))
        {
            $string = '<Address>
                            <AddressLine>' . $data->Address->AddressLine . '</AddressLine>
                            <CityName>' . $data->Address->CityName . '</CityName>
                            <PostalCode>' . $data->Address->PostalCode . '</PostalCode>
                            <StateProv>' . $data->Address->StateProv . '</StateProv>
                            <CountryName>' . $data->Address->CountryName . '</CountryName>
                        </Address>';

            return $string;
        }
    }

    private function _getEmail($data)
    {
        if(array_key_exists('Email', $data))
        {
            $string = '<Email>' . $data->Email . '</Email>';

            return $string;
        }
    }

    private function _getPaxID($data)
    {
        if(array_key_exists('Document', $data))
        {
            return '<Document DocID="' . $data->Document->DocID . '" DocType="' . $data->Document->DocType . '"></Document>';
        }
    }

    private function _getCustoLoyalty($data)
    {
        if(array_key_exists('CustoLoyalty', $data))
        {
            $string = '<CustoLoyalty ProgramID="'. $data->CustoLoyalty->ProgramID . '" MembershipID="'. $data->CustoLoyalty->MembershipID . '" />';
        }
    }

}