@extends($res = ($layoutInt =='US') ? 'waa.simplepage': 'layouts.simplepage')


@section('js')
    <script type="text/javascript">

        $(document).ready(function () {
            @if(Auth::user()->country->iso2 != 've')
                $('.div_dni_nac').hide();
                $('.dni_inp_nac').attr('disabled', true);
            @else
                $('.div_dni_int').hide();
                $('.dni_inp_int').attr('disabled', true);
            @endif

            @if($paxs->ADT > 1)
                @for($i = 1; $i < $paxs->ADT; $i++)
                    $('#country_{{ $i }}').on('change', function () {
                    if($('#country_{{ $i }}').val() == 241)
                    {
                        $('#div_dni_nac_{{ $i }}').show(500);
                        $('#div_dni_int_{{ $i }}').hide(500);
                        $('#dni_int_{{ $i }}').attr('disabled', true);
                        $('#dni_nac_{{ $i }}').attr('disabled', false);
                    }
                    else
                    {
                        $('#div_dni_nac_{{ $i }}').hide(500);
                        $('#div_dni_int_{{ $i }}').show(500);
                        $('#dni_int_{{ $i }}').attr('disabled', false);
                        $('#dni_nac_{{ $i }}').attr('disabled', true);
                    }
                });
                @endfor
            @endif
        });

        function cne(id) {
            var nac = $('#dni_type_' + id).val().substr(0, 1);
            var ci = $('#dni_nac_' + id).val();

            $.ajax({
                type: 'get',
                dataType: "json",
                url: "{{ url('/search/cne') }}/" + nac + "/" + ci,
                success: function ($response) {
                    var names = $response.nombres;
                    var surnames = $response.apellidos;

                    if($response.nombres == null)
                    {
                        $('#first_name_' + id).attr('value', null);
                        $('#last_name_' + id).attr('value', null);
                        $('#first_name_' + id).attr('readonly', false);
                        $('#last_name_' + id).attr('readonly', false);
                    }
                    else
                    {
                        $('#first_name_' + id).attr('value', names);
                        $('#last_name_' + id).attr('value', surnames);
                        $('#first_name_' + id).attr('readonly', true);
                        $('#last_name_' + id).attr('readonly', true);
                    }
                },
                error: function () {
                    $('#first_name_' + id).attr('value', null);
                    $('#last_name_' + id).attr('value', null);
                    $('#first_name_' + id).attr('readonly', false);
                    $('#last_name_' + id).attr('readonly', false);
                }
            });
        }
            $(document).ready(function(){
                $('#ValfechaPasaporte').hide("linear");
                inp1 = document.getElementById('exp_date').value; //2017-02-23
                var fecha = new Date();
                var fecha2 = new Date(inp1);
                var fecha3 = new Date(fecha2);
                    fecha3.setMonth(fecha3.getMonth()+1);
                var fecha4 = new Date();
                    fecha4.setMonth(fecha4.getMonth()+1);
  
//document.write("<br> Fecha Actual " + fecha + "<br> Fecha Pasaporte " + fecha2 + "<br> Fecha Pasaporte mas un mes " + fecha3 + "<br> Fecha actual mas un mes " + fecha4);                       
                if(fecha2 > fecha4){
                        $('#ValfechaPasaporte').hide("linear");
                    }else{
                        $('#ValfechaPasaporte').show("linear");
                };
            });

    </script>
@endsection

@section('content')
    <div class="container to-animate">
        <div class="row" id="about-us">
            <div class="row">
                <div class="col-sm-1 col-xs-2">
                    <a href="javascript:history.back()" id="goback" style="float:left">
                        <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMxLjQ5NCAzMS40OTQiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMxLjQ5NCAzMS40OTQ7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNjRweCIgaGVpZ2h0PSI2NHB4Ij4KPHBhdGggZD0iTTEwLjI3Myw1LjAwOWMwLjQ0NC0wLjQ0NCwxLjE0My0wLjQ0NCwxLjU4NywwYzAuNDI5LDAuNDI5LDAuNDI5LDEuMTQzLDAsMS41NzFsLTguMDQ3LDguMDQ3aDI2LjU1NCAgYzAuNjE5LDAsMS4xMjcsMC40OTIsMS4xMjcsMS4xMTFjMCwwLjYxOS0wLjUwOCwxLjEyNy0xLjEyNywxLjEyN0gzLjgxM2w4LjA0Nyw4LjAzMmMwLjQyOSwwLjQ0NCwwLjQyOSwxLjE1OSwwLDEuNTg3ICBjLTAuNDQ0LDAuNDQ0LTEuMTQzLDAuNDQ0LTEuNTg3LDBsLTkuOTUyLTkuOTUyYy0wLjQyOS0wLjQyOS0wLjQyOS0xLjE0MywwLTEuNTcxTDEwLjI3Myw1LjAwOXoiIGZpbGw9IiNjY2NjY2MiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" style="height:auto; width:80%; margin-right:20%;" />
                    </a>
                </div>
                <div class="col-sm-10 col-xs-8">
                </div>
            </div>

            {!! Form::open(['route' => ['Kiu.AirBook']]) !!}
                @for($i = 0; $i < $paxs->ADT; $i++)
                    @if( ($userisocountry) == 'US')
                        @if($layoutInt == 'US')
                            <p style="font-size:250%; color:#87bc24; margin-bottom: 20px;" align="center">
                                <img src="{{ asset('img/bolet-2.png') }}"> {{ trans('kiu.passengers.pax') }} {{ $i + 1 }}
                            </p>
                            <p style="margin-left: 44%;color:#87bc24;"><span style="color:#87bc24; margin-right: 5px;" class="glyphicon glyphicon-tags" aria-hidden="true"> </span> @lang('kiu.itineraries.charter')</p> 
                        @else
                            <p style="font-size:250%; color:#87bc24; margin-bottom: 20px;" align="center">
                                <img src="{{ asset('img/bolet-2.png') }}"> {{ trans('kiu.passengers.pax') }} {{ $i + 1 }}
                            </p>
                        @endif
                    @else
                        <p style="font-size:250%; color:#87bc24; margin-bottom: 20px;" align="center">
                            <img src="{{ asset('img/bolet-2.png') }}"> {{ trans('kiu.passengers.pax') }} {{ $i + 1 }}
                        </p>
                    @endif
                    <div class="row col-xs-offset-1">
                        <div class="col-md-2"></div>
                        <div class="col-lg-8">
                            @if($i == 0)
                                <div class="row hidden" align="center" style="margin:20px">
                                    <span><b style="color:grey">@lang('kiu.passengers.edit_msg') <a href="{{ route('user.profile.edit') }}" class="link" style="color:blue">@lang('kiu.passengers.edit_link')</a></b></span>
                                    <br>
                                </div>    
                                @if($is_int)
                                    @if(Auth::user()->country->iso2 == 've')
                                    <div class="form-group{{ $errors->has('dni2') ? ' has-error' : '' }} row">
                                        <label for="name" class="col-md-2 regispasenger1" style="text-align: left;">{{ trans('register.dni2') }}</label>

                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <select id="dni2_type" style="margin:0px;" name="dni2_type" class="form-control" {{ (Auth::user()->dni2_type != '') ? 'disabled' : null }}>
                                                        <option value="VP" {{ (Auth::user()->dni2_type == 'VP') ? 'selected' : null }}>VP</option>
                                                        <option value="EP" {{ (Auth::user()->dni2_type == 'EP') ? 'selected' : null }}>EP</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input id="dni2" type="text" class="form-control" name="dni2" value="{{ (!is_null(old('dni2'))) ? old('dni2') : Auth::user() ->dni2 }}" autocomplete="off" disabled="true" required>
                                                </div>
                                            </div>

                                            @if ($errors->has('dni2'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('dni[' . $i . ']') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Aqui Alerto Sobre la Fecha de Pasaporte -->
                                        <div id="ValfechaPasaporte" class="col-md-10 alert alert-warning alert-dismissible" role="alert">
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              <strong>{{ trans('register.atencion') }}</strong> {{ trans('register.infoexp_date') }}
                                        </div>
                                        <!-- Aqui Alerto Sobre la Fecha de Pasaporte -->
                                        <!-- Aqui Traigo la Fecha de Pasaporte -->
                                         <div class="form-group row">
                                            <label class="col-md-4 expdatepasaporte">{{ trans('register.exp_date') }}</label>
                                            <div class="col-md-6">
                                                <input id="exp_date" type="text" style="width:100%; border-radius:5px" class="form-control" value="{{ Auth::user()->exp_date }}" 
                                                data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="0d" disabled="true">
                                            </div>
                                        </div>
                                        <!-- Aqui Traigo la Fecha de Pasaporte -->
                                    @else
                                    
                                    <!-- Esconde en un Hiden el Psaporte tipo -->
                                        <div class="form-group{{ $errors->has('dni2') ? ' has-error' : '' }} row">
                                            <label for="name" class="col-md-2 regispasenger1" style="text-align: left;">{{ trans('register.passport') }}</label>

                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-sm-4 hidden">
                                                        <select id="dni2_type" name="dni2_type" style="margin:0px;" class="form-control" {{ (Auth::user()->dni2_type != '') ? 'disabled' : null }}>
                                                            <option value="VP" {{ (Auth::user()->dni2_type == 'VP') ? 'selected' : null }}>VP</option>
                                                            <option value="EP" {{ (Auth::user()->dni2_type == 'EP') ? 'selected' : null }}>EP</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <input id="dni2" type="text" class="form-control" name="dni2" value="{{ (!is_null(old('dni2'))) ? old('dni2') : Auth::user() ->dni2 }}" autocomplete="off" required {{ (Auth::user()->dni2 != '') ? 'disabled' : null }}>
                                                    </div>
                                                </div>

                                                @if ($errors->has('dni2'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('dni[' . $i . ']') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                    @endif
                                 @else
                                    @if(Auth::user()->country->iso2 != 've')
                                         <div class="form-group row">
                                        <!-- Error de Conversion debe estar el fom-group bootrapt 1.5 -->
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2" style="text-align: left;">{{ trans('register.dni2') }}</label>
                                            <div class="col-md-8">
                                                <input type="text" style="width:100%; border-radius:5px" class="form-control" value="{{ (!is_null(old('dni2'))) ? old('dni2') : Auth::user() ->dni2 }}" disabled="true">
                                            </div>
                                        </div>
                                    @else 
                                        <div class="form-group row">
                                        <!-- Error de Conversion debe estar el fom-group bootrapt 1.5 -->
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2" style="text-align: left;">{{ trans('register.dni') }}</label>
                                            <div class="col-md-8">
                                                <input type="text" style="width:100%; border-radius:5px" class="form-control" value="{{ (!is_null(old('dni'))) ? old('dni') : Auth::user() ->dni }}" disabled="true">
                                            </div>
                                        </div>
                                    @endif      
                                @endif
                                <div class="form-group row">
                                    <label class="col-md-2 regispasenger1">{{ trans('register.first_name') }}</label>
                                    <div class="col-md-8">
                                        <input type="text" style="width:100%; border-radius:5px" class="form-control" value="{{ Auth::user()->first_name }}" disabled="true">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 regispasenger1">{{ trans('register.last_name') }}</label>
                                    <div class="col-md-8">
                                        <input type="text" style="width:100%; border-radius:5px" placeholder="" class="form-control" value="{{ Auth::user()->last_name }}" disabled="true">
                                    </div>
                                </div>
                            @else
                                <div class="form-group{{ $errors->has('country' . $i ) ? ' has-error' : '' }} row">
                                    <label for="name" class="col-md-2 control-label regispasenger1">{{ trans('register.country') }}</label>

                                    <div class="col-md-8">
                                        <select name="country[{{ $i }}]" id="country_{{ $i }}" class="form-control nationality">
                                            <option value="">@lang('general.select')</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}" {{ ($country->id == Auth::user()->country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('country' . $i ))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div id="div_dni_int_{{ $i }}" class="form-group{{ $errors->has('dni.' . $i ) ? ' has-error' : '' }} row div_dni_int">
                                    <label for="name" class="col-md-2 control-label regispasenger1">{{ trans('register.passport') }}</label>

                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input id="dni_int_{{ $i }}" type="text" class="form-control dni_inp_int" name="dni[{{ $i }}]" value="{{ old('dni') }}" autocomplete="off" required>
                                            </div>
                                        </div>

                                        @if ($errors->has('dni.' . $i ))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('dni.' . $i ) }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div id="div_dni_nac_{{ $i }}" class="form-group{{ $errors->has('dni.' . $i ) ? ' has-error' : '' }} row div_dni_nac">
                                    <label for="name" class="col-md-2 control-label" style="text-align: left;padding-top: 10px;">{{ trans('register.' . (($is_int) ? 'passport' : 'dni' ) ) }}</label>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <select id="dni_type_{{ $i }}" name="dni_type[{{ $i }}]" style="margin:0px;" class="form-control dni_action">
                                                    @if(!$is_int)
                                                        <option value="VCI">V</option>
                                                        <option value="ECI">E</option>
                                                    @else
                                                        <option value="VP">VP</option>
                                                        <option value="EP">EP</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-sm-8">
                                                <input id="dni_nac_{{ $i }}" type="text" class="form-control dni_action dni_inp_nac" name="dni[{{ $i }}]" value="{{ old('dni') }}" autocomplete="off" required onchange="cne({{ $i }})">
                                            </div>
                                        </div>

                                        @if ($errors->has('dni.' . $i ))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('dni.' . $i ) }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- Aqui Traigo la Fecha de Pasaporte al segundo pasajero-->

                                         <div class="form-group{{ $errors->has('exp_date.' . $i) ? ' has-error' : '' }} row">
                                            <label for="name" class="col-md-4 control-label expdatepasaporte">{{ trans('register.exp_date') }}</label>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-sm-12 datepicker">
                                                        <input id="exp_date_{{ $i }}" type="text" class="form-control" name="exp_date[{{ $i }}]" value="{{ old('exp_date[' . $i . ']') }}" autocomplete="off" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="0d" required>
                                                    </div>
                                                </div>

                                                @if ($errors->has('exp_date'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('exp_date') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                <!-- Aqui Traigo la Fecha de Pasaporte -->
                                <!-- Aqui Traigo la Fecha de nacimiento al segundo pasajero-->

                                         <div class="form-group{{ $errors->has('BirtfDate.' . $i) ? ' has-error' : '' }} row">
                                            <label for="name" class="col-md-4 control-label expdatepasaporte">{{ trans('register.BirtfDate') }}</label>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-sm-12 datepicker">
                                                        <input id="BirtfDate_{{ $i }}" type="text" class="form-control" name="BirtfDate[{{ $i }}]" value="{{ old('BirtfDate[' . $i . ']') }}" autocomplete="off" data-provide="datepicker" data-date-format="yyyy-mm-dd"  data-date-end-date="-12y" required>
                                                    </div>
                                                </div>

                                                @if ($errors->has('exp_date'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('exp_date') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                <!-- Aqui Traigo la Fecha de Pasaporte -->
                                <div class="form-group{{ $errors->has('first_name.' . $i ) ? ' has-error' : '' }} row">
                                    <label for="name" class="col-md-2 control-label regispasenger1" >{{ trans('register.first_name') }}</label>

                                    <div class="col-md-8">
                                        <input id="first_name_{{ $i }}" type="text" class="form-control" name="first_name[{{ $i }}]" value="{{ old('first_name[' . $i . ']') }}" required {{ (Auth::user()->country_id == 490 && !$is_int) ? 'readonly' : null }}>

                                        @if ($errors->has('first_name.' . $i ))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('first_name.' . $i ) }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('last_name.' . $i) ? ' has-error' : '' }} row">
                                    <label for="name" class="col-md-2 control-label regispasenger1">{{ trans('register.last_name') }}</label>

                                    <div class="col-md-8">
                                        <input id="last_name_{{ $i }}" type="text" class="form-control" name="last_name[{{ $i }}]" value="{{ old('last_name[' . $i . ']') }}" required {{ (Auth::user()->country_id == 490 && !$is_int) ? 'readonly' : null }}>

                                        @if ($errors->has('last_name.' . $i ))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('last_name.' . $i ) }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <hr/>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                @endfor
                <div class="row col-md-offset-5">
                    <div class="col-md-6">
                        <button class="btn btn-cotice col-md-6">
                             @lang('kiu.itineraries.nextBtn')
                        </button>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection