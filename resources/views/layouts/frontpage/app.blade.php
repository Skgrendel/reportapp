<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Loader -->
    <link href="{{ asset('layouts/vertical-light-menu/css/light/loader.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('layouts/vertical-light-menu/css/dark/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('layouts/vertical-light-menu/loader.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <link href="{{ asset('src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('layouts/vertical-light-menu/css/light/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('layouts/vertical-light-menu/css/dark/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/mystyle.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/elements/alert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/elements/alert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/glightbox/glightbox.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/src/plugins/src/tomSelect/tom-select.default.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/src/plugins/css/light/tomSelect/custom-tomSelect.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/src/plugins/css/dark/tomSelect/custom-tomSelect.css')}}">

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <style>
        body.dark .layout-px-spacing,
        .layout-px-spacing {
            min-height: calc(100vh - 155px) !important;
        }
    </style>

</head>

<body class="layout-boxed" page="starter-pack">

    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    @include('layouts.frontpage.navbar')
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container sidebar-closed sbar-open" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        @include('layouts.frontpage.sidebar')
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="middle-content container-xxl p-0">

                    <!--  BEGIN BREADCRUMBS  -->
                    @include('layouts.frontpage.secondnavbar')
                    <!--  END BREADCRUMBS  -->

                    <div class="row layout-top-spacing">
                        @yield('content')
                    </div>
                </div>
            </div>
            @include('layouts.frontpage.footer')
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->
 <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
 <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
 <script src="{{ asset('src/plugins/src/global/vendors.min.js') }}"></script>
 <script src="{{ asset('src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
 <script src="{{ asset('src/plugins/src/mousetrap/mousetrap.min.js') }}"></script>
 <script src="{{ asset('src/plugins/src/waves/waves.min.js') }}"></script>
 <script src="{{ asset('src/plugins/src/highlight/highlight.pack.js') }}"></script>
 <script src="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
 <script src="{{ asset('src/assets/js/custom.js') }}"></script>
 <script src="{{ asset('layouts/vertical-light-menu/app.js') }}"></script>
 <script src="{{ asset('src/plugins/src/glightbox/glightbox.min.js')}}"></script>
 <script src="{{ asset('src/plugins/src/glightbox/custom-glightbox.min.js')}}"></script>
 <script src="{{ asset('src/plugins/src/tomSelect/tom-select.base.js')}}"></script>
 <script src="{{ asset('src/plugins/src/tomSelect/custom-tom-select.js')}}"></script>
 <!-- END GLOBAL MANDATORY SCRIPTS -->


    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    @yield('scripts')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
</body>

</html>
