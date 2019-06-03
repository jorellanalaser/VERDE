@extends($res = ($layoutInt =='US') ? 'waa.simplepage': 'layouts.simplepage')

@section('js')
    <script src="{{ asset('/plugins/other/js/jquery.creditCardValidator.js') }}"></script>
    <script src="{{ asset('/plugins/other/js/jquery.form-validator.min.js') }}"></script>
    <script src="{{ asset('/plugins/other/js/jquery.form-validator.es.js') }}"></script>
    <script src="{{ asset('/plugins/other/js/hideShowPassword.min.js') }}"></script>
    <script type="text/javascript">
        $('#CardNumber').validateCreditCard(function (e) {
            if (e.card_type == null && $('#CardNumber').val().length <= 0) {
                $("#img-mastercard").attr("src","{{ asset('img/mastercard-gris2.svg') }}");
                $("#img-visa").attr("src","{{ asset('img/visa-gris2.svg') }}");
            }
            else if(e.card_type != null)
            {
                $("#CardCode").attr('value', e.card_type.code);

                $(".cards ." + e.card_type.name).removeClass("off");

                if(e.card_type.code == 'IK')
                {
                    $("#img-mastercard").attr("src","{{ asset('img/mastercard-color2.svg') }}");
                }
                else
                {
                    $("#img-mastercard").attr("src","{{ asset('img/mastercard-gris2.svg') }}");
                }

                if(e.card_type.code == 'VI')
                {
                    $("#img-visa").attr("src","{{ asset('img/visa-color2.svg') }}");
                }
                else
                {
                    $("#img-visa").attr("src","{{ asset('img/visa-gris2.svg') }}");
                }
            }
            else {
                $("#img-mastercard").attr("src","{{ asset('img/mastercard-gris2.svg') }}");
                $("#img-visa").attr("src","{{ asset('img/visa-gris2.svg') }}");
            }

            return e.length_valid && e.luhn_valid ? $("#CardNumber").addClass("valid") : $("#CardNumber").removeClass("valid")
        }, {
            accept: ["visa", "mastercard"]
        }).call(this);
    </script>

    <!-- Form Validator-->
    <script type="text/javascript">
        $.validate({
            form: '#MyPaymentForm',
            language: es,
            scrollToTopOnError: false
        });

        $(document).ready(function () {
            $("#recaptcha_response_field").attr("data-validation", "required");
        });
    </script>
    <!-- Show/Hide Data -->
    <script type="text/javascript">
        $('#show-CardNumber').change(function () {
            $('#CardNumber').hideShowPassword($(this).prop('checked'));
        });

        $('#show-cvv').change(function () {
            $('#cvv').hideShowPassword($(this).prop('checked'));
        });
    </script>
     <script type="text/javascript">
          function marcado(){
            if (document.getElementById("aceptTermWA").checked) {
                    $('#myModal').modal('show');
                    $('.modal-backdrop').remove();
                } else {
                    $('#myModal').modal('hide'); 
                }
            }      
    </script>
    <script type="text/javascript">
        function aceptoCondiciones(){
            document.getElementById("aceptTermWA").checked=false;
        };
    </script>
    <script type="text/javascript">
        $(function() {
          $("#fv").datepicker({
                format: 'mmyy',
                startView: 'years', 
                minViewMode: 'months',
                autoclose: 'true'
            });
        });
    </script>
    <script>
        $(document).ready(function()
        {
            $("#Modalpayment").modal("show");
        });
    </script>
    <script>
        $(document).ready(function()
        {
            $("#CondBancaria").modal("show");
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row row-bottom-padded-lg" id="about-us">
            <div class="col-md-12 to-animate">

                <div class="col-sm-1 col-xs-2">
                    <a href="#" id="goback" style="float:left">
                        <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMxLjQ5NCAzMS40OTQiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMxLjQ5NCAzMS40OTQ7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNjRweCIgaGVpZ2h0PSI2NHB4Ij4KPHBhdGggZD0iTTEwLjI3Myw1LjAwOWMwLjQ0NC0wLjQ0NCwxLjE0My0wLjQ0NCwxLjU4NywwYzAuNDI5LDAuNDI5LDAuNDI5LDEuMTQzLDAsMS41NzFsLTguMDQ3LDguMDQ3aDI2LjU1NCAgYzAuNjE5LDAsMS4xMjcsMC40OTIsMS4xMjcsMS4xMTFjMCwwLjYxOS0wLjUwOCwxLjEyNy0xLjEyNywxLjEyN0gzLjgxM2w4LjA0Nyw4LjAzMmMwLjQyOSwwLjQ0NCwwLjQyOSwxLjE1OSwwLDEuNTg3ICBjLTAuNDQ0LDAuNDQ0LTEuMTQzLDAuNDQ0LTEuNTg3LDBsLTkuOTUyLTkuOTUyYy0wLjQyOS0wLjQyOS0wLjQyOS0xLjE0MywwLTEuNTcxTDEwLjI3Myw1LjAwOXoiIGZpbGw9IiNjY2NjY2MiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" style="height:auto; width:80%; margin-right:20%;" />
                    </a>
                </div>
            @if(($userisocountry) == 'US' && ($booking->currency) == 'VES')
                    <p style="font-size:200%; color:#87bc24; margin-bottom: 20px; margin-top: 10%;" align="center">
                        @lang('payment.blockvemen')
                    </p>
                    <div class="row">
                        <div class="col-md-4"></div>
                            <div class="col-md-4"> 
                            <a href="{{ route('home') }}">
                                <button type="submit" class="btn col-sm-12">
                                    <span>@lang('payment.blockve')</span>
                                </button>
                            </div> 
                            <div class="col-md-4"></div>
                    </div>
            @else
                <div class="col-sm-10 col-xs-8">
                    @if( ($userisocountry) == 'US')
                            @if($layoutInt == 'US')
                                <p style="font-size:250%; color:#87bc24; margin-bottom: 20px;" align="center">
                                    <img src="{{ asset('img/bolet-1.png')}}">
                                    {{ \Modules\Helpers\Utilities::number_format2( $booking->amount ) }} {{ $booking->currency }}
                                    <br/>
                                    <span style="font-size: 24px">@lang('kiu.itineraries.booking'): {{ $booking->booking_ref }}</span>
                                </p>
                            @else
                                <p style="font-size:250%; color:#87bc24; margin-bottom: 20px;" align="center">
                                    <img src="{{ asset('img/bolet-1.png')}}">
                                    {{ \Modules\Helpers\Utilities::number_format( $booking->amount ) }} {{ $booking->currency }}
                                    <br/>
                                    <span style="font-size: 24px">@lang('kiu.itineraries.booking'): {{ $booking->booking_ref }}</span>
                                </p>
                            @endif
                    @else
                            <p style="font-size:250%; color:#87bc24; margin-bottom: 20px;" align="center">
                                <img src="{{ asset('img/bolet-1.png')}}">
                                {{ \Modules\Helpers\Utilities::number_format( $booking->amount ) }} {{ $booking->currency }}
                                <br/>
                                <span style="font-size: 24px">@lang('kiu.itineraries.booking'): {{ $booking->booking_ref }}</span>
                            </p>
                    @endif
                    {!! Form::open(['route' => ['Kiu.AirDemand'], 'id' => 'MyPaymentForm']) !!}
                     @if ($errors->has())
                        <br/>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    @elseif(Session::has('alert-danger'))
                        <br/>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="alert alert-danger">
                                    {{ Session::get('aler-danger') }}
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    @endif

                    
                    <div class="form-group row">
                        <label class="col-md-3">{{ trans('register.dni') }}</label>
                        <div class="col-md-6">
                            <input class="form-control" type="text" type="text" style="width:100%; border-radius:5px" placeholder="{{ trans('register.dni') }}" value="{{ strtoupper(Auth::user()->dni) }}" disabled>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-3">@lang('register.first_name')</label>
                        <div class="col-md-6">
                            <input type="text" style="width:100%; border-radius:5px" class="form-control" value="{{ strtoupper(Auth::user()->first_name) }}&nbsp;{{ strtoupper(Auth::user()->last_name) }}" disabled="true">
                        </div>
                    </div>
                    <hr>

                    <div id="campo_card" class="form-group row">
                        <label class="col-md-3">@lang('kiu.payment.cc_number')</label>
                        <div class="col-md-6">
                            <input id="CardNumber" type="password" style="width:100%; border-radius:5px" placeholder="@lang('kiu.payment.cc_number')" class="form-control" required="true" data-validation="custom" data-validation-regexp="^(^5[1-5]\d{14})|^4\d{15}$" maxlength="16"
                                   name="card_number">
                            <input type="checkbox" id="show-CardNumber"> <label for="show-CardNumber"><small>@lang('kiu.payment.show_cc_number')</small></label>
                            <input type="hidden" name="CardCode" id="CardCode" />
                        </div>
                        <div class="col-md-3 text-center" style="margin-top:5px;">
                            <img id="img-visa" src="{{ asset('img/visa-gris2.svg') }}" height="35"><span>&nbsp;</span>
                            <img id="img-mastercard" src="{{ asset('img/mastercard-gris2.svg') }}" height="35">
                        </div>
                        <label class="md-col-12" id="error"></label>
                    </div>

                    <div id="campo_cvv" class="form-group row">
                        <label class="col-md-3">@lang('kiu.payment.cvv')</label>
                        <div class="col-md-6">
                            <input type="password" id="cvv" name="cvv" style="width:100%; border-radius:5px" placeholder="@lang('kiu.payment.cvv')" class="form-control" required="true" data-validation="custom" data-validation-regexp="^([0-9]){3}$" maxlength="3">
                            <input type="checkbox" id="show-cvv"> <label for="show-cvv"><small>@lang('kiu.payment.show_cvv')</small></label>
                        </div>
                    </div>

                    <div id="campo_fv" class="form-group row">
                        <label class="col-md-3">@lang('kiu.payment.expiry') <small>(MMYY)</small></label>
                        <div class="col-md-6">
                            <input id="fv" name="expire" type="text" style="width:100%; border-radius:5px;" placeholder="@lang('kiu.payment.expiry')" class="form-control" required="true" data-validation-regexp="" data-validation="custom" data-date-start-date="0d" maxlength="4" autocomplete="off"> 
                        </div>
                    </div>
                   
                    <!-- Comparo la MONEDA para colocar los datos para el pago EN USD -->
                    @if( ($booking->currency) === 'USD')
                        @if( ($userisocountry) == 'US')
                             @if($layoutInt == 'US')
                                <p style="font-size:250%; color:#87bc24;" align="center">
                                    <span style="font-size: 24px">@lang('payment.condicion')</span>
                                </p>
                             @else
                               <p style="font-size:250%; color:#87bc24;" align="center">
                                    <span style="font-size: 24px">@lang('payment.condicion')</span>
                                </p>
                             @endif
                        @else
                            <p style="font-size:250%; color:#87bc24;" align="center">
                                    <span style="font-size: 24px">@lang('payment.condicion')</span>
                                </p>
                        @endif

                    <!-- Datos de Pais -->
                    <div id="campo_fv" class="form-group row">
                        <label class="col-md-3">@lang('payment.country')</label>
                        <div class="col-md-6">
                            <select name="country" id="country" class="form-control">
                                    <option value="">@lang('general.select')</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->iso2 }}">{{ $country->name }}</option>
                                    @endforeach  
                                </select>
                        </div>
                    </div>
                    <!-- Datos de Estado -->
                    <div id="campo_fv" class="form-group row">
                        <label class="col-md-3">@lang('payment.state')</label>
                        <div class="col-md-6">
                            <input id="state" name="state" type="text" style="width:100%; border-radius:5px;" placeholder="@lang('payment.state')" class="form-control" required="true" data-validation-regexp="" data-validation="custom" maxlength="250" autocomplete="off">
                        </div>
                    </div>
                    <!-- Datos de Ciudad -->
                    <div id="campo_fv" class="form-group row">
                        <label class="col-md-3">@lang('payment.city')</label>
                        <div class="col-md-6">
                            <input id="city" name="city" type="text" style="width:100%; border-radius:5px;" placeholder="@lang('payment.city')" class="form-control" required="true" data-validation-regexp="" data-validation="custom" maxlength="250" autocomplete="off">
                        </div>
                    </div>
                    <!--  Datos de Direccion -->
                    <div id="campo_fv" class="form-group row">
                        <label class="col-md-3">@lang('payment.address1')</label>
                        <div class="col-md-6">
                            <input id="address1" name="address1" type="text" style="width:100%; border-radius:5px;" placeholder="@lang('payment.address1')" class="form-control" required="true" data-validation-regexp="" data-validation="custom" maxlength="250" autocomplete="off">
                        </div>
                    </div>
                    <!-- Datos de  codigo postal -->
                    <div id="campo_fv" class="form-group row">
                        <label class="col-md-3">@lang('payment.zipcode')</label>
                        <div class="col-md-6">
                            <input id="zipcode" name="zipcode" type="text" style="width:100%; border-radius:5px;" placeholder="@lang('payment.zipcode')" class="form-control" required="true" data-validation-regexp="" data-validation="custom" maxlength="250" autocomplete="off">
                        </div>
                    </div>
                    <!-- Datos User Agente -->
                    <!-- Datos Email -->
                    <div id="campo_fv" class="form-group row">
                        <label class="col-md-3">@lang('payment.email')</label>
                        <div class="col-md-6">
                            <input id="email" name="email" type="email" style="width:100%; border-radius:5px;" placeholder="@lang('payment.email')" class="form-control" required="true" data-validation-regexp="" data-validation="custom" maxlength="250" autocomplete="off">
                        </div>
                    </div>
                    <!-- Datos de Cookie -->
                    <!-- Descripcion -->
                    @endif    
    
                    <div class="form-group row">
                        <label class="col-md-3">&nbsp;</label>
                        <div class="col-md-6">
                            <input type="checkbox" id="aceptTerm" name="aceptTerm" data-validation="required" required>
                            <label for="aceptTerm" class="laserFromLabel">
                                <a href="{{ url( asset('/downloads/TermAndCond_' . App::getLocale() . '.pdf') ) }}" target="_blank">
                                    @lang('kiu.payment.accept_termns'). 
                                </a>
                            </label>
                            <a href="{{ url( asset('/downloads/TermAndCond_' . App::getLocale() . '.pdf') ) }}" class="label label-success" download="Contract-Laser">
                                <span class="glyphicon glyphicon-save-file"></span>
                            </a>
                        </div>
                    </div>
                    {{-- Terminos y condicions MIA--}}
                    @if(\Modules\Helpers\AirportHelper::hasLocation($booking->booking_ref, 'MIA'))
                        <div class="form-group row ">
                            <label class="col-md-3">&nbsp;</label>
                            <div class="col-md-6">
                                <input type="checkbox" onclick="marcado();" id="aceptTermWA" name="aceptTermWA" data-validation="required" required>
                                <label for="aceptTermWA" class="laserFromLabel">
                                    <a href="{{ url( asset('/downloads/copc.pdf') ) }}" target="_blank">
                                        @lang('payment.contract').
                                    </a>
                                </label>
                                <a href="{{  url( asset('/downloads/copc.pdf') ) }}" class="label label-success" download="Contract-WAA">
                                        <span class="glyphicon glyphicon-save-file"></span>
                                    </a>
                            </a>
                            </div>
                        </div>    
                    @endif
                    <div class="form-group row">
                        <label class="col-md-3">@lang('kiu.payment.captcha')</label>
                        <div class="col-md-2">
                                {!! Recaptcha::render() !!}
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4"></div>
                             <div class="col-md-4"> 
                                <input type="submit" name="enviar" id="enviar" class="btn btn-cotice col-md-12" value="@lang('kiu.payment.pay')" onClick="this.form.submit(); this.disabled=true; this.value='@lang('payment.loading')'; "> 
                            </div> 
                        <div class="col-md-4"></div>
                    </div>
                    
                     <div class="row">
                        <div class="col-md-4"></div>
                            @if( ($booking->currency) == 'USD')
                                <div class="col-md-4">
                                    <img src="{{ asset('img/logoinstapago.png') }}" class="img-responsive" style="margin-top: 30px;">
                                 </div>
                            @else
                                    <div class="col-md-4">
                                        <img src="{{ asset('img/instapago.png') }}" class="img-responsive" style="margin-top: 30px; margin-left: 1%;">
                                    </div>
                            @endif
                        <div class="col-md-4"></div>
                    </div>
                    <!-- Aqui Coloco el mensaje modal para contrato MIA -->
                        @include('kiu.contract.contractModal')
                    <!-- Aqui Coloco el mensaje modal para contrato MIA --> 
                    {!! Form::close() !!}
                </div>
            </div>
            @endif
        </div>
        <!-- Modal JO 20/12/2018 Ventana POPUP Informatica Bancaria --> 
        <div class="modal fade bs-example-modal-md" id="CondBancaria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        <img src="{{ asset('img/CondBancaria1.png') }}"  alt="LaserAirlines">
                    </div> 
                </div>
            </div> 
        </div>
        <!-- Fin JO -->
        <!-- Modal 
        <div class="modal fade bs-example-modal-md" id="Modalpayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        <img src="{{ asset('img/pop_payment2.jpg') }}"  alt="LaserAirlines">
                    </div> 
                </div>
            </div> 
        </div>
        -->
    </div>
@endsection
