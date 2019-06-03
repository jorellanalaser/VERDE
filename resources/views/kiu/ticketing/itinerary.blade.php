
<tr>
    <td>@lang('kiu.itineraries.flight'):</td>
    <td><b>{{ $item->Airline }} {{ $item->FlightNumber }}</b></td>
    <td>{{ $item->DepartureAirport }} - {{ $item->ArrivalAirport }}</td>
    <td>
        @if(count($item) > 1)
            <?php
                $modalID = md5( json_encode( $item ) );
            ?>
        <span style="color: #87bc24;font-weight: bold">
            @lang('kiu.itineraries.stopover') {{ count($item) - 1 }}
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
            {{ \Carbon\Carbon::parse( $item->DepartureDateTime )->format('d-m-Y') }}
        </b>
    </td>
    <td>
        <b style="color:#219dde !important;">
            {{ \Carbon\Carbon::parse( $item->DepartureDateTime )->format('h:i:s a') }}
        </b>
    </td>
</tr>
<tr>
    <td>@lang('kiu.itineraries.arrival'):</td>
    <td><img src="{{ asset('img/home-19.png') }}"></td>
    <td>{{ \Carbon\Carbon::parse( $item->ArrivalDateTime )->format('d-m-Y') }}</td>
    <td>{{ \Carbon\Carbon::parse( $item->ArrivalDateTime )->format('h:i:s a') }}</td>
</tr>
