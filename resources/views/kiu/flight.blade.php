@if(count($segments) > 0)
    <div class="container">
        <table class="col-md-6 col-xs-12 col-md-offset-3">
            <tr>
                <td>@lang('kiu.itineraries.flight'):</td>
                <td><b>{{ $segments[0]->Airline }} {{ $segments[0]->FlightNumber }}</b></td>
                <td>{{ $segments[0]->DepartureAirport }} - {{ (count($segments) > 1) ? $segments[ (count($segments) - 1) ]->ArrivalAirport : $segments[0]->ArrivalAirport }}</td>
                <td>
                    @if(count($segments) > 1)
                        <?php
                            $modalID = md5( json_encode( $segments ) );
                        ?>

                        <span style="color: #87bc24;font-weight: bold">
                            @lang('kiu.itineraries.stopover') {{ count($segments) - 1 }}
                        </span>
                    @else
                        @lang('kiu.itineraries.stopover') 0
                    @endif
                </td>
                <td style="width: 120px" class="text-center"><strong>@lang('kiu.itineraries.booking_class')</strong></td>
            </tr>
            <tr>
                <td>@lang('kiu.itineraries.departure'):</td>
                <td><img src="{{ asset('img/home-18.png') }}"></td>

                <td>
                    <b style="color:#219dde !important;">
                        {{ \Carbon\Carbon::parse( $segments[0]->DepartureDateTime )->format('d-m-Y') }}
                    </b>
                </td>
                <td>
                    <b style="color:#219dde !important;">
                        {{ \Carbon\Carbon::parse( $segments[0]->DepartureDateTime )->format('h:i:s a') }}
                    </b>
                </td>

                
                <td width="50" align="center">
                    @foreach( \Modules\Facades\BookingClass::cleaner( $segments[0]->BookingClass, $request->PassengerData->ADT, $request->PassengerData->ADT ) as $bookingClass)
                        <?php
                            // ID radio
                            $id = rand(100, 1000);

                            // Crea objeto de vuelo
                            $flight = [
                                    'segment'   => $segments,
                                    'booking_class' => $bookingClass->ResBookDesigCode
                            ];
                            
                        ?>
                        <input type="radio" class="css-checkbox" id="data_{{ $i.$id }}" name="data_{{ ($i == 0) ? 'ida' : 'vuelta' }}" value="{{ \Modules\Helpers\Utilities::encrypt( $flight ) }}" required>
                        <label for="data_{{ $i.$id }}" class="css-label radGroup1">
                            {{ $bookingClass->ResBookDesigCode }}
                        </label>
                        @break;
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>@lang('kiu.itineraries.arrival'):</td>
                <td><img src="{{ asset('img/home-19.png') }}"></td>
                <td>{{ \Carbon\Carbon::parse( (count($segments) > 1) ? $segments[ count($segments) - 1]->ArrivalDateTime : $segments[0]->ArrivalDateTime )->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse( (count($segments) > 1) ? $segments[ count($segments) - 1]->ArrivalDateTime : $segments[0]->ArrivalDateTime  )->format('h:i:s a') }}</td>
                <td>
                    &nbsp;
                </td>
            </tr>
            <!--  Impirme todas las tarifas disponibles
            <tr>
                <td class="text-center" colspan="5">
                    <!-- Colocando las variables --
                    @foreach( \Modules\Facades\BookingClass::cleaner( $segments[0]->BookingClass, $request->PassengerData->ADT ) as $bookingClass)
                        <?php
                        // Crea objeto de vuelo
                        $flight = [
                                'segment'   => $segments,
                                'booking_class' => $bookingClass->ResBookDesigCode
                        ];
                        ?>

                        <div class="form-group col-xs-1">
                            <label>
                                <input type="radio" name="data_{{ ($i == 0) ? 'ida' : 'vuelta' }}" value="{{ \Modules\Helpers\Utilities::encrypt( $flight ) }}" required>
                                {{ $bookingClass->ResBookDesigCode }}
                            </label>
                        </div>
                    @endforeach
                </td>
            </tr>
            -->
        </table>
    </div>
    <hr>
@endif