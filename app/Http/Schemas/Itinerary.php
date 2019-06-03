<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 24/08/16
 * Time: 04:33 PM
 */

namespace App\Http\Schemas;


use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    public $timestamps = false;

    public function booking()
    {
        return $this->belongsTo( \App\Http\Schemas\Booking::class );
    }
}