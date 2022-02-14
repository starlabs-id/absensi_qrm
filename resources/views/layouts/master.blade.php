<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name') }} - Admin</title>

        <link rel="icon" href="{{ asset('packages/images/logo.png') }}">
        
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
        <!-- @yield('before-css') -->

        <!-- Theme CSS -->
        <link id="gull-theme" rel="stylesheet" href="{{ asset('packages/styles/css/themes/lite-blue.css') }}">
        <link rel="stylesheet" href="{{ asset('packages/styles/vendor/perfect-scrollbar.css') }}">

        <!-- page specific css -->
        <!-- @yield('page-css') -->

        <link rel="stylesheet" type="text/css" href="{{ asset('packages/styles/vendor/smart.wizard/smart_wizard_theme_arrows.css') }}">
        <link rel="stylesheet" href="{{ asset('packages/styles/vendor/datatables.min.css') }}">
        <link href="{{ asset('packages/styles/css/bootstrap-rtl.css') }}" rel="stylesheet">
        <link href="{{ asset('packages/styles/vendor/toastr.min.css') }}" rel="stylesheet">
        <link href="{{ asset('packages/vendor/sweetalert/sweetalert2.min.css') }}" rel="stylesheet">
        <link href="{{ asset('packages/vendor/jquery-confirm/dist/jquery-confirm.min.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('packages/vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('packages/vendor/morris/morris.css') }}" rel="stylesheet" type="text/css">
        @yield('ext_css')

        <style type="text/css">
            #pageloader
            {
                background: rgba( 255, 255, 255, 0.8 );
                display: none;
                height: 100%;
                position: fixed;
                width: 100%;
                z-index: 9999;
            }

            #pageloader img
            {
                left: 50%;
                margin-left: -32px;
                margin-top: -32px;
                position: absolute;
                top: 50%;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <div id="pageloader">
        <img src="{{ asset('packages/images/spinner.gif') }}" alt="processing..." />
        </div>

    </head>


    <!-- <body class="text-left" onload="startTime()"> -->
    <body class="text-left">
        
        <div class="app-admin-wrap layout-sidebar-large clearfix">
            @include('layouts.header-menu')
            <!-- ============ end of header menu ============= -->

            @include('layouts.sidebar')
            <!-- ============ end of left sidebar ============= -->

            <!-- ============ Body content start ============= -->
            <div class="main-content-wrap sidenav-open d-flex flex-column">
                <div class="main-content">
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="">Selamat Datang</a></li>
                            <li>{{ Auth::user()->name }}</li>
                        </ul>
                        <!-- <div class="col-sm-12 col-xs-12 pull-right">
                            <h5 style="margin-top: 0em;" class="pull-right">
                              <small>{{ date('d F Y') }} | <span id="txt"></span> WITA</small>
                            </h5>
                        </div> -->
                    </div>

                    <div class="separator-breadcrumb border-top"></div>
                    
                    @if($errors->any())
                        <div class="col-md-12 mb-4">
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $no = 1; ?>                                            
                                    @foreach ($errors->all() as $error)
                                        <li style="list-style-type: none;">{{ $no++ }}. {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @yield('content')
                    
                </div>

                @include('layouts.footer')
            </div>
            <!-- ============ Body content End ============= -->
        </div>
        <!--=============== End app-admin-wrap ================-->



        <script src="{{ asset('packages/js/vendor/jquery-3.3.1.min.js') }}"></script>
        <!-- common js -->
        <script src="{{ mix('packages/js/common-bundle-script.js') }}"></script>
        <!-- page specific javascript -->
        <!-- @yield('page-js') -->
        <!-- Theme javascript -->
        {{-- <script src="{{ mix('packages/js/es5/script.js') }}"></script> --}}
        <script src="{{ asset('packages/js/script.js') }}"></script>
        <script src="{{ asset('packages/js/sidebar.large.script.js') }}"></script>
        <script src="{{ asset('packages/js/vendor/datatables.min.js')}}"></script>
        <script src="{{ asset('packages/js/form.validation.script.js') }}"></script>
        <script src="{{ asset('packages/js/datatables.script.js') }}"></script>
        <script src="{{ asset('packages/js/default.js') }}"></script>
        <script src="{{ asset('packages/vendor/jquery-confirm/dist/jquery-confirm.min.js') }}"></script>
        <script src="{{ asset('packages/vendor/tinymce/tinymce.min.js') }}"></script>
        <script src="{{ asset('packages/vendor/select2/dist/js/select2.js') }}"></script>
        <script src="{{ asset('packages/vendor/sweetalert/sweetalert.all.js') }}"></script>
        <script src="{{ asset('packages/vendor/morris/morris.min.js') }}"></script>
        <script src="{{ asset('packages/vendor/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('packages/js/vendor/jquery.smartWizard.min.js') }}"></script>
        <script src="{{ asset('packages/js/smart.wizard.script.js') }}"></script>
        @yield('graphPage')

        @yield('customJs')
        @yield('bottom-js')

        @toastr_js
        @toastr_render
        @yield('script')

        
    </body>

</html>