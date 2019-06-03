<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 29/10/15
 * Time: 10:43 AM
 */

namespace Modules\Kiu\TravelItineraryRead;


class CustomerInfosGetter
{

    public static function get($data)
    {
        $Customer = self::_getCustomerInfos($data);

        return $Customer;
    }

    private static function _getCustomerInfos($data)
    {
        if(array_key_exists('CustomerInfo', $data))
        {
            if(array_key_exists('@attributes', $data->CustomerInfo))
                return self::_getCustomerInfo($data->CustomerInfo);

            else
                return self::_getCustomersInfo($data->CustomerInfo);
        }
    }

    private static function _getCustomersInfo($data)
    {
        $CustomersInfo = null;

        for($ciID = 0; $ciID < count($data); $ciID++)
        {
            $CustomersInfo[$ciID] = self::_getCustomerInfo($data[$ciID]);
        }

        return $CustomersInfo;
    }

    private static function _getCustomerInfo($data)
    {
        $CustomerInfo = new \stdClass();

        if(array_key_exists("@attributes", $data))
            if(array_key_exists('RPH', $data->{"@attributes"}))
                $CustomerInfo->RPH = $data->{"@attributes"}->RPH;

        if(array_key_exists('Customer', $data))
            $CustomerInfo->Customer = self::_getCustomer($data->Customer);

        return $CustomerInfo;
    }

    private static function _getCustomer($data)
    {
        $Customer = new \stdClass();

        if(array_key_exists("@attributes", $data))
            $Customer->Type = $data->{"@attributes"}->PassengerTypeCode;

        if(array_key_exists('PersonName', $data))
            $Customer->PersonName = self::_getCustomerPersonName($data->PersonName);

        if(array_key_exists('Document', $data))
            $Customer->Document = self::_getCustomerDocument($data->Document);

        if(array_key_exists('ContactPerson', $data))
            $Customer->ContactPerson = self::_getCustomerContactPerson($data->ContactPerson);

        return $Customer;
    }

    private static function _getCustomerPersonName($data)
    {
        $PersonName = new \stdClass();

        if(array_key_exists('Surname', $data))
            $PersonName->Surname = $data->Surname;

        if(array_key_exists('GivenName', $data))
            $PersonName->GivenName = $data->GivenName;

        return $PersonName;
    }

    private static function _getCustomerDocument($data)
    {
        if(array_key_exists("@attributes", $data))
        {
            $Document = new \stdClass();

            if(array_key_exists('DocType', $data->{"@attributes"}))
                $Document->Type = $data->{"@attributes"}->DocType;

            if(array_key_exists('DocID', $data->{"@attributes"}))
                $Document->ID = $data->{"@attributes"}->DocID;

            return $Document;
        }
    }

    private static function _getCustomerContactPerson($data)
    {
        $ContactPerson = new \stdClass();

        foreach($data as $key => $value)
        {
            if($key == 'Telephone')
                $ContactPerson->Tlf = $value;

            if($key == 'Email')
                $ContactPerson->Email = $value;
        }

        return $ContactPerson;
    }
}