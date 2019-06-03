<div class="panel panel-default">
    <div class="panel-heading">
        <span class="glyphicon glyphicon-shopping-cart"></span> @lang('kiu.shopping_cart.title')
    </div>
    <div class="panel-body">
        @if(!Auth::guest())
            <h4>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h4>
            <br>
        @endif

        @foreach(\Modules\Helpers\ShoppingCart::get() as $item)
            @if(!is_null($item->data))
                <table class="col-md-12">
                    @foreach($item->data->OriginDestinationInfo as $flights)
                        <tr>
                            <td>@lang('kiu.itineraries.flight'):</td>
                            <td><b>{{ $flights->Segments[0]->Airline }} {{ $flights->Segments[0]->FlightNumber }}</b></td>
                            <td>{{ $flights->Segments[0]->DepartureAirport }} - {{ (count($flights->Segments) > 1) ? $flights->Segments[ (count($flights->Segments) - 1) ]->ArrivalAirport : $flights->Segments[0]->ArrivalAirport }}</td>
                            <td>
                                    <span style="color: #87bc24;font-weight: bold">
                                        @lang('kiu.itineraries.stopover') {{ count($flights->Segments) - 1 }}
                                    </span>
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('kiu.itineraries.departure'):</td>
                            <td><img src="{{ asset('img/home-18.png') }}"></td>

                            <td>
                                <b style="color:#219dde !important;">
                                    {{ \Carbon\Carbon::parse( $flights->Segments[0]->DepartureDateTime )->format('d-m-Y') }}
                                </b>
                            </td>
                            <td>
                                <b style="color:#219dde !important;">
                                    {{ \Carbon\Carbon::parse( $flights->Segments[0]->DepartureDateTime )->format('h:i:s a') }}
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('kiu.itineraries.arrival'):</td>
                            <td><img src="{{ asset('img/home-19.png') }}"></td>
                            <td>{{ \Carbon\Carbon::parse( $flights->Segments[ count($flights->Segments) - 1]->ArrivalDateTime )->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse( $flights->Segments[ count($flights->Segments) - 1]->ArrivalDateTime )->format('h:i:s a') }}</td>
                        </tr>
                        <tr><td colspan="4"><hr/></td> </tr>
                    @endforeach
                </table>
            @endif
        @endforeach

        <div class="row">
            <div  class="col-md-12">
                <div class="col-md-6">
                    <a href="{{ route('Kiu.Passengers.ShoppingCart') }}" class="btn btn-success">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                        @lang('kiu.itineraries.continueBtn')
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="/clear/shopping-cart" class="btn btn-danger">
                        <span class="glyphicon glyphicon-trash"></span>
                        @lang('kiu.itineraries.cancelBtn')
                    </a>
                </div>
            </div>        
        </div>
    </div>
</div>