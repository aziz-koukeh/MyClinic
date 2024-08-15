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
    <link href="{{ asset('assets/MyClinicApp/css/all.css') }}" rel="stylesheet">

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
                                        <h1 class="h4 text-gray-900 mb-4"> أهلاً بعودتك </h1>
                                    </div>
                                    <form method="POST" action="{{ route('Clinic.login') }} " class="user" style="direction:rtl">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user @error('username') is-invalid @enderror" id="exampleInputUsername" aria-describedby="usernameHelp" placeholder="اسم المستخدم">
                                                @error('username')
                                                    <span class="invalid-feedback text-center" role="alert">
                                                        <strong >{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="كلمة المرور">
                                                @error('password')
                                                    <span class="invalid-feedback text-center" role="alert">
                                                        <strong >{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                        {{-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small" style="text-align:right" >
                                                <input type="checkbox" class="custom-control-input" name="remember" id="customCheck" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="customCheck">تذكرني</label>
                                            </div>
                                        </div> --}}
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            تسجيل الدخول
                                        </button>
                                    </form>
                                    <hr>

                                    {{-- <div style="text-align:right">
                                        @if (Route::has('Clinic.password.request'))
                                            <a class="small" href="{{route('Clinic.password.request')}}">نسيت كلمة المرور ؟</a>
                                        @endif
                                    </div> --}}
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

