<?php

namespace App\Http\Schemas;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'address',
        'dni_type',
        'dni',
    	'dni2',
        'dni2_type',
        'BirtfDate',
    	'exp_date',
        'gender',
        'confirmed',
        'confirmation_token',
        'banned',
        'country_id',
        'marketing'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'confirmation_token'
    ];

    public function contacts()
    {
        return $this->hasMany( \App\Http\Schemas\Contact::class );
    }

    public function booking()
    {
        return $this->hasMany( \App\Http\Schemas\Booking::class );
    }

    public function to_blocks()
    {
        return $this->hasMany( \App\Http\Schemas\ToBlock::class );
    }

    public function blacklists()
    {
        return $this->hasMany( \App\Http\Schemas\Blacklist::class );
    }

    public function country()
    {
        return $this->belongsTo( \App\Http\Schemas\Country::class );
    }
}
