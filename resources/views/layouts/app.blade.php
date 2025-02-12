<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    {{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{--    <link rel="dns-prefetch" href="//fonts.bunny.net">--}}
    {{--    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">--}}

<!-- Web Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet"/>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}"/>
<!-- <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}" /> -->
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/niceselect.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/flex-slider.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/owl-carousel.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/color/color2.css') }}">
    <link rel="stylesheet" href="#" id="colors"/>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts -->
    {{--    @vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}
</head>
<body class="js">

<!-- Preloader -->
<div class="preloader">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- End Preloader -->

<!-- Header -->
@include('partials.header')

<!-- Main Content -->
<main>
    @yield('content')
</main>

<!-- Footer -->
@include('partials.footer')

<!-- JS Files -->
<script src="{{ asset('js/cart.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-migrate-3.0.0.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/colors.js') }}"></script>
<script src="{{ asset('js/slicknav.min.js') }}"></script>
<script src="{{ asset('js/owl-carousel.js') }}"></script>
<script src="{{ asset('js/magnific-popup.js') }}"></script>
<!-- <script src="{{ asset('js/fancybox.min.js') }}"></script> -->
<script src="{{ asset('js/waypoints.min.js') }}"></script>
<script src="{{ asset('js/finalcountdown.min.js') }}"></script>
<script src="{{ asset('js/nicesellect.js') }}"></script>
<script src="{{ asset('js/flex-slider.js') }}"></script>
<script src="{{ asset('js/scrollup.js') }}"></script>
<script src="{{ asset('js/onepage-nav.min.js') }}"></script>
<script src="{{ asset('js/easing.js') }}"></script>
<script src="{{ asset('js/active.js') }}"></script>
<script src="{{ asset('js/include-html.js') }}"></script>

@stack('scripts')
</body>
</html>
