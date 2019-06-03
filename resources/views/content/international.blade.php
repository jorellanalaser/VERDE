@extends('layouts.simplepage')

@section('section-icon')
    <div class="col-md-5 to-animate">
        <center>
            <img src="{{ asset('img/internacional.png') }}" class="img-responsive img-rounded to-animate contenedor" style="width:70%; height:auto; margin:0 0 20px 0;">
        </center>
    </div>
@endsection

@section('content')
    <div class="col-md-7 to-animate">
        <p style="font-size:150%; color:#87bc24;" align="left">
            <a href="{{ url('/#information') }}">
                <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMxLjA1OSAzMS4wNTkiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMxLjA1OSAzMS4wNTk7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNjRweCIgaGVpZ2h0PSI2NHB4Ij4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMzAuMTcxLDE2LjQxNkgwLjg4OEMwLjM5OCwxNi40MTYsMCwxNi4wMiwwLDE1LjUyOWMwLTAuNDksMC4zOTgtMC44ODgsMC44ODgtMC44ODhoMjkuMjgzICAgIGMwLjQ5LDAsMC44ODgsMC4zOTgsMC44ODgsMC44ODhDMzEuMDU5LDE2LjAyLDMwLjY2MSwxNi40MTYsMzAuMTcxLDE2LjQxNnoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KCTxnPgoJCTxwYXRoIGQ9Ik0xNi4wMTcsMzEuMDU5Yy0wLjIyMiwwLTAuNDQ1LTAuMDgzLTAuNjE3LTAuMjVMMC4yNzEsMTYuMTY2QzAuMDk4LDE1Ljk5OSwwLDE1Ljc3LDAsMTUuNTI5ICAgIGMwLTAuMjQsMC4wOTgtMC40NzEsMC4yNzEtMC42MzhMMTUuNCwwLjI1YzAuMzUyLTAuMzQxLDAuOTE0LTAuMzMyLDEuMjU1LDAuMDJjMC4zNCwwLjM1MywwLjMzMSwwLjkxNS0wLjAyMSwxLjI1NUwyLjE2MywxNS41MjkgICAgbDE0LjQ3MSwxNC4wMDRjMC4zNTIsMC4zNDEsMC4zNjEsMC45MDIsMC4wMjEsMS4yNTVDMTYuNDgsMzAuOTY4LDE2LjI0OSwzMS4wNTksMTYuMDE3LDMxLjA1OXoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" style="height:auto; width:5%; margin-right:20px;" />
            </a>
            @lang('static.info.inter.title')
        </p>
        <p align="justify" style="margin-left:9%;">@lang('static.info.inter.p1')</p>

        <div class="panel-group" id="accordion">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title" style="margin-left:7%;">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.inter.p2')
                        </a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse in">
                    <div class="panel-body" style="margin-left:7%;">

                        <ul>
                            <li><p align="justify">@lang('static.info.inter.p3')</p></li>
                            <ul>
                               <!-- <li><b><p align="justify">@lang('static.info.inter.p26')</p></b></li>
                                    <align="justify">@lang('static.info.inter.p27')
                                    <ul>
                                    <li align="justify">@lang('static.info.inter.p28')</li>
                                    <li><p align="justify">@lang('static.info.inter.p29')</p></li>
                                </ul> -->

                                <li><b><p align="justify">@lang('static.info.inter.p4')</p></b></li>
                                    <li align="justify">@lang('static.info.inter.p5')</li>
                                    <ul>
                                    <li align="justify">@lang('static.info.inter.p6')</li>
                                    <li align="justify">@lang('static.info.inter.p7')</li>
                                    <li><b> <p align="justify">@lang('static.info.inter.p30')</p></b></li>
                                </ul>

                                <li><b><p align="justify">@lang('static.info.inter.p8'):</p></b></li>
                                <ul>
                                    <li><b><p align="justify">@lang('static.info.inter.p9')</p></b></li>
                                </ul>
                                
                                <li><b><p align="justify">@lang('static.info.inter.p10'):</p></b></li>
                                <ul>
                                    <li align="justify">@lang('static.info.inter.p11')</li>
                                    <li align="justify">@lang('static.info.inter.p31')</li>
                                    <li><b> <p align="justify">@lang('static.info.inter.p32')</p></b></li>
                                </ul>
                            </ul>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title" style="margin-left:7%;">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.inter.p12'):</a>
                    </h4>
                </div>
                <div id="collapse4" class="panel-collapse collapse">
                    <div class="panel-body" style="margin-left:7%;">
                        <ul>
                            <li><p align="justify">@lang('static.info.inter.p13')</p></li>

                            <li><p align="justify">@lang('static.info.inter.p14')</p></li>

                            <li><p align="justify">@lang('static.info.inter.p15')</p></li>

                            <li><p align="justify">@lang('static.info.inter.p16')</p></li>

                            <li><p align="justify">@lang('static.info.inter.p17')</p></li>

                            <li><p align="justify">@lang('static.info.inter.p18')</p></li>

                            <li><p align="justify">@lang('static.info.inter.p19')</p></li>

                            <li><p align="justify">@lang('static.info.inter.p20')</p></li>

                            <li><p align="justify">@lang('static.info.inter.p21')</p></li>

                            <li><p align="justify">@lang('static.info.inter.p22')</p></li>

                            <li><p align="justify">@lang('static.info.inter.p23')</p></li>

                            <li><p align="justify">@lang('static.info.inter.p24')</p></li>

                            <!--<li><p align="justify">@lang('static.info.inter.p25')</p></li> -->
                        </ul>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title" style="margin-left:7%;">
                        <a href="../img/Autorizacion_Cargo_TDC-TecladoAbierto.pdf" target="_blank" style="margin-left:7%; text-decoration:none;">@lang('static.info.inter.p30')</a>
                    <!--                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" style="margin-left:8%; text-decoration:none;" class="acordion">
                            @lang('static.info.inter.p30'):</a> -->
                    </h4>
                </div>
                <div class="panel-heading">
                    <h4 class="panel-title" style="margin-left:7%;">
                        <a href="../img/Card_Authorization_Form.pdf" target="_blank" style="margin-left:7%; text-decoration:none;">@lang('static.info.inter.p31')</a>
                    <!--                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" style="margin-left:8%; text-decoration:none;" class="acordion">
                            @lang('static.info.inter.p31'):</a> -->
                    </h4>
                </div>

            </div>

        </div>
    </div>
@endsection