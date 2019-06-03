@extends('layouts.simplepage')

@section('section-icon')
    <div class="col-md-5 to-animate">
        <center>
            <img src="{{ asset('img/volar.png') }}" class="img-responsive img-rounded to-animate contenedor" style="width:70%; height:auto; margin:0 0 20px 0;">
        </center>
    </div>
@endsection

@section('content')
    <div class="col-md-7 to-animate">
        <p style="font-size:150%; color:#87bc24;" align="left">
            <a href="{{ url('/#information') }}">
                <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMxLjA1OSAzMS4wNTkiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMxLjA1OSAzMS4wNTk7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNjRweCIgaGVpZ2h0PSI2NHB4Ij4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMzAuMTcxLDE2LjQxNkgwLjg4OEMwLjM5OCwxNi40MTYsMCwxNi4wMiwwLDE1LjUyOWMwLTAuNDksMC4zOTgtMC44ODgsMC44ODgtMC44ODhoMjkuMjgzICAgIGMwLjQ5LDAsMC44ODgsMC4zOTgsMC44ODgsMC44ODhDMzEuMDU5LDE2LjAyLDMwLjY2MSwxNi40MTYsMzAuMTcxLDE2LjQxNnoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KCTxnPgoJCTxwYXRoIGQ9Ik0xNi4wMTcsMzEuMDU5Yy0wLjIyMiwwLTAuNDQ1LTAuMDgzLTAuNjE3LTAuMjVMMC4yNzEsMTYuMTY2QzAuMDk4LDE1Ljk5OSwwLDE1Ljc3LDAsMTUuNTI5ICAgIGMwLTAuMjQsMC4wOTgtMC40NzEsMC4yNzEtMC42MzhMMTUuNCwwLjI1YzAuMzUyLTAuMzQxLDAuOTE0LTAuMzMyLDEuMjU1LDAuMDJjMC4zNCwwLjM1MywwLjMzMSwwLjkxNS0wLjAyMSwxLjI1NUwyLjE2MywxNS41MjkgICAgbDE0LjQ3MSwxNC4wMDRjMC4zNTIsMC4zNDEsMC4zNjEsMC45MDIsMC4wMjEsMS4yNTVDMTYuNDgsMzAuOTY4LDE2LjI0OSwzMS4wNTksMTYuMDE3LDMxLjA1OXoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" style="height:auto; width:5%; margin-right:20px;" />
            </a>

            @lang('static.info.magazine.title')</p>


        <br><br>



        <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-mb30">
            <div class="fh5co-product">
                <center>
                    <a href="http://www.turevistaonline.com/revistas/VOLAR12015/index.html#p=1" target="_blank"><img src="{{ asset('img/vol1.png')}}" class="img-responsive" style="height:auto; widt:100%;"></a>
                    <br>
                    <a href="http://www.turevistaonline.com/revistas/VOLAR12015/index.html#p=1" style="text-decoration:none; color:green;" target="_blank">1era Edición</a>
                </center>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-mb30">
            <div class="fh5co-product">
                <center>
                    <a href="http://www.turevistaonline.com/revistas/volar2/index.html#p=1" target="_blank"><img src="{{ asset('img/vol2.png') }}" class="img-responsive" style="height:auto; widt:100%;"></a>
                    <br>
                    <a href="http://www.turevistaonline.com/revistas/volar2/index.html#p=1" style="text-decoration:none; color:green;" target="_blank">2da Edición</a>
                </center>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-mb30">
            <div class="fh5co-product">
                <center>
                    <a href="http://www.turevistaonline.com/revistas/revistavolar3/index.html#p=1" target="_blank"><img src="{{ asset('img/vol3.png') }}" class="img-responsive" style="height:auto; widt:100%;"></a>
                    <br>
                    <a href="http://www.turevistaonline.com/revistas/revistavolar3/index.html#p=1" style="text-decoration:none; color:green;" target="_blank">3era Edición</a>
                </center>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-mb30">
            <div class="fh5co-product">
                <center>
                    <a href="http://www.turevistaonline.com/revistas/Volar4d/Volar4d.html#p=1" target="_blank"><img src="{{ asset('img/vol4.png') }}" class="img-responsive" style="height:auto; widt:100%;"></a>
                    <br>
                    <a href="http://www.turevistaonline.com/revistas/Volar4d/Volar4d.html#p=1" style="text-decoration:none; color:green;" target="_blank">4ta Edición</a>
                </center>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-mb30">
            <div class="fh5co-product">
                <center>
                    <a href="http://www.turevistaonline.com/revistas/Volar5/mobile/index.html#p=1" target="_blank"><img src="{{ asset('img/vol5.png') }}" class="img-responsive" style="height:auto; widt:100%;"></a>
                    <br>
                    <a href="http://www.turevistaonline.com/revistas/Volar5/mobile/index.html#p=1" style="text-decoration:none; color:green;" target="_blank">5ta Edición</a>
                </center>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-mb30">
            <div class="fh5co-product">
                <center>
                    <a href="http://www.turevistaonline.com/revistas/VOLAR6/VOLAR6.html" target="_blank"><img src="{{ asset('img/vol6.png') }}" class="img-responsive" style="height:auto; widt:100%;"></a>
                    <br>
                    <a href="http://www.turevistaonline.com/revistas/VOLAR6/VOLAR6.html" style="text-decoration:none; color:green;" target="_blank">6ta Edición</a>
                </center>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-mb30">
            <div class="fh5co-product">
                <center>
                    <a href="http://www.turevistaonline.com/revistas/VOLAR7D/VOLAR7D.html" target="_blank"><img src="{{ asset('img/vol7.png') }}" class="img-responsive" style="height:auto; widt:100%;"></a>
                    <br>
                    <a href="http://www.turevistaonline.com/revistas/VOLAR7D/VOLAR7D.html" style="text-decoration:none; color:green;" target="_blank">7mo Edición</a>
                </center>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-mb30">
            <div class="fh5co-product">
                <center>
                    <a href="http://www.turevistaonline.com/revistas/volar8xc/index.html" target="_blank"><img src="{{ asset('img/vol8.jpg') }}" class="img-responsive" style="height:auto; widt:100%;"></a>
                    <br>
                    <a href="http://www.turevistaonline.com/revistas/volar8xc/index.html" style="text-decoration:none; color:green;" target="_blank">8vo Edición</a>
                </center>
            </div>
        </div>
        
        <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-mb30">
            <div class="fh5co-product">
                <center>
                    <a href=http://www.turevistaonline.com/revistas/Volar9/index.html" target="_blank"><img src="{{ asset('img/vol9.jpg') }}" class="img-responsive" style="height:auto; widt:100%;"></a>
                    <br>
                    <a href="http://www.turevistaonline.com/revistas/Volar9/index.html" style="text-decoration:none; color:green;" target="_blank">9no Edición</a>
                </center>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-mb30">
            <div class="fh5co-product">
                <center>
                    <a href="http://www.turevistaonline.com/revistas/volar10/index.html" target="_blank"><img src="{{ asset('img/vol10.jpg') }}" class="img-responsive" style="height:auto; widt:100%;"></a>
                    <br>
                    <a href="http://www.turevistaonline.com/revistas/volar10/index.html" style="text-decoration:none; color:green;" target="_blank">10mo Edición</a>
                </center>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-mb30">
            <div class="fh5co-product">
                <center>
                    <a href="http://www.turevistaonline.com/revistas/volar11/index.html" target="_blank"><img src="{{ asset('img/vol11.jpg') }}" class="img-responsive" style="height:auto; widt:100%;"></a>
                    <br>
                    <a href="http://www.turevistaonline.com/revistas/volar11/index.html" style="text-decoration:none; color:green;" target="_blank">11mo Edición</a>
                </center>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-mb30">
            <div class="fh5co-product">
                <center>
                    <a href="http://www.turevistaonline.com/revistas/volar12c/index.html" target="_blank"><img src="{{ asset('img/vol12.jpg') }}" class="img-responsive" style="height:auto; widt:100%;"></a>
                    <br>
                    <a href="http://www.turevistaonline.com/revistas/volar12c/index.html" style="text-decoration:none; color:green;" target="_blank">12mo Edición</a>
                </center>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-mb30">
            <div class="fh5co-product">
                <center>
                    <a href="http://www.turevistaonline.com/revistas/volar13mag/index.html" target="_blank"><img src="{{ asset('img/vol13.jpg') }}" class="img-responsive" style="height:auto; widt:100%;"></a>
                    <br>
                    <a href="http://www.turevistaonline.com/revistas/volar13mag/index.html" style="text-decoration:none; color:green;" target="_blank">13mo Edición</a>
                </center>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-mb30">
            <div class="fh5co-product">
                <center>
                    <a href="http://www.turevistaonline.com/revistas/volar14/index.html" target="_blank"><img src="{{ asset('img/vol14.jpg') }}" class="img-responsive" style="height:auto; widt:100%;"></a>
                    <br>
                    <a href="http://www.turevistaonline.com/revistas/volar14/index.html" style="text-decoration:none; color:green;" target="_blank">14mo Edición</a>
                </center>
            </div>
        </div>

    </div>
@endsection