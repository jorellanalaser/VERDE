@extends('layouts.simplepage')

@section('js')
    <script src="{{ asset('/plugins/other/js/jquery.mask.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#div_dni_nac').hide();
            $('#phone').mask('+0Z (000) 0000000', {
                translation: {
                    'Z': {
                        pattern: /\d/,
                        optional: true
                    }
                }
            });
            $('#country').on('change', function () {
                if($('#country').val() == 241)
                {
                    $('#div_dni_nac').show(500);
                    $('#div_dni_int').hide(500);
                    $('#dni_int').attr('disabled', true);
                    $('#dni_nac').attr('disabled', false);
                    $('#first_name').attr('value', null);
                    $('#last_name').attr('value', null);
                    $('#first_name').attr('readonly', false);
                    $('#last_name').attr('readonly', false);
                }
                else
                {
                    $('#div_dni_nac').hide(500);
                    $('#div_dni_int').show(500);
                    $('#dni_int').attr('disabled', false);
                    $('#dni_nac').attr('disabled', true);
                    $('#first_name').attr('value', null);
                    $('#last_name').attr('value', null);
                    $('#first_name').attr('readonly', false);
                    $('#last_name').attr('readonly', false);
                }
            });
        });

        $( ".dni_action" ).change(function() {
            var nac = $('#dni_type').val().substr(0, 1);
            var ci = $('#dni_nac').val();

            $.ajax({
                type: 'get',
                dataType: "json",
                url: "{{ url('/search/cne') }}/" + nac + "/" + ci,
                success: function ($response) {
                    var names = $response.nombres;
                    var surnames = $response.apellidos;

                    if($response.nombres == null)
                    {
                        $('#first_name').attr('value', null);
                        $('#last_name').attr('value', null);
                        $('#first_name').attr('readonly', false);
                        $('#last_name').attr('readonly', false);
                    }
                    else
                    {
                        $('#first_name').attr('value', names);
                        $('#last_name').attr('value', surnames);
                        $('#first_name').attr('readonly', true);
                        $('#last_name').attr('readonly', true);
                    }
                },
                error: function () {
                    $('#first_name').attr('value', null);
                    $('#last_name').attr('value', null);
                    $('#first_name').attr('readonly', false);
                    $('#last_name').attr('readonly', false);
                }
            });
        });
            $(function () {
              $('[data-toggle="popover"]').popover()
            })
    </script>
    <script type="text/javascript">
        $(function() {
          $("#BirtfDate").datepicker({  
                startView: 'years'
            });
          $("#exp_date").datepicker({  
                startView: 'years'
            });
        });
    </script>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('register.register') }}</div>
                <div class="panel-body">
                    @if(\Illuminate\Support\Facades\Session::has('alert-verification_failed'))
                        <div class="alert alert-danger">
                            <i class="glyphicon glyphicon-warning-sign"></i>
                            {{ \Illuminate\Support\Facades\Session::get('alert-verification_failed') }}
                        </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label registersenger">{{ trans('register.country') }}</label>

                            <div class="col-md-6">
                                <select name="country" id="country" class="form-control">
                                    <option value="">@lang('general.select')</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div id="div_dni_int" class="form-group{{ $errors->has('dni') ? ' has-error' : '' }}">
                            <!-- <label for="name" class="col-md-4 control-label">{{ trans('register.dni_int') }}</label>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input id="dni_int" type="text" class="form-control" name="dni" value="{{ old('dni') }}" autocomplete="off" required>
                                    </div>
                                </div>

                                @if ($errors->has('dni'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dni') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-1"><button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top" data-content="{{ trans('register.infodni') }}">?</button>
                            </div> -->
                        </div>
                        <div id="div_dni_nac" class="form-group{{ $errors->has('dni') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">{{ trans('register.dni') }}</label>
                            <div class="col-md-6">
                                    <div class="col-sm-4">
                                        <select id="dni_type" name="dni_type" class="form-control dni_action" style="margin-top:0px;margin-bottom:0px;">
                                            <option value="VCI">V</option>
                                            <option value="ECI">E</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-8">
                                        <input id="dni_nac" type="text" class="form-control dni_action" name="dni" value="{{ old('dni') }}" autocomplete="off" min="7" maxlength="8" size="8" pattern="[0-9]{7,8}" required>
                                    </div>
                                @if ($errors->has('dni'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dni') }}</strong>
                                    </span>
                                @endif                              
                            </div>
                            <div class="col-ms-1"><button style="margin-left: 2%;" type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top" data-content="{{ trans('register.infodni') }}">?</button></div>
                        </div>
                        <!-- Aqui coloca Pasaporte -->
                        <div id="div_dni_int" class="form-group{{ $errors->has('dni2') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">{{ trans('register.dni2') }}</label>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input id="dni_int2" type="text" class="form-control" name="dni2" value="{{ old('dni2') }}" autocomplete="off" required>
                                    </div>
                                </div>
                                @if ($errors->has('dni2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dni2') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-1"><button style="margin: 0px;" type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top" data-content="{{ trans('register.infodni2') }}">?</button></div>
                        </div>
                        <!-- Termino Pasaporte   -->
                        <!-- Aqui coloca Fecha de Expiracion -->
                         <div class="form-group{{ $errors->has('exp_date') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label expdatepasaporte2">{{ trans('register.exp_date') }}</label>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-12 datepicker">
                                        <input id="exp_date" type="text" class="form-control" name="exp_date" value="{{ old('exp_date') }}" autocomplete="off" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" data-date-start-date="0d" required>
                                    </div>
                                </div>
                                @if ($errors->has('exp_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('exp_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-1"><button style="margin: 0px;" type="button" class="btn bten-dfault" data-container="body" data-toggle="popover" data-placement="top" data-content="{{ trans('register.infoexp_date') }}">?</button></div>
                        </div>       
                        <!-- Termino Fecha de Expiracion  -->    
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label registersenger2">{{ trans('register.first_name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label registersenger2">{{ trans('register.last_name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- Aqui coloca Fecha Nacimiento -->
                        <div class="form-group{{ $errors->has('BirtfDate') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label registersenger2">{{ trans('register.BirtfDate') }}</label>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-12 datepicker">
                                        <input id="BirtfDate" type="text" class="form-control" name="BirtfDate" value="{{ old('BirtfDate') }}" autocomplete="off" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="-120y" data-date-end-date="-18y" placeholder="yyyy-mm-dd" required >
                                    </div>
                                </div>

                                @if ($errors->has('BirtfDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('BirtfDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-1">
                                <button style="margin: 0px;" type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top" data-content="{{ trans('register.birtfdate') }}">!</button>
                            </div>
                        </div>
                        <!-- Termino Fecha Nacimiento  --> 
                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">{{ trans('register.gender') }}</label>

                            <div class="col-md-6">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="M" checked="checked">{{ trans('register.genders.m') }}
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="F">{{ trans('register.genders.f') }}
                                </label>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label registersenger2">{{ trans('register.address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="address" class="form-control" name="address" value="{{ old('address') }}" required>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label registersenger2">{{ trans('register.phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="phone" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="+00 (000) 000-0000" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label registersenger2">{{ trans('register.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="off" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label registersenger2">{{ trans('register.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label registersenger2">{{ trans('register.password_confirmation') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3"></label>
                            <div class="col-md-2">
                                    
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label registersenger2">@lang('kiu.payment.captcha')</label>
                            <div class="col-md-6">
                                {!! Recaptcha::render() !!}
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('marketing') ? ' has-error' : '' }}">
                            <label for="marketing" class="col-md-4 control-label registersenger2"></label>
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label class="checkbox-inline">
                                      <input type="checkbox" name="marketing" id="marketing" value="1" checked requerid>{{ trans('register.acceptNotifications') }}
                                    </label>
                                </div>
                                @if ($errors->has('marketing'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('marketing') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
