@extends('layouts.simplepage')

@section('content')
    <div class="container">
        <div class="row row-bottom-padded-lg" id="about-us">
            <div class="col-md-3"></div>
            <div class="col-md-6" style="margin-top: 2%;">
                @if(property_exists($booking, 'ItineraryRef'))
                    <div class="row">
                        <div class="col-xs-6">
                            <b>@lang('kiu.itineraries.booking'):</b> <div class="label label-default">{{ $booking->ItineraryRef->ID }}</div>
                        </div>
                        <div class="col-xs-6">
                            <?php
                                $ticketing = \Modules\Helpers\TicketsUtilities::status($booking);
                            ?>
                            <b>@lang('kiu.itineraries.status.title'):</b>
                            @if($ticketing->code == 1)
                                <div class="label label-info">{{ $ticketing->status }}</div>
                            @elseif($ticketing->code == 3)
                                <div class="label label-success">{{ $ticketing->status }}</div>
                            @else
                                <div class="label label-danger">{{ $ticketing->status }}</div>
                            @endif
                        </div>
                    </div>
                @endif

                @if(property_exists($booking, 'ItineraryInfo'))
                    @if(property_exists($booking->ItineraryInfo, 'Items'))
                        <br/>
                        <div class="row">
                            <div class="container">
                                <table class="col-md-6 col-xs-12">
                                    @if(is_array($booking->ItineraryInfo->Items))

                                        @foreach($booking->ItineraryInfo->Items as $item)
                                            
                                            @include('kiu.ticketing.itinerary', ['item' => $item->Reservation])
                                        @endforeach
                                    @else

                                        @include('kiu.ticketing.itinerary', ['item' => $booking->ItineraryInfo->Items->Reservation])
                                    @endif
                                </table>
                            </div>
                        </div>
                    @endif
                @endif

                
                @if(property_exists($booking, 'ItineraryInfo'))
                    @if(property_exists($booking->ItineraryInfo, 'Pricing'))
                        <br/>
                        <div class="row">
                            <div class="col-md-12">
                                @include('kiu.ticketing.fare', ['pricing' => $booking->ItineraryInfo->Pricing])
                            </div>
                        </div>
                    @endif
                @endif
                

                @if(property_exists($booking, 'CustomerInfo'))
                    <br>
                    
                        @if(is_array($booking->CustomerInfo))
                            @foreach($booking->CustomerInfo as $passenger)
                                @include('kiu.ticketing.passengers', ['passenger' => $passenger])
                            @endforeach
                        @else
                            @include('kiu.ticketing.passengers', [
                                'passenger' => $booking->CustomerInfo,
                                'ticketing' => $ticketing
                            ])
                        @endif
                   
                @endif

                @if($ticketing->code == 1)
                    {!! Form::open(['route' => 'Kiu.OninePayment']) !!}
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-cotice col-xs-12">@lang('kiu.payment.pay')</button>
                              
                            <div class="div-md-2">
                                <input type="hidden" name="booking_ref" value="{{ $booking->ItineraryRef->ID }}">
                            </div>
                        </div>
                    {!! Form::close() !!}
                @endif
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection