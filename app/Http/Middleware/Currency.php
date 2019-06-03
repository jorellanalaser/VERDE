<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Torann\GeoIP\GeoIPFacade as GeoIP;

class Currency
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(!$this->exceptions())
        {
            if(Auth::guest())
            {
                $location = GeoIP::getLocation();

                if (!Session::has('currency'))
                {
                    if ($location['isoCode'] == 'VE')
                        $currency = 'VES';
                    else
                        $currency = 'USD';

                    Session::put('currency', $currency);
                }
            }
            else
            {
                if(!Session::has('currency')) {
                    if (Auth::user()->country->iso2 == 've')
                        $currency = 'VES';
                    else
                        $currency = 'USD';

                    Session::put('currency', $currency);
                }
            }
        }
        else
        {
            $config = Config::get('odavila.location_exception');
            Session::put('currency', $config[ request()->ip() ]);
        }


        return $next($request);
    }

    public function exceptions()
    {
        return (array_key_exists(request()->ip(), Config::get('odavila.location_exception')))
            ? true
            : false;
    }
}
