<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 31/08/16
 * Time: 10:14 PM
 */

namespace App\Http\Controllers\Kiu;


use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Modules\Kiu\Support\APIKiu;
use Modules\Helpers\Utilities;

class KiuItineraryRead extends Controller
{
    public function index($ticket)
    {
        // Validar que usuario autenticado sea dueño de los tickets

        $TravelItinReadRQ =   [
            'UniqueID' => [
                'Type' => '30',
                'ID' => $ticket
            ]
        ];

        $TravelItinReadRS = APIKiu::get('TravelerItineraryRead', json_encode($TravelItinReadRQ));

        echo html_entity_decode($TravelItinReadRS->response->TicketAdvisory);
    }

    public function getBooking()
    {   
        // Busco IP US para No dejar Comprar
            //$userisocountry = GeoIP::getLocation(); //Comentar para Setear
            //$userisocountry = ["isoCode" =>'VE',];
            //dd($userisocountry);

        // Validar que usuario autenticado sea dueño de los tickets

        $TravelItinReadRQ =   [
            'UniqueID' => [
                'Type' => '14',
                'ID' => Input::get('code')
            ]
        ];

        $TravelItinReadRS = APIKiu::get('TravelerItineraryRead', json_encode($TravelItinReadRQ));
        
        $booking_user=Utilities::booking_user(Input::get('code'), Auth::user()->id);
        
        if(property_exists($TravelItinReadRS->response, 'Error'))
        {
            return View::make('kiu.error', ['error' => $TravelItinReadRS->response->Error]);
        }
        if ($booking_user)
        {
            return View::make('kiu.ticketing.ticketInfo', ['booking' => $TravelItinReadRS->response]);
        }
        else
        {
            return View::make('kiu.error2');
        }
    }
    public function pdf($ticket)
    {
        $TravelItinReadRQ =   [
            'UniqueID' => [
                'Type' => '30',
                'ID' => $ticket
            ]
        ];

        $TravelItinReadRS = APIKiu::get('TravelerItineraryRead', json_encode($TravelItinReadRQ));

        $data = $TravelItinReadRS->response->TicketAdvisory;

        $view = View::make('kiu.voucher_pdf', compact('data') )->render();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('double-letter');
        $pdf->loadHTML($view);

        $file_name = $ticket . '_' . Carbon::now()->format('dmYHis');

        return $pdf->download( $file_name . '.pdf');
    }

}