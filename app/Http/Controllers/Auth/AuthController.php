<?php

namespace App\Http\Controllers\Auth;

use App\Http\Schemas\Country;
use Modules\Helpers\Mailer;
use App\Http\Schemas\Contact;
use App\Http\Schemas\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\Helpers\ShoppingCart;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'gender' => 'required',
            'address' => 'required|max:255',
            'phone' => 'required',
            'dni' => 'numeric',
            'dni2' => 'required|numeric',
            'exp_date' => 'required',
            'dni_type' => 'required',
            'BirtfDate' => 'required',
            'country'   => 'required',
            'marketing'   => 'required',
        ],[], ['dni' => trans('register.dni')]);
    }

    /**
     * Override laramel method
     */
    public function logout()
    {
        ShoppingCart::clear();

        Auth::guard($this->getGuard())->logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'first_name' => ucwords(strtolower( $data['first_name'] )),
            'last_name' => ucwords(strtolower( $data['last_name'] )),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'address' => $data['address'],
            'dni_type' => $data['dni_type'],
            'dni' => empty($data['dni']) ? '99' : $data['dni'],
            'dni2' => $data['dni2'],
            'exp_date' => $data['exp_date'],
            'BirtfDate' => $data['BirtfDate'],
            'gender' => $data['gender'],
            'confirmed' => true,
            'confirmation_token' => csrf_token(),
            'banned' => false,
            'country_id' => $data['country'],
            'marketing' => $data['marketing']
        ]);

        $phone = new Contact();
        $phone->type = 'phone';
        $phone->contact = $data['phone'];
        $phone->verified = false;

        $user->contacts()->save( $phone );

        // Send mail
        Mailer::newUser($user);

        return $user;
    }

    private function mail($user)
    {
        try {
            Mail::queue('emails.register', ['user' => $user], function ($m) use ($user) {
                $m->to($user->email, $user->first_name)->subject(trans('emails.register.subject'));
            });
        }
        catch (\Exception $e)
        {
            if (env(APP_DEBUG) === true)
                dd($e);
            else
                Log::error($e);
        }
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $countries = Country::all();

        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }

        return view('auth.register', ['countries' => $countries]);
    }
}
