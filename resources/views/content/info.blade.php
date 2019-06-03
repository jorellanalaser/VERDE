@extends('layouts.simplepage')

@section('section-icon')
    <div class="col-md-5 to-animate">
        <center>
            <img src="{{ asset('img/preguntasfrecu.png') }}" class="img-responsive img-rounded to-animate contenedor" style="width:70%; height:auto; margin:0 0 20px 0;">
        </center>
    </div>
@endsection

@section('content')
    <div class="col-md-7 to-animate">
        <p style="font-size:150%; color:#87bc24;" align="left">
            <a href="{{ url('/#information') }}">
                <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMxLjA1OSAzMS4wNTkiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMxLjA1OSAzMS4wNTk7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNjRweCIgaGVpZ2h0PSI2NHB4Ij4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMzAuMTcxLDE2LjQxNkgwLjg4OEMwLjM5OCwxNi40MTYsMCwxNi4wMiwwLDE1LjUyOWMwLTAuNDksMC4zOTgtMC44ODgsMC44ODgtMC44ODhoMjkuMjgzICAgIGMwLjQ5LDAsMC44ODgsMC4zOTgsMC44ODgsMC44ODhDMzEuMDU5LDE2LjAyLDMwLjY2MSwxNi40MTYsMzAuMTcxLDE2LjQxNnoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KCTxnPgoJCTxwYXRoIGQ9Ik0xNi4wMTcsMzEuMDU5Yy0wLjIyMiwwLTAuNDQ1LTAuMDgzLTAuNjE3LTAuMjVMMC4yNzEsMTYuMTY2QzAuMDk4LDE1Ljk5OSwwLDE1Ljc3LDAsMTUuNTI5ICAgIGMwLTAuMjQsMC4wOTgtMC40NzEsMC4yNzEtMC42MzhMMTUuNCwwLjI1YzAuMzUyLTAuMzQxLDAuOTE0LTAuMzMyLDEuMjU1LDAuMDJjMC4zNCwwLjM1MywwLjMzMSwwLjkxNS0wLjAyMSwxLjI1NUwyLjE2MywxNS41MjkgICAgbDE0LjQ3MSwxNC4wMDRjMC4zNTIsMC4zNDEsMC4zNjEsMC45MDIsMC4wMjEsMS4yNTVDMTYuNDgsMzAuOTY4LDE2LjI0OSwzMS4wNTksMTYuMDE3LDMxLjA1OXoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" style="height:auto; width:5%; margin-right:20px;" />
            </a>

            @lang('static.info.frequentlyq.title')
        </p>

        <div class="panel-group" id="accordion">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.frequentlyq.view')
                        </a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p align="justify" style="margin-left:7%;">

                            <b>@lang('static.info.frequentlyq.q1.title')</b>
                            @lang('static.info.frequentlyq.q1.p1')
                            <br><br>
                            <b>@lang('static.info.frequentlyq.q2.title')</b>
                            @lang('static.info.frequentlyq.q2.p1')
                            <br>
                            <b>@lang('static.info.frequentlyq.q3.title')</b>
                            @lang('static.info.frequentlyq.q3.p1')
                            <br><br>
                            <b></b>
                            <b>@lang('static.info.frequentlyq.q4.title')</b>
                            @lang('static.info.frequentlyq.q4.p1')
                            <br><br>
                            <b></b>
                            <b>@lang('static.info.frequentlyq.q5.title')</b>
                            @lang('static.info.frequentlyq.q5.p1')
                            <br><br>
                            <b></b>
                            <b>@lang('static.info.frequentlyq.q6.title')</b>
                            @lang('static.info.frequentlyq.q6.p1')
                        </p>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.frequentlyq.policyBaggageIn')
                        </a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <img src="{{ asset('img/Equipaje_Mano.jpg') }}" class="img-responsive">
                        <img src="{{ asset('img/inteq3.png') }}" class="img-responsive">
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.frequentlyq.policyBaggageNc')
                        </a>
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
                    <div class="panel-body">
                        <img src="{{ asset('img/Equipaje_Mano.jpg') }}" class="img-responsive">
                        <img src="{{ asset('img/naceq3.png') }}" class="img-responsive">
                    </div>
                </div>
            </div>
           <!-- JOMIA 03-06-2019
                <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.frequentlyq.miami.title')
                        </a>
                    </h4>
                </div>
                <div id="collapse4" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p align="justify" style="margin-left:7%;">
                            <ul>
                                <p align="justify">@lang('static.info.frequentlyq.miami.p1')</p>
                                <b><p align="justify">@lang('static.info.frequentlyq.miami.p2')</p></b>
                                <li align="justify">@lang('static.info.frequentlyq.miami.p3')</li> 
                                <li align="justify">@lang('static.info.frequentlyq.miami.p4')</li> 
                                <li align="justify">@lang('static.info.frequentlyq.miami.p5')</li> 
                                <li align="justify">@lang('static.info.frequentlyq.miami.p6')</li> 
                                <li align="justify">@lang('static.info.frequentlyq.miami.p7')</li> 
                                <li align="justify">@lang('static.info.frequentlyq.miami.p8')</li> 
                                <li align="justify">@lang('static.info.frequentlyq.miami.p9')</li> 
                                <li align="justify">@lang('static.info.frequentlyq.miami.p10')</li>
                                <li align="justify">@lang('static.info.frequentlyq.miami.p11')</li> 
                                <li align="justify">@lang('static.info.frequentlyq.miami.p12')</li> 
                                <li align="justify">@lang('static.info.frequentlyq.miami.p13')</li> 
                                <li align="justify">@lang('static.info.frequentlyq.miami.p14')</li>
                                <br> 
                                <p align="justify">@lang('static.info.frequentlyq.miami.p15')</p> 
                                <p align="justify">@lang('static.info.frequentlyq.miami.p16')</p> 
                                <p align="justify">@lang('static.info.frequentlyq.miami.p17')</p> 
                                <p align="justify">@lang('static.info.frequentlyq.miami.p18')</p> 
                                <p align="justify">@lang('static.info.frequentlyq.miami.p19')</p> 
                                <p align="justify">@lang('static.info.frequentlyq.miami.p20')</p>
                                <li align="justify">@lang('static.info.frequentlyq.miami.p21')</li> 
                                <br> 
                                <p align="justify">@lang('static.info.frequentlyq.miami.p22')</p>
                                <p align="justify">@lang('static.info.frequentlyq.miami.p23')</p> 
                            </ul>
                        </p>
                    </div>
                </div>
            </div> -->
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.frequentlyq.panama.title')
                        </a>
                    </h4>
                </div>
                <div id="collapse5" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p align="justify" style="margin-left:7%;">
                            <ul>
                                <p align="justify">@lang('static.info.frequentlyq.panama.p1')</p>
                                <li align="justify">@lang('static.info.frequentlyq.panama.p2')</li>
                                <li align="justify">@lang('static.info.frequentlyq.panama.p3')</li>
                                <li align="justify">@lang('static.info.frequentlyq.panama.p4')</li>
                                <li align="justify">@lang('static.info.frequentlyq.panama.p5')</li>
                                <li align="justify">@lang('static.info.frequentlyq.panama.p6')</li>
                                <li align="justify">@lang('static.info.frequentlyq.panama.p7')</li>
                                <li align="justify">@lang('static.info.frequentlyq.panama.p8')</li>
                                <li align="justify">@lang('static.info.frequentlyq.panama.p9')</li><br>
                                <p align="justify">* @lang('static.info.frequentlyq.panama.p10')</p>
                                <p align="justify">* @lang('static.info.frequentlyq.panama.p11')</p>
                                <li align="justify">@lang('static.info.frequentlyq.panama.p12')</li>
                               <li align="justify">@lang('static.info.frequentlyq.panama.p13')</li>  
                                <li align="justify">@lang('static.info.frequentlyq.panama.p14')</li>
                                <li align="justify">@lang('static.info.frequentlyq.panama.p15')</li>
                                <li align="justify">@lang('static.info.frequentlyq.panama.p16')</li>
                                <li align="justify">@lang('static.info.frequentlyq.panama.p17')</li>
                                <li align="justify">@lang('static.info.frequentlyq.panama.p18')</li>
                                <li align="justify">@lang('static.info.frequentlyq.panama.p19')</li>
                                <li align="justify">@lang('static.info.frequentlyq.panama.p20')</li>
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse6" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.frequentlyq.dominicana.title')
                        </a>
                    </h4>
                </div>
                <div id="collapse6" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p align="justify" style="margin-left:7%;">
                            <ul>
                                <p align="justify">@lang('static.info.frequentlyq.dominicana.p1')</p>
                                <b><p align="justify">@lang('static.info.frequentlyq.dominicana.p2')</p></b>
                                <li align="justify">@lang('static.info.frequentlyq.dominicana.p3')</li>
                                <li align="justify">@lang('static.info.frequentlyq.dominicana.p4')</li>
                                <li align="justify">@lang('static.info.frequentlyq.dominicana.p5')</li>
                                <li align="justify">@lang('static.info.frequentlyq.dominicana.p6')</li>
                                <li align="justify">@lang('static.info.frequentlyq.dominicana.p7')</li>
                                <li align="justify">@lang('static.info.frequentlyq.dominicana.p8')</li>
                                <li align="justify">@lang('static.info.frequentlyq.dominicana.p9')</li>
                                <li align="justify">@lang('static.info.frequentlyq.dominicana.p10')</li>
                                <li align="justify">@lang('static.info.frequentlyq.dominicana.p11')</li>
                                <li align="justify">@lang('static.info.frequentlyq.dominicana.p12')</li>
                                <br>
                                <p align="justify"> * @lang('static.info.frequentlyq.dominicana.p13')</p>
                                <p align="justify"> * @lang('static.info.frequentlyq.dominicana.p14')</p>
                                <li align="justify">@lang('static.info.frequentlyq.dominicana.p15')</li>
                                <li align="justify">@lang('static.info.frequentlyq.dominicana.p16')</li>
                                <br>
                                <p align="justify"> * @lang('static.info.frequentlyq.dominicana.p17')</p>
                                <p align="justify"> * @lang('static.info.frequentlyq.dominicana.p18')</p>
                                <p align="justify"> * @lang('static.info.frequentlyq.dominicana.p19')</p>
                                <br>
                                <li align="justify">@lang('static.info.frequentlyq.dominicana.p20')</li>
                                <br>
                                <b><p align="justify">@lang('static.info.frequentlyq.dominicana.p21')</p></b>
                                <li align="justify">@lang('static.info.frequentlyq.dominicana.p22')</li>
                                <li align="justify">@lang('static.info.frequentlyq.dominicana.p23')</li>
                                <li align="justify">@lang('static.info.frequentlyq.dominicana.p24')</li>
                                <br>
                                <b><p align="justify">@lang('static.info.frequentlyq.dominicana.p25')</p></b>
                                <li align="justify">@lang('static.info.frequentlyq.dominicana.p26')</li>
                                <br>
                                <b><p align="justify">@lang('static.info.frequentlyq.dominicana.p27')</p></b>
                                <li align="justify">@lang('static.info.frequentlyq.dominicana.p28')</li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse7" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.frequentlyq.aruba.title')
                        </a>
                    </h4>
                </div>
                <div id="collapse7" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p align="justify" style="margin-left:7%;">
                            <ul>
                                <p align="justify">@lang('static.info.frequentlyq.aruba.p1')</p>
                                <b><p align="justify">@lang('static.info.frequentlyq.aruba.p2')</p></b>
                                <li align="justify">@lang('static.info.frequentlyq.aruba.p3')</li>
                                <li align="justify">@lang('static.info.frequentlyq.aruba.p4')</li>
                                <li align="justify">@lang('static.info.frequentlyq.aruba.p5')</li>
                                <li align="justify">@lang('static.info.frequentlyq.aruba.p6')</li>
                                <li align="justify">@lang('static.info.frequentlyq.aruba.p7')</li>
                                <li align="justify">@lang('static.info.frequentlyq.aruba.p8')</li>
                                <b align="justify">@lang('static.info.frequentlyq.aruba.p9')</b>
                                <li align="justify">@lang('static.info.frequentlyq.aruba.p10')</li> 
                                <li align="justify">@lang('static.info.frequentlyq.aruba.p11')</li> 
                                <li align="justify">@lang('static.info.frequentlyq.aruba.p12')</li> 
                                <li align="justify">@lang('static.info.frequentlyq.aruba.p13')</li>
                                <li align="justify">@lang('static.info.frequentlyq.aruba.p14')</li>
                                <li align="justify">@lang('static.info.frequentlyq.aruba.p15')</li>
								<li align="justify">@lang('static.info.frequentlyq.aruba.p16')</li>
								<br>
								<p align="justify">@lang('static.info.frequentlyq.aruba.p17')</p>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse8" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.frequentlyq.curacao.title')
                        </a>
                    </h4>
                </div>
                <div id="collapse8" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p align="justify" style="margin-left:7%;">
                            <ul>
                                <p align="justify">@lang('static.info.frequentlyq.curacao.p1')</p>
                                <b><p align="justify">@lang('static.info.frequentlyq.curacao.p2')</p></b>
                                <li align="justify">@lang('static.info.frequentlyq.curacao.p3')</li>
                                <li align="justify">@lang('static.info.frequentlyq.curacao.p4')</li>
                                <li align="justify">@lang('static.info.frequentlyq.curacao.p5')</li>
                                <li align="justify">@lang('static.info.frequentlyq.curacao.p6')</li>
                                <li align="justify">@lang('static.info.frequentlyq.curacao.p7')</li>
                                <li align="justify">@lang('static.info.frequentlyq.curacao.p8')</li>
                                <li align="justify">@lang('static.info.frequentlyq.curacao.p9')</li>
                                <li align="justify">@lang('static.info.frequentlyq.curacao.p10')</li> 
                                <li align="justify">@lang('static.info.frequentlyq.curacao.p11')</li> 
                                <li align="justify">@lang('static.info.frequentlyq.curacao.p12')</li> 
                                <!--<li align="justify">@lang('static.info.frequentlyq.curacao.p13')</li>-->
								<li align="justify">@lang('static.info.frequentlyq.curacao.p14')</li>
								<li align="justify">@lang('static.info.frequentlyq.curacao.p15')</li>
                                <br>
                                <p align="justify">@lang('static.info.frequentlyq.curacao.p16')</p>
                                <li align="justify">@lang('static.info.frequentlyq.curacao.p17')</li>
                                <li align="justify">@lang('static.info.frequentlyq.curacao.p18')</li>
                                <li align="justify">@lang('static.info.frequentlyq.curacao.p19')</li>
                                <li align="justify">@lang('static.info.frequentlyq.curacao.p20')</li>
                                <li align="justify">@lang('static.info.frequentlyq.curacao.p21')</li>
								<br>
								<p align="justify">@lang('static.info.frequentlyq.curacao.p22')</p>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse9" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.frequentlyq.ecuador.title')
                        </a>
                    </h4>
                </div>
                <div id="collapse9" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p align="justify" style="margin-left:7%;">
                            <ul>
                        <p align="justify">@lang('static.info.frequentlyq.ecuador.p1')</p>
                        <li align="justify">@lang('static.info.frequentlyq.ecuador.p2')</li>
                        <li align="justify">@lang('static.info.frequentlyq.ecuador.p3')</li>
                        <li align="justify">@lang('static.info.frequentlyq.ecuador.p4')</li>
                        <li align="justify">@lang('static.info.frequentlyq.ecuador.p5')</li>
                        <li align="justify">@lang('static.info.frequentlyq.ecuador.p6')</li>
                        <li align="justify">@lang('static.info.frequentlyq.ecuador.p7')</li>
						<li align="justify">@lang('static.info.frequentlyq.ecuador.p8')</li>
                        <li align="justify">@lang('static.info.frequentlyq.ecuador.p9')</li>
                        <!--<li align="justify">@lang('static.info.frequentlyq.ecuador.p10')</li>
                        <li align="justify">@lang('static.info.frequentlyq.ecuador.p11')</li> -->
                        </ul>
                        </p>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse10" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.frequentlyq.venezuela.title')
                        </a>
                    </h4>
                </div>
                <div id="collapse10" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p align="justify" style="margin-left:7%;">
                            <ul>
                                <p align="justify">@lang('static.info.frequentlyq.venezuela.p1')</p>
                                <li align="justify">@lang('static.info.frequentlyq.venezuela.p2')</li>
                                <li align="justify">@lang('static.info.frequentlyq.venezuela.p3')</li>
                                <li align="justify">@lang('static.info.frequentlyq.venezuela.p4')</li>
                                <li align="justify">@lang('static.info.frequentlyq.venezuela.p5')</li>
                        <br>
                                <p align="justify">* @lang('static.info.frequentlyq.venezuela.p6')</p>
                                <p align="justify">* @lang('static.info.frequentlyq.venezuela.p7')</p>
                                <p align="justify">* @lang('static.info.frequentlyq.venezuela.p8')</p>
                                <li align="justify">@lang('static.info.frequentlyq.venezuela.p9')</li>
                                <li align="justify">@lang('static.info.frequentlyq.venezuela.p10')</li>
                                <li align="justify">@lang('static.info.frequentlyq.venezuela.p11')</li>
                                <li align="justify">@lang('static.info.frequentlyq.venezuela.p12')</li>

                        </ul>
                        </p>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse11" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.frequentlyq.mascotsLA.title')
                        </a>
                    </h4>
                </div>
                <div id="collapse11" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p align="justify" style="margin-left:7%;">
                            <ul>
                                <p align="justify">@lang('static.info.frequentlyq.mascotsLA.p1')</p>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p2')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p3')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p4')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p5')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p6')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p7')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p8')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p9')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p10')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p27')</li>
                                <li align="justify"><b>@lang('static.info.frequentlyq.mascotsLA.p11')</b></li>
                                <br>
                                <p align="justify"><b>@lang('static.info.frequentlyq.mascotsLA.p12')</b></p>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p13')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p14')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p15')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p16')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p17')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p18')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p19')</li>
                                <br>
                                <p align="justify"><b>@lang('static.info.frequentlyq.mascotsLA.p20')</b></p>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p21')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p22')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p23')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p24')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p25')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p26')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p27')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p28')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsLA.p29')</li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
            <!-- JOMIA 30-05-2019
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse12" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.frequentlyq.mascotsSA.title')
                        </a>
                    </h4>
                </div>
                <div id="collapse12" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p align="justify" style="margin-left:7%;">
                            <ul>
                                <p align="justify">@lang('static.info.frequentlyq.mascotsSA.p1')</p>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p2')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p3')</li>
								<p align="justify">@lang('static.info.frequentlyq.mascotsSA.p4')</p>
								COMENTAR ESTA LINEA Traslado de PETC (en Cabina) 
								<p align="justify"><b>@lang('static.info.frequentlyq.mascotsSA.p5')</b></p>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p6')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p7')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p8')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p9')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p10')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p11')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p12')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p13')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p14')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p15')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p16')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p17')</li>
                                <br>
								COMENTAR ESTA LINEA Traslado de AVIH (en Bodega) 
                                <p><b align="justify">@lang('static.info.frequentlyq.mascotsSA.p18')</b></p>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p19')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p20')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p21')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p22')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p23')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p24')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p25')</li>
                                <br>
								COMENTAR ESTA LINEA Lazarillos
                                <p><b align="justify">@lang('static.info.frequentlyq.mascotsSA.p26')</b></p>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p27')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p28')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p29')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p30')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p31')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p32')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p33')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p34')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p35')</li>
                                <br>
								COMENTAR ESTA LINEA Emocional 
                                <p><b align="justify">@lang('static.info.frequentlyq.mascotsSA.p36')</b></p>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p37')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p38')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p39')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p40')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p41')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p42')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p43')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p44')</li>
                                <li align="justify">@lang('static.info.frequentlyq.mascotsSA.p45')</li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div> -->
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse13" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.frequentlyq.equipaje.title')
                        </a>
                    </h4>
                </div>
                <div id="collapse13" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p align="justify" style="margin-left:7%;">
                            <ul>
                        <p align="justify">@lang('static.info.frequentlyq.equipaje.p1')</p>
                        <p align="justify">@lang('static.info.frequentlyq.equipaje.p2')</p>
                        <p align="justify">@lang('static.info.frequentlyq.equipaje.p3')</p>
                        <p align="justify">@lang('static.info.frequentlyq.equipaje.p4')</p>
                        <p align="justify">@lang('static.info.frequentlyq.equipaje.p5')</p>
                        <p align="justify">@lang('static.info.frequentlyq.equipaje.p6')</p>
                        <p align="justify">@lang('static.info.frequentlyq.equipaje.p7')</p>
                        <p align="justify">@lang('static.info.frequentlyq.equipaje.p8')</p>
                        <p align="justify">@lang('static.info.frequentlyq.equipaje.p9')</p>
                        <p align="justify">@lang('static.info.frequentlyq.equipaje.p10')</p>
                        <p align="justify">@lang('static.info.frequentlyq.equipaje.p11')</p>
                        <p align="justify">@lang('static.info.frequentlyq.equipaje.p12')</p>
                        <p align="justify">@lang('static.info.frequentlyq.equipaje.p13')</p>
                        <p align="justify">@lang('static.info.frequentlyq.equipaje.p14')</p>
                        <p align="justify">@lang('static.info.frequentlyq.equipaje.p15')</p>
                        <p align="justify">@lang('static.info.frequentlyq.equipaje.p16')</p>
                        <p align="justify">@lang('static.info.frequentlyq.equipaje.p17')</p>
                        <p align="justify">@lang('static.info.frequentlyq.equipaje.p18')</p>
                        <p align="justify">@lang('static.info.frequentlyq.equipaje.p19')</p>

                        </p>
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse14" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.frequentlyq.menores.title')
                        </a>
                    </h4>
                </div>
                <div id="collapse14" class="panel-collapse collapse">
                    <div class="panel-body">
                    <p align="justify" style="margin-left:7%;">
                        <ul>
                            <p align="justify">@lang('static.info.frequentlyq.menores.p1')</p>
                            <li><p align="justify">@lang('static.info.frequentlyq.menores.p2')</p></li>
                            <li><p align="justify">@lang('static.info.frequentlyq.menores.p3')</p></li>
                            <li><p align="justify">@lang('static.info.frequentlyq.menores.p4')</p></li>
                            <li><p align="justify">@lang('static.info.frequentlyq.menores.p5')</p></li>
                            <li><p align="justify">@lang('static.info.frequentlyq.menores.p6')</p></li>
                            <li><p align="justify">@lang('static.info.frequentlyq.menores.p7')</p></li>
                            <li><p align="justify">@lang('static.info.frequentlyq.menores.p8')</p></li>
                            <li><p align="justify">@lang('static.info.frequentlyq.menores.p9')</p></li>
                            <li><p align="justify">@lang('static.info.frequentlyq.menores.p10')</p></li>
                            <li><p align="justify">@lang('static.info.frequentlyq.menores.p11')</p></li>
                            <li><p align="justify">@lang('static.info.frequentlyq.menores.p12')</p></li>
                            <li><p align="justify">@lang('static.info.frequentlyq.menores.p13')</p></li>
                            <li><p align="justify">@lang('static.info.frequentlyq.menores.p14')</p></li>
                            <!--<li><p align="justify">@lang('static.info.frequentlyq.menores.p15')</p></li> --> 
                            <p align="justify">@lang('static.info.frequentlyq.menores.p16')</p>
                            <!-- </p>  --> 
                        </ul>
                    </p>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse15" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.frequentlyq.servicios.title')
                        </a>
                    </h4>
                </div>
                <div id="collapse15" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p align="justify" style="margin-left:7%;">
                            <ul>
                                <p align="justify">@lang('static.info.frequentlyq.servicios.p1')</p>
                                <p align="justify"><b>@lang('static.info.frequentlyq.servicios.p2')</b></p>
                                <p><u align="justify"><b>@lang('static.info.frequentlyq.servicios.p3')</b></u></p>
                                <li align="justify">@lang('static.info.frequentlyq.servicios.p4')</li>
                                <li align="justify">@lang('static.info.frequentlyq.servicios.p5')</li>
                                <li align="justify">@lang('static.info.frequentlyq.servicios.p6')</li>
                                <li align="justify">@lang('static.info.frequentlyq.servicios.p7')</li>
                                <br>
                                <p align="justify"><b>@lang('static.info.frequentlyq.servicios.p8')</b></p>
                                <li align="justify">@lang('static.info.frequentlyq.servicios.p9')</li>
                                <li align="justify">@lang('static.info.frequentlyq.servicios.p10')</li>
                                <li align="justify">@lang('static.info.frequentlyq.servicios.p11')</li>
                                <br>
                                <p align="justify"><b>@lang('static.info.frequentlyq.servicios.p12')</b></p>
                                <li align="justify">@lang('static.info.frequentlyq.servicios.p13')</li>
                                <li align="justify">@lang('static.info.frequentlyq.servicios.p14')</li>
                                <li align="justify">@lang('static.info.frequentlyq.servicios.p15')</li>
                                <li align="justify">@lang('static.info.frequentlyq.servicios.p16')</li>
                                <li align="justify">@lang('static.info.frequentlyq.servicios.p17')</li>
                                <li align="justify">@lang('static.info.frequentlyq.servicios.p18')</li>
                                <ol>
                                    <li align="justify">@lang('static.info.frequentlyq.servicios.p19')</li>
                                    <li align="justify">@lang('static.info.frequentlyq.servicios.p20')</li>
                                    <li align="justify">@lang('static.info.frequentlyq.servicios.p21')</li>
                                    <li align="justify">@lang('static.info.frequentlyq.servicios.p22')</li>
                                    <li align="justify">@lang('static.info.frequentlyq.servicios.p23')</li>
                                </ol>
                                <br>
                                <i><p align="justify">@lang('static.info.frequentlyq.servicios.p24')</b></i><p>
                                <p align="justify">@lang('static.info.frequentlyq.servicios.p25')</p>
                                <p align="justify">@lang('static.info.frequentlyq.servicios.p26')</p>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse16" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.frequentlyq.ArtnoIndemnizables')
                        </a>
                    </h4>
                </div>
                <div id="collapse16" class="panel-collapse collapse">
                    <div class="panel-body">
                        <img src="{{ asset('img/Art_no_Indemnizables.png') }}" class="img-responsive">
                    </div>
                </div>
            </div>
			<div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse17" style="margin-left:7%; text-decoration:none;" class="acordion">
                            @lang('static.info.frequentlyq.PenalidadInter')
                        </a>
                    </h4>
                </div>
                <div id="collapse17" class="panel-collapse collapse">
                    <div class="panel-body">
                        <img src="{{ asset('img/PenalxFecha_2.png') }}" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
