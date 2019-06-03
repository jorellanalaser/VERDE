<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 22/08/16
 * Time: 09:40 AM
 */

namespace App\Http\Controllers\Kiu;


use App\Http\Controllers\Controller;
use App\Http\Schemas\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Modules\Helpers\AirportHelper;
use Modules\Helpers\ShoppingCart;
use Modules\Helpers\Utilities;
use Torann\GeoIP\GeoIPFacade as GeoIP;

class KiuPassengers extends Controller
{
    private $request;
    private $is_int;

    public function __construct()
    {
        // Obtener request
        $this->getFlight();

        $this->middleware('auth');
    }

    public function index()
    {
        if(!is_null($this->request))
        {   
            // Busco IP US para No dejar Comprar
            $userisocountry = GeoIP::getLocation(); //Comentar para Setear
            //$userisocountry = ["isoCode" =>'US',];
            //creo layout
            $layoutInt = $this->layoutInt($userisocountry);

            $dni = $this->clientDNI();

            $countries = Country::all();

            return View::make('kiu.passengers', [
                'dni' => $dni,
                'paxs' => $this->request->AirTravelerAvail,
                'is_int' => $this->is_int,
                'countries' => $countries,
                'userisocountry' => $userisocountry['isoCode'],
                'layoutInt' => $layoutInt
            ]);
        }

        return Redirect::route('home');
    }

    public function shopping_cart()
    {
        if(!is_null($this->request))
        {   
            // Busco IP US para No dejar Comprar
            $userisocountry = GeoIP::getLocation(); //Comentar para Setear
            //$userisocountry = ["isoCode" =>'US',];
            //creo layout
            $layoutInt = $this->layoutInt($userisocountry);

            $dni = $this->clientDNI();

            $countries = Country::all();

            return View::make('kiu.passengers', [
                'paxs' => $this->request->AirTravelerAvail,
                'is_int' => $this->is_int,
                'dni' => $dni,
                'countries' => $countries,
                'userisocountry' => $userisocountry['isoCode'],
                'layoutInt' => $layoutInt
            ]);
        }

        return Redirect::route('home');
    }

    private function getFlight()
    {
        if(!is_null(Input::get('request'))) {
            $this->request = Utilities::decrypt(Input::get('request'));

            // Guarda la compra en la sesion
            ShoppingCart::create($this->request);
        }
        elseif (!is_null(ShoppingCart::get()))
        {
            $cart = ShoppingCart::get();

            $this->request = $cart[0]->data;
        }

        // Verifica si es internacional
        if(!is_null($this->request))
            $this->is_int = $this->is_int();
    }

    private function is_int()
    {
        foreach ($this->request->OriginDestinationInfo as $flight)
        {
            foreach ($flight->Segments as $segment) {
                if(AirportHelper::is_int($segment->DepartureAirport) || AirportHelper::is_int($segment->ArrivalAirport) )
                    return true;
            }
        }

        return false;
    }

    private function clientDNI()
    {
        $dni = '';

        if(Auth::user()->country->iso2 == 've')
            $dni = Auth::user()->dni_type . Auth::user()->dni;
        else
            $dni = Auth::user()->dni;

        return $dni;
    }

        public function layoutInt($userisocountry)
    {   
        $origin = $this->request->OriginDestinationInfo[0]->Segments[0]->DepartureAirport;
        $destino = $this->request->OriginDestinationInfo[0]->Segments[0]->ArrivalAirport;
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
}