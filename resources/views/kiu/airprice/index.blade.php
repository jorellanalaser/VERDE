@extends($res = ($layoutInt =='US') ? 'waa.simplepage': 'layouts.simplepage')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/datepicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datepicker/css/bootstrap-datepicker3.standalone.css')}}">
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
    <div class="container to-animate">
        {!! Form::open(['route' => 'Kiu.Passengers']) !!}
            {{-- Recorre itinerarios, ida y vuelta o solo ida --}}
            @foreach($itineraries as $key => $itinerary)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-1 col-xs-2">
                            @if($key == 0)
                                <a href="javascript:history.back()" id="goback" style="float:left">
                                    <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMxLjA1OSAzMS4wNTkiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMxLjA1OSAzMS4wNTk7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNjRweCIgaGVpZ2h0PSI2NHB4Ij4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMzAuMTcxLDE2LjQxNkgwLjg4OEMwLjM5OCwxNi40MTYsMCwxNi4wMiwwLDE1LjUyOWMwLTAuNDksMC4zOTgtMC44ODgsMC44ODgtMC44ODhoMjkuMjgzICAgIGMwLjQ5LDAsMC44ODgsMC4zOTgsMC44ODgsMC44ODhDMzEuMDU5LDE2LjAyLDMwLjY2MSwxNi40MTYsMzAuMTcxLDE2LjQxNnoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KCTxnPgoJCTxwYXRoIGQ9Ik0xNi4wMTcsMzEuMDU5Yy0wLjIyMiwwLTAuNDQ1LTAuMDgzLTAuNjE3LTAuMjVMMC4yNzEsMTYuMTY2QzAuMDk4LDE1Ljk5OSwwLDE1Ljc3LDAsMTUuNTI5ICAgIGMwLTAuMjQsMC4wOTgtMC40NzEsMC4yNzEtMC42MzhMMTUuNCwwLjI1YzAuMzUyLTAuMzQxLDAuOTE0LTAuMzMyLDEuMjU1LDAuMDJjMC4zNCwwLjM1MywwLjMzMSwwLjkxNS0wLjAyMSwxLjI1NUwyLjE2MywxNS41MjkgICAgbDE0LjQ3MSwxNC4wMDRjMC4zNTIsMC4zNDEsMC4zNjEsMC45MDIsMC4wMjEsMS4yNTVDMTYuNDgsMzAuOTY4LDE2LjI0OSwzMS4wNTksMTYuMDE3LDMxLjA1OXoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" style="height:auto; width:80%; margin-right:20px;" />
                                </a>
                            @endif
                        </div>
                        <div class="col-sm-10 col-xs-8">
                        @if( ($userisocountry) == 'US')
                            @if($layoutInt == 'US')
                              <p style="font-size:250%; color:#87bc24; margin-bottom: 2%;" class="col-sm-offset-4">
                              @if($key == 0)
                                    <img src="{{ asset('img/home-14.png') }}">
                                    {{ $itinerary[0]->DepartureAirport }} - {{ $itinerary[count($itinerary) - 1]->ArrivalAirport }}
                                    <p style="margin-left: 38%;color:#87bc24;"><span style="color:#87bc24; margin-right: 5px;" class="glyphicon glyphicon-tags" aria-hidden="true"> </span> @lang('kiu.itineraries.charter')</p> 
                                    
                                @else
                                    <img src="{{ asset('img/home-15.png') }}">
                                    {{ $itinerary[0]->DepartureAirport }} - {{ $itinerary[count($itinerary) - 1]->ArrivalAirport }}
                                    <p style="margin-left: 38%;color:#87bc24;"><span style="color:#87bc24; margin-right: 5px;" class="glyphicon glyphicon-tags" aria-hidden="true"> </span> @lang('kiu.itineraries.charter')</p> 
                                    
                                @endif
                              </p>
                            @else
                              <p style="font-size:250%; color:#87bc24; margin-bottom: 2%;" class="col-sm-offset-4">
                               @if($key == 0)
                                    <img src="{{ asset('img/home-14.png') }}">
                                    {{ $itinerary[0]->DepartureAirport }} - {{ $itinerary[count($itinerary) - 1]->ArrivalAirport }}
                                    
                                @else
                                    <img src="{{ asset('img/home-15.png') }}">
                                    {{ $itinerary[0]->DepartureAirport }} - {{ $itinerary[count($itinerary) - 1]->ArrivalAirport }}
                                    
                                @endif
                              </p>
                            @endif
                        @else
                            <p style="font-size:250%; color:#87bc24; margin-bottom: 2%;" class="col-sm-offset-4">
                                @if($key == 0)
                                        <img src="{{ asset('img/home-14.png') }}">
                                        {{ $itinerary[0]->DepartureAirport }} - {{ $itinerary[count($itinerary) - 1]->ArrivalAirport }}
                                        
                                    @else
                                        <img src="{{ asset('img/home-15.png') }}">
                                        {{ $itinerary[0]->DepartureAirport }} - {{ $itinerary[count($itinerary) - 1]->ArrivalAirport }}
                                        
                                    @endif
                             </p>       
                            </p>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 to-animate">
                        {{-- Segmentos --}}
                        @include('kiu.airprice.flight', [
                            'segments'   => $itineraries[$key],
                        ])
                    </div>
                </div>
            @endforeach

            <div class="row">
                <div class="col-sm-12">
                    <p style="font-size:250%; color:#87bc24; margin-bottom: 0px;" align="center">
                       @lang('kiu.itineraries.price')
                    </p>       
                </div>
            </div>
             @if(property_exists($fares, 'PricedInfo'))
                        @if(property_exists($fares->PricedInfo, 'PTC_FareBreakdown'))
                            @if(property_exists($fares->PricedInfo->PTC_FareBreakdown, 'Passengers'))
                                @foreach($fares->PricedInfo->PTC_FareBreakdown->Passengers as $passengers)
            <div class="col-md-6 col-xs-12 col-md-offset-3 container table-responsive to-animated">
            <div>
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">@lang('kiu.itineraries.Summary')</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">@choice('kiu.itineraries.bp', $passengers->Quantity)</a></li>
                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">@lang('kiu.itineraries.taxes')</a></li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="col-md-10" style="padding: 0px;">
                            <div class="col-md-3">
                                <b style="color:#669933;text-transform: capitalize !important; margin: 0px; padding: 0px;">{{ trans('kiu.passengers.pax') }}</b>     
                            </div>
                            <div class="col-md-3" >
                                <p style="margin: 0px; padding: 0px;">{{ $passengers->Quantity }} {{ trans('general.pax_type.' . $passengers->Code ) }}</p> 
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <div class="col-md-2" style="margin: 0px; padding: 0px;">
                                        {{ $passengers->BaseFare->Currency }}
                                    </div>
                                    <div class="col-md-10" style="text-align: right;">
                                    @if( ($userisocountry) == 'US')
                                         @if($layoutInt == 'US')
                                            {{ \Modules\Helpers\Utilities::number_format2( $passengers->BaseFare->Amount )}}
                                         @else
                                           {{ \Modules\Helpers\Utilities::number_format2( $passengers->BaseFare->Amount )}}
                                         @endif
                                    @else
                                        {{ \Modules\Helpers\Utilities::number_format( $passengers->BaseFare->Amount )}}
                                    @endif
                                    </div>
                                </div>     
                            </div>

                            <div class="col-md-3">
                                <b style="color:#669933;text-transform: capitalize !important;">@lang('kiu.itineraries.taxes'):</b>     
                            </div>
                            <div class="col-md-3"> 
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <div class="col-md-2" style="margin: 0px; padding: 0px;">
                                        {{ $passengers->BaseFare->Currency }}
                                    </div>
                                    <div class="col-md-10" style="text-align: right;">
                                         @if( ($userisocountry) == 'US')
                                             @if($layoutInt == 'US')
                                                {{\Modules\Helpers\Utilities::number_format2($fares->PricedInfo->ItinTotalFare->TotalFare->Amount - $passengers->BaseFare->Amount)}}
                                             @else
                                               {{\Modules\Helpers\Utilities::number_format2($fares->PricedInfo->ItinTotalFare->TotalFare->Amount - $passengers->BaseFare->Amount)}}
                                             @endif
                                        @else
                                            {{\Modules\Helpers\Utilities::number_format($fares->PricedInfo->ItinTotalFare->TotalFare->Amount - $passengers->BaseFare->Amount)}}
                                        @endif
                                    </div>
                                </div> 
                            </div>
                            <div class="col-md-3">  
                            </div>
                            <div class="col-md-3">
                              <b style="color:#669933;text-transform: capitalize !important;">@lang('kiu.itineraries.total')</b>       
                            </div>
                            <div class="col-md-6">
                            <div class="col-md-12">
                                    <div class="col-md-2" style="margin: 0px; padding: 0px;">
                                        <b style="color:#669933;">{{ $fares->PricedInfo->ItinTotalFare->TotalFare->CurrencyCode }} </b>      
                                    </div>
                                    <div class="col-md-10" style="text-align: right;">
                                      <b style="color:#669933;">{{ \Modules\Helpers\Utilities::number_format2( $fares->PricedInfo->ItinTotalFare->TotalFare->Amount)}}</b>
                                    </div>
                                </div>
                            </div>
                        </div>    
                </div>
        
                <div role="tabpanel" class="tab-pane" id="profile">
                    <div class="col-md-10" style="padding: 0px;">
                            <div class="col-md-3">
                              <b style="color:#669933;text-transform: capitalize !important; margin: 0px; padding: 0px;">{{ trans('kiu.passengers.pax') }}</b>   
                            </div>
                            <div class="col-md-3" >
                                <p style="margin: 0px; padding: 0px;">{{ $passengers->Quantity }} {{ trans('general.pax_type.' . $passengers->Code ) }}</p> 
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <div class="col-md-2" style="margin: 0px; padding: 0px;">
                                        {{ $passengers->BaseFare->Currency }}
                                    </div>
                                    <div class="col-md-10" style="text-align: right;">
                                        
                                        @if( ($userisocountry) == 'US')
                                             @if($layoutInt == 'US')
                                                {{ \Modules\Helpers\Utilities::number_format2( $passengers->BaseFare->Amount )}}
                                             @else
                                               {{ \Modules\Helpers\Utilities::number_format2( $passengers->BaseFare->Amount )}}
                                             @endif
                                        @else
                                            {{ \Modules\Helpers\Utilities::number_format( $passengers->BaseFare->Amount )}}
                                        @endif
                                    </div>
                                </div>     
                            </div>

                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3"> 
                            </div>
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-3">  
                            </div>
                            <div class="col-md-3">
                              <b style="color:#669933;text-transform: capitalize !important;">@lang('kiu.itineraries.total')</b>      
                            </div>
                            <div class="col-md-6">
                            <div class="col-md-12">
                                    <div class="col-md-2" style="margin: 0px; padding: 0px;">
                                       <b style="color:#669933;">{{ $fares->PricedInfo->ItinTotalFare->TotalFare->CurrencyCode }} </b>      
                                    </div>
                                    <div class="col-md-10" style="text-align: right;">
                                      <b style="color:#669933;">{{ \Modules\Helpers\Utilities::number_format2( $passengers->BaseFare->Amount )}}</b>

                                    </div>
                                </div>
                            </div>
                        </div>    
                </div>

                <div role="tabpanel" class="tab-pane" id="messages">
                    <div class="col-md-10" style="padding: 0px;">
                             @foreach ($passengers->Taxes->Tax as $tax)
                                <div class="col-md-6">
                                  <p style="color:#669933;text-transform: capitalize !important; margin: 0px; padding: 0px;">{{ $tax->TaxCode }}</p>       
                                </div>

                                <div class="col-md-6">
                                    <div class="col-md-2" style="margin: 0px; padding: 0px;">
                                        {{ $tax->Currency }}
                                    </div>
                                    <div class="col-md-9" style="text-align: right;">                                        
                                        @if( ($userisocountry) == 'US')
                                             @if($layoutInt == 'US')
                                                {{ \Modules\Helpers\Utilities::number_format2( $tax->Amount ) }}
                                             @else
                                               {{ \Modules\Helpers\Utilities::number_format2( $tax->Amount ) }}
                                             @endif
                                        @else
                                             {{ \Modules\Helpers\Utilities::number_format( $tax->Amount ) }}
                                        @endif
                                    </div>
                                </div>
                             @endforeach
                            <div class="col-md-12">
                                <div class="col-md-3"></div>
                                <div class="col-md-3">
                                  <b style="color:#669933;text-transform: capitalize !important; margin: 0px; padding: 0px;">@lang('kiu.itineraries.total')</b>
                                             
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-2" style="margin: 0px; padding: 0px;">
                                      <b style="color:#669933;text-transform: capitalize !important; margin: 0px; padding: 0px;">{{ $tax->Currency }}</b> 
                                    </div>
                                    <div class="col-md-10" style="text-align: right;">
                                        
                                        @if( ($userisocountry) == 'US')
                                             @if($layoutInt == 'US')
                                                <b style="color:#669933;text-transform: capitalize !important; margin: 0px; padding: 0px;">{{\Modules\Helpers\Utilities::number_format2($fares->PricedInfo->ItinTotalFare->TotalFare->Amount - $passengers->BaseFare->Amount)}}</b>
                                             @else
                                               <b style="color:#669933;text-transform: capitalize !important; margin: 0px; padding: 0px;">{{\Modules\Helpers\Utilities::number_format2($fares->PricedInfo->ItinTotalFare->TotalFare->Amount - $passengers->BaseFare->Amount)}}</b>
                                             @endif
                                        @else
                                             <b style="color:#669933;text-transform: capitalize !important; margin: 0px; padding: 0px;">{{\Modules\Helpers\Utilities::number_format($fares->PricedInfo->ItinTotalFare->TotalFare->Amount - $passengers->BaseFare->Amount)}}</b>
                                        @endif
                                    </div>    
                                </div>
                            </div>
                    </div>
                </div>
              </div>
            </div>
                        @endforeach
                            @endif
                        @endif
                    @endif
            </div>
            <br/>

            <div class="row">
                <div class="col-md-12 text-center">
                 <hr>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                          <div class="text-center">
                             <button type="submit" class="btn btn-cotice col-xs-7 col-md-offset-2">@lang('kiu.itineraries.nextBtn')</button>
                          </div>              
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="request" value="{{ \Modules\Helpers\Utilities::encrypt( $request ) }}">
        {!! Form::close() !!}
    </div>
@endsection