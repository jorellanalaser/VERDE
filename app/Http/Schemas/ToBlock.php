<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 11/09/16
 * Time: 09:58 AM
 */

namespace App\Http\Schemas;


use Illuminate\Database\Eloquent\Model;

class ToBlock extends Model
{
    public function user()
    {
        return $this->belongsTo( \App\Http\Schemas\User::class );
    }
}