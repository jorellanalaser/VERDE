<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 16/08/16
 * Time: 09:16 PM
 */

namespace App\Http\Controllers\Kiu;


use App\Http\Controllers\Controller;
use App\Http\Schemas\Airport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Modules\Helpers\CurrencyHelper;
use Modules\Kiu\Support\APIKiu;
use Torann\GeoIP\GeoIPFacade as GeoIP;

class KiuAirAvail extends Controller
{
    /**
     * Consulta disponibilidad
     * @return mixed
     */
    public function index()
    {
        $rules = $this->rules();

        // Validar datos
        $v = Validator::make(Input::all(), $rules);

        if($v->fails())
        {
            // Retorna error
            return Redirect::route('home')->withErrors($v)->withInput();
        }
        else
        {
            // Estructura json request
            $data = $this->data_json();

          // Consulta API Kiu
            $rs = APIKiu::get('AirAvail', $data);

            // Busco IP US para No dejar Comprar
            $userisocountry = GeoIP::getLocation(); //Comentar para Setear
            //$userisocountry = ["isoCode" =>'US',];
            //dd($userisocountry);
            // Verifica existencia de error                            
            if(property_exists($rs->response, 'Error'))
            {
                return View::make('kiu.error', [
                    'error' => $rs->response->Error
                ]);
            }
            else
            {   
                $layoutInt = $this->layoutInt($userisocountry);
                //dd($layoutInt);
                // Cambia moneda si el origin del vuelo es internacional
                CurrencyHelper::interceptor($rs->request->Segments[0]->Origin, $rs->request->Segments[0]->Destination);
                // Retorna vuelos encontrados
                return View::make('kiu.itineraries', [
                    'request'   => $rs->request,
                    'itineraries' => $rs->response->Itineraries,
                    'userisocountry' => $userisocountry['isoCode'],
                    'layoutInt' => $layoutInt
                ]);
                
            }
        }
        
    }

    /**
     * Reglas de validacion
     * @return array
     */
    private function rules()
    {
        return [
            'flight_type'   => ['reuired'],
            'origin'    => ['required'],
            'destination' => ['required'],
            'departure_date' => ['required'],
            'adults'    => ['required']
        ];
    }

    private function data_json()
    {
        $_ida = [
            'Origin' => Input::get('origin'),
            'Destination' => Input::get('destination'),
            'DepartureDateTime' => Input::get('departure_date')
        ];

        $ida = $this->OneWayCollector( $_ida );

        $vuelta = null;

        $data = [
            'Airline' => Config::get('odavila.Kiu_Airline'),
            'Segments' => [
                $ida
            ],
            "DirectFlight" =>   "false",
            "MaxStopQuantity" => 2,
            "CabinPref" => "",
            "PassengerData" => [
                "ADT" => Input::get('adults')
            ],
            'CabinPref' => ucwords(Input::get('cabin'))
        ];

        if(!is_null(Input::get('return_date')))
        {
            $_vuelta = [
                'Origin' => Input::get('destination'),
                'Destination' => Input::get('origin'),
                'DepartureDateTime' => Input::get('return_date')
            ];

            $data['Segments'][] = $this->OneWayCollector( $_vuelta );
        }

        return json_encode($data);
    }

    private function OneWayCollector($data)
    {
        $datos = [
            'Origin' => $this->getAirportCode( $data['Origin'] ),
            'Destination'   => $this->getAirportCode( $data['Destination'] ),
            'DepartureDateTime' => $this->strToDate( $data['DepartureDateTime'] )

        ];

        return $datos;
    }

    private function getAirportCode($_airport)
    {
        $airport = Airport::find($_airport);

        if(!is_null($airport))
        {
            return $airport->code;
        }
    }

    private function strToDate($str)
    {
        $Date = Carbon::parse($str);

        return $Date->format('Y-m-d');
    }

    public function layoutInt($userisocountry)
    {   
        $data = $this->data_json();
        $rs = APIKiu::get('AirAvail', $data);
        //Verifico si el Layout es WAA o LASER
            if( ($userisocountry['isoCode']) == 'US')
            {
                if(($rs->request->Segments[0]->Origin) == 'MIA' or ($rs->request->Segments[0]->Destination) == 'MIA')
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
}