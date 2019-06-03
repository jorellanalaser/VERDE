@extends('layouts.simplepage')

@section('content')
    <div class="container">
        <div class="row row-bottom-padded-lg to-animate">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <p style="font-size:200%; color:#87bc24;" align="left">
                            <a href="{{ url('/#contact') }}">
                                <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMxLjA1OSAzMS4wNTkiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMxLjA1OSAzMS4wNTk7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNjRweCIgaGVpZ2h0PSI2NHB4Ij4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMzAuMTcxLDE2LjQxNkgwLjg4OEMwLjM5OCwxNi40MTYsMCwxNi4wMiwwLDE1LjUyOWMwLTAuNDksMC4zOTgtMC44ODgsMC44ODgtMC44ODhoMjkuMjgzICAgIGMwLjQ5LDAsMC44ODgsMC4zOTgsMC44ODgsMC44ODhDMzEuMDU5LDE2LjAyLDMwLjY2MSwxNi40MTYsMzAuMTcxLDE2LjQxNnoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KCTxnPgoJCTxwYXRoIGQ9Ik0xNi4wMTcsMzEuMDU5Yy0wLjIyMiwwLTAuNDQ1LTAuMDgzLTAuNjE3LTAuMjVMMC4yNzEsMTYuMTY2QzAuMDk4LDE1Ljk5OSwwLDE1Ljc3LDAsMTUuNTI5ICAgIGMwLTAuMjQsMC4wOTgtMC40NzEsMC4yNzEtMC42MzhMMTUuNCwwLjI1YzAuMzUyLTAuMzQxLDAuOTE0LTAuMzMyLDEuMjU1LDAuMDJjMC4zNCwwLjM1MywwLjMzMSwwLjkxNS0wLjAyMSwxLjI1NUwyLjE2MywxNS41MjkgICAgbDE0LjQ3MSwxNC4wMDRjMC4zNTIsMC4zNDEsMC4zNjEsMC45MDIsMC4wMjEsMS4yNTVDMTYuNDgsMzAuOTY4LDE2LjI0OSwzMS4wNTksMTYuMDE3LDMxLjA1OXoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" style="height:auto; width:5%; margin-right:10px;" />
                            </a>

                            @lang('offices.title')
                        </p>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <br><br>
                @if(count($offices) > 0)
                    <?php $control = 0; ?>

                    @foreach ($offices as $office)
                        @if ($control == 0)
                            <div class="row">
                                @endif
                                <?php $control++; ?>

                                <div class="col-md-6">
                                    <div class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object img-responsive" src="{{ asset('/img/ciudades/' . $office->image ) }}" />
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{ $office->title }}</h4>
                                            <strong>@lang('offices.address'):</strong>
                                            <div style="margin-bottom:5px;font-size: 14px">
                                                {{ $office->address }}
                                            </div>
                                            <small style="font-size: 12px"><b><span class="glyphicon glyphicon-time"></span> {{ $office->horary }}</b></small>
                                            <br />
                                            <span class="label label-success">
                                        <i class="glyphicon glyphicon-phone-alt"></i>
                                        <small>&nbsp;&nbsp;{{ $office->phone }} </small>
                                    </span>
                                        </div>
                                    </div>
                                    <br />
                                </div>

                                @if ($control > 1)
                            </div>
                            <?php $control = 0; ?>
                        @endif

                    @endforeach
                @else
                    <br><br>
                    <div class="alert alert-info">
                        <strong>Oficina no encontrada.</strong>
                        <br />
                        Lo sentimos no tenemos oficina en la ciudad indicada.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection