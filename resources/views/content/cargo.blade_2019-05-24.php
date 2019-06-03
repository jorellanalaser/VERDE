@extends('layouts.simplepage')

@section('section-icon')
    <!-- Icono de la pagina -->
    <div class="col-md-5 to-animate">
        <center>
            <img src="{{ asset('img/lasercargo.png') }}" class="img-responsive img-rounded to-animate contenedor" style="width:70%; height:auto; margin:0 0 20px 0;">
        </center>
    </div>
@endsection

@section('content')

    <!-- Contenido de la pagina -->
    <div class="col-md-7 to-animate">
        <p style="font-size:150%; color:#87bc24;" align="left">
            <a href="{{ url('/#information') }}">
                <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMxLjA1OSAzMS4wNTkiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMxLjA1OSAzMS4wNTk7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNjRweCIgaGVpZ2h0PSI2NHB4Ij4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMzAuMTcxLDE2LjQxNkgwLjg4OEMwLjM5OCwxNi40MTYsMCwxNi4wMiwwLDE1LjUyOWMwLTAuNDksMC4zOTgtMC44ODgsMC44ODgtMC44ODhoMjkuMjgzICAgIGMwLjQ5LDAsMC44ODgsMC4zOTgsMC44ODgsMC44ODhDMzEuMDU5LDE2LjAyLDMwLjY2MSwxNi40MTYsMzAuMTcxLDE2LjQxNnoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KCTxnPgoJCTxwYXRoIGQ9Ik0xNi4wMTcsMzEuMDU5Yy0wLjIyMiwwLTAuNDQ1LTAuMDgzLTAuNjE3LTAuMjVMMC4yNzEsMTYuMTY2QzAuMDk4LDE1Ljk5OSwwLDE1Ljc3LDAsMTUuNTI5ICAgIGMwLTAuMjQsMC4wOTgtMC40NzEsMC4yNzEtMC42MzhMMTUuNCwwLjI1YzAuMzUyLTAuMzQxLDAuOTE0LTAuMzMyLDEuMjU1LDAuMDJjMC4zNCwwLjM1MywwLjMzMSwwLjkxNS0wLjAyMSwxLjI1NUwyLjE2MywxNS41MjkgICAgbDE0LjQ3MSwxNC4wMDRjMC4zNTIsMC4zNDEsMC4zNjEsMC45MDIsMC4wMjEsMS4yNTVDMTYuNDgsMzAuOTY4LDE2LjI0OSwzMS4wNTksMTYuMDE3LDMxLjA1OXoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" style="height:auto; width:5%; margin-right:20px;" />
            </a>

            @lang('static.info.cargo.title')
        </p>

        <div class="panel-group" id="accordion">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.cargo.title')
                        </a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <p align="justify" style="margin-left:7%;">
                            @lang('static.info.cargo.cargo.p1')
                        </p>
                        <p align="justify" style="margin-left:7%;">
                            @lang('static.info.cargo.cargo.p2')
                            <br/><br/>
                            <a href="../img/IntructivoAVLASER_1.pdf" target="_blank" style="text-decoration:none; color:green">@lang('static.info.cargo.cargo.p3')</a>
                        </p>

                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.cargo.benefits.title')
                        </a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body" style="margin-left:7%;">
                    <ul>
                        <LI><p align="justify" >@lang('static.info.cargo.benefits.p1')</p></LI>
                            <li><p align="justify">@lang('static.info.cargo.benefits.p2')</p></li>
                          <!--  <li><p align="justify">@lang('static.info.cargo.benefits.p3')</p></li>  -->
                            <li><p align="justify">@lang('static.info.cargo.benefits.p4')</p></li>
                            <li><p align="justify">@lang('static.info.cargo.benefits.p5')</p></li>
                            <li><p align="justify">@lang('static.info.cargo.benefits.p6')</p></li>
                            <li><p align="justify">@lang('static.info.cargo.benefits.p7')</p></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.cargo.types.title')
                        </a>
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
                    <div class="panel-body" style="margin-left:7%;">
                    <ul>
                        <!--<LI><p align="justify">@lang('static.info.cargo.types.p1')</p></LI> -->
                            <li><p align="justify">@lang('static.info.cargo.types.p2')</p></li>
                            <li><p align="justify">@lang('static.info.cargo.types.p3')</p></li>
                            <li><p align="justify">@lang('static.info.cargo.types.p4')</p></li>
                            <li><p align="justify">@lang('static.info.cargo.types.p5')</p></li>
                            <li><p align="justify">@lang('static.info.cargo.types.p6')</p></li>
                            <li><p align="justify">@lang('static.info.cargo.types.p7')</p></li>
                            <li><p align="justify">@lang('static.info.cargo.types.p8')</p></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.cargo.policies.title')
                        </a>
                    </h4>
                </div>
                <div id="collapse4" class="panel-collapse collapse">
                    <div class="panel-body" style="margin-left:7%;">
                    <ul>
                        <LI><p align="justify">@lang('static.info.cargo.policies.p1')</p></LI>
                            <li><p align="justify">@lang('static.info.cargo.policies.p2')</p></li>
                            <li><p align="justify">@lang('static.info.cargo.policies.p3')</p></li>
                            <li><p align="justify">@lang('static.info.cargo.policies.p4')</p></li>
                            <li><p align="justify">@lang('static.info.cargo.policies.p5')</p></li>
                            <li><p align="justify">@lang('static.info.cargo.policies.p6')</p></li>
                            <li><p align="justify">@lang('static.info.cargo.policies.p7')</p></li>
                            <li><p align="justify">@lang('static.info.cargo.policies.p8')</p></li>
                            <li><p align="justify">@lang('static.info.cargo.policies.p9')</p></li>
                            <li><p align="justify">@lang('static.info.cargo.policies.p10')</p></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.cargo.fares.title')
                        </a>
                    </h4>
                </div>
                <div id="collapse5" class="panel-collapse collapse">
                    <div class="panel-body">
                        <img src="{{ asset('img/TCC19.png') }}" class="img-responsive">
                    </div>
                </div>    
            </div>
			<div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse6" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.cargo.fares.title1')
                        </a>
                    </h4>
                </div>
                <div id="collapse6" class="panel-collapse collapse">
                    <div class="panel-body">
                        <img src="{{ asset('img/Tarif_Conexion_4.png') }}" class="img-responsive">
                    </div>
                </div>    
            </div>			
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse7" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.cargo.fares.title2')
                        </a>
                    </h4>
                </div>
                <div id="collapse7" class="panel-collapse collapse">
                    <div class="panel-body">
                        <img src="{{ asset('img/equipajeCostos1_4.png') }}" class="img-responsive">
                    </div>
                    <!--<div class="panel-body">
                        <img src="{{ asset('img/equipajeMIACostos_1.png') }}" class="img-responsive">
                    </div> -->
                </div>                
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse8" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.cargo.fares.title3')
                        </a>
                    </h4>
                </div>
                <div id="collapse8" class="panel-collapse collapse">
                    <div class="panel-body">
                        <img src="{{ asset('img/Serv_Especiales_4.png') }}" class="img-responsive">
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse9" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.cargo.facturado.title')
                        </a>
                    </h4>
                </div>
                <div id="collapse9" class="panel-collapse collapse">
                    <div class="panel-body" style="margin-left:7%;">
                        <b><p align="justify">@lang('static.info.cargo.facturado.p1')</p></b>
                        <p align="justify">@lang('static.info.cargo.facturado.p2')</p>
                        <div class="bs-example bs-example-tabs " data-example-id="togglable-tabs">
                            <ul class="nav nav-tabs nav-justified" id="myTabs" role="tablist">
                                <li class="active" role="presentation">
                                    <a aria-controls="home" aria-expanded="true" data-toggle="tab" href="#condiciones" id="home-tab" role="tab">
                                        @lang('static.info.cargo.facturado.title2')
                                    </a>
                                </li>
                                <li class="" role="presentation">
                                    <a aria-controls="profile" aria-expanded="false" data-toggle="tab" href="#restricciones" id="profile-tab" role="tab">
                                        @lang('static.info.cargo.facturado.title3')
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div aria-labelledby="home-tab" class="tab-pane fade active in" id="condiciones" role="tabpanel">
                                    <ul>
                                        <li><p align="justify">@lang('static.info.cargo.facturado.p3')</p></li>
                                        <li><p align="justify">@lang('static.info.cargo.facturado.p4')</p></li>
                                        <li><p align="justify">@lang('static.info.cargo.facturado.p5')</p></li>
                                        <li><p align="justify">@lang('static.info.cargo.facturado.p6')</p></li>
                                        <li><p align="justify">@lang('static.info.cargo.facturado.p7')</p></li>
                                        <li><p align="justify">@lang('static.info.cargo.facturado.p8')</p></li>
                                        <li><p align="justify">@lang('static.info.cargo.facturado.p9')</p></li>
                                        <li><p align="justify">@lang('static.info.cargo.facturado.p10')</p></li>
                                    </ul>
                                </div>
                                <div aria-labelledby="profile-tab" class="tab-pane fade" id="restricciones" role="tabpanel">
                                    <p align="justify">@lang('static.info.cargo.facturado.p11')</p>
                                    <ul>
                                        <li><p align="justify">@lang('static.info.cargo.facturado.p12')</p></li>
                                        <li><p align="justify">@lang('static.info.cargo.facturado.p13')</p></li>
                                        <li><p align="justify">@lang('static.info.cargo.facturado.p14')</p></li>
                                        <li><p align="justify">@lang('static.info.cargo.facturado.p15')</p></li>
                                        <li><p align="justify">@lang('static.info.cargo.facturado.p16')</p></li>
                                        <li><p align="justify">@lang('static.info.cargo.facturado.p17')</p></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse10" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.cargo.ArtnoIndemnizablesC')
                        </a>
                    </h4>
                </div>
                <div id="collapse10" class="panel-collapse collapse">
                    <div class="panel-body">
                        <img src="{{ asset('img/Art_no_Indemnizables.png') }}" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin del Contenido de la pagina-->
@endsection