@extends($res = ($layoutInt =='US') ? 'waa.simplepage': 'layouts.simplepage')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/datepicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datepicker/css/bootstrap-datepicker3.standalone.css')}}">
    <link rel="stylesheet" href="{{asset('css/radiobutton.css')}}">
    <style type="text/css">
        /*this is just to organize the demo checkboxes*/
        label {margin-right:20px;}
    </style>
@endsection

@section('js')
    <script src="{{asset('plugins/datepicker/js/bootstrap-datepicker.js')}}"></script>
    <!-- Languaje -->
    <script src="{{asset('plugins/datepicker/locales/bootstrap-datepicker.es.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();

            $('.datepicker').datepicker({
                format: "yyyy-mm-dd",
                language: "es",
                minDate: 0,
                autoclose: true,
                startDate: yyyy + '-' + mm + '-' + dd
            });
        });
    </script>
@endsection

@section('content')
    <div class="container">
        {!! Form::open(['route' => 'Kiu.AirPrice']) !!}
            <div class="row">
                <div class="col-md-12 to-animate">
                    <div class="row">
                        <div class="col-md-1">
                            <a href="{{ route('home') }}" style="float:left">
                                <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMxLjA1OSAzMS4wNTkiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMxLjA1OSAzMS4wNTk7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNjRweCIgaGVpZ2h0PSI2NHB4Ij4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMzAuMTcxLDE2LjQxNkgwLjg4OEMwLjM5OCwxNi40MTYsMCwxNi4wMiwwLDE1LjUyOWMwLTAuNDksMC4zOTgtMC44ODgsMC44ODgtMC44ODhoMjkuMjgzICAgIGMwLjQ5LDAsMC44ODgsMC4zOTgsMC44ODgsMC44ODhDMzEuMDU5LDE2LjAyLDMwLjY2MSwxNi40MTYsMzAuMTcxLDE2LjQxNnoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KCTxnPgoJCTxwYXRoIGQ9Ik0xNi4wMTcsMzEuMDU5Yy0wLjIyMiwwLTAuNDQ1LTAuMDgzLTAuNjE3LTAuMjVMMC4yNzEsMTYuMTY2QzAuMDk4LDE1Ljk5OSwwLDE1Ljc3LDAsMTUuNTI5ICAgIGMwLTAuMjQsMC4wOTgtMC40NzEsMC4yNzEtMC42MzhMMTUuNCwwLjI1YzAuMzUyLTAuMzQxLDAuOTE0LTAuMzMyLDEuMjU1LDAuMDJjMC4zNCwwLjM1MywwLjMzMSwwLjkxNS0wLjAyMSwxLjI1NUwyLjE2MywxNS41MjkgICAgbDE0LjQ3MSwxNC4wMDRjMC4zNTIsMC4zNDEsMC4zNjEsMC45MDIsMC4wMjEsMS4yNTVDMTYuNDgsMzAuOTY4LDE2LjI0OSwzMS4wNTksMTYuMDE3LDMxLjA1OXoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" style="height:auto; width:80%; margin-right:20px;" />
                            </a>
                        </div>
                        <div class="col-md-11">
                            <p style="font-size:250%; color:#87bc24; margin-bottom: 2%;" class="col-sm-offset-4">
                                <img src="{{ asset('img/home-14.png') }}">
                                {{ $itineraries[0]->Origin }} - {{ $itineraries[0]->Destination }}
                                
                                {{-- Verifica si el Origen de la IP es de EEUU --}}
                                    @if( ($userisocountry) == 'US')
                                        @if(($itineraries[0]->Origin) == 'MIA' or ($itineraries[0]->Destination) == 'MIA')
                                            <p style="margin-left: 38%;color:#87bc24;"><span style="color:#87bc24; margin-right: 5px;" class="glyphicon glyphicon-tags" aria-hidden="true"> </span> @lang('kiu.itineraries.charter')</p> 
                                            @else
                                        @endif
                                    @else
                                    @endif 
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                     <div class="col-md-12 to-animate">
                    {{-- Vuelos ida --}}
                    @if(count($itineraries[0]->Flights) > 0)
                        @foreach($itineraries[0]->Flights as $itinerary)
                            @include('kiu.flight', ['segments' => $itinerary, 'i' => 0])
                        @endforeach
                    @else
                        @if(\Modules\Helpers\CabinHelper::has($request->CabinPref, $request->Segments[0]->Origin))
                            <p style="" class="text-center">
                                @lang('kiu.itineraries.empty').
                                <br>
                                @lang('kiu.itineraries.other_days').
                                <br>
                            </p>
                        @else
                            <p class="text-center">
                                @lang('home.booking.mjscupos') 
                            </p>
                        @endif
                    @endif
                </div>
            </div>

            {{-- Vuelos vuelta --}}
            @if(array_key_exists(1, $itineraries))
                <div class="row">
                    <div class="col-md-12 to-animate">
                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-11">
                            <p style="font-size:250%; color:#87bc24; margin-bottom: 2%;" class="col-sm-offset-4">
                                <img src="{{ asset('img/home-15.png') }}">
                                {{ $itineraries[1]->Origin }} - {{ $itineraries[1]->Destination }}
                            </p>
                             {{-- Verifica si el Origen de la IP es de EEUU --}}
                                    @if( ($userisocountry) == 'US')
                                        @if(($itineraries[1]->Origin) == 'MIA' or ($itineraries[1]->Destination) == 'MIA')
                                          <p style="margin-left: 38%;color:#87bc24;"><span style="color:#87bc24; margin-right: 5px;" class="glyphicon glyphicon-tags" aria-hidden="true"> </span> @lang('kiu.itineraries.charter')</p>  
                                        @else
                                         @endif
                                    @else 
                                    @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 to-animate">
                        {{-- Vuelos vuelta --}}
                        @if(count($itineraries[1]->Flights) > 0)
                            @foreach($itineraries[1]->Flights as $itinerary)
                                @include('kiu.flight', ['segments' => $itinerary, 'i' => 1, 'request' => $request])
                            @endforeach
                        @else
                            @if(\Modules\Helpers\CabinHelper::has($request->CabinPref, $request->Segments[0]->Origin))
                                <p style="" class="text-center">
                                    @lang('kiu.itineraries.empty').
                                    <br>
                                    @lang('kiu.itineraries.other_days').
                                    <br>
                                </p>
                            @else
                                <p class="text-center">
                                    @lang('home.booking.mjscupos') 
                                </p>
                            @endif
                        @endif
                    </div>
                </div>
            @endif
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-cotice1">
                            @lang('kiu.itineraries.searchBtn')
                        </button>
                    </div>
                </div>                          
     
            <input type="hidden" name="request" value="{{ \Modules\Helpers\Utilities::encrypt( $request ) }}">
        {!! Form::close() !!}

        <br/>
        {{-- Nuevas fechas --}}
        {!! Form::open(['route' => ['Kiu.AirAvail']]) !!}
        <hr/>
       
            <h2 align="center" style="color:#87bc24;">@lang('kiu.itineraries.other_days')</h2>
        {{-- Ida y vuelta --}}
        @if(array_key_exists(1, $request->Segments))
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-3 text-center">
                    <h3 style="color:gray;" align="center">{{ $itineraries[0]->Origin }} - {{ $itineraries[0]->Destination }} </h3>
                    <div class="input-group date">
                        <input type="text" name="departure_date" class="form-control datepicker col-xs-6 text-center" value="{{ $request->Segments[0]->DepartureDateTime }}" required>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div> 
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-3 text-center">
                    <h3 style="color:gray;" align="center">{{ $itineraries[1]->Origin }} - {{ $itineraries[1]->Destination }}</h3>
                    <div class="input-group date">
                        <input type="text" name="return_date" class="form-control datepicker col-xs-6 text-center" value="{{ $request->Segments[1]->DepartureDateTime }}" required>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>  
                </div>
                
                <div class="col-md-2"></div>
            </div>
        @else
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 text-center">
                    <h3 style="color:gray;" align="center">{{ $itineraries[0]->Origin }} - {{ $itineraries[0]->Destination }}</h3>
                    <div class="input-group date">
                        <input type="text" name="departure_date" class="form-control datepicker col-xs-6 text-center" value="{{ $request->Segments[0]->DepartureDateTime }}" required>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        @endif

        <input type="hidden" name="origin" value="{{ \Modules\Helpers\AirportHelper::idByCode( $request->Segments[0]->Origin ) }}">
        <input type="hidden" name="destination" value="{{ \Modules\Helpers\AirportHelper::idByCode( $request->Segments[0]->Destination ) }}">
        <input type="hidden" name="adults" value="{{ $request->PassengerData->ADT }}">
        <br/>
        <hr>
            <div class="row">
                <div class="col-md-4"></div>
                    <div class="col-md-4 text-center">
                        <button type="submit" class="btn btn-cotice">
                             @lang('home.booking.searchBtn')
                        </button>
                </div>
            <div class="col-md-4"></div>
            </div>                           
        <hr/>
        {!! Form::close() !!}
    </div>
@endsection