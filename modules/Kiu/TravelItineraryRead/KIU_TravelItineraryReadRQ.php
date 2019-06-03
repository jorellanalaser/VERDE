<?php
/**
 * Created by SublimetText3.
 * User: Plopez
 * Date: 27/04/17
 * Time: 09:54 AM
 */

namespace Modules\Kiu\TravelItineraryRead;


use Illuminate\Support\Facades\Config;
use Modules\Helpers\AirportHelper;
use Modules\Helpers\SalesUser;

class KIU_TravelItineraryReadRQ
{
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
                <KIU_TravelItineraryReadRQ EchoToken="1" TimeStamp="' . date('c') .'"
                    Target="' . Config::get('odavila.Kiu_Target') . '" Version="3.0" SequenceNmbr="1" PrimaryLangID="en-us">

                <POS>
                    <Source AgentSine="' . Config::get('odavila.Kiu_AgentSine') . '" TerminalID="' . $this->_KiuTerminal() . '">
                    </Source>
                </POS>

                ' . $this->_getQueryData($this->_data) . '

                ' . $this->_getVerifyEmail($this->_data) . '

                </KIU_TravelItineraryReadRQ>';

        return $xml;
        //dd($xml);
    }

     private function _KiuTerminal()
    {   
        //AQui Busco en el Formulario Principal el Origen de la pantalla princial y obtengo el ID que identificamos.
         $BookingRef = $this->_data->UniqueID->ID;
         $Origin1 = AirportHelper::DemandTerminalID($BookingRef);
        //AQui Busco en el Formulario Principal el Origen de la pantalla princial y obtengo el ID que identificamos. 
        return SalesUser::KiuTerminal1($Origin1['origen'], $Origin1['destino']);       
    }

    private function _getQueryData($data)
    {
        if(array_key_exists('UniqueID', $data))
        {
            return '<UniqueID Type="' . $data->UniqueID->Type . '" ID="' . $data->UniqueID->ID . '" />';
        }
    }

    private function _getVerifyEmaiL($data)
    {
        if(array_key_exists('Email', $data))
        {
            return '<Verification>
                        <Email>' . $data->Email . '</Email>
                    </Verification>';
        }
    }
}