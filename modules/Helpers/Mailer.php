<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 26/03/16
 * Time: 09:31 PM
 */

namespace Modules\Helpers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Modules\Kiu\Support\APIKiu;

class Mailer
{
    
    public static function newUser($User)
    {
        try
        {
            $email = new \stdClass();
            $email->title   = 'Confirme su Correo';
            $email->to      = $User->email;
            $email->first_name = $User->first_name;
            $email->verify_link = url('/register/verify') . '/' . $User->confirmation_token;
            $email->locale = App::getLocale();

            Mail::queue('emails.register', ['email' => $email], function ($m) use ($email) {
                $m->to($email->to)->subject(trans('emails.register.subject', [], 'message', $email->locale));
            });
            
            return true;
        }
        catch (\Swift_TransportException $e)
        {
            return $e->getMessage();
        }

    }

    public static function passwordUpdate($user)
    {

        $email = new \stdClass();
        $email->title = trans('emails.password.update.subject', [], 'message', App::getLocale());
        $email->to = $user->email;
        $email->locale = App::getLocale();

        try
        {
            Mail::queue('emails.passwordUpd', ['email' => $email], function ($m) use ($email) {
                $m->to($email->to)->subject(trans('emails.password.update.subject', [], 'message', $email->locale));
            });

            return true;
        }
        catch (\Swift_TransportException $e)
        {
            return $e->getMessage();
        }
    }

    public static function ticket($voucher, $passengers)
    {
        try
        {
            $email = new \stdClass();
            $email->title = trans('emails.tickets.subject', [], 'message', App::getLocale());
            $email->to = Auth::user()->email;
            $email->first_name = Auth::user()->first_name;
            $email->voucher = $voucher;
            $email->locale = App::getLocale();

            foreach ($passengers as $passenger)
            {
                $TravelItinReadRQ =   [
                    'UniqueID' => [
                        'Type' => '30',
                        'ID' => $passenger->ticket->document_number
                    ]
                ];

                $TravelItinReadRS = APIKiu::get('TravelerItineraryRead', json_encode($TravelItinReadRQ));

                $email->tickets[] = $TravelItinReadRS->response->TicketAdvisory;
            }

            try
            {
                Mail::queue('emails.tickets', ['email' => $email], function ($m) use ($email) {
                    $m->to($email->to)->subject(trans('emails.tickets.subject', [], 'message', $email->locale));
                });

                return true;
            }
            catch (\Swift_TransportException $e)
            {
                return $e->getMessage();
            }
        }catch (\ErrorException $e){}
    }
}