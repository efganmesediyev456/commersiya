<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        @yield('title')
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="canonical" href="#" />
    <!--  Social tags      -->
    <meta name="keywords" content="iptv, baki, ip, tv, kanal">
    <meta name="description" content="Avirnet iptv">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Iptv">
    <meta itemprop="description" content="Avirnet iptv">
    <meta itemprop="image" content="#">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@avirnet">
    <meta name="twitter:title" content="Avirnet iptv">
    <meta name="twitter:description" content="Avirnet iptv">
    <meta name="twitter:creator" content="@avirnet">
    <meta name="twitter:image" content="#">
    <!-- Open Graph data -->
    <meta property="fb:app_id" content="#">
    <meta property="og:title" content="Avirnet iptv" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="3" />
    <meta property="og:image" content="" />
    <meta property="og:description" content="Avirnet iptv" />
    <meta property="og:site_name" content="Avirnet" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{ asset('css/material-kit.min1036.css?v=2.1.1') }}" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('demo/demo.css') }}" rel="stylesheet" />
    <link href="{{ asset('demo/vertical-nav.css') }}" rel="stylesheet" />
</head>

<body class="@yield('page') sidebar-collapse">
<nav class="navbar bg-dark  fixed-top navbar-expand-lg "  id="sectionsNav">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="{{ route('frontend.index') }}">
                <img alt="logo" class="img-fluid index-logo" src="/img/iptvlogo2.png" /> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">

                <li class="dropdown nav-item">
                    <a href="{{route('about')}}" class="nav-link">
                        <i class="material-icons">information</i> @lang('site.about_us')
                    </a>

                </li>
                <li class="dropdown nav-item">
                    <a href="{{route('pricing')}}" class="nav-link">
                        <i class="material-icons">stars</i>  @lang('site.pricing')
                    </a>
                </li>
                <li class="dropdown nav-item">
                    <a href="{{route('channels')}}" class="nav-link">
                        <i class="material-icons">tv</i> @lang('site.channels')
                    </a>
                </li>
                <li class="dropdown nav-item">
                    <a href="{{route('frontend.faq')}}" class="nav-link" >
                        <i class="material-icons">question_answer</i> @lang('site.faq')
                    </a>
                </li>
                <li class="dropdown nav-item">
                    <a href="{{route('frontend.contact')}}" class="nav-link">
                        <i class="material-icons">contactless</i> @lang('site.contact_us')
                    </a>
                </li>

                <li class="dropdown nav-item">
                    <a href="{{route('frontend.payment')}}" class="nav-link">
                        <i class="material-icons">
                            payment
                        </i>
                        {{ __('site.Ödəmə nöqtələri')  }}
                    </a>
                </li>
{{--                <li class="dropdown nav-item">--}}
{{--                    <a href="#pablo" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false">--}}
{{--                        <i class="material-icons">language</i>--}}
{{--                        <b class="caret"></b>--}}
{{--                        <div class="ripple-container"></div></a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right">--}}
{{--                        @foreach($languages as $language)--}}
{{--                            <a href="{{ route('set-locale', ['locale' => $language->code]) }}" class="dropdown-item">{{ $language->name }}</a>--}}
{{--                        @endforeach--}}

{{--                    </div>--}}
{{--                </li>--}}
                <li class="button-container nav-item iframe-extern">
                    @auth
                        <a href="signup.html" target="_blank" class="btn  btn-danger btn-round btn-block">
                            <i class="material-icons">account_box</i> Account
                        </a>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" class="btn  btn-danger btn-round btn-block">
                            <i class="material-icons">fingerprint</i> @lang('site.login')
                        </a>
                    @endguest

                </li>
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<script src="{{ asset('js/core/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/core/bootstrap-material-design.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/plugins/moment.min.js') }}"></script>
<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="{{ asset('js/plugins/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{ asset('js/plugins/nouislider.min.js') }}" type="text/javascript"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGat1sgDZ-3y6fFe6HD7QUziVC6jlJNog"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="{{ asset('https://buttons.github.io/buttons.js') }}"></script>
<!--	Plugin for Sharrre btn -->
<script src="{{ asset('js/plugins/jquery.sharrre.js') }}" type="text/javascript"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{ asset('js/plugins/bootstrap-tagsinput.js') }}"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{ asset('js/plugins/bootstrap-selectpicker.js') }}" type="text/javascript"></script>
<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ asset('js/plugins/jasny-bootstrap.min.js') }}" type="text/javascript"></script>
<!--	Plugin for Small Gallery in Product Page -->
<script src="{{ asset('js/plugins/jquery.flexisel.js') }}" type="text/javascript"></script>
<!-- Plugins for presentation and navigation  -->
<script src="{{ asset('demo/modernizr.js') }}" type="text/javascript"></script>
<script src="{{ asset('demo/vertical-nav.js') }}" type="text/javascript"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="{{ asset('demo/vertical-nav.js') }}"></script>

<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Js With initialisations For Demo Purpose, Don't Include it in Your Project -->
<script src="{{ asset('demo/demo.js') }}" type="text/javascript"></script>
<!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('js/material-kit.min1036.js?v=2.1.1') }}" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        //init DateTimePickers
        materialKit.initFormExtendedDatetimepickers();

        // Sliders Init
        materialKit.initSliders();
    });
</script>
<script>
    $('#agree').click(function () {
        $("input#condition").attr('checked',true);
    });
    $('#disagree').click(function () {
        $("input#condition").attr('checked',false);

    })
</script>

@stack('js')
</body>
