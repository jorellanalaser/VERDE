@extends($res = ($layoutInt =='US') ? 'waa.simplepage': 'layouts.simplepage')

@section('content')
    <div class="container">
        <div class="row row-bottom-padded-lg" id="about-us">
            <div class="col-md-12 to-animate">
                <div class="col-md-3" style="text-align: center;">
                <p style="text-align: center;">
                    <img src="{{ asset('img/oksucessfull.ico') }}" class="img-responsive" style="margin: 0 auto;">    
                </p>
                <p class="label label-success" style="text-align: center; margin: 0 auto;">@lang('kiu.pagorespuesta')</p>                  
                </div>
                    <div class="col-md-6">
                         <div class="col-md-9">
                            <div class="col-md-12 col-md-offset-3 pago">
                                    <div class="row">   
                                        <h3 class="text-center">@lang('kiu.itineraries.Summary')</h3>
                                    </div>
                                    <hr/> 
                                    <div class="col-md-6">
                                        <p>@lang('kiu.itineraries.booking'):</p>
                                    </div>

                                    <div class="col-md-6" style="text-align: center;">
                                        <p class="label label-success" style="text-align: center;">{{ $booking->booking_ref }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>@lang('kiu.itineraries.status.title'):</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p style="text-align: center; color:#87bc24;">@lang('kiu.itineraries.status.' . $booking->status)</p>
                                    </div>

                                    <div class="col-md-6">
                                        @lang('kiu.itineraries.createdAt'): 
                                    </div>

                                    <div class="col-md-6">
                                        <p>{{ \Carbon\Carbon::parse( $booking->created_at )->format('d M y H:i') }}</p>
                                    </div>
                                     <!-- Determino si el Itinerario tiene Salida -->
                                    <div class="col-md-12">
                                        <img src="{{ asset('img/home-18.png') }}" class="img-responsive" style="margin: 0 auto;"><p style="text-align: center; color:#87bc24;">@lang('kiu.itineraries.going')</p>
                                    </div>
                                     @if(count($itinerary) > 0)
                                        <div class="col-md-6">
                                            <p><p>@lang('kiu.itineraries.going'): </p></p>
                                        </div>

                                        <div class="col-md-6">
                                            <p>{{ \Carbon\Carbon::parse( $itinerary[0]->departure_datetime )->format('d M y H:i') }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>@lang('kiu.itineraries.arrival'):</p>
                                        </div>

                                        <div class="col-md-6">
                                            {{ \Carbon\Carbon::parse( $itinerary[0]->arrival_datetime )->format('d M y H:i') }}</p>
                                        </div>     
                                    @endif
                                    <!-- Determino si el Itinerario tiene Llegada -->
                                    @if(isset($itinerary[1]))
                                        @if(count($itinerary[1]) > 0)
                                            <div class="col-md-12">
                                                <img src="{{ asset('img/home-19.png') }}" class="img-responsive" style="margin: 0 auto;"><p style="text-align: center; color:#87bc24;">@lang('kiu.itineraries.return')</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><p>@lang('kiu.itineraries.departure'): </p></p>
                                            </div>

                                            <div class="col-md-6">
                                                <p>{{ \Carbon\Carbon::parse( $itinerary[1]->departure_datetime )->format('d M y H:i') }}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <p>@lang('kiu.itineraries.arrival'):</p>
                                            </div>

                                            <div class="col-md-6">
                                                {{ \Carbon\Carbon::parse( $itinerary[1]->arrival_datetime )->format('d M y H:i') }}</p>
                                            </div>
                                        @endif
                                    @endif    
                            </div>
                            <div class="row">
                            </div>
                            <hr/>
                            <!-- Ruta de Vuelos users.flights -->
                            <div class="col-md-12 col-md-offset-1">
                                <div class="col-md-offset-6">
                                    <a class="btn btn-large" href="{{ route('home') }}"> @lang('kiu.payment.finish')</a>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12 col-md-offset-3">
                                <h3 class="text-center">@choice('kiu.itineraries.bp', $passengers)</h3>
                            </div>
                        </div> 
                        @foreach($passengers as $passenger)
                            <div class="row">
                                <div class="col-sm-10 col-md-offset-2">
                                <div class="col-sm-2 text center">
                                
                                     <a href="{{ route('Kiu.ItinRead.PDF', $passenger->ticket->document_number) }}" class="label label-success" download="{{ $passenger->ticket->document_number }}" target="_blank">
                                    <span class="glyphicon glyphicon-save-file"></span>
                                </a> 
                                </div>
                                    <a href="{{ route('Kiu.ItinRead.GET', $passenger->ticket->document_number) }}" class="btn-link" target="_blank">
                                        {{ $passenger->ticket->document_number }}
                                        - {{ $passenger->first_name }}  {{ $passenger->last_name }}
                                    </a>
                                </div>   
                            </div>
                        <hr/>
                        @endforeach   
                    </div>  
                <div class="col-md-3">
                    <div class="text-center">
                        <h3 style="text-align: center;">@lang('kiu.payment.voucher')</h3>
                        <div class="text-center" style="text-align: center;">
                            <p style="text-align: center;">{!! html_entity_decode($voucher) !!}</p>               
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
@endsection