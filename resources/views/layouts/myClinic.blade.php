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


        <!-- the SummerNotes plugin styling CSS file -->
        <link href="{{ asset('assets/SummerNotes/summernote-bs4.min.css') }}" rel="stylesheet">

        <!-- the fileinput plugin styling CSS file -->

        <link rel="stylesheet" href="{{ asset('assets/BootstrapFileInput/themes/explorer-fa5/theme.min.css')}}" crossorigin="anonymous">

        <link href="{{ asset('assets/BootstrapFileInput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />

        @yield('style')
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/MyClinicApp/vendor/jquery/jquery.min.js')}}"></script>
    {{-- <script src="{{ asset('assets/MyClinicApp/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script> --}}


    <!-- PWA  -->

    <body id="page-top" class="sidebar-toggled">
        <div id="app">
            <div id="wrapper" style="direction: rtl">
                {{-- @desktop --}}
                    @include('partial.myClinic.sidebar')
                {{-- @enddesktop --}}
                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Main Content -->
                    <div id="content">

                        @include('partial.myClinic.header')

                        <main class="mt-4 px-0" style="direction:rtl ;text-align:left">
                            <div > @include('partial.flash') </div>
                            <br>
                            @yield('content')
                        </main>

                        <div class="mt-3">
                         @include('partial.myClinic.footer')
                        </div>
                    </div>
                </div>
            </div>


            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>


        </div>




        <!-- Scripts -->
        {{-- <script src="{{ asset('js/app.js') }}" ></script> --}}
        <!-- Bootstrap core JavaScript-->
        {{-- <script src="{{ asset('assets/MyClinicApp/vendor/jquery/jquery.min.js')}}"></script> --}}
        <script src="{{ asset('assets/MyClinicApp/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{ asset('assets/MyClinicApp/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('assets/MyClinicApp/js/sb-admin-2.js')}}"></script>
        <script src="{{ asset('assets/MyClinicApp/js/custom.js') }}" ></script>
        <!-- the BootstrapFileInput plugin JavaScript -->
        <script src="{{ asset('assets/BootstrapFileInput/js/plugins/buffer.min.js')}}"></script>
        <script src="{{ asset('assets/BootstrapFileInput/js/plugins/filetype.min.js')}}"></script>
        <script src="{{ asset('assets/BootstrapFileInput/js/plugins/piexif.min.js')}}"></script>
        <script src="{{ asset('assets/BootstrapFileInput/js/plugins/sortable.min.js')}}"></script>
        <script src="{{ asset('assets/BootstrapFileInput/js/fileinput.min.js')}}"></script>
        <script src="{{ asset('assets/BootstrapFileInput/themes/fa5/theme.js')}}"></script>


        @yield('script')

    </body>
</html>