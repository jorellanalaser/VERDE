<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 10/09/16
 * Time: 08:37 PM
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Schemas\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class VerifyController extends Controller
{
    public function index($token)
    {
        $user = User::where('confirmation_token', $token)
            ->first();

        if(!is_null($user))
        {
            $user->confirmed = true;
            $user->confirmation_token = null;
            $user->save();

            Session::flash('alert-verification_success', trans('register.verification_success'));

            if(Auth::guest())
                return Redirect::to('/login');
            else
                return Redirect::route('user.dashboard');
        }
        else
        {
            Session::flash('alert-verification_failed', trans('register.verification_failed'));

            if(Auth::guest())
                return Redirect::to('/register');
            else
                return Redirect::route('user.dashboard');
        }
    }
}