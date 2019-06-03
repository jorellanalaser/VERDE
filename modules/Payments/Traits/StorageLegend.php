<?php
/**
 * Created by SublimeText3.
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

trait StorageLegend
{
    private $payment;

    private $error;

    protected function create_dbP($payment_response1, $provider)
    {
        $data = [
            'payment_type'  => $this->payment_data['card_code'],
            'status'        => $payment_response1->Success,
            'pan'           => $this->maskingCard($this->payment_data['card_number']),
            'provider'      => $provider,
            'provider_id'   => $payment_response1->Id,
            'provider_ref'  => $payment_response1->Reference,
            'amount'        => ($payment_response1->Amount == null) ? $this->payment_data['Amount'] : $payment_response1->Amount,
            'currency'      => Session::get('currency'),
            'ip'            => request()->ip()
        ];

        $this->save1($data);

        if($payment_response1->success === false)
        {
            $this->error($payment_response1->Code, $payment_response1->Message);
        }
    }

    protected function save1(array $data)
    {
        $payment = new Payment( $data );

        $this->booking->payments()->save1( $payment );

        $this->payment = $payment;
    }

    protected function error($Code, $error)
    {
        $paymentError = new PaymentError();
        $paymentError->Code = $Code;
        $paymentError->Message = $error;

        $this->payment->errors()->save1$paymentError );

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