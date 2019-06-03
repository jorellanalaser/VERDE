<?php
/**
 * Created by PhpStorm.
 * User: plopez
 * Date: 02/03/17
 * Time: 10:14 AM
 */

namespace Modules\Payments\Traits;


use App\Http\Schemas\Payment;
use App\Http\Schemas\PaymentError;
use App\Http\Schemas\ToBlock;
use App\Http\Schemas\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

trait Storage
{
    private $payment;

    private $error;

    protected function create_db($payment_response, $provider)
    {
        $data = [
            'payment_type'  => $this->payment_data['card_code'],
            'status'        => $payment_response->success,
            'pan'           => $this->maskingCard($this->payment_data['card_number']),
            'provider'      => $provider,
            'provider_id'   => $payment_response->id,
            'provider_ref'  => $payment_response->reference,
            'amount'        => ($payment_response->amount == null) ? $this->payment_data['amount'] : $payment_response->amount,
            'currency'      => Session::get('currency'),
            'ip'            => request()->ip()
        ];

        $this->save($data);

        if($payment_response->success === false)
        {
            $this->error($payment_response->code, $payment_response->message);
        }
    }

    protected function save(array $data)
    {
        $payment = new Payment( $data );

        $this->booking->payments()->save( $payment );

        $this->payment = $payment;
    }

    protected function error($code, $error)
    {
        $paymentError = new PaymentError();
        $paymentError->code = $code;
        $paymentError->message = $error;

        $this->payment->errors()->save( $paymentError );

        $this->error = $paymentError;

        $this->toBlock();
    }

    protected function toBlock()
    {
        $data = [
            'payment'   => $this->payment->id,
            'booking'   => $this->booking->id,
            'error'     => $this->error->id
        ];

        $toBlock = new ToBlock();
        $toBlock->ip = request()->ip();
        $toBlock->value = json_encode( $data );

        $user = User::find(Auth::user()->id);

        $user->to_blocks()->save( $toBlock );
    }

    /**
     * Enmascara tarjeta de credito, retorna BIN y ultimos 4 digitos
     * @param $card
     * @return string 123456******1234
     */
    private function maskingCard($card)
    {
        $ini = substr( $card, 0, 6);

        $end = substr( $card, -4);

        return $ini . '******' . $end;
    }
}