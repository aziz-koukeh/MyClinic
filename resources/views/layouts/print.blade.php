<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Custom fonts for this template-->
        <link href="{{ asset('assets/MyClinicApp/css/all.css') }}" rel="stylesheet">


        <!-- Custom styles for this template-->
        <link href="{{ asset('assets/MyClinicApp/css/sb-admin-2.css') }}" rel="stylesheet">



        @yield('style')

    </head>
    <body>
        <div >

        <main>
            <div > @include('partial.flash') </div>
            <br>
            @yield('print')
        </main>




        </div>


        @yield('script')

    </body>
</html>
