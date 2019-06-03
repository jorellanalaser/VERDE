<?php

namespace App\Console\Commands;

use App\Http\Schemas\Booking;
use Illuminate\Console\Command;
use Modules\Kiu\Support\APIKiu;

class BookingStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza el status de las reservas según el sistema de boleteria';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->bookings();
    }

    private function bookings()
    {
        $bookings = Booking::where('status', 'booking')
            ->get();

        if(count($bookings) > 0)
        {
            foreach ($bookings as $booking)
            {
                $data =   [
                    'UniqueID' => [
                        'Type' => '14',
                        'ID' => $booking->booking_ref
                    ]
                ];

                $kiu = APIKiu::get('TravelerItineraryRead', json_encode($data) );

                $status = $this->getKiuStatus($kiu);

                $this->updater($booking, $status);
            }
        }
    }

    private function getKiuStatus($kiuData)
    {
        if(property_exists($kiuData, 'response'))
            if(property_exists($kiuData->response, 'ItineraryInfo'))
                if (property_exists($kiuData->response->ItineraryInfo, 'Ticketing'))
                    if (property_exists($kiuData->response->ItineraryInfo->Ticketing, 'Status'))
                        return $kiuData->response->ItineraryInfo->Ticketing->Status;

        return false;
    }

    private function updater($booking, $status)
    {
        if($status == 3)
            $booking->status = 'emmited';
        elseif($status == 1)
            $booking->status = 'booking';
        else
            $booking->status = 'cancel';

        $booking->save();
    }
}
