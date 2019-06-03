<?php
/**
 * Created by SublimeText3.
 * User: plopez
 * Date: 15/04/17
 * Time: 01:26 PM
 */

namespace App\Http\Controllers\Kiu;

use App\Http\Controllers\Controller;
use App\Http\Schemas\Booking;
use App\Http\Schemas\Ticket;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Modules\Helpers\Mailer;
use Modules\Facades\Payments;
use Modules\Helpers\ShoppingCart;
use Modules\Kiu\Support\APIKiu;
use Modules\Helpers\AirportHelper;
use Torann\GeoIP\GeoIPFacade as GeoIP;

class KiuAirDemand extends Controller
{   
    public $request;

    public function index()
    {    
        if(count(ShoppingCart::getBookingID()) > 0)
        {
            $_bookingID = ShoppingCart::getBookingID()[0]->id;
            $rules = $this->rules($_bookingID);
            $attrs = $this->attributes($_bookingID);
            //dd($rules);
            $v = Validator::make(Input::all(), $rules, [], $attrs);
            
            if($v->fails())
            {  
                return Redirect::route('Kiu.AirBook')->withErrors($v);
            }
            else
            {

                $booking = Booking::findOrFail($_bookingID);
                $payment = $this->payment($booking);

                if($payment == false)
                {
                    //dd('Booking error');
                }
                else
                {

                    // Pago aprobado
                    if($payment->success === true)
                    {
                        // Limpia carro de compras si la compra es correcta
                        ShoppingCart::clearBookingID();

                        $extra = [
                            'cvv' => Input::get('cvv'),
                            'expire' => Input::get('expire'),
                            'code' => Input::get('CardCode'),
                            'card_number' => Input::get('card_number'),
                        ];

                        $tickets = $this->ticketDemand($booking, $extra);

                        if(property_exists($tickets->response, 'Error'))
                        {
                            return View::make('kiu.error', ['error' => $tickets->response->Error]);
                        }
                        else
                        {
                            if(property_exists($tickets->response, 'Tickets'))
                                $this->saveTickets($tickets->response->Tickets, $booking);

                            Mailer::ticket($payment->voucher, $booking->passengers()->get());
                            
                            $booking2 = Booking::findOrFail($_bookingID);
                            $itinerary1 = $booking2->itineraries;
                            //dd($itinerary1);
                            // Busco IP US para No dejar Comprar
                            $userisocountry = GeoIP::getLocation(); //Comentar para Setear
                            //$userisocountry = ["isoCode" =>'US',];
                            $layoutInt = $this->OriginWAA($booking,$userisocountry);                          
                            //dd($layoutInt);
                            return View::make('kiu.voucher', [
                                'voucher' => $payment->voucher,
                                'passengers' => $booking->passengers()->get(),
                                'booking'   => $booking2,
                                'itinerary' => $itinerary1,
                                'userisocountry' => $userisocountry['isoCode'],
                                'layoutInt' => $layoutInt
                            ]); 
                        }
                    }
                    else
                    {
                        return Redirect::route('Kiu.AirBook.GET')->withErrors([$payment->message]);
                    }
                }
            }
        }

        return Redirect::route('home');
    }

   public function OriginWAA($booking,$userisocountry){
        $bookingref = $booking->booking_ref;
        return AirportHelper::OriginWAA($bookingref,$userisocountry);

    }
    
    /**
     * Conecta con merchant de pago (instapagos)
     * @param $booking
     * @return bool|\Modules\Payments\Instapago\datos|void
     */
    private function payment($booking)
    {
        if(!is_null($booking))
        {
            $data = [
                'amount'    => $booking->amount,
                'pnr'       => $booking->booking_ref,
                'card_number' => Input::get('card_number'),
                'cvv'       => Input::get('cvv'),
                'expire'    => Input::get('expire'),
                'card_code' => Input::get('CardCode'),
                'address1'  => Input::get('address1'),
                'country'  => Input::get('country'),
                'state'  => Input::get('state'),
                'city'  => Input::get('city'),
                'zipcode'  => Input::get('zipcode'),
                'email'  => Input::get('email'),


            ];

            $payment = Payments::create($data, $booking);

            return $payment;
        }

        return false;
    }

    private function ticketDemand($booking, array $extra)
    {
        if(!is_null($booking->payments))
        {
            $airDemand = [
                'BookingRefID'  => $booking->booking_ref,
                'Airline'       => Config::get('odavila.Kiu_Airline'),
                'PaymentInfo'   => [
                    'PaymentType' => '5',
                    'CreditCardInfo' => [
                        'CardType'  => '1',
                        'CardCode'  => $extra['code'],
                        'CardNumber'=> $extra['card_number'],
                        'SeriesCode'=> $extra['cvv'],
                        'ExpireDate'=> $extra['expire']
                    ]
                ]
            ];

            $query = json_encode( $airDemand );

            $response = APIKiu::get('AirDemandTicket', $query);

            if(!array_key_exists('Error', $response->response))
            {
                $booking->status = 'emmited';
                $booking->save();
            }

            return $response;
        }
    }

    private function saveTickets($_data, $_booking)
    {
        if(!is_null($_data))
        {
            foreach ($_data as $_ticket)
            {

                $pax = $_booking->passengers()
                    ->where('first_name', $_ticket->Paxs->GivenName)
                    ->where('last_name', $_ticket->Paxs->Surname)
                    ->first();


                $ticket = new Ticket();
                $ticket->document_number = $_ticket->Tkt->TicketNumber;
                $ticket->type = $_ticket->Tkt->Type;
                $ticket->item_number = $_ticket->Tkt->ItemNumber;
                $ticket->amount = $_ticket->Tkt->TotalAmount;
                $ticket->commission_amount = $_ticket->Tkt->CommissionAmount;
                $ticket->passenger_id = $pax->id;

                $ticket->save();
            }
        }
    }

    private function rules($_bookingID)
    {   
        $booking = Booking::findOrFail($_bookingID);
        $contractMia = AirportHelper::hasLocationCompany($booking->booking_ref);
        $currency = $booking->currency;
        
        if($currency == 'USD' && $contractMia == config('odavila.Kiu_CompanyMIA')){
            $rules = [
                        'g-recaptcha-response' => 'required',
                        'card_number'          => 'required',
                        'cvv'                  => 'required',
                        'aceptTerm'            => 'required',
                        'expire'               => 'required',
                        'aceptTermWA'          => 'required',
                        'state'                => 'required',
                        'city'                 => 'required',
                        'address1'             => 'required',
                        'zipcode'              => 'required',
                        'email'                => 'required'
                     ];
        }elseif($currency == 'USD' && $contractMia == config('odavila.Kiu_CompanyVE')){  
                $rules = [
                            'g-recaptcha-response' => 'required',
                            'card_number'          => 'required',
                            'cvv'                  => 'required',
                            'aceptTerm'            => 'required',
                            'expire'               => 'required',
                            'state'                => 'required',
                            'city'                 => 'required',
                            'address1'             => 'required',
                            'zipcode'              => 'required',
                            'email'                => 'required'       
                        ];          
        }elseif($currency == 'VES' && $contractMia == config('odavila.Kiu_CompanyMIA')){  
                $rules = [
                            'g-recaptcha-response' => 'required',
                            'card_number'          => 'required',
                            'cvv'                  => 'required',
                            'aceptTerm'            => 'required',
                            'expire'               => 'required',
                            'aceptTermWA'          => 'required'       
                        ];
        }else{
            $rules = [
                        'g-recaptcha-response' => 'required',
                        'card_number'          => 'required',
                        'cvv'                  => 'required',
                        'aceptTerm'            => 'required',
                        'expire'               => 'required'
                    ];
        }
        return $rules; 
    }

    private function attributes($_bookingID)
    {   
        $booking = Booking::findOrFail($_bookingID);
        $contractMia = AirportHelper::hasLocationCompany($booking->booking_ref);
        $currency = $booking->currency;
        
        if($currency == 'USD' && $contractMia == config('odavila.Kiu_CompanyMIA')){
            $attributes = [
                        'g-recaptcha-response'  => trans('validation.recaptcha'),
                        'card_number'           => trans('payment.card_number'),
                        'cvv'                   => trans('payment.cvv'),
                        'aceptTerm'             => trans('payment.aceptTerm'),
                        'expire'                => trans('payment.expire'),
                        'aceptTermWA'           => trans('payment.aceptTermWA'),
                        'state'                 => trans('payment.state'),
                        'city'                  => trans('payment.city'),
                        'address1'              => trans('payment.address1'),
                        'zipcode'               => trans('payment.zipcode'),
                        'email'                 => trans('payment.email')
                     ];
        }elseif($currency == 'USD' && $contractMia == config('odavila.Kiu_CompanyVE')){  
                $attributes = [
                        'g-recaptcha-response'  => trans('validation.recaptcha'),
                        'card_number'           => trans('payment.card_number'),
                        'cvv'                   => trans('payment.cvv'),
                        'aceptTerm'             => trans('payment.aceptTerm'),
                        'expire'                => trans('payment.expire'),
                        'state'                 => trans('payment.state'),
                        'city'                  => trans('payment.city'),
                        'address1'              => trans('payment.address1'),
                        'zipcode'               => trans('payment.zipcode'),
                        'email'                 => trans('payment.email')       
                        ];                        
        }elseif($currency == 'VES' && $contractMia == config('odavila.Kiu_CompanyMIA')){  
                $attributes = [
                        'g-recaptcha-response'  => trans('validation.recaptcha'),
                        'card_number'           => trans('payment.card_number'),
                        'cvv'                   => trans('payment.cvv'),
                        'aceptTerm'             => trans('payment.aceptTerm'),
                        'expire'                => trans('payment.expire'),
                        'aceptTermWA'           => trans('payment.aceptTermWA')         
                        ];
        }else{
            $attributes = [
                        'g-recaptcha-response'  => trans('validation.recaptcha'),
                        'card_number'           => trans('payment.card_number'),
                        'cvv'                   => trans('payment.cvv'),
                        'aceptTerm'             => trans('payment.aceptTerm'),
                        'expire'                => trans('payment.expire')
                    ];
        }
        return $attributes;
    }
}