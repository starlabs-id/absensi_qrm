<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name') }} - Admin</title>

        <link rel="icon" href="">

        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('packages/styles/css/themes/lite-blue.min.css') }}">


        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('packages/styles/vendor/smart.wizard/smart_wizard_theme_arrows.min.css') }}">
    </head>

    <body class="text-left">
        <div class="auth-layout-wrap" style="background-color: #333;">
             <!-- style="background-image: url(' {{ asset('packages/images/photo-wide-4.jpg') }} ')" -->
            <div class="auth-content">
                <div class="card o-hidden">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>

</html>
