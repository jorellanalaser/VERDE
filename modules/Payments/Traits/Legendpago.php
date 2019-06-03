<?php
/**
 * Created by Sublimetext3.
 * User: Plopez
 * Date: 23/02/17
 * Time: 10:29 AM
 */

namespace Modules\Payments\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Modules\Payments\Legendpago\LegendpagoPayment;

trait Legendpago
{
    protected function legendpago($data)
    {
        $legendpago = new LegendpagoPayment(env('LEGENDPAGO_KEY'), env('LEGENDPAGO_PUBLIC_KEY'));

        $cardHolder = Auth::user()->first_name . ' ' . Auth::user()->last_name;

        $expityMonth = substr($data['expire'], 0, 2);
        $expityYear = '20' . substr($data['expire'], 2, 2);

        $payment = $legendpago->payment(
            $data['amount'],
            $data['pnr'],
            $cardHolder,
            Auth::user()->dni,
            $data['card_number'],
            $data['cvv'],
            $expityMonth . '/' . $expityYear,
            '2',
            Request::ip(),
            $data['address1'],
            $data['country'],
            $data['state'],
            $data['city'],
            $data['zipcode'],
            $data['email']
        );
        
        return $payment;
    }
}