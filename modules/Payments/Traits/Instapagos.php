<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 11/09/16
 * Time: 10:29 AM
 */

namespace Modules\Payments\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Modules\Payments\Instapago\InstapagoPayment;

trait Instapagos
{
    protected function instapagos($data)
    {
        $instapago = new InstapagoPayment(env('INSTAPAGOS_KEY'), env('INSTAPAGOS_PUBLIC_KEY'));

        $cardHolder = Auth::user()->first_name . ' ' . Auth::user()->last_name;

        $expityMonth = substr($data['expire'], 0, 2);
        $expityYear = '20' . substr($data['expire'], 2, 2);

        $payment = $instapago->payment(
            $data['amount'],
            $data['pnr'],
            $cardHolder,
            Auth::user()->dni,
            $data['card_number'],
            $data['cvv'],
            $expityMonth . '/' . $expityYear,
            '2',
            Request::ip()
        );

        return $payment;
    }
}