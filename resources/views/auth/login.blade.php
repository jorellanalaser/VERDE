@extends('layouts.simplepage')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
             <div class="panel panel-default">
                <div class="panel-heading">@lang('general.nav.signup')</div>
                <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-4 col-md-offset-4" style="margin-bottom:10%;text-align: center;">
                                <a class="" href="{{ url('/register') }}">
                                    <img src="{{ asset('img/icono-registro.png') }}" class="img-responsive">
                                </a>
                            </div>
                            <div class="col-md-12" style="text-align: center;">
                                <p>{{ trans('register.textoregistra') }}</p>
                            </div>
                            <div class="col-md-4 col-md-offset-3">
                                <a class="btn btn-link" href="{{ url('/register')  }}">@lang('general.nav.signup')</a>
                            </div>
                            @if (@lang == 'en')
                                <div class="col-md-4 col-md-offset-4">
                                    <a class="btn btn-link" href="{{ url('/register')  }}">@lang('general.nav.signup')</a>          
                                 </div>    
                            @endif
                        </div>
                  
                </div>
            </div>

        </div>
        <div class="col-md-6 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('auth.login') }}</div>
                <div class="panel-body">
                    @if(\Illuminate\Support\Facades\Session::has('alert-verification_success'))
                        <div class="alert alert-success">
                            <i class="glyphicon glyphicon-warning-sign"></i>
                            {{ \Illuminate\Support\Facades\Session::get('alert-verification_success') }}
                        </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{ trans('auth.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{ trans('auth.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> {{ trans('auth.remember') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-btn fa-sign-in"></i> {{ trans('auth.login') }}
                                </button>
                                <br/><br/>
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">{{ trans('auth.forgot') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
