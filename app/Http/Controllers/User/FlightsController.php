<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 2/09/16
 * Time: 09:47 AM
 */

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Schemas\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class FlightsController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::user()->id )
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return View::make('users.flights', ['bookings' => $bookings]);
    }
}