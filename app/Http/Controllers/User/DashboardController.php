<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 21/08/16
 * Time: 12:09 AM
 */

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Schemas\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Modules\Helpers\Mailer;

class DashboardController extends Controller
{
    public function index()
    {
        return View::make('users.dashboard');
    }

    public function resendToken()
    {
        $user = User::find( Auth::user()->id );

        Mailer::newUser($user);

        return Redirect::route('user.dashboard');
    }
}