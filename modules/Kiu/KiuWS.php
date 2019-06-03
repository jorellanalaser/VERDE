<?php

namespace Modules\Kiu;

use Illuminate\Support\Facades\File;
use Modules\Kiu\AirAvail\KIU_AirAvailRQ;
use Modules\Kiu\AirAvail\KIU_AirAvailRS;
use Modules\Kiu\AirBook\KIU_AirBookRS;
use Modules\Kiu\AirDemand\KIU_AirDemandRQ;
use Modules\Kiu\AirDemand\KIU_AirDemandRS;
use Modules\Kiu\AirPrice\KIU_AirPriceRQ;
use Modules\Kiu\AirPrice\KIU_AirPriceRS;
use Modules\Kiu\AirBook\KIU_AirBookRQ;
use Modules\Kiu\TravelItineraryRead\KIU_TravelItineraryReadRQ;
use Modules\Kiu\TravelItineraryRead\KIU_TravelItineraryReadRS;

class KiuWS extends Kiu_DataResolv
{
	public function __construct(){}

	public function get($action, $json)
	{
        $data = json_decode($json);

        // Ejecuta accion indicada
		if($action == 'AirAvail')
		{
			return $this->AirAvail($data);
		}
        else if($action == 'AirPrice')
        {
            return $this->AirPrice($data);
        }
        else if($action == 'AirBook')
        {
            return $this->AirBook($data);
        }
        else if($action == 'AirDemandTicket')
        {
            return $this->AirDemandTicket($data);
        }
        else if($action == 'TravelerItineraryRead')
        {
            return $this->TravelItineraryRead($data);
        }
	}

	private function AirAvail(\stdClass $data)
	{
        $xmlRQ = new KIU_AirAvailRQ($data);

    
        $query = $this->send($xmlRQ->getXml());
//echo '<pre>' . htmlentities($query->xml);exit;   
        $response = new KIU_AirAvailRS($query->obj);
//$this->putFile('AirAvail', $query->obj);
//        $query = $this->getFile('AirAvail');
//
//        $response = new KIU_AirAvailRS($query);  (JCCV)

		$AirAvail = new \stdClass();

		$AirAvail->request = $data;
        $AirAvail->response = $response->getAirAvail();
        //dd($AirAvail);

		return $AirAvail;
	}

    private function AirPrice(\stdClass $Itinerary)
    {
        $xmlRQ = new KIU_AirPriceRQ($Itinerary);

        $query = $this->send($xmlRQ->getXml());
//        echo '<pre>' . htmlentities($query->xml);exit;
        $response = new KIU_AirPriceRS($query->obj);
//$this->putFile('AirPrice', $query->obj);
        /*$query = $this->getFile('AirPrice');
        $response = new KIU_AirPriceRS($query);*/

        $AirPrice = new \stdClass();

        $AirPrice->request  = $Itinerary;
        $AirPrice->response = $response->getAirPrice();
     
        return $AirPrice;
    }

    private function AirBook(\stdClass $data)
    {
        $xmlRQ = new KIU_AirBookRQ($data);

        $query = $this->send($xmlRQ->getXml());

//echo '<pre>' . htmlentities($query->xml);exit;      
//$this->putFile('AirBook', $query->obj); 
        $response = new KIU_AirBookRS($query->obj);

/*$query = $this->getFile('AirBook');

$response = new KIU_AirBookRS($query);*/

        $AirAvail = new \stdClass();

        $AirAvail->request = $data;
        $AirAvail->response = $response->getAirBook();

        return $AirAvail;
    }

    private function TravelItineraryRead(\stdClass $data)
    {
        $xmlRQ = new KIU_TravelItineraryReadRQ($data);
//echo '<pre>' . htmlentities($xmlRQ->getXml());exit;
        $query = $this->send($xmlRQ->getXml());
//echo '<pre>' . htmlentities($query->xml);exit;
        $this->putFile('TravelItineraryRead2', $query->obj);

        $response = new KIU_TravelItineraryReadRS($query->obj, $query->xml);

        /*$query = $this->getFile('TravelItineraryRead');

        $response = new KIU_TravelItineraryReadRS($query);*/

        $TravelItinRead = new \stdClass();

        $TravelItinRead->request    = $data;
        $TravelItinRead->response   = $response->getTravelItinerary();

        return $TravelItinRead;
    }

    private function AirDemandTicket(\stdClass $data)
    {
        $xmlRQ = new KIU_AirDemandRQ($data);

    //echo '<pre>' . htmlentities($xmlRQ->getXml());exit;

        // Query de consulta a KIU
        $query = $this->send($xmlRQ->getXml());
        //$this->putFile('AirDemandTicket2', $query->obj);

        $response = new KIU_AirDemandRS($query->obj);


        // Query de lectura de archivo
        /*$query = $this->getFile('AirDemandTicket');
        
        $response = new KIU_AirDemandRS($query);*/

        $AirDemand = new \stdClass();
        $AirDemand->request = $data;
        $AirDemand->response = $response->getAirDemand();
        
        return $AirDemand;
    }

    private function putFile($name, $content)
    {
        File::put(storage_path() . '/app/' . $name, json_encode($content));
    }

    public function getFile($file)
    {
        $contents = File::get(storage_path() . '/app/' . $file);

        return json_decode($contents);
    }
}