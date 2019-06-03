<header role="banner" id="fh5co-header" style="background-color:#209632 !important; margin-top:0px !important;">
    <div class="container">
        <!-- <div class="row"> -->
        <nav class="navbar navbar-default">
            <div class="navbar-header col-md-4">
                <!-- Mobile Toggle Menu Button -->
                <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse" data-target="#navbar"
                   aria-expanded="false" aria-controls="navbar"><i></i></a>
                <div class="col-md-9"> 
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('img/waa.png') }}" class="img-responsive" style="width: 100%;height:auto; margin-right: 0px; padding: 0px;">
                    </a>
                </div>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="{{ url('/') }}"><span>@lang('general.nav.home')</span></a></li>
                    <li><a href="{{ url('/#about') }}"><span>@lang('general.nav.about')</span></a></li>
                    <li><a href="{{ url('/#information') }}"><span>@lang('general.nav.info')</span></a></li>
                    <li><a href="{{ url('/#contact') }}"><span>@lang('general.nav.contac')</span></a></li>
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
                    <li><a href="" class="disabled visible-xs"><span><hr style="width: 40%"/><br/></span></a></li>
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
                </ul>
            </div>
        </nav>
        <!-- </div> -->
    </div>
</header>