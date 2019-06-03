<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 11/09/16
 * Time: 09:51 AM
 */

namespace App\Http\Schemas;


use Illuminate\Database\Eloquent\Model;

class PaymentError extends Model
{
    public function payment()
    {
        return $this->belongsTo( \App\Http\Schemas\Payment::class );
    }
}