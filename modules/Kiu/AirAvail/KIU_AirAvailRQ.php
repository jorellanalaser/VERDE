<?php
/**
 * Created by PhpStorm.
 * User: plopez
 * Date: 23/03/17
 * Time: 8:21
 */

namespace Modules\Kiu\AirAvail;

use Illuminate\Support\Facades\Config;
use Modules\Helpers\SalesUser;
use Torann\GeoIP\GeoIPFacade as GeoIP;
use App\Http\Schemas\Airport;
use App\Http\Schemas\Booking;
use Modules\Helpers\CurrencyHelper;
use App\Http\Controllers\Kiu\KiuAirAvail;
use Illuminate\Support\Facades\Input;


/**
 * Class KIU_AirAvailRQ
 * Construye XML de peticion al Webservice de Kiu
 * By Omar Davila
*/
class KIU_AirAvailRQ
{
	private $_data;
//    private $_xml;

	public function __construct($data)
	{
		$this->_data = $data;
	}

    public function getXml()
    {
        return $this->_xml();
    }
	private function _xml()
	{
		$xml = '<?xml version="1.0" encoding="UTF-8"?>
				<KIU_AirAvailRQ EchoToken="1" TimeStamp="' . date('c') .'"
					Target="' . Config::get('odavila.Kiu_Target') . '" Version="3.0" SequenceNmbr="1" PrimaryLangID="en-us"
					DirectFlightsOnly="' . $this->_getDirectFlight() . '" MaxResponses="' . Config::get('odavila.Kiu_MaxResponses') . '">

					<POS>
						<Source AgentSine="' . Config::get('odavila.Kiu_AgentSine') . '" TerminalID="' . $this->_KiuTerminal() . '">
						</Source>
					</POS>

					<SpecificFlightInfo>
						<Airline Code="' . $this->_getAirline() . '"/>
					</SpecificFlightInfo>

					' . $this->_getOriginDestinationInformation() . '

					<TravelPreferences MaxStopsQuantity="' . $this->_getMaxStopQuantity() . '">
					   <CabinPref Cabin="' . $this->_getCabin() . '"/>
						</TravelPreferences>

					<TravelerInfoSummary>
						<AirTravelerAvail>
							' . $this->_getPassengerData() . '
						</AirTravelerAvail>
					</TravelerInfoSummary>
				</KIU_AirAvailRQ>';
		//dd($xml);
		// <CabinPref Cabin="' . $this->_getCabin() . '"/>

		return $xml;
	}

	private function _KiuTerminal()
    {	
    	//AQui Busco en el Formulario Principal el Origen de la pantalla princial y obtengo el ID que identificamos. 
    	$Origin1 = Input::get('origin');
    	$destination1 = Input::get('destination');
        return SalesUser::KiuTerminal($Origin1, $destination1);    
    }

    private function _KiuISOCountry()
    {	
    	//AQui Busco en el Formulario Principal el Origen de la pantalla princial y obtengo el ID que identificamos. 
    	$Origin1 = Input::get('origin');
    	$destination1 = Input::get('destination');
        return SalesUser::KiuISOCountry($Origin1, $destination1);    
    }

	private function _getOriginDestinationInformation()
	{
        $string = '';

		foreach($this->_data->Segments as $Segment)
		{
			$Origin			= $this->_getOrigin($Segment);
			$Destination	= $this->_getDestination($Segment);
			$DepartureDate	= $Segment->DepartureDateTime;

			$string .= $this->_getBlockOriginDestInfo($Origin, $Destination, $DepartureDate);
			//dd($string, $Segment);  /* JCCV */
		}

        return $string;
	}

    private function _getBlockOriginDestInfo($origin, $dest, $date)
    {
        $string = '';

        for($i = intval(Config::get('odavila.Kiu_QueryLastDays')); $i <= intval(Config::get('odavila.Kiu_QueryMaxDays')); $i++)
        {
			$new_date = $this->_getDepartureDate($date, $i);

            if(!$new_date->isValid)
                continue;

            $string .= '
                <OriginDestinationInformation>
                    <DepartureDateTime>' . $new_date->getDate . '</DepartureDateTime>
                    <OriginLocation LocationCode="' . $origin . '"/>
                    <DestinationLocation LocationCode="'. $dest .'"/>
                </OriginDestinationInformation>
            ';
		}
		//dd($string);
		//dd($origin, $dest, $date);

        return $string;
    }

	private function _getDirectFlight()
	{
		return $this->_data->DirectFlight;
	}

	private function _getAirline()
	{
		return $this->_data->Airline;
	}

	private function _getDepartureDate($date, $plus)
    {

        if (intval($plus) > 0) {
            $days = '+ ' . $plus;
        } else if (intval($plus) < 0) {
            $days = '- ' . $plus * -1;
        } else {
            $days = 0;
        }

        $timestamp = strtotime($date . $days . ' day');

        $returnDate = date('Y-m-d', $timestamp);

        $today = date('Y-m-d');

        $new_date = new \stdClass();

        if($returnDate < $today)
        {
            $new_date->isValid = false;
        }
        else
            $new_date->isValid = true;

        $new_date->getDate = $returnDate;

		return $new_date;
	}

	private function _getOrigin($Segment)
	{
		return $Segment->Origin;	
	}

	private function _getDestination($Segment)
	{
		return $Segment->Destination;
	}

	private function _getMaxStopQuantity()
	{
		return $this->_data->MaxStopQuantity;
	}

	private function _getCabin()
	{
		return $this->_data->CabinPref;
	}

	private function _getPassengerData()
	{
		$string = '';

		if(is_array($this->_data->PassengerData))
		{
			foreach ($this->_data->PassengerData as $key => $value) {

				$string .= '<PassengerTypeQuantity Code="' . $key . '" Quantity="' . $value . '"/>';
			}
		}

		return $string;
	}

	
}