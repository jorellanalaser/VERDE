@extends('layouts.simplepage')

@section('content')
    <div class="container">
        <div class="row row-bottom-padded-lg to-animate">
            <div class="col-md-5 text-center">
                <img src="{{ asset((Auth::user()->gender == 'M') ? 'img/home-16.png' : 'img/home-17.png') }}" class="img-rounded" style="width:70%; height:auto; margin:0 0 20px 0 !important;">
            </div>
            <div class="col-md-5">

                <p style="font-size:200%; color:#87bc24;" align="left">
                    <a href="{{ route('home') }}">
                        <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMxLjA1OSAzMS4wNTkiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMxLjA1OSAzMS4wNTk7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNjRweCIgaGVpZ2h0PSI2NHB4Ij4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMzAuMTcxLDE2LjQxNkgwLjg4OEMwLjM5OCwxNi40MTYsMCwxNi4wMiwwLDE1LjUyOWMwLTAuNDksMC4zOTgtMC44ODgsMC44ODgtMC44ODhoMjkuMjgzICAgIGMwLjQ5LDAsMC44ODgsMC4zOTgsMC44ODgsMC44ODhDMzEuMDU5LDE2LjAyLDMwLjY2MSwxNi40MTYsMzAuMTcxLDE2LjQxNnoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KCTxnPgoJCTxwYXRoIGQ9Ik0xNi4wMTcsMzEuMDU5Yy0wLjIyMiwwLTAuNDQ1LTAuMDgzLTAuNjE3LTAuMjVMMC4yNzEsMTYuMTY2QzAuMDk4LDE1Ljk5OSwwLDE1Ljc3LDAsMTUuNTI5ICAgIGMwLTAuMjQsMC4wOTgtMC40NzEsMC4yNzEtMC42MzhMMTUuNCwwLjI1YzAuMzUyLTAuMzQxLDAuOTE0LTAuMzMyLDEuMjU1LDAuMDJjMC4zNCwwLjM1MywwLjMzMSwwLjkxNS0wLjAyMSwxLjI1NUwyLjE2MywxNS41MjkgICAgbDE0LjQ3MSwxNC4wMDRjMC4zNTIsMC4zNDEsMC4zNjEsMC45MDIsMC4wMjEsMS4yNTVDMTYuNDgsMzAuOTY4LDE2LjI0OSwzMS4wNTksMTYuMDE3LDMxLjA1OXoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" style="height:auto; width:5%; margin-right:20px;" />
                    </a>

                    {{ trans('dashboard.title') }}
                </p>

                <div class="panel">
                    <div class="page-body">
                        @if(!Auth::user()->confirmed)
                            @if(\Illuminate\Support\Facades\Session::has('alert-verify'))
                                <div class="alert alert-danger">
                                    <i class="glyphicon glyphicon-warning-sign"></i>
                                    {{ \Illuminate\Support\Facades\Session::get('alert-verify') }}
                                </div>
                            @endif

                            @if(\Illuminate\Support\Facades\Session::has('alert-verification_failed'))
                                <div class="alert alert-danger">
                                    <i class="glyphicon glyphicon-warning-sign"></i>
                                    {{ \Illuminate\Support\Facades\Session::get('alert-verification_failed') }}
                                </div>
                            @endif

                            <div class="alert alert-warning">
                                <strong><i class="glyphicon glyphicon-warning-sign"></i> @lang('register.warning.confirmed.title')</strong>
                                <p class="text-justify">
                                    @lang('register.warning.confirmed.p1')
                                </p>
                                <br/>
                                <div class="text-justify">
                                    <a href="{{ url('user/verify/send') }}" class="btn-link">
                                        @lang('register.warning.confirmed.p2')
                                    </a>
                                </div>
                            </div>
                        @elseif(\Illuminate\Support\Facades\Session::has('alert-verification_success'))
                            <div class="alert alert-success">
                                <i class="glyphicon glyphicon-warning-sign"></i>
                                {{ \Illuminate\Support\Facades\Session::get('alert-verification_success') }}
                            </div>
                        @endif
                        <table width="500px">
                            <tr>
                                <th>{{ trans('register.first_name') }}:</th>
                                <td>{{ Auth::user()->first_name }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('register.last_name') }}:</th>
                                <td>{{ Auth::user()->last_name }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('register.dni') }}:</th>
                                <td>{{ substr(Auth::user()->dni_type, 0, 1) }}{{ Auth::user()->dni }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('register.gender') }}:</th>
                                <td>{{ trans('register.genders.' . strtolower(Auth::user()->gender) ) }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('register.address') }}:</th>
                                <td>{{ Auth::user()->address }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('register.email') }}:</th>
                                <td>{{ Auth::user()->email }}</td>
                            </tr>
                            <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
                            <tr>
                                 <th colspan="2" class="text-center">{{ trans('dashboard.contacts')}}</th>
                            </tr>
                            @foreach(Auth::user()->contacts as $contact)
                                <tr>
                                    <th>{{ trans('register.' . $contact->type) }}:</th>
                                    <td>{{ $contact->contact }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="row" style="margin-top:30px;">
                    <div class="col-xs-5" align="right">
                        <a href="{{ route('user.profile.edit') }}" class="btn btn-success">{{ trans('dashboard.profile.edit') }}</a>
                    </div>
                    <div class="col-xs-2"></div>
                    <!-- Escondo Listado de Vuelos -->
                    <!-- <div class="col-xs-5" align="left">
                        <a href="{{ route('users.flights') }}" class="btn btn-success">
                            @lang('dashboard.my_flights')
                        </a>
                    </div> -->
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection