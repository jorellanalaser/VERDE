<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 24/08/16
 * Time: 04:33 PM
 */

namespace App\Http\Schemas;


use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function itineraries()
    {
        return $this->hasMany( \App\Http\Schemas\Itinerary::class );
    }

    public function passengers()
    {
        return $this->hasMany( \App\Http\Schemas\Passenger::class );
    }

    public function payments()
    {
        return $this->hasMany( \App\Http\Schemas\Payment::class );
    }
}