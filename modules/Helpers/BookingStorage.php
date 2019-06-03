<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 24/08/16
 * Time: 04:22 PM
 */

namespace Modules\Helpers;


use App\Http\Schemas\Booking;
use App\Http\Schemas\Itinerary;
use App\Http\Schemas\Passenger;
use App\Http\Schemas\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BookingStorage
{
    private $data = null;

    private $user;

    private $booking;

    private $price;

    public function __construct($_data, $_price)
    {
        $this->data = $_data;

        $this->price = $_price;

        $this->user = User::findOrFail( Auth::user()->id );
    }

    public function save()
    {
        if(!is_null($this->data))
        {
            // Booking
            $this->booking();

            // Itineraries
            $this->itineraries();

            // Travelers
            $this->travelers();

            return $this->booking;
        }
    }

    /**
     * Save booking into database
     */
    private function booking()
    {
        if(property_exists($this->data, 'BookingRef'))
        {
            $booking = new Booking();
            $booking->booking_ref = $this->data->BookingRef->ID;
            $booking->status = 'booking';
            $booking->amount = $this->price->PricedInfo->ItinTotalFare->TotalFare->Amount;
            $booking->currency = Session::get('currency');

            $this->user->booking()->save($booking);

            $this->booking = $booking;
        }
    }

    /**
     * Save itineraries into database
     */
    private function itineraries()
    {
        if(property_exists($this->data, 'Itinerary'))
        {
            // Recorre itinerarios
            foreach ($this->data->Itinerary as $itinerary) {
                // Recorre segmentos
                foreach ($itinerary as $segment) {
                    if(!is_null($this->booking))
                    {
                        $itin = new Itinerary();
                        $itin->flight_number = $segment->FlightNumber;
                        $itin->origin = $segment->DepartureAirport;
                        $itin->destination = $segment->ArrivalAirport;
                        $itin->departure_datetime = $segment->DepartureDateTime;
                        $itin->arrival_datetime = $segment->ArrivalDateTime;
                        $itin->booking_class = $segment->BookingClass;

                        $this->booking->itineraries()->save($itin);
                    }
                }
            }
        }
    }

    private function travelers()
    {
        if(property_exists($this->data, 'Traveler'))
        {
            if(is_array($this->data->Traveler))
            {
                foreach ($this->data->Traveler as $traveler)
                {
                    $this->traveler($traveler);
                }
            }
            else
                $this->traveler($this->data->Traveler);
        }
    }

    private function traveler($_traveler)
    {
        if(!is_null($_traveler))
        {
            $traveler = new Passenger();
            $traveler->first_name = $_traveler->PersonName->GivenName;
            $traveler->last_name = $_traveler->PersonName->Surname;
            $traveler->doc_type = $_traveler->Document->Type;
            $traveler->doc_id = $_traveler->Document->ID;
            $traveler->pax_type = $_traveler->PassengerType;

            $this->booking->passengers()->save($traveler);
        }
    }
}