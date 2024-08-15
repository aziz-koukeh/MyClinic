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
        <div class="container">
            <div class="mt-5"> @include('partial.flash') </div>
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body">
                    <!-- Nested Row within Card Body -->
                    <div class="row px-2 py-4">
                        <div class="col-lg-5 d-none d-lg-block bg-contactUs-image"></div>
                        <div class="col-lg-7">
                            <div class="p-2">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">.. ابقى على تواصل معنا</h1>
                                </div>
                                <form class="user text-center" method="post" action="{{ route('Clinic.do_ContantUs') }}" style="direction:rtl">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-sm-4 mb-3">
                                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="الاسم">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4 mb-3">
                                            <input type="tel" class="form-control form-control-user @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" placeholder="رقم الهاتف">
                                            @error('mobile')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4 mb-3" style="direction:ltr">
                                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="الإيميل">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-sm-12 mb-3">
                                            <input type="text" class="form-control form-control-user @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" placeholder="الموضوع">
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 mb-3">
                                            <textarea name="message" style="border-radius: 25px;padding:1rem 0.75rem;font-size: 0.8rem;" class="form-control @error('message') is-invalid @enderror" rows="4" placeholder="نص الرسالة ..."></textarea>
                                            @error('message')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <h6 class="text-xs mb-3 text-center text-primary"><b> لن يكتمل الإجراء في حال وجود خطأ في البيانات</b></h6>
                                    <hr>
                                    <button type="submit" class="btn btn-primary btn-user justify-content-center" style="width:150px">
                                        إرسال
                                    </button>
                                </form>
                            </div>
                            <hr>
                            <a class="small" style="float:right" href="{{route('Clinic.welcome')}}">صفحة الترحيب</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('assets/MyClinicApp/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/MyClinicApp/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('assets/MyClinicApp/js/custom.js') }}" ></script>

    </body>
</html>


