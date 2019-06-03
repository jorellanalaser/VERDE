@extends('layouts.simplepage')

@section('js')
    <script src="{{ asset('/plugins/other/js/jquery.mask.min.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('.phone').mask('+0Z (000) 0000000', {
                translation: {
                    'Z': {
                        pattern: /\d/,
                        optional: true
                    }
                }
            });
        });

        $( ".dni_action" ).change(function() {
            var nac = $('#dni_type').val().substr(0, 1);
            var ci = $('#dni').val();

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
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 to-animate">
                <p class="col-md-offset-3" style="font-size:200%; color:#87bc24;" align="left">
                    <a href="#" onclick="history.back(-1)">
                        <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMxLjA1OSAzMS4wNTkiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMxLjA1OSAzMS4wNTk7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNjRweCIgaGVpZ2h0PSI2NHB4Ij4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMzAuMTcxLDE2LjQxNkgwLjg4OEMwLjM5OCwxNi40MTYsMCwxNi4wMiwwLDE1LjUyOWMwLTAuNDksMC4zOTgtMC44ODgsMC44ODgtMC44ODhoMjkuMjgzICAgIGMwLjQ5LDAsMC44ODgsMC4zOTgsMC44ODgsMC44ODhDMzEuMDU5LDE2LjAyLDMwLjY2MSwxNi40MTYsMzAuMTcxLDE2LjQxNnoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KCTxnPgoJCTxwYXRoIGQ9Ik0xNi4wMTcsMzEuMDU5Yy0wLjIyMiwwLTAuNDQ1LTAuMDgzLTAuNjE3LTAuMjVMMC4yNzEsMTYuMTY2QzAuMDk4LDE1Ljk5OSwwLDE1Ljc3LDAsMTUuNTI5ICAgIGMwLTAuMjQsMC4wOTgtMC40NzEsMC4yNzEtMC42MzhMMTUuNCwwLjI1YzAuMzUyLTAuMzQxLDAuOTE0LTAuMzMyLDEuMjU1LDAuMDJjMC4zNCwwLjM1MywwLjMzMSwwLjkxNS0wLjAyMSwxLjI1NUwyLjE2MywxNS41MjkgICAgbDE0LjQ3MSwxNC4wMDRjMC4zNTIsMC4zNDEsMC4zNjEsMC45MDIsMC4wMjEsMS4yNTVDMTYuNDgsMzAuOTY4LDE2LjI0OSwzMS4wNTksMTYuMDE3LDMxLjA1OXoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" style="height:auto; width:5%; margin-right:20px;" />
                    </a>
                         @lang('kiu.passengers.edit_link')
                </p>

                {!! Form::open(['route' => ['user.profile.update'], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

                <div class="form-group{{ $errors->has('dni') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">{{ trans('register.dni') }}</label>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <input id="dni" type="text" class="form-control dni_action" name="dni" value="{{ (!is_null(old('dni_type'))) ? old('dni_type') : Auth::user()->dni_type }}" autocomplete="off" min="7" maxlength="8" size="8" pattern="[0-9]{7,8}" readonly required>
                            </div>
                            <div class="col-sm-8">
                                <input id="dni" type="text" class="form-control dni_action" name="dni" value="{{ (!is_null(old('dni'))) ? old('dni') : Auth::user()->dni }}" autocomplete="off" min="7" maxlength="8" size="8" pattern="[0-9]{7,8}" readonly required>
                            </div>
                        </div>

                        @if ($errors->has('dni'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('dni') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('dni2') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">{{ trans('register.dni2') }}</label>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-sm-12">
                                <input id="dni2" type="text" class="form-control dni_action" name="dni2" value="{{ (!is_null(old('dni2'))) ? old('dni2') : Auth::user()->dni2 }}" autocomplete="off" min="7" maxlength="8" size="8" pattern="[0-9]{7,8}" required>
                            </div>
                        </div>

                        @if ($errors->has('dni2'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('dni2') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <!-- Aqui coloca Fecha de Expiracion -->
                         <div class="form-group{{ $errors->has('exp_date') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">{{ trans('register.exp_date') }}</label>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-12 datepicker">
                                        <input id="exp_date" type="text" class="form-control" name="exp_date" value="{{ (!is_null(old('exp_date'))) ? old('exp_date') : Auth::user()->exp_date }}" autocomplete="off" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="0d" required>
                                    </div>
                                </div>

                                @if ($errors->has('exp_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('exp_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-1"><button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top" data-content="{{ trans('register.infoexp_date') }}" style="margin: 0px;">?</button></div>
                        </div>       
                        <!-- Termino Fecha de Expiracion  -->

                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">{{ trans('register.first_name') }}</label>

                    <div class="col-md-6">
                        <input id="first_name" type="text" class="form-control" name="first_name" value="{{ (!is_null(old('first_name'))) ? old('first_name') : Auth::user()->first_name }}" readonly required>

                        @if ($errors->has('first_name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">{{ trans('register.last_name') }}</label>

                    <div class="col-md-6">
                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ (!is_null(old('last_name'))) ? old('last_name') : Auth::user() ->last_name}}" readonly required>

                        @if ($errors->has('last_name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <!-- Aqui coloca Fecha Nacimiento -->
                        <div class="form-group{{ $errors->has('BirtfDate') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">{{ trans('register.BirtfDate') }}</label>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-12 datepicker">
                                        <input id="BirtfDate" type="text" class="form-control" name="BirtfDate" value="{{ (!is_null(old('BirtfDate'))) ? old('BirtfDate') : Auth::user() ->BirtfDate}}" autocomplete="off" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="-120y" data-date-end-date="-18y" required >
                                    </div>
                                </div>

                                @if ($errors->has('BirtfDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('BirtfDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- Termino Fecha Nacimiento  --> 

                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                    <label for="gender" class="col-md-4 control-label">{{ trans('register.gender') }}</label>

                    <div class="col-md-6">
                        <label class="radio-inline">
                            <input type="radio" name="gender" value="M" {{ (Auth::user()->gender == 'M') ? 'checked="checked"' : null }}  >
                            {{ trans('register.genders.m') }}
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="gender" value="F" {{ (Auth::user()->gender == 'F') ? 'checked="checked"' : null }}>

                            {{ trans('register.genders.f') }}
                        </label>

                        @if ($errors->has('gender'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address" class="col-md-4 control-label">{{ trans('register.address') }}</label>

                    <div class="col-md-6">
                        <input id="address" type="text" class="form-control" name="address" value="{{ (!is_null(old('address'))) ? old('address') : Auth::user()->address }}" required>

                        @if ($errors->has('address'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    @foreach(Auth::user()->contacts as $contact)
                        <label for="" class="col-md-4 control-label">{{ trans('register.' . $contact->type) }}</label>
                        <div class="col-md-6">
                            <input type="{{ ($contact->type == 'email') ? $contact->type : 'text' }}" class="form-control {{ ($contact->type == 'phone') ? $contact->type : null }}" name="contact[]" value="{{ (!is_null(old('address'))) ? old('address') : $contact->contact }}" required>
                            <input type="hidden" name="contact_type[]" value="{{ $contact->type }}">
                            <input type="hidden" name="contact_id[]" value="{{ $contact->id }}">
                            @if ($errors->has('address'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-success col-xs-12">
                            <i class="fa fa-btn fa-user"></i> @lang('kiu.passengers.edit_link')
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}

                @if(Session::has('alert-success'))
                    <br/>
                    <div class="alert alert-success">
                        {{ Session::get('alert-success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection