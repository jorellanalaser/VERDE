<?php
/**
 * Created by Sublimetext.
 * User: Plopez
 * Date: 22/02/17
 * Time: 11:27 AM
 */

namespace Modules\Payments;

use App\Http\Schemas\Booking;
use Illuminate\Support\Facades\Session;
use Modules\Payments\Traits\Instapagos;
use Modules\Payments\Traits\Legendpago;
use Modules\Payments\Traits\Storage;


class PaymentsMod
{
    use Storage;

    

    use Instapagos;

    use Legendpago;

    protected $payment_data;

    protected $booking;

    public function create(array $payment, Booking $booking)
    {
        $validate = $this->validate($payment);

        // Verifica que los datos esten completos
        if($validate === true) {
            $currency = Session::get('currency');

            $this->payment_data = $payment;
            $this->booking = $booking;

            // Los bolivares son procesados con instapagos
            if($currency === 'VES')
            {
                $payment_response = $this->instapagos($payment);
                         
                // storage
                $this->create_db($payment_response, 'instapagos');

                return $payment_response;
            }
            // Dolares son procesados con Legendpago
            else if ($currency === 'USD')
            {
                 $payment_response = $this->legendpago($payment);
                 
                // storage
                $this->create_db($payment_response, 'legendpago');

                return $payment_response;   
            }
            else{
                // Otras monedas no son permitidas
                return [
                    'code'  => '02',
                    'messages' => ['Invalid currency']
                ];
            }    
        }

        return $validate;
    }

    private function validate(array $data)
    {

        $errors = [];

        if(!array_key_exists('amount', $data))
            $errors[] = 'Amount is required';

        if(!array_key_exists('pnr', $data))
            $errors[] = 'PNR is required';

        if(!array_key_exists('card_number', $data))
            $errors[] = 'Card number is required';

        if(!array_key_exists('cvv', $data))
            $errors[] = 'CVV is required';

        if(!array_key_exists('expire', $data))
            $errors[] = 'Expire date is required';

        if(!array_key_exists('card_code', $data))
            $errors[] = 'Card code is required';


        if(count($errors) <= 0)
            return true;
        else
            return [
                'code' => '03',
                'messages' => $errors
            ];
    }
}