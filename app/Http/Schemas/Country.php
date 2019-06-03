<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 17/09/16
 * Time: 09:29 PM
 */

namespace App\Http\Schemas;


use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function users()
    {
        return $this->hasMany( \App\Http\Schemas\Country::class );
    }
}