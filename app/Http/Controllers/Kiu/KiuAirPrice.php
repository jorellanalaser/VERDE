<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 19/08/16
 * Time: 06:55 PM
 */

namespace App\Http\Controllers\Kiu;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Modules\Helpers\AirPriceRQHelper;
use Modules\Helpers\CurrencyHelper;
use Modules\Helpers\Utilities;
use Modules\Kiu\Support\APIKiu;
use Torann\GeoIP\GeoIPFacade as GeoIP;

class KiuAirPrice extends Controller
{
    public function index()
    {
        // Ida y vuelta
        if(array_key_exists('data_vuelta', Input::all()))
        {
            $dataSegments[0] = Utilities::decrypt(Input::get('data_ida'));
            $dataSegments[1] = Utilities::decrypt(Input::get('data_vuelta'));
        }
        else
        {
            // Solo ida
            $dataSegments[0] = Utilities::decrypt(Input::get('data_ida'));
        }

        $request = Utilities::decrypt(Input::get('request'));

        $json_rq = new AirPriceRQHelper();

        $jsonData = $json_rq->data_json($dataSegments, $request->PassengerData->ADT);

        $rs = APIKiu::get('AirPrice', $jsonData);
        
        // Busco IP US para No dejar Comprar
            $userisocountry = GeoIP::getLocation(); //Comentar para Setear
            //$userisocountry = ["isoCode" =>'US',];
            //dd($userisocountry);

        if (property_exists($rs->response, 'Error'))
        {
            return View::make('kiu.error', ['error' => $rs->response->Error]);
        }
        else
        {   //creo layout
            $layoutInt = $this->layoutInt($rs, $userisocountry);
            //dd($layoutInt);
            // Cambia moneda si el origin del vuelo es internacional
            CurrencyHelper::interceptor($rs->request->OriginDestinationInfo[0]->Segments[0]->DepartureAirport, $rs->request->OriginDestinationInfo[0]->Segments[$this->_SegmentsFlight($rs)]->ArrivalAirport);
            
            $amount = $this->getAmountBeforeTaxes($rs->response->Fares);
            //$totaltaxs = array_sum($rs->response->Fares->PricedInfo->ItinTotalFare->Taxes->Tax->Amount);
            //dd($rs);
            if($amount > 0)
            {
                return View::make('kiu.airprice.index', [
                    'request' => $rs->request,
                    'itineraries' => $rs->response->Itinerary->Flights,
                    'fares' => $rs->response->Fares,
                    'userisocountry' => $userisocountry['isoCode'],
                    'layoutInt' => $layoutInt
                ]);

            }
            else
            {
                $error = new \stdClass();

                $error->ErrorCode   = 'Internal error';
                $error->ErrorMsg    = 'ERROR EN COTIZACION';

                return View::make('kiu.error', ['error' => $error]);
            }
        }
    }

    private function getAmountBeforeTaxes($fares)
    {
        if(property_exists($fares, 'PricedInfo'))
        {
            if(property_exists($fares->PricedInfo, 'ItinTotalFare'))
            {
                if(property_exists($fares->PricedInfo->ItinTotalFare, 'BaseFare'))
                {
                    if (property_exists($fares->PricedInfo->ItinTotalFare->BaseFare, 'Amount'))
                    {
                        return $fares->PricedInfo->ItinTotalFare->BaseFare->Amount;
                    }
                }
            }
        }

        return 0;
    }

     public function layoutInt($rs, $userisocountry)
    {   
        $origin = $rs->request->OriginDestinationInfo[0]->Segments[0]->DepartureAirport;
        $destino = $rs->request->OriginDestinationInfo[0]->Segments[0]->ArrivalAirport;
        //Verifico si el Layout es WAA o LASER
            if( ($userisocountry['isoCode']) == 'US')
            {
                if(($origin) == 'MIA' or ($destino) == 'MIA')
                {
                    $layoutInt = 'US';
                    return $layoutInt;      
                }
                else
                {
                    $layoutInt = 'VE';
                    return $layoutInt;  
                }
                return $layoutInt;
            }
            else
            {
                $layoutInt = 'VE'; 
            }
            return $layoutInt;
    }

    function _SegmentsFlight($rs)
    {
        $varSegments = $rs->request->OriginDestinationInfo[0]->Segments;
        end( $varSegments );
        return key( $varSegments );
    } 
}