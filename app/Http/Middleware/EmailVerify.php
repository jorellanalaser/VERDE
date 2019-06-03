<?php

namespace App\Http\Middleware;

use App\Http\Schemas\Booking;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EmailVerify
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
        if(!Auth::guest())
        {
            $booking = Booking::where('user_id', Auth::user()->id)->count();

            if (!Auth::user()->confirmed && $booking >= 1) {
                Session::flash('alert-verify', trans('auth.verify'));

                return redirect()->route('user.dashboard');
            }
        }

        return $next($request);
    }
}
