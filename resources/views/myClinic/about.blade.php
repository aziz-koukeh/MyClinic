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

        <!-- Custom fonts for this template-->
        <link href="{{ asset('assets/MyClinicApp/css/all.css') }}" rel="stylesheet">

    </head>

    <body class="bg-gradient-primary">
        <div class="container" >
            <div class="card o-hidden border-0 shadow-lg mt-5"style="height: 550px;text-align: right">
                <div class="card-body p-1" style="overflow-y: auto">
                    <!-- Nested Row within Card Body -->
                    <div class="form-row m-0" style=";direction:rtl" >
                        @php
                            $doctor_info =  App\Models\Doctor_info::where('user_id',auth()->user()->doctor_id)->first();
                            if ($doctor_info == null) {
                                $doctor_info =Doctor_info::create([
                                    'user_id' => auth()->user()->doctor_id ,
                                ]);
                                $doctor_info->save();
                            }
                        @endphp
                        <div class="col-md-7 p-4">
                            <div class="h5 font-weight-bold text-primary text-center text-uppercase mb-2">حول الطبيب</div>
                            <hr class="text-primary">
                            @if($doctor_info->university || $doctor_info->med_specialty)<div class="h6 mb-1 font-weight-bold text-gray-800">@if($doctor_info->university) - درس الطبيب في جامعة {{$doctor_info->university}} @endif @if($doctor_info->med_specialty) حاز على شهادة  {{$doctor_info->med_specialty}} @endif.</div> @endif
                            @if($doctor_info->exp_about || $doctor_info->exp_work_year)
                                <div class="h6 mb-1 font-weight-bold text-gray-800">
                                    @if($doctor_info->exp_about) - مجالات التخصص تشمل : {{$doctor_info->exp_about}}
                                    @endif
                                    @if($doctor_info->exp_work_year)  خبرة عمل ما يقارب
                                        <span class="text-primary" >
                                            @if ($doctor_info->exp_work_year > 0 )
                                                @if ($doctor_info->exp_work_year == 1 || $doctor_info->exp_work_year >= 11 ) {{$doctor_info->exp_work_year}}   سنة
                                                @elseif ($doctor_info->exp_work_year == 2 ) سنتين
                                                @elseif ($doctor_info->exp_work_year >= 3 && $doctor_info->exp_work_year <= 10 ) {{$doctor_info->exp_work_year}}   سنوات
                                                @endif
                                            @endif
                                        </span>.
                                    @endif
                                </div>
                            @endif
                            @if($doctor_info->bio) <div class="h6 mb-1 font-weight-bold text-gray-800"> - نبذة عن الطبيب : {{$doctor_info->bio}} .</div> @endif
                            @if($doctor_info->address) <div class=" mb-1 font-weight-bold text-gray-800"> - عنوان العيادة : {{$doctor_info->address}} .</div> @endif

                            @if($doctor_info->opentime || $doctor_info->opentime)
                            <div class="text-xs my-1 font-weight-bold text-gray-900 text-center">@if($doctor_info->opentime) - بداية الدوام : الساعة {{\Carbon\Carbon::parse($doctor_info->opentime)->format('h:i a')}} @endif @if($doctor_info->closetime) - نهاية الدوام : الساعة {{\Carbon\Carbon::parse($doctor_info->closetime)->format('h:i a')}} @endif .</div>
                            @endif<hr>


                            <div class="d-flex py-1 justify-content-center" style="direction:ltr">
                                @if($doctor_info->facepage)<a class="btn btn-social" href="{{$doctor_info->facepage}}"><i class="fab fa-facebook-f"></i></a> @endif
                                @if($doctor_info->whatsapp)<a class="btn btn-social" href="{{$doctor_info->whatsapp}}"><i class='bx bxl-whatsapp' style="font-size:150%"></i></a> @endif
                                @if($doctor_info->telegram)<a class="btn btn-social" href="{{$doctor_info->telegram}}"><i class='bx bxl-telegram'  style="font-size:120%"></i></a> @endif
                                @if($doctor_info->instagram)<a class="btn btn-social" href="{{$doctor_info->instagram}}"><i class="fab fa-instagram"></i></a> @endif
                                @if($doctor_info->youtube)<a class="btn btn-social" href="{{$doctor_info->youtube}}"><i class="fab fa-youtube"></i></a> @endif
                                @if($doctor_info->twitter)<a class="btn btn-social" href="{{$doctor_info->twitter}}"><i class="fab fa-twitter"></i></a> @endif
                                @if($doctor_info->linked_in)<a class="btn btn-social" href="{{$doctor_info->linked_in}}"><i class="fab fa-linkedin-in"></i></a> @endif
                            </div>
                            <hr>
                            <a class="small" href="{{route('Clinic.welcome')}}">صفحة الدخول</a>


                        </div>

                        <div class="col-md-5 bg-aboutUs-image">
                            @if($doctor_info->map_emb)
                            <div class="card border-top-dark border-left-dark border-bottom-dark border-right-dark" style="background:rgb(197, 197, 197);height: 542px;">
                                {!! $doctor_info->map_emb !!}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>


