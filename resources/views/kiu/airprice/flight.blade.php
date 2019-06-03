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
            </tr>
            <tr>
                <td>@lang('kiu.itineraries.arrival'):</td>
                <td><img src="{{ asset('img/home-19.png') }}"></td>
                <td>{{ \Carbon\Carbon::parse( (count($segments) > 1) ? $segments[ count($segments) - 1]->ArrivalDateTime : $segments[0]->ArrivalDateTime )->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse( (count($segments) > 1) ? $segments[ count($segments) - 1]->ArrivalDateTime : $segments[0]->ArrivalDateTime  )->format('h:i:s a') }}</td>
            </tr>
        </table>
    </div>
    <hr>
@endif