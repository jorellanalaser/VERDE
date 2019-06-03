<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use  Torann\GeoIP\GeoIPFacade as GeoIP;

class Locale
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
        $location = GeoIP::getLocation();

        if($location['isoCode'] == 'VE')
            $lang = 'es';
        else
            $lang = 'en';

        if(!Session::has('locale'))
        {
            Session::put('locale', $lang);
        }

        app()->setLocale(Session::get('locale'));

        return $next($request);
    }
}
