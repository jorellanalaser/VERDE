<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 11/09/16
 * Time: 10:00 AM
 */

namespace App\Http\Schemas;


use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    protected $deletes = ['delete_at'];

    public function user()
    {
        return $this->belongsTo( \App\Http\Schemas\User::class );
    }
}