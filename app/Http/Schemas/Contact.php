<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 20/08/16
 * Time: 11:22 PM
 */

namespace App\Http\Schemas;


use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function user()
    {
        return $this->belongsToMany( \App\Http\Schemas\User::class );
    }
}