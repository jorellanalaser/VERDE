<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 24/10/15
 * Time: 01:41 PM
 */

namespace Modules\Kiu\AirBook;

use Modules\Kiu\InfoGetters\Itinerary;

class KIU_AirBookRS
{

    public function __construct($data)
    {
        $this->_data = $data;

        $this->AirBook = new \stdClass();

        $this->_organize();
    }

    public function getAirBook()
    {
        return $this->AirBook;
    }

    private function _organize()
    {
        foreach($this->_data as $key => $value)
        {
            if($key == '@attributes')
            {
                $this->_attr_identifier($value, $this->AirBook);
            }
            elseif($key == 'AirItinerary')
            {
                $this->_getItinerary($this->_data->AirItinerary, $this->AirBook);
            }
            elseif($key == 'TravelerInfo')
            {
                $this->_getTravelers($this->_data->TravelerInfo, $this->AirBook);
            }
            elseif($key == 'BookingReferenceID')
            {
                $this->_getBookingRefID($this->_data->BookingReferenceID, $this->AirBook);
            }
            elseif($key == 'Error')
            {
                $this->_getError($value, $this->AirBook);
            }
        }
    }

    private function _getItinerary($data, $Obj)
    {
        if(array_key_exists('OriginDestinationOptions', $data))
        {
            $Itinerary = new Itinerary($data->OriginDestinationOptions);

            $Obj->Itinerary = $Itinerary->get();
        }
    }

    private function _getTravelers($data, $Obj)
    {
        if(array_key_exists('AirTraveler', $data)) {
            // Solo un Pasajero
            if (array_key_exists('@attributes', $data->AirTraveler))
                $Obj->Traveler = $this->_getAirTraveler($data->AirTraveler);
            // Mas de un pasajero
            else
                $Obj->Traveler = $this->_getAirTravelers($data->AirTraveler);
        }
    }

    private function _getAirTravelers($data)
    {
        for($travelerID = 0; $travelerID < count($data); $travelerID++)
        {
            $Travelers[$travelerID] = $this->_getAirTraveler($data[$travelerID]);
        }

        return $Travelers;
    }

    private function _getAirTraveler($data)
    {
        $Traveler = new \stdClass();

        if(array_key_exists('@attributes', $data))
        {
            if(array_key_exists('BirtfDate', $data->{"@attributes"}))
                $Traveler->BirtfDate = $data->{"@attributes"}->BirtfDate;

            if(array_key_exists('PassengerTypeCode', $data->{"@attributes"}))
                $Traveler->PassengerType = $data->{"@attributes"}->PassengerTypeCode;
        }

        if(array_key_exists('PersonName', $data))
        {
            $Traveler->PersonName = $this->_getPersonName($data->PersonName);
        }

        if(array_key_exists('Telephone', $data))
        {
            // un tlf
            if(array_key_exists("@attributes", $data->Telephone))
                $Traveler->Telephone = $this->_getTelephone($data->Telephone);
            else
                $Traveler->Telephone = $this->_getTelephones($data->Telephone);
        }

        if(array_key_exists('Address', $data))
            $Traveler->Address = $this->_getAddress($data->Address);

        if(array_key_exists('Email', $data))
            $Traveler->Email = $data->Email;

        if(array_key_exists('Document', $data))
        {
            // Un documento de identificacion
            if(array_key_exists("@attributes", $data->Document))
                $Traveler->Document = $this->_getDocument($data->Document);
            else
                $Traveler->Document = $this->_getDocuments($data->Document);
        }

        if(array_key_exists('TSAInfo', $data))
            $Traveler->TSAInfo = $this->_getTSAInfo($data->TSAInfo);

        if(array_key_exists('TravelerRefNumber', $data))
            $Traveler->RefNumber = $data->TravelerRefNumber->{"@attributes"}->RPH;

        return $Traveler;
    }

    private function _getPersonName($data)
    {
        $PersonName = new \stdClass();

        if(array_key_exists('NamePrefix', $data))
            $PersonName->NamePrefix = $data->NamePrefix;

        if(array_key_exists('GivenName', $data))
            $PersonName->GivenName = $data->GivenName;

        if(array_key_exists('MiddleName', $data))
            $PersonName->MiddleName = $data->MiddleName;

        if(array_key_exists('Surname', $data))
            $PersonName->Surname = $data->Surname;

        return $PersonName;
    }

    private function _getTelephones($data)
    {
        for($tlfID = 0; $tlfID < count($data); $tlfID++)
        {
            $Tlf[$tlfID] = $this->_getTelephone($data[$tlfID]);
        }

        return $Tlf;
    }

    private function _getTelephone($data)
    {
        if(array_key_exists("@attributes", $data))
        {
            $Tlf = new \stdClass();

            if(array_key_exists('AreaCityCode', $data->{"@attributes"}))
                $Tlf->AreaCityCode = $data->{"@attributes"}->AreaCityCode;

            if(array_key_exists('PhoneNumber', $data->{"@attributes"}))
                $Tlf->PhoneNumber =  $data->{"@attributes"}->PhoneNumber;

            return $Tlf;
        }
    }

    private function _getAddress($data)
    {
        $Address = new \stdClass();

        if(array_key_exists('AddressLine', $data))
            $Address->AddressLine = $data->AddressLine;

        if(array_key_exists('CityName', $data))
            $Address->City = $data->CityName;

        if(array_key_exists('PostalCode', $data))
            $Address->PostalCode = $data->PostalCode;

        if(array_key_exists('StateProv', $data))
            $Address->StateProv = $data->StateProv;

        if(array_key_exists('CountryName', $data))
            $Address->Country = $data->CountryName;

        return $Address;
    }

    private function _getDocuments($data)
    {
        for($docID = 0; $docID < count($data); $docID++)
        {
            $Doc[$docID] = $this->_getDocument($data[$docID]);
        }

        return $Doc;
    }

    private function _getDocument($data)
    {
        if(array_key_exists("@attributes", $data))
        {
            $Doc = new \stdClass();

            $Doc->Type = $data->{"@attributes"}->DocType;

            $Doc->ID = $data->{"@attributes"}->DocID;

            return $Doc;
        }
    }

    private function _getTSAInfo($data)
    {
        $TSAInfo = new \stdClass();

        if(array_key_exists('BirtfDate', $data))
            $TSAInfo->BirtfDate = $data->BirtfDate;

        if(array_key_exists('Gender', $data))
            $TSAInfo->Gender = $data->Gender;

        if(array_key_exists('DocExpireDate', $data))
            $TSAInfo->DocExpire = $data->DocExpireDate;

        if(array_key_exists('DocIssueCountry', $data))
            $TSAInfo->DocCountry = $data->DocIssueCountry;

        if(array_key_exists('BirthCountry', $data))
            $TSAInfo->BithCountry = $data->BirthCountry;

        if(array_key_exists('TSADocType', $data))
            $TSAInfo->DocType  = $data->TSADocType;

        if(array_key_exists('TSADocID', $data))
            $TSAInfo->DocID = $data->TSADocID;

        return $TSAInfo;
    }

    private function _getBookingRefID($data, $Obj)
    {
        if(array_key_exists("@attributes", $data))
        {
            $Obj->BookingRef = new \stdClass();

            $Obj->BookingRef->Type = $data->{"@attributes"}->Type;

            $Obj->BookingRef->ID = $data->{"@attributes"}->ID;
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