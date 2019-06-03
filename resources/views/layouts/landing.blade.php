<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laser Airlines</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Página Web Oficial de Laser Airlines" />
    <meta name="keywords" content="Laser, Airlines, Volar, Viaje, Travel" />
    <meta name="author" content="Laser Airlines" />

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="{{ asset('img/favicon-01.png') }}">

    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,400italic,700' rel='stylesheet' type='text/css'>

    <!-- Animate.css -->
    <link rel="stylesheet" href=" {{ asset('plugins/other/css/animate.css') }} ">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href=" {{ asset('plugins/other/css/icomoon.css') }} ">
    <!-- Simple Line Icons -->
    <!--<link rel="stylesheet" href="css/simple-line-icons.css">-->
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('plugins/other/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/other/css/owl.theme.default.min.css') }}">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">

    <!-- Mi estilo -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- ParalaxS -->
    <link rel="stylesheet" href="{{ asset('plugins/other/css/parallax.css') }}">

    <!-- Modal -->
    <!--<script>
        $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus()
        })
    </script>-->

    <!-- Modernizr JS -->
    <script src="{{ asset('plugins/other/js/modernizr-2.6.2.min.js') }}"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <!-- DatePicker -->

    <link rel="stylesheet" href="{{asset('plugins/datepicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datepicker/css/bootstrap-datepicker3.standalone.css')}}">
    <!--Start of Tawk.to Script-->
        <script type="text/javascript">
                var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
                (function(){
                var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                s1.async=true;
                s1.src='https://embed.tawk.to/58e23c56f97dd14875f5b70c/default';
                s1.charset='UTF-8';
                s1.setAttribute('crossorigin','*');
                s0.parentNode.insertBefore(s1,s0);
                })();
        </script>
    <!--End of Tawk.to Script-->
    <!--Google Analityt-->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-98377377-1', 'auto');
      ga('send', 'pageview');
    </script>
    <!-- End Google Analityt-->
</head>
<body>

@include('components.nav')

@yield('content')

<div id="contact"></div>
@include('components.contact')
@include('components.footer')


<!-- jQuery -->
<script src="{{ asset('plugins/other/js/jquery.min.js') }}"></script>
<!-- jQuery Easing -->
<script src="{{ asset('plugins/other/js/jquery.easing.1.3.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- Waypoints -->
<script src="{{ asset('plugins/other/js/jquery.waypoints.min.js') }}"></script>
<!-- Owl Carousel -->
<script src="{{ asset('plugins/other/js/owl.carousel.min.js') }}"></script>
<!-- Horas -->
<script src="{{ asset('plugins/other/js/horas.js') }}"></script>


<!-- For demo purposes only styleswitcher ( You may delete this anytime ) -->
<script src="{{ asset('plugins/other/js/jquery.style.switcher.js') }}"></script>
<script>
    $(function(){
        $('#colour-variations ul').styleSwitcher({
            defaultThemeId: 'theme-switch',
            hasPreview: false,
            cookie: {
                expires: 30,
                isManagingLoad: true
            }
        });

        $("input[type=text]").keyup(function(){
            $(this).val( $(this).val().toUpperCase() );
        });

        $('.option-toggle').click(function() {
            $('#colour-variations').toggleClass('sleep');
        });
    });

    jQuery('#lang_es').click(function()
    {
        jQuery.ajax({
            url: '{{ url('locale/es') }}',
            type: "get",
            data: 'lang_code='+jQuery(this).val(),
            success: function() {
                window.location.reload();
            }
        });
    });

    jQuery('#lang_en').click(function()
    {
        jQuery.ajax({
            url: '{{ url('locale/en') }}',
            type: "get",
            data: 'lang_code='+jQuery(this).val(),
            success: function() {
                window.location.reload();
            }
        });
    });
</script>

<script src="{{asset('plugins/datepicker/js/bootstrap-datepicker.js')}}"></script>
<!-- Languaje -->
<script src="{{asset('plugins/datepicker/locales/bootstrap-datepicker.es.min.js')}}"></script>

<!-- Main JS (Do not remove) -->
<script src="{{ asset('plugins/other/js/main.js') }}"></script>
@yield('js')
</body>
</html>