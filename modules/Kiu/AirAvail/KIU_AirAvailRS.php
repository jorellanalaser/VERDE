<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 25/09/15
 * Time: 9:55
 */

namespace Modules\Kiu\AirAvail;
use Modules\Kiu\InfoGetters\Itinerary;

/**
 * Construye objeto de respuesta.
 * By Omar Davila
 */
class KIU_AirAvailRS
{
    private $_data;
    private $AirAvail;

    public function __construct($data)
    {
        $this->_data = $data;

        $this->AirAvail = new \stdClass();

        $this->_organize($this->AirAvail);

       //dd($data);
    }

    public function getAirAvail()
    {   
        return $this->AirAvail;

    }

    private function _organize($Obj)
    {

        if($this->_data !== false) {
            foreach ($this->_data as $key => $value) {

                if ($key == '@attributes') {
                    $this->_attr_identifier($value, $Obj);
                } elseif ($key == 'OriginDestinationInformation') {
                    $this->_getOriginDestinationInformations($this->_data, $Obj);
                } elseif ($key == 'Error') {
                    $this->_getError($value, $Obj);
                }
                
            }
        }
    }

    /**
     * Recorrio de los dias consultados
     * @param $data
     */
    private function _getOriginDestinationInformations($data, $Obj)
    {
        if(array_key_exists('DepartureDateTime', $data->OriginDestinationInformation))
        {
            // Crea Objeto Itinerary
            $Obj->Itineraries[0] = $this->_getOriginDestinationInformation($data->OriginDestinationInformation);
        }
        else
        {
            for($dayID = 0; $dayID < count($data->OriginDestinationInformation); $dayID++)
            {
                // Crea Objeto Itinerary
                $Obj->Itineraries[$dayID] = $this->_getOriginDestinationInformation($data->OriginDestinationInformation[$dayID]);
            }
        }

        //dd($data);

    }

    private function _getOriginDestinationInformation($data)
    {
        $Obj = new \stdClass();

        $Obj->DepartureDate  = $data->DepartureDateTime;

        $Obj->Origin         = $data->OriginLocation;

        $Obj->Destination    = $data->DestinationLocation;

        if(array_key_exists('OriginDestinationOptions', $data))
        {
            // Instancia Clase Itinerary
            $Itinerary = new Itinerary($data->OriginDestinationOptions);

            // Obtiene Itinerario del dia indicado
            $Obj->Flights = $Itinerary->get();
        }
        //dd($data);
        return $Obj;
    }

    /**
     * Obtiene cabecera de la respuesta.
     * Agrega los datos al objeto de respuesta.
     */
    private function _attr_identifier($data, $Obj)
    {
        if(array_key_exists('EchoToken', $data))
        {
            $Obj->Common = new \stdClass();

            $Obj->Common = $data;
        }

        //dd($data);
        return null;
    }

    /**
     * Obtiene datos de error en consulta.
     * Agrega los datos al objeto de respuesta.
     * @param $data
     * @param $Obj
     */
    private function _getError($data, $Obj)
    {
        $Obj->Error = $data;
    }    
}