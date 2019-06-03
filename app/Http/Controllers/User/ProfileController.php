<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 21/08/16
 * Time: 02:45 PM
 */

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Schemas\Contact;
use App\Http\Schemas\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = User::findOrFail( Auth::user()->id );

        return View::make('users.edit_profile', ['user' => $user]);
    }

    public function update()
    {
        $rules = $this->rules();

        $v = Validator::make(Input::all(), $rules);

        if($v->fails())
        {
            return Redirect::route('user.profile.edit')->withErrors($v)->withInput();
        }
        else
        {
            // Update User
            $user = User::findOrFail( Auth::user()->id );
            $user->first_name = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            $user->dni = Input::get('dni');
            $user->dni_type = Input::get('dni_type');
            $user->address = Input::get('address');
            $user->gender = Input::get('gender');
            $user->dni2 = Input::get('dni2');
            $user->dni2_type = Input::get('dni2_type');
            $user->exp_date = Input::get('exp_date');
            $user->BirtfDate = Input::get('BirtfDate');
            $user->save();

            // Update contacts
            $contact_id = Input::get('contact_id');
            $contact_type = Input::get('contact_type');
            $contact = Input::get('contact');

            for ($i = 0; $i < count($contact_id); $i++)
            {
                $_contact = Contact::where( 'id', $contact_id[$i] )
                    ->where('user_id', Auth::user()->id)
                    ->first();

                if(!is_null($_contact))
                {
                    $_contact->type = $contact_type[$i];
                    $_contact->contact = $contact[$i];
                    $_contact->save();
                }
            }

            Session::flash('alert-success', trans('register.edit.success') );

            return Redirect::route('user.profile.edit');
        }
    }

    private function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'gender' => 'required',
            'address' => 'required|max:255',
            'dni_type' => 'required',
            'dni' => 'required|numeric',
            'contact' => 'required',
            'dni2_type' => 'required',
            'dni2' => 'required|numeric',
            'exp_date' => 'required',
            'BirtfDate' => 'required'
        ];
    }
}
