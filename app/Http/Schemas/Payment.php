<?php
/**
 * Created by Sublimetext3.
 * User: Plopez
 * Date: 28/02/17
 * Time: 11:30 PM
 */

namespace App\Http\Schemas;


use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['payment_type', 'status','pan','provider','provider_id','provider_ref','amount','currency','ip'];

    public function booking()
    {
        return $this->belongsTo( \App\Http\Schemas\Booking::class );
    }

    public function errors()
    {
        return $this->hasMany( \App\Http\Schemas\PaymentError::class );
    }
}