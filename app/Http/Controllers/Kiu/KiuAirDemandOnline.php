<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 28/08/16
 * Time: 01:26 PM
 */

namespace App\Http\Controllers\Kiu;


use App\Http\Controllers\Controller;
use App\Http\Schemas\Booking;
use App\Http\Schemas\Ticket;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Modules\Helpers\Mailer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Modules\Facades\Payments;
use Modules\Helpers\ShoppingCart;
use Modules\Kiu\Support\APIKiu;

class KiuAirDemand extends Controller
{
    public function index(){
        $TravelItinReadRQ =   [
            'UniqueID' => [
                'Type' => '14',
                'ID' => Input::get('booking_ref')
            ]
        ];

        $response = APIKiu::get('TravelerItineraryRead', json_encode($TravelItinReadRQ));

        if(property_exists($response->response, 'Error'))
        {
            return View::make('kiu.error', ['error' => $response->response->Error]);
        }

        $ticketing = \Modules\Helpers\TicketsUtilities::status($response->response);

        if($ticketing->code == 1) {

            $rules = $this->rules();
            $attrs = $this->attributes();

            $v = Validator::make(Input::all(), $rules, [], $attrs);

            if($v->fails())
            {
                return Redirect::route('Kiu.AirBook.GET')->withErrors($v);
            }
            else
            {

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

                            return View::make('kiu.voucher', [
                                'voucher' => $payment->voucher,
                                'passengers' => $booking->passengers()->get()
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
        else
            return Redirect::route('home');
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

    private function rules()
    {
        return [
            //'g-recaptcha-response' => 'required|recaptcha',
            'card_number'   => 'required',
            'cvv' => 'required',
            'aceptTerm'     => 'required',
            'expire'        => 'required'
        ];
    }

    private function attributes()
    {
        return [
            'g-recaptcha-response' => trans('payment.captcha'),
            'card_number'   => trans('payment.card_number'),
            'cvv'           => trans('payment.cvv'),
            'aceptTerm'     => trans('payment.aceptTerm'),
            'expire'        => trans('payment.expire')
        ];
    }
}