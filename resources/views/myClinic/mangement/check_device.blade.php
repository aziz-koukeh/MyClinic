<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/MyClinicApp/css/sb-admin-2.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container mt-5">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row px-2 py-3">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"> أهلاً بك </h1>
                                    </div>
                                    <div class="text-center font-weight-bold text-gray-800">
                                        <p class="text-xs">
                                            ! لم يتم التصريح لك بالدخول
                                        </p>
                                        <p class="text-xs">
                                            الرجاء التواصل مع المسؤول وإعادة المحاولة
                                        </p>
                                        <a href="" type="button" class="btn btn-outline-primary text-xs rounded">إعادة المحاولة</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</body>

</html>

