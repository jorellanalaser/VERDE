<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 20/08/16
 * Time: 02:06 PM
 */

namespace App\Http\Controllers\Kiu;


use App\Http\Controllers\Controller;
use App\Http\Schemas\Booking;
use App\Http\Schemas\Contact;
use App\Http\Schemas\Country;
use App\Http\Schemas\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Modules\Helpers\AirportHelper;
use Modules\Helpers\AirPriceRQHelper;
use Modules\Helpers\BookingStorage;
use Modules\Helpers\ShoppingCart;
use Modules\Helpers\Utilities;
use Modules\Kiu\Support\APIKiu;
use Torann\GeoIP\GeoIPFacade as GeoIP;

class KiuAirBook extends Controller
{
    private $request;

    private $request_type;

    private $is_int;

    public function __construct()
    {
        if(!is_null(ShoppingCart::get()))
        {
            $this->request = ShoppingCart::get();
            $this->request_type = 'itinerary';

            $this->is_int = $this->is_int();
        }
        elseif (!is_null(ShoppingCart::getBookingID()))
        {
            $this->request = ShoppingCart::getBookingID();
            $this->request_type = 'storage';
        }
    }

    public function index()
    {
        /*return View::make('kiu.payment', [
            'booking' => Booking::find(11)
        ]);*/

        // Si es mayor a 1 tiene un campo mas que _token
        /*if(count(Input::all()) > 1)
        {
            $rules = $this->rules();
            $messages = $this->messages();
            //dd($rules);
            $v = Validator::make(Input::all(), $rules, $messages);

            if ($v->fails()) {
                return Redirect::route('Kiu.Passengers.ShoppingCart')->withErrors($v)->withInput();
            }
        }*/
        //dd($itinerary);

        if (!is_null($this->request)) {
            $storage = null;
            
            // Lee itinerario y lo procesa
            if($this->request_type == 'itinerary')
            {   

                $itinerary = (array)$this->request[0]->data;
                
                if (!is_null($itinerary)) {

                    $passengers = $this->passengerData($itinerary);
                    $request = [
                        'AirItinerary' => [
                            'OriginDestinationInfo' => $itinerary['OriginDestinationInfo']
                        ],
                        'TravelerInfo' => $passengers
                    ];
                    
                    //Price
                    $price = $this->getPrice();

                    $response = APIKiu::get('AirBook', json_encode($request));
                    //dd($response);
                    // Limpiar carro de compras
                    ShoppingCart::clear();

                    if (property_exists($response->response, 'Error'))
                    {

                        return View::make('kiu.error', ['error' => $response->response->Error]);
                    } else {

                        $booking = new BookingStorage($response->response, $price);
                        $storage = $booking->save();
                    }
                }
            }
            elseif($this->request_type = 'storage')
            {
                // Carga bookind de base de datos
                $bookingID = $this->request[0]->id;
                $storage = Booking::findOrFail($bookingID);
            }
            // Busco IP US para No dejar Comprar
            $userisocountry = GeoIP::getLocation(); //Comentar para Setear
            //$userisocountry = ["isoCode" =>'US',];
            $layoutInt = $this->OriginWAA($storage->booking_ref,$userisocountry);                          
            //dd($layoutInt); 
            // Cargar vista
            if(!is_null($storage))
            {   
                if($storage->status == 'booking') {
                    $countries = Country::all();
                    ShoppingCart::createBookingID($storage->id);

                    return View::make('kiu.payment', [
                        'booking' => $storage,
                        'countries' => $countries,
                        'userisocountry' => $userisocountry['isoCode'],
                        'layoutInt' => $layoutInt
                        
                    ]);
                }
                else
                    
                    return Redirect::to('/');
            }
        }

        return Redirect::route('home');
    }

    private function passengerData($_data)
    {
        $passengers = [];

        for ($i = 0; $i < $_data['AirTravelerAvail']->ADT; $i++) {
            if ($i == 0) {
                // Client

                $tlf = $this->getClientPhone();

                $document = $this->getClientDocument();
                $tsaInfo = $this->getTSAInfo();

                $passengers['AirTraveler'][] = [
                    'PassengerType' => 'ADT',
                    'PersonName' => [
                        'GivenName' => strtoupper( Utilities::elimina_acentos( Auth::user()->first_name ) ),
                        'Surname' => strtoupper( Utilities::elimina_acentos( Auth::user()->last_name ) )
                    ],
                    'Telephone' => $tlf,
                    'Email' => strtoupper( Auth::user()->email ),
                    'Document' => [
                        'DocType' => $document['type'],
                        'DocID' => $document['id']
                    ],
                    'TSAInfo'=> [
                        'BirtfDate' => $tsaInfo['BirtfDate'],
                        'Gender' => $tsaInfo['Gender'],
                        'DocExpireDate' => $tsaInfo['DocExpireDate'],
                        'DocIssueCountry' => $tsaInfo['DocIssueCountry'],
                        'BirthCountry' => $tsaInfo['BirthCountry'],
                        'TSADocType' => $tsaInfo['TSADocType'],
                        'TSADocID' => $tsaInfo['TSADocID']
                    ],
                    'TravelerRefNumber' => '0' . ($i + 1)
                ];
            } else {
                $datos = Input::all();

                 $country = Country::find($datos['country'][$i]);

                if($country->iso2 == 've')
                {
                    $dni_type = 'ID';
                    $dni_prefix = $datos['dni_type'][$i];
                }
                else
                {
                    $dni_type = 'PP';
                    $dni_prefix = null;
                }

                // Passengers extra
                $passengers['AirTraveler'][] = [
                    'PassengerType' => 'ADT',
                    'PersonName' => [
                        'GivenName' => strtoupper( Utilities::elimina_acentos( $datos['first_name'][$i] ) ),
                        'Surname' => strtoupper( Utilities::elimina_acentos( $datos['last_name'][$i] ) )
                    ],
                    'Document' => [
                        'DocType' => $dni_type,
                        'DocID' => $dni_prefix . $datos['dni'][$i]
                    ],
                    'TSAInfo'=> [
                        'BirtfDate' => $datos['BirtfDate'][$i],
                        'Gender' => $tsaInfo['Gender'],
                        'DocExpireDate' => $tsaInfo['DocExpireDate'],
                        'DocIssueCountry' => strtoupper( Utilities::elimina_acentos($country->iso2)),
                        'BirthCountry' => strtoupper( Utilities::elimina_acentos($country->iso2)),
                        'TSADocType' => $tsaInfo['TSADocType'],
                        'TSADocID' => $datos['dni'][$i]
                    ],
                    'TravelerRefNumber' => '0' . ($i + 1)
                ];
            }
        }

        return $passengers;
    }

    private function is_int()
    {
        if(!is_null($this->request)) {
            foreach ($this->request[0]->data->OriginDestinationInfo as $flight) {
                foreach ($flight->Segments as $segment) {
                    if (AirportHelper::is_int($segment->DepartureAirport) || AirportHelper::is_int($segment->ArrivalAirport))
                        return true;

                }
            }
        }
        return false;
        
    }
    
 private function getTSAInfo()
    {
        $TSAInfo = [
            'type' => 'ID',
            'id'   => null,
            'BirtfDate' => null,
            'Gender' => null,
            'DocExpireDate' => null,
            'DocIssueCountry' => null,
            'BirthCountry' => null,
            'TSADocType' => null,
            'TSADocID' => null
        ];

        $country = Country::find(Auth::user()->country_id);

                // Client
                if($this->is_int)
                    {
                        // passport
                        if(Auth::user()->dni2 != '')
                        {
                            $prefix2 = 'PP';

                            if(Auth::user()->country->iso2 == 've')
                                $prefix2 = Auth::user()->dni2_type;

                            $TSAInfo['id'] = $prefix2 . Auth::user()->dni2;
                            $TSAInfo['BirtfDate'] =  Auth::user()->BirtfDate;
                            $TSAInfo['Gender'] =  Auth::user()->gender;
                            $TSAInfo['DocExpireDate'] =  Auth::user()->exp_date;
                            $TSAInfo['DocIssueCountry'] =  strtoupper( Utilities::elimina_acentos($country['iso2']));
                            $TSAInfo['BirthCountry'] =  strtoupper( Utilities::elimina_acentos($country['iso2']));
                            $TSAInfo['TSADocType'] =  'P';
                            $TSAInfo['TSADocID'] =  Auth::user()->dni2;
                        }
                        else
                        {
                            // Set client passport
                            $user = User::find( Auth::user()->id );
                            $user->dni2_type = Input::get('dni2_type');
                            $user->dni2 = Input::get('dni2');
                            $user->BirtfDate = Input::get('BirtfDate');
                            $user->exp_date = Input::get('exp_date');
                            $user->gender = Input::get('gender');
                            $user->save();

                            $TSAInfo['id'] = Input::get('dni2_type') . Input::get('dni2');
                        }
                    }
                    else
                    {
                        $prefix = '';

                        if(Auth::user()->country->iso2 == 've')
                            $prefix = Auth::user()->dni_type;
                        
                            $TSAInfo['id'] = $prefix . Auth::user()->dni2;
                            $TSAInfo['BirtfDate'] =  Auth::user()->BirtfDate;
                            $TSAInfo['Gender'] =  Auth::user()->gender;
                            $TSAInfo['DocExpireDate'] =  Auth::user()->exp_date;
                            $TSAInfo['DocIssueCountry'] =  strtoupper( Utilities::elimina_acentos($country['iso2']));
                            $TSAInfo['BirthCountry'] =  strtoupper( Utilities::elimina_acentos($country['iso2']));
                            $TSAInfo['TSADocType'] =  'P';
                            $TSAInfo['TSADocID'] =  Auth::user()->dni2;
                    }

            return $TSAInfo;         
    }     

    private function getClientPhone()
    {
        $tlfs = [];

        $contacts = Contact::where('user_id', Auth::user()->id)
            ->where('type', 'phone')
            ->get();

        foreach ($contacts as $contact)
        {
            $pattern = "/^\\+(?<country>\\d{1,4})\\ \\((?<company>\\d{3})\\)\\ (?<phone>\\d{7})$/";

            $result = preg_match( $pattern, $contact->contact , $_tlf );

            if($result) {
                $tlfs[] = [
                    "AreaCityCode" => $_tlf['country'] . $_tlf['company'],
                    "PhoneNumber" =>  $_tlf['phone']
                ];
            }
            else
            {
                $country = trim( substr($contact->contact, 0, 3) );
                $company = trim( substr($contact->contact, 5, 3) );
                $phone = trim( substr($contact->contact, 10, 7) );
            }
        }

        return $tlfs;
    }

    private function getClientDocument()
    {
        $document = [
            'type' => 'ID',
            'id'   => null
        ];

        if($this->is_int)
        {
            // passport
            if(Auth::user()->dni != '99')
            {
                $prefix2 = 'PP';

                if(Auth::user()->country->iso2 == 've')
                $document['id'] =  Auth::user()->dni2;
                $document['type'] = 'PP';
            }
            else
            {
                // Set client passport
                $prefix3 = 'VP';
                $prefix4 = 'PP';

                $document['id'] =  Auth::user()->dni2;
                $document['type'] = $prefix4;
            }
        }
        else
        {
            $prefix = '';

            if(Auth::user()->country->iso2 == 've')
            {
                $prefix = 'NI';

                $document['id'] =  Auth::user()->dni;
                $document['type'] = $prefix;

            }
            else
            {
               $prefix = Auth::user()->dni2_type; 
               $document['id'] =  Auth::user()->dni2;
               $document['type'] = $prefix;         
            }
        }

        return $document;
    }

    private function rules()
    {
        $rules = null;

        if($this->request[0]->data->AirTravelerAvail->ADT > 1)
        {
            for ($i = 1; $i < $this->request[0]->data->AirTravelerAvail->ADT; $i++)
            {
                $rules['first_name.' . $i] = 'required';
                $rules['last_name.' . $i] = 'required';
                $rules['dni_type.' . $i] = 'required';
                $rules['dni.' . $i] = 'required';
            }
        }

        return $rules;
    }

    private function messages()
    {
        $messages = [];

        for ($i = 1; $i < $this->request[0]->data->AirTravelerAvail->ADT; $i++)
        {
            $messages['first_name.' . $i . '.required'] = str_replace(':attribute', trans('register.first_name') . ' ' . $i + 1, trans('validation.required'));
            $messages['last_name.' . $i . '.required'] = str_replace(':attribute', trans('register.last_name') . ' ' . $i + 1, trans('validation.required'));
            $messages['dni.' . $i . '.required'] = str_replace(':attribute', trans('register.dni') . ' ' . $i + 1, trans('validation.required'));
        }
        return $messages;
    }

    private function getPrice()
    {
        $_data = $this->request[0]->data;

        $price_rq = new AirPriceRQHelper();
        $jsonData = $price_rq->data_json(
            $_data->OriginDestinationInfo,
            $_data->AirTravelerAvail->ADT
        );

        $rs = APIKiu::get('AirPrice', $jsonData);

        return (property_exists($rs->response, 'Fares')) ? $rs->response->Fares : null;
    }

     public function OriginWAA($booking,$userisocountry){
        $bookingref = $booking;
        return AirportHelper::OriginWAA($bookingref,$userisocountry);
    }
}