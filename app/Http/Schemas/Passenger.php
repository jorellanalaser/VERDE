<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 24/08/16
 * Time: 05:18 PM
 */

namespace App\Http\Schemas;


use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    public $timestamps = false;

    public function booking()
    {
        return $this->belongsTo( \App\Http\Schemas\Booking::class );
    }

    public function ticket()
    {
        return $this->hasOne( \App\Http\Schemas\Ticket::class );
    }
}