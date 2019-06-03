<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 25/09/16
 * Time: 09:51 AM
 */

namespace App\Http\Controllers\Kiu;


use App\Http\Controllers\Controller;
use App\Http\Schemas\Booking;
use App\Http\Schemas\Itinerary;
use App\Http\Schemas\Passenger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Modules\Helpers\ShoppingCart;
use Modules\Kiu\Support\APIKiu;
use Illuminate\Http\Response;

class OnlinePayment extends Controller
{
    public function index()
    {
        $TravelItinReadRQ =   [
            'UniqueID' => [
                'Type' => '14',
                'ID' => Input::get('booking_ref')
            ]
        ];

        $response = APIKiu::get('TravelerItineraryRead', json_encode($TravelItinReadRQ));

        if(property_exists($response->response, 'Error'))
        {
            return View::make('kiu.error', ['error' => $response->response->Error]);
        }

        $ticketing = \Modules\Helpers\TicketsUtilities::status($response->response);

        if($ticketing->code == 1) {
            $booking = $this->searchBooking($response->response->ItineraryRef->ID);

            if(!($booking instanceof Booking))
            {
                $booking = $this->saveBooking($response->response);
                if($booking)
                {
                    $this->saveItineraries($response->response, $booking);

                    $this->saveTravelers($response->response, $booking);
                }
            }

            if($booking instanceof Booking)
            {

                // Verificar si el usuario en session es pasajero en la reserva
                $isPassenger = $this->isPassenger($response->response);
                
                if($isPassenger === true) {

                    ShoppingCart::clear();
                    ShoppingCart::clearBookingID();

                    ShoppingCart::createBookingID($booking->id);

                    return Redirect::route('Kiu.AirBook');
                }
                else
                    return View::make('kiu.nopax');
            }
        }
        else
            return Redirect::to('/');

    }

    private function saveBooking($_booking)
    {
        Session::put('currency', $_booking->ItineraryInfo->Pricing->Taxes[0]->Currency);

        $booking = new Booking();
        $booking->booking_ref = $_booking->ItineraryRef->ID;
        $booking->status = 'booking';
        $booking->amount = $_booking->ItineraryInfo->Pricing->Cost->AmountAfterTax;
        $booking->currency = $_booking->ItineraryInfo->Pricing->Taxes[0]->Currency;
        $booking->description = 'online payment';

        $user = Auth::user();

        $user->booking()->save($booking);

        if($booking instanceof Booking)
            return $booking;
        else
            return false;
    }

    private function saveItineraries($_booking, $booking)
    {
        if(is_array($_booking->ItineraryInfo->Items))
            foreach ($_booking->ItineraryInfo->Items as $_itinerary)
            {
                $this->__saveItinerary($_itinerary, $booking);
            }
        else
            $this->__saveItinerary($_booking->ItineraryInfo->Items, $booking);
    }

    private function __saveItinerary($_itinerary, $booking)
    {
        $itinerary = new Itinerary();
        $itinerary->flight_number = $_itinerary->Reservation->FlightNumber;
        $itinerary->origin = $_itinerary->Reservation->DepartureAirport;
        $itinerary->destination = $_itinerary->Reservation->ArrivalAirport;
        $itinerary->departure_datetime = $_itinerary->Reservation->DepartureDateTime;
        $itinerary->arrival_datetime = $_itinerary->Reservation->ArrivalDateTime;
        $itinerary->booking_class = $_itinerary->Reservation->ResBookDesigCode;
        

        $booking->itineraries()->save( $itinerary );
    }

    private function saveTravelers($_booking, $booking)
    {
        if(is_array($_booking->CustomerInfo))
            foreach ($_booking->CustomerInfo as $_passenger)
            {
                $this->__saveTraveler($_passenger, $booking);
            }
        else
            $this->__saveTraveler($_booking->CustomerInfo, $booking);
    }

    private function __saveTraveler($_passenger, $booking)
    {
        $passenger = new Passenger();
        $passenger->first_name = $_passenger->Customer->PersonName->GivenName;
        $passenger->last_name = $_passenger->Customer->PersonName->Surname;
        $passenger->doc_type = $_passenger->Customer->Document->Type;
        $passenger->doc_id = $_passenger->Customer->Document->ID;
        $passenger->pax_type = $_passenger->Customer->Type;

        $booking->passengers()->save( $passenger );
    }

    private function searchBooking($ref)
    {
        $booking = Booking::where('booking_ref', $ref)
            ->where('status', 'booking')
            ->where('user_id', Auth::user()->id)
            ->first();

        return $booking;
    }

    private function isPassenger($_booking)
    {
        if(is_array($_booking->CustomerInfo))
            foreach ($_booking->CustomerInfo as $_passenger)
            {
                $compare = $this->compare($_passenger->Customer->Document->ID);

                if($compare === true)
                    return true;
            }
        else
            return $this->compare($_booking->CustomerInfo->Customer->Document->ID);

        return false;
    }

    private function compare($id)
    {
        $compare = strpos($id, Auth::user()->dni);

        if($compare === false)
            $compare = strpos($id, Auth::user()->dni2);

        return ($compare === false) ? false : true;
    }
}
