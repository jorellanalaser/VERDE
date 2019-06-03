<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 24/08/16
 * Time: 04:36 PM
 */

namespace App\Http\Schemas;


use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public $timestamps = false;

    public function passenger()
    {
        return $this->belongsTo( \App\Http\Schemas\Passenger::class );
    }
}