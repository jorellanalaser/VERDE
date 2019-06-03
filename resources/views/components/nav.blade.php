<header role="banner" id="fh5co-header">
    <div class="container">
        <!-- <div class="row"> -->
        <nav class="navbar navbar-default">
            <div class="navbar-header col-md-3">
                <!-- Mobile Toggle Menu Button -->
                <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse" data-target="#navbar"
                   aria-expanded="false" aria-controls="navbar"><i></i></a>
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('img/logolaser_4.png') }}" class="img-responsive" style="width:100%;height:auto; margin-right: 0px; padding: 0px;">
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="#" data-nav-section="home"><span>@lang('general.nav.home')</span></a></li>
                    <li><a href="#" data-nav-section="about"><span>@lang('general.nav.about')</span></a></li>
                    <li><a href="#" data-nav-section="information"><span>@lang('general.nav.info')</span></a></li>
                    <li><a href="#" data-nav-section="contact"><span>@lang('general.nav.contac')</span></a></li>             
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            @lang('general.languages')
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#" id="lang_es">@lang('general.lang.es')</a></li>
                            <li><a href="#" id="lang_en">@lang('general.lang.en')</a></li>
                        </ul>
                    </li>

                    <li><a href="" class="disabled hidden-xs"><span>&#124;</span></a></li>
                    <li><a href="" class="disabled visible-xs"><span><hr style="width: 1%;"/><br/></span></a></li>

                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}"><span>@lang('general.nav.sigin')</span></a></li>
                        <li><a href="{{ url('/register') }}"><span>@lang('general.nav.signup')</span></a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">{{ trans('auth.hello') }},
                                {{ Auth::user()->first_name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('user.dashboard') }}">@lang('general.nav.account')</a></li>
                                <li><a href="{{ url('/logout') }}">@lang('general.nav.logout')</a></li>
                            </ul>
                        </li>
                    @endif

                <!--<li><a href="#" data-nav-section="press"  data-toggle="modal" data-target="#myModal"><span>Iniciar sesión</span></a></li>-->
                </ul>
            </div>
        </nav>
        <!-- </div> -->
    </div>
</header>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" style="margin-top:50px;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <form align="center" autocomplete="off">
                    <div class="form-group">
                        <input type="text" style="width:100%; border-radius:5px"
                               placeholder="Usuario o num.Telf.Celular" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" style="width:100%; border-radius:5px" placeholder="Contraseña"
                               class="form-control">
                    </div>
                </form>
                <a href="sesion/perfil" class="btn btn-send " style="width:100%;">Iniciar sesión</a>
                <br><br>
                <center>
                    <a href="#" data-toggle="modal" data-target="#myModalclave"
                       style="width:100%; text-decoration:none; color:#e04e01;">Olvide mi contraseña</a>
                    <br><br>
                    <b style="color:grey" align="center">¿Aún no tienes una cuenta?</b><br>
                    <a href="#" data-toggle="modal" data-target="#myModalcuenta"
                       style="width:100%; text-decoration:none; color:#3394db;">Crear cuenta</a>
                </center>
            </div>
        </div>

    </div>
</div>

<!-- Modal Crear Usuario-->
<div id="myModalcuenta" class="modal fade" role="dialog" style="margin-top:50px;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <form align="center" autocomplete="off">
                    <div class="form-group">
                        <input type="text" style="width:100%; border-radius:5px" placeholder="Nombre"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" style="width:100%; border-radius:5px" placeholder="Apellido"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Masculino"> Masculino
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Femenino"> Femenino
                        </label>
                    </div>
                    <div class="form-group">
                        <input type="email" style="width:100%; border-radius:5px" placeholder="Correo electrónico"
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="password" style="width:100%; border-radius:5px" placeholder="Contraseña"
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="password" style="width:100%; border-radius:5px" placeholder="Repetir contraseña"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <p style="color:#e04e01;font-size:15px">* Por favor confirma los datos antes de seguir,
                            asegurate de ser datos reales y verdaderos</p>
                    </div>

                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" value="option1"> Acepto las <a
                                    style="text-decoration:none;" href="#"><b style="color: #3394db;">condiciones de
                                    uso</b></a>
                        </label>
                    </div>
                </form>
                <a href="/sesion/perfil" class="btn btn-send " style="width:100%;">Siguiente</a>
                <br><br>
            </div>
        </div>

    </div>
</div>

<!-- Modal Olvide-->
<div id="myModalclave" class="modal fade" role="dialog" style="margin-top:50px;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <form align="center" autocomplete="off" method="POST" action="{{ url('/login') }}">
                    <div class="form-group">
                        <input type="text" style="width:100%; border-radius:5px"
                               placeholder="Usuario o num.Telf.Celular" class="form-control">
                    </div>
                </form>
                <a data-toggle="modal" data-target="#myModalrecuperar" class="btn btn-send " style="width:100%;">Recuperar
                    contraseña</a>
                <br><br>
            </div>
        </div>

    </div>
</div>

<!-- Modal Recuperar-->
<div id="myModalrecuperar" class="modal fade" role="dialog" style="margin-top:50px;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <center>
                    Ha sido enviado un correo de recuperación de contraseña a su correo anteriormente registrado
                </center>
            </div>
        </div>

    </div>
</div>
