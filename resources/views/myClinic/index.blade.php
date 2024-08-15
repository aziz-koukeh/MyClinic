@extends('layouts.myClinic')

@section('style')
{{-- <link href="{{ asset('assets/MyClinicApp/calender/css/style.css') }}" rel="stylesheet"> --}}
<link href="{{ asset('assets/MyClinicApp/calender/css/tempusdominus-bootstrap-4.css') }}" rel="stylesheet">

@endsection
{{-- ------------------ --}}

@section('content')

<div class=" mb-5 pb-5 ">
    @if (count($errors)>0)
        @foreach ($errors->all() as $item)
            <div class="alert alert-secondary" role="alert">
                {{$item}}
            </div>
        @endforeach
    @endif
    {{-- calenderModal --}}
    <div class="modal fade" id="calenderModal" tabindex="-1" aria-labelledby="calenderModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-left-primary ">
                <div class="modal-body">
                    <div class="card-body">
                        <div id="calender" style="direction: ltr"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>{{-- calenderModal --}}
    {{-- clinicTasks --}}
    <div class="modal fade" id="clinicTasks" tabindex="-1" aria-labelledby="clinicTasks" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-left-primary ">
                <div class="modal-header d-block text-center text-primary p-1">
                    <p class="p-0 m-0"><b>جدول المهام</b> <span>عدد  : ( {{$tasks->where('forUser_id','<>',auth()->user()->doctor_id)->count()}} )</span>

                    <button type="button" style="float:right" class="btn btn-secondary btn-sm p-1" data-dismiss="modal">
                        <i class="fa-solid fa-close fa-lg text-light"></i>
                    </button></p>
                    <p class="text-xs p-0 m-0">{{Carbon\Carbon::now()->format('D d-m-Y')}}</p>

                </div>
                <div class="modal-body p-1" style="direction: ltr">
                    <div class="card-body p-2" >
                        @forelse ($tasks->where('forUser_id','<>',auth()->user()->doctor_id) as $task)
                            @if ($task->read_at == null )
                                @php
                                $typetask ='info'
                                @endphp
                            @else
                                @php
                                $typetask ='success'
                                @endphp
                            @endif
                            <div class="card border-bottom-{{$typetask}} p-1">
                                <div class="d-flex" >
                                    {{-- <div class="d-block " style="width:25%;">

                                    </div> --}}

                                    <div class="d-block " style="width:100% ; text-align:right;direction: rtl">
                                        <div class="d-inline-flex w-100">
                                            <button type="submit" style="float:right" class="btn btn-primary btn-user text-xs p-1" onclick="document.getElementById('task{{$task->slug}}').submit();">إنجاز</button>
                                            <form id="task{{$task->slug}}" action="{{route('Clinic.taskDone',$task->slug)}}" method="post" class="d-none">
                                                @csrf
                                            </form>
                                            <p class="text-center text-gray-800 p-0 m-0 w-100"><b class="text-xs font-weight-bold text-gray-900">المهمة : </b>@if ($task->forDay)
                                                <span class=" text-xs text-dark"><b> لتاريخ  {{\Carbon\Carbon::parse($task->forDay)->format('D d/m/Y - h:i a')}}</b></span>
                                                @endif
                                            </p>
                                        </div>
                                        @if ($task->forDay)
                                            <p class=" text-xs text-gray-800 p-0 px-3 mb-2 w-100" style="text-align:left">{{\Carbon\Carbon::parse($task->forDay)->diffForHumans()}}
                                            </p>
                                        @endif
                                        <p class="text-center text-xs text-gray-800 card p-1 my-1"><b class="text-xs text-gray-900">{!! \Illuminate\Support\Str::limit($task->contant, 100 , '...') !!}</b></p>
                                        <div class="d-block text-center" style="width:100% ; text-align:right;direction: rtl">
                                            <p class="text-center text-xs text-gray-800 p-0 m-0"><b class="text-xs text-gray-900">
                                                @if ($task->forUser_id == null)
                                                    مهمة عامة
                                                @else
                                                    @if ($task->foruser && $task->foruser->doctor_id == $task->forGroup_id)
                                                        مهمة لـ {{$task->foruser->name}}
                                                    @else
                                                        مهمة لموظف سابق
                                                    @endif

                                                @endif
                                            </b> -
                                            <span class=" text-xs text-dark"><b>وقت الإنشاء : {{$task->created_at->format('D d/m/Y - h:i a')}} </b></span></p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <hr class="my-2">
                        @empty
                            <div class="d-flex" >
                                <div class="d-block " style="width:100% ;">
                                    <p class="text-center text-gray-800 p-0 m-0"><b>لا يوجد مهام للتنفيذ</b></p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>{{-- clinicTasks --}}

    @if (count($tasks->where('forUser_id','<>',auth()->user()->doctor_id))>0)
        <a type="button"  class="btn btn-primary shadow btn-circle rounded-left py-2 px-3"  style="position: fixed;left:0;bottom:50px;overflow:visible;z-index:1;height: 40px"  role="button"  data-toggle="modal" data-target="#clinicTasks">
            <i class="fa-regular fa-clipboard fa-lg text-light"  data-toggle="tooltip" title="مهام العيادة"></i>
        </a>
    @endif
    <a type="button"  class="btn btn-primary shadow btn-circle rounded-left py-2 px-3"  style="position: fixed;left:0;bottom:100px;overflow:visible;z-index:1;height: 40px"  role="button"  data-toggle="modal" data-target="#calenderModal">
        <i class="fa-solid fa-calendar-days fa-lg text-light"  data-toggle="tooltip" title="الروزنامة"></i>
    </a>
    <a type="button"  class="btn btn-primary shadow btn-circle rounded-left py-2 px-3 nav-link"  style="position: fixed;left:0;bottom:150px;overflow:visible;z-index:1;height: 40px;"  role="button"  data-toggle="modal" data-target="#nextReview">
        {{-- <i class="fa-solid fa-calendar-days"></i> --}}
        <i class="fa-solid fa-clock-rotate-left fa-lg text-light" style="position:relative"  data-toggle="tooltip" title="المواعيد القادمة"></i>
        @if (count($nextReviews) > 0)
            <span class="badge badge-success badge-counter"  style="position: absolute;right: 0;border: 2px solid;font-size: xx-small;">
                {{count($nextReviews)}}
            </span>
        @endif
    </a>

    <div class="form-row mx-2" style="direction:ltr">

        <div class="col-lg-12">
            <div class="card border-left-primary shadow  my-3" style="min-height: calc(100vh - 80px)" >
                <div class="text-primary py-2 px-3"><b style="float:right">زوار في العيادة   @if (count($patientReviews) >0)<span class="text-xs" >عدد :  {{count($patientReviews)}}</span> @endif</b><b style="float:left">{{Carbon\Carbon::now()->format('D d-m-Y')}} </b>
                    {{-- <a type="button" class="text-xs btn text-success" style="direction: rtl;text-align:right;float: right"
                    role="button"  data-toggle="modal" data-target="#nextReview">
                    - المواعيد القادمة :
                        @if (count($nextReviews) >0)
                            <span><b>( {{count($nextReviews)}} )</b></span>
                        @endif
                    </a> --}}
                </div><hr class="p-0 m-0">
                <div class="card-body p-2 my-2" style="overflow-y:auto">
                    @forelse ($patientReviews as $review)
                        @if ($review->review_type == 'معاينة')
                            @php
                            $type ='success'
                            @endphp
                        @elseif ($review->review_type == 'مراجعة')
                            @php
                            $type ='warning'
                            @endphp
                        @elseif ($review->review_type == 'اسعافية')
                            @php
                            $type ='danger'
                            @endphp
                        @else
                            @php
                            $type ='info'
                            @endphp
                        @endif
                        <div class="card border-bottom-{{$type}} p-2">
                            <div class="d-flex" >
                                <div class="d-block " style="width:10% ;float: left">
                                    <!-- Default dropright button -->
                                    <div class="btn-group dropright d-md-block ">
                                        <button type="button"  class="btn btn-light btn-circle btn-sm mb-1 rounded-circle" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-regular fa-lightbulb  fa-xl text-warning"></i>
                                        </button>
                                        <div class="dropdown-menu p-1" style="direction: rtl;text-align:right;width:250px">
                                            معلومات ال{{$review->review_type}} :
                                            @if ($review->outsideReviews)
                                                <br>عائدة إلى  {{$review->outsideReviews->review_type}}
                                                <br>سبب ال{{$review->outsideReviews->review_type}} السابقة :  <br>{{$review->outsideReviews->main_complaint}}
                                                <br>التشخيص :  <br>{{$review->outsideReviews->medical_report}}
                                                @if ($review->outsideReviews->doctor_notes)
                                                    <br>ملاحظات حول الزيارة :  <br>{{$review->outsideReviews->doctor_notes}}
                                                @endif
                                            @endif
                                            <br> سبب الزيارة :  {{$review->main_complaint}}
                                            @if ($review->leave_off == 1) <br> موجود في العيادة @else <br> حجز هاتفي @endif
                                            <br>  الاسم : {{$review->patient->patient_name}}
                                            @if ($review->patient->age && $review->patient->age != date('Y')) <br> العمر : {{date('Y') -$review->patient->age}}  @endif
                                            @if ($review->patient->blood_type) <br> زمرة الدم : {{$review->patient->blood_type}}  @endif
                                            @if ($review->patient->gender == 'male') <br> الجنس :  ذكر @elseif ($review->patient->gender == 'female') <br> الجنس :  أنثى @endif
                                            @if ($review->patient->smoking == 'negative') <br> مدخن :  سلبي @elseif ($review->patient->smoking == 'positive') <br> مدخن :  إيجابي @endif
                                            @if ($review->patient->relationship == 'married') <br> الحالة الإجتماعية :  متزوج @elseif ($review->patient->relationship == 'single') <br> الحالة الإجتماعية :  عازب @endif
                                            @if ($review->pain_story)<br> القصة المرضية :  {{$review->pain_story}}  @endif
                                            @if ($review->patient->child_count) <br> الأولاد : {{$review->patient->child_count}}  @endif
                                            @if ($review->patient->older_surgery) <br> السوابق الجراحية :  {{$review->patient->older_surgery}}  @endif
                                            @if ($review->patient->older_sicky) <br> السوابق المرضية :  {{$review->patient->older_sicky}}  @endif
                                            @if ($review->patient->older_sensitive) <br> السوابق التحسسية :  {{$review->patient->older_sensitive}}  @endif
                                            @if ($review->patient->permanent_medic) <br> الأدوية الدائمة :  {{$review->patient->permanent_medic}}  @endif
                                            @if ($review->patient->patient_state) <br> حول المريض :  {{$review->patient->patient_state}}  @endif
                                            @if ($review->patient->phone) <br> رقم الهاتف : {{$review->patient->phone}}  @endif
                                        </div>
                                    </div><!-- Default dropright button -->
                                </div>
                                <div class="d-block " style="width:80% ;direction: rtl">

                                    <p class="text-center text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0" href="{{route('Clinic.patientProfile',$review->patient->patient_slug)}}"><b class="text-xs text-gray-900">اسم المريض: </b><b>{{$review->patient->patient_name}}</b></a></p>
                                    <p class="text-center text-xs text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0" href="{{route('Clinic.patientProfile',$review->patient->patient_slug)}}"><b class="text-xs text-gray-900">سبب الزيارة: </b>{!! \Illuminate\Support\Str::limit($review->main_complaint, 40 , '...') !!}</a></p>
                                    <p class="text-center text-xs text-gray-800 p-0 m-0"><b >وقت الزيارة</b><span> {{$review->created_at->format('h:i a')}}</span></p>

                                </div>
                                {{-- <div class="d-block " style="width:20%;">
                                    <p class="text-center text-xs text-gray-800 p-0 m-0"><b >وقت الزيارة</b><span> {{$review->created_at->format('h:i a')}}</span></p>
                                    <p class="text-center text-xs text-gray-800 p-0 m-0"></p>
                                </div> --}}
                                <div class="d-block "  style="width:10% ">
                                    @if (auth()->user()->id == auth()->user()->doctor_id)
                                        <button class="btn btn-primary btn-sm mb-1 rounded-circle" style="float: right"  data-toggle="modal" data-target="#EditReview{{$review->id}}">
                                            <span class="d-none d-lg-block text-xs">تشخيصي</span>
                                            {{-- <i class="fa-solid fa-comment-medical fa-lg text-light"></i> --}}
                                            <i class="fa-solid fa-stethoscope  fa-lg text-light"></i>
                                        </button>
                                    @endif

                                </div>
                            </div>
                        </div>

                        {{-- @if (Carbon\Carbon::now() > Carbon\Carbon::parse($review->date_expecting))
                            sadsakdh
                        @else
                            2345678
                        @endif
                        {{Carbon\Carbon::now() }}--{{ Carbon\Carbon::parse($review->date_expecting)}}
                        @dd(Carbon\Carbon::parse($review->date_expecting)) --}}

                        <!-- Modal Doctor Repory -->
                        <div class="modal fade" id="EditReview{{$review->id}}" tabindex="-1" aria-labelledby="EditReview{{$review->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-body py-1">
                                        <form action="{{route('Clinic.updateReview_doctor',$review->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="d-block py-2" style="width:100% ;direction: rtl">


                                                {{-- <p class="text-center text-{{$type}} p-0 m-0">{{$review->review_type}}</p> --}}
                                                <p class="text-center text-gray-800 p-0 m-0"><span class="text-{{$type}} font-weight-bold">{{$review->review_type}} للمريض :  </span><a class="text-center text-gray-800 p-0 m-0" href="{{route('Clinic.patientProfile',$review->patient->patient_slug)}}"><b>{{$review->patient->patient_name}}</b></a></p>
                                                <p class="text-center text-xs text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0" href="{{route('Clinic.patientProfile',$review->patient->patient_slug)}}"><b class="text-xs text-gray-900">وقت الزيارة : </b> {{$review->created_at->format('D d/m - h:i a')}}</a></p>
                                                <p class="text-center text-xs text-gray-800 p-0 m-0">سبب الزيارة : <b>{{$review->main_complaint}}</b></p>
                                            </div>
                                        <hr class="m-0">
                                            <div class="row">
                                                <div class="col-lg-4 bg-new-image"></div>
                                                <div class="col-lg-8">
                                                    <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                        <label class="text-xs">رأي الطبيب : </label>
                                                        <textarea id="editReview-medical_report" class="VoiceToText form-control @error('medical_report') is-invalid @enderror" name="medical_report" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" >{{$review->medical_report}}</textarea>
                                                            @error('medical_report')
                                                                <span class="invalid-feedback text-center" role="alert">
                                                                    <strong >{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-medical_report">
                                                            <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                        </button>
                                                    </div>

                                                    <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                        <label class="text-xs">خطة العلاج : </label>
                                                        <textarea id="editReview-treatment_plan" class="VoiceToText form-control @error('treatment_plan') is-invalid @enderror" name="treatment_plan" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" >{{$review->treatment_plan}}</textarea>
                                                            @error('treatment_plan')
                                                                <span class="invalid-feedback text-center" role="alert">
                                                                    <strong >{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-treatment_plan">
                                                            <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                        </button>
                                                    </div>
                                                    <!-- Collapse Modal InsideReviews InsideEmergency -->
                                                    <div class="card mb-2">
                                                        <!-- Card Header - Accordion -->
                                                        <a href="#CollapseEditViewReviewEmergency" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                            role="button" aria-expanded="true" aria-controls="CollapseEditViewReviewEmergency">
                                                            <h6 class="m-0 text-xs font-weight-bold text-gray-600 text-center">المزيد  :
                                                                <span class=" @if ($review->main_complaint)
                                                                text-primary
                                                                @endif">سبب الزيارة</span>
                                                                - <span class=" @if ($review->pain_story)
                                                                text-primary
                                                                @endif">القصة المرضية</span>
                                                                - <span class=" @if ($review->med_analysis_T)
                                                                text-primary
                                                                @endif">نص التحليل</span>
                                                                - <span class=" @if ($review->med_photo_T)
                                                                text-primary
                                                                @endif">محتوى الصورة</span>
                                                                - <span class=" @if ($review->doctor_notes)
                                                                text-primary
                                                                @endif">ملاحظات الزيارة</span>
                                                                @if (Carbon\Carbon::today() < Carbon\Carbon::parse($review->date_expecting))
                                                                    - <span class=" @if ($review->date_expecting)
                                                                        text-primary
                                                                        @endif">
                                                                        @if ($review->main_complaint ==' - تحديد عملية - تحليل' || $review->main_complaint =='تحديد عملية' || $review->main_complaint ==' - تحديد عملية - صورة - تحليل' || $review->main_complaint ==' - تحديد عملية - صورة')
                                                                            موعد العملية
                                                                        @else
                                                                            الموعد القادم
                                                                        @endif
                                                                    </span>
                                                                @endif

                                                            </h6>
                                                        </a>
                                                        <!-- Card Content - Collapse -->
                                                        <div class="collapse" id="CollapseEditViewReviewEmergency">
                                                            <div class="card-body px-1 py-1">
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">نص التحليل : </label>
                                                                    <textarea id="editReview-med_analysis_T" class="VoiceToText form-control @error('med_analysis_T') is-invalid @enderror" name="med_analysis_T" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" >{{$review->med_analysis_T}}</textarea>
                                                                        @error('med_analysis_T')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:39px;" for="editReview-med_analysis_T">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">محتوى الصورة : </label>
                                                                    <textarea id="editReview-med_photo_T" class="VoiceToText form-control @error('med_photo_T') is-invalid @enderror" name="med_photo_T" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" >{{$review->med_photo_T}}</textarea>
                                                                        @error('med_photo_T')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:39px;" for="editReview-med_photo_T">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="form-group mb-2" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">
                                                                        @if ($review->main_complaint ==' - تحديد عملية - تحليل' || $review->main_complaint =='تحديد عملية' || $review->main_complaint ==' - تحديد عملية - صورة - تحليل' || $review->main_complaint ==' - تحديد عملية - صورة')
                                                                             موعد العملية
                                                                        @else
                                                                             الموعد القادم
                                                                        @endif
                                                                        : </label>
                                                                    {{-- @if ($review->date_expecting) --}}

                                                                        {{-- @dd(\Carbon\Carbon::parse($review->date_expecting)->format('Y-m-d')) --}}
                                                                    {{-- @endif --}}
                                                                    <input type="date" min="{{Carbon\Carbon::tomorrow()->format('Y-m-d')}}" @if ($review->date_expecting)
                                                                        value="{{Carbon\Carbon::parse($review->date_expecting)->format('Y-m-d')}}"
                                                                    @endif  class="form-control @error('date_expecting') is-invalid @enderror" name="date_expecting" style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
                                                                    @error('date_expecting')
                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                            <strong >{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">ملاحظات الزيارة : </label>
                                                                    <textarea id="editReview-doctor_notes" class=" VoiceToText form-control @error('doctor_notes') is-invalid @enderror" name="doctor_notes" rows="3" style="padding: 0.375rem 0.75rem;text-align:center">{{$review->doctor_notes}}</textarea>
                                                                        @error('doctor_notes')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-doctor_notes">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>

                                                                {{-- <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">سبب الزيارة : </label>
                                                                    <textarea id="editReview-main_complaint" class=" VoiceToText form-control @error('main_complaint') is-invalid @enderror" name="main_complaint" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" >{{$review->main_complaint}}</textarea>
                                                                        @error('main_complaint')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-main_complaint">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div> --}}
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">القصة المرضية : </label>
                                                                    <textarea id="editReview-pain_story" class=" VoiceToText form-control @error('pain_story') is-invalid @enderror" name="pain_story" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" >{{$review->pain_story}}</textarea>
                                                                        @error('pain_story')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-pain_story">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>

                                                                {{-- علق لأن المشروع الحالي لا يمكن رفع الصور --}}
                                                                <div class="form-group mb-2" style="direction:ltr;text-align:right" >
                                                                    <label class="text-xs" style="text-align:right;direction: rtl;">صور مرفقة : </label>
                                                                    <input type="file" class="input_image form-control @error('images') is-invalid @enderror" name="images[]" multiple style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
                                                                    @error('images')
                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                            <strong >{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>{{-- علق لأن المشروع الحالي لا يمكن رفع الصور --}}
                                                            </div>
                                                        </div>
                                                    </div><!-- Collapse Modal View Review Emergency -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer py-1">
                                            <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                            <button type="submit" class="btn btn-primary btn-user">حفظ</button>
                                        </form>
                                        </div>
                                </div>
                            </div>
                        </div><!-- Modal Doctor Repory -->
                        <hr class="my-1">

                    @empty
                        <div class="d-flex" >
                            <div class="d-block " style="width:100% ;">
                                <p class="text-center text-gray-800 p-0 m-0"><b>لايوجد</b></p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    <!-- Modal Next -->
    <div class="modal fade" id="nextReview" tabindex="-1" aria-labelledby="nextReview" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="width: 95%;height: 95%;">
                <div class="modal-header py-1">
                    <div class="h6 d-flex w-100 text-primary font-weight-bold text-center py-1 px-1" style="text-align: right ;direction:rtl">
                        @if (count($nextReviews)>0)
                            - الزيارت القادمة :  ( {{count($nextReviews)}} )

                        @else
                            لا يوجد بعد
                        @endif
                    </div>
                </div>
                <div class="modal-body py-1" style="direction:ltr;" >
                    <div class="py-2">
                        @php
                            $pantientNum=count($nextReviews);
                        @endphp
                        @forelse ($nextReviews as $review)
                            @if ($review->review_type == 'معاينة')
                                @php
                                $type ='success'
                                @endphp
                            @elseif ($review->review_type == 'مراجعة')
                                @php
                                $type ='warning'
                                @endphp
                            @elseif ($review->review_type == 'اسعافية')
                                @php
                                $type ='danger'
                                @endphp
                            @else
                                @php
                                $type ='info'
                                @endphp
                            @endif
                            <div class="card bg-gray-200 border-bottom-{{$type}} py-2 px-1">
                                <div class="d-flex" >
                                    <div class="d-block"  style="width:12% ;direction: rtl">

                                        <a class="btn btn-light btn-circle btn-sm" type="button" href="{{route('Clinic.destroyReviewEmployee',$review->id)}}"  data-toggle="tooltip" title=" حذف الزيارة ">
                                            <i class="fas fa-trash fa-lg text-danger"></i>
                                        </a>
                                    </div>

                                    <div class="d-block " style="width:80% ;direction: rtl">
                                        <p class="text-center text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0" type="button" data-toggle="modal"   data-target="#nextReview{{$review->id}}"><b class="text-xs text-gray-900">اسم المريض: </b><b>{{$review->patient->patient_name}}</b></a></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0" type="button" data-toggle="modal" data-target="#nextReview{{$review->id}}"><b class="text-xs text-gray-900">سبب الزيارة: </b>{!! \Illuminate\Support\Str::limit($review->main_complaint, 40 , '...') !!}</a></p>
                                        <p class="text-center font-weight-bold text-gray-800 p-0 m-0"><b >لتاريخ :</b><span> {{Carbon\Carbon::parse($review->review_forDay)->format('D d-m-Y')}}</span></p>
                                    </div>
                                    <div class="d-block " style="width:12%;">
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><b>#</b></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><b>{{$pantientNum}}</b></p>
                                        <!-- Default dropright button -->
                                        <div class="btn-group dropleft text-center d-md-block ">
                                            <button type="button"  class="btn btn-light btn-circle btn-sm mb-1 rounded-circle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-regular fa-lightbulb  fa-xl text-warning"></i>
                                            </button>
                                            <div class="dropdown-menu p-1" style="direction: rtl;text-align:right;width:250px">
                                                معلومات ال{{$review->review_type}} :
                                                @if ($review->outsideReviews)
                                                    <br>عائدة إلى  {{$review->outsideReviews->review_type}}
                                                    <br>سبب ال{{$review->outsideReviews->review_type}} السابقة :  <br>{{$review->outsideReviews->main_complaint}}
                                                    <br>التشخيص :  <br>{{$review->outsideReviews->medical_report}}
                                                    @if ($review->outsideReviews->doctor_notes)
                                                        <br>ملاحظات حول الزيارة :  <br>{{$review->outsideReviews->doctor_notes}}
                                                    @endif
                                                @endif
                                                <br> سبب الزيارة :  {{$review->main_complaint}}
                                                @if ($review->leave_off == 1) <br> موجود في العيادة @else <br> حجز هاتفي @endif
                                                <br>  الاسم : {{$review->patient->patient_name}}
                                                @if ($review->patient->age && $review->patient->age != date('Y')) <br> العمر : {{date('Y') -$review->patient->age}}  @endif
                                                @if ($review->patient->blood_type) <br> زمرة الدم : {{$review->patient->blood_type}}  @endif
                                                @if ($review->patient->gender == 'male') <br> الجنس :  ذكر @elseif ($review->patient->gender == 'female') <br> الجنس :  أنثى @endif
                                                @if ($review->patient->smoking == 'negative') <br> مدخن :  سلبي @elseif ($review->patient->smoking == 'positive') <br> مدخن :  إيجابي @endif
                                                @if ($review->patient->relationship == 'married') <br> الحالة الإجتماعية :  متزوج @elseif ($review->patient->relationship == 'single') <br> الحالة الإجتماعية :  عازب @endif
                                                @if ($review->pain_story)<br> القصة المرضية :  {{$review->pain_story}}  @endif
                                                @if ($review->patient->child_count) <br> الأولاد : {{$review->patient->child_count}}  @endif
                                                @if ($review->patient->older_surgery) <br> السوابق الجراحية :  {{$review->patient->older_surgery}}  @endif
                                                @if ($review->patient->older_sicky) <br> السوابق المرضية :  {{$review->patient->older_sicky}}  @endif
                                                @if ($review->patient->older_sensitive) <br> السوابق التحسسية :  {{$review->patient->older_sensitive}}  @endif
                                                @if ($review->patient->permanent_medic) <br> الأدوية الدائمة :  {{$review->patient->permanent_medic}}  @endif
                                                @if ($review->patient->patient_state) <br> حول المريض :  {{$review->patient->patient_state}}  @endif
                                                @if ($review->patient->phone) <br> رقم الهاتف : {{$review->patient->phone}}  @endif
                                            </div>
                                        </div><!-- Default dropright button -->
                                    </div>


                                </div>
                            </div>

                            <hr class="my-1">
                            @php
                            --$pantientNum;
                            @endphp
                            <!-- Modal Next -->
                            <div class="modal fade" id="nextReview{{$review->id}}" tabindex="-1" aria-labelledby="nextReview{{$review->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header py-1">
                                            <div class="text-center w-100">
                                                <h1 class="h6 font-weight-bold text-gray-900 my-2 text-center" style="direction:rtl;">تعديل على موعد {{$review->patient->patient_name}}</h1>
                                            </div>
                                        </div>
                                        <div class="modal-body py-0">
                                            <div class="card-body p-0" style="direction:ltr">
                                                <!-- Nested Row within Card Body -->

                                                <form  class="user" method="POST" action="{{route('Clinic.updateReview_insert',$review->id)}}">
                                                    @csrf
                                                    <div class="form-group mb-3" style="direction: rtl;margin-bottom: 0.5rem;">
                                                        <div class="form-row">
                                                            <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                <label class="text-xs">تاريخ الحجز القادم :</label>
                                                                <input type="date" min="{{Carbon\Carbon::tomorrow()->format('Y-m-d')}}"
                                                                class="form-control form-control @error('review_forDay') is-invalid @enderror" value="{{Carbon\Carbon::parse($review->review_forDay)->format('Y-m-d')}}" name="review_forDay" placeholder="حجز موعد"
                                                                    style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                                @error('review_forDay')
                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                        <strong >{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mb-3 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                <div class="custom-radio custom-control-inline">
                                                                    <label class="text-xs mr-3">سبب الزيارة : </label>
                                                                </div>
                                                                <div class="card d-block" style="height: 38px;">
                                                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                        <input type="radio" id="editviewNext{{$review->id}}" name="main_complaint[]" @if ($review->review_type == "معاينة") checked  @endif value="معاينة جديدة" class="custom-control-input">
                                                                        <label class="text-xs text-success font-weight-bold custom-control-label" for="editviewNext{{$review->id}}" >معاينة</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                        <input type="radio" id="editnewreviewNext{{$review->id}}" name="main_complaint[]" @if ($review->review_type == "مراجعة") checked  @endif  value="مراجعة" class="custom-control-input">
                                                                        <label class="text-xs text-warning font-weight-bold custom-control-label" for="editnewreviewNext{{$review->id}}" >مراجعة</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                            <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">اسم الزائر : </label>
                                                            <input class="VoiceToText form-control @error('patient_name') is-invalid @enderror" type="text" id="patient_nameNext{{$review->id}}" value="{{$review->patient->patient_name}}" name="patient_name" required placeholder=" أكتب الاسم والكنية "
                                                            style="padding: 0.375rem 0.75rem;height:38px;font-size: 75%;text-align:center;">
                                                                @error('patient_name')
                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                        <strong >{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:38px;" for="patient_nameNext{{$review->id}}">
                                                                <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                            </button>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group mb-3 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">رقم الهاتف : </label>
                                                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" value="{{$review->patient->phone}}" name="phone" placeholder=" أكتب رقم الهاتف"
                                                                style="padding: 0.375rem 0.75rem;height:38px;text-align:center;direction: ltr;font-size: 75%;">
                                                                @error('phone')
                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                        <strong >{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mb-3 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">العمر : </label>
                                                                <input type="tel" max="99" min="1" class="form-control form-control @error('age') is-invalid @enderror" value="{{date('Y') -$review->patient->age}}" name="age" placeholder="1~99"
                                                                    style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                                @error('age')
                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                        <strong >{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group mb-3 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                <div class="custom-radio custom-control-inline">
                                                                    <label class="text-xs mr-3">الجنس : </label>
                                                                </div>
                                                                <div class="card d-block" style="height: 38px">
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="editgenderMaleNext{{$review->id}}" name="gender" @if ($review->patient->gender == 'male') checked  @endif  value="male" class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editgenderMaleNext{{$review->id}}">ذكر</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="editgenderFemaleNext{{$review->id}}" name="gender" @if ($review->patient->gender == 'female') checked  @endif  value="female" class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editgenderFemaleNext{{$review->id}}">أنثى</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                <div class="custom-radio custom-control-inline">
                                                                    <label class="text-xs mr-3">التدخين : </label>
                                                                </div>
                                                                <div class="card d-block" style="height: 38px">
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="editnegativeNext{{$review->id}}" name="smoking" value="negative" @if ($review->patient->smoking == 'negative') checked  @endif class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editnegativeNext{{$review->id}}">سلبي</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="editpositiveNext{{$review->id}}" name="smoking"  value="positive" @if ( $review->patient->smoking == 'positive') checked  @endif class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editpositiveNext{{$review->id}}">إيجابي</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- collapseCardMoreDetailsPatients -->
                                                        <div class="card mb-1">
                                                            <!-- Card Header - Accordion -->
                                                            <a href="#collapseCardMoreDetailsNextReview{{$review->id}}" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                                role="button" aria-expanded="true" aria-controls="collapseCardMoreDetailsNextReview{{$review->id}}">
                                                                <h6 class="m-0 text-xs font-weight-bold text-primary text-center">المزيد ...</h6>
                                                            </a>
                                                            <!-- Card Content - Collapse -->
                                                            <div class="collapse" id="collapseCardMoreDetailsNextReview{{$review->id}}">
                                                                <div class="card-body px-1 py-3">
                                                                    <div class="form-row">
                                                                        <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                            <label class="text-xs mb-0 mr-3" style="padding-bottom: 0.2rem;text-align:right;direction:rtl;">الحالة الإجتماعية : </label>
                                                                            <div class="card d-block" style="height: 38px">
                                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                                    <input type="radio" id="editRelationshipMarriedNext{{$review->id}}" name="relationship" value="married" @if ( $review->patient->relationship == 'married') checked  @endif  class="custom-control-input">
                                                                                    <label class="text-xs custom-control-label" for="editRelationshipMarriedNext{{$review->id}}">متزوج</label>
                                                                                </div>
                                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                                    <input type="radio" id="editRelationshipSingleNext{{$review->id}}" name="relationship"  value="single" @if ( $review->patient->relationship == 'single') checked  @endif class="custom-control-input">
                                                                                    <label class="text-xs custom-control-label" for="editRelationshipSingleNext{{$review->id}}">أعزب</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                            <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">عدد الأولاد : </label>
                                                                            <input type="tel" max="20" min="0" class="form-control form-control @error('child_count') is-invalid @enderror" value="{{$review->patient->child_count}}" name="child_count"
                                                                                style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                                            @error('child_count')
                                                                                <span class="invalid-feedback text-center" role="alert">
                                                                                    <strong >{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group mb-2 col-md-6 col-sm-12 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                            <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">المهنة : </label>
                                                                            <input type="text"class="VoiceToText form-control form-control @error('patient_job') is-invalid @enderror" value="{{$review->patient->patient_job}}" id="patient_jobNext{{$review->id}}" name="patient_job"
                                                                                style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                                                @error('patient_job')
                                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                                        <strong >{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_jobNext{{$review->id}}">
                                                                                <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                            </button>
                                                                        </div>
                                                                            <div class="form-group mb-2 col-md-6 col-sm-12 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                            <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">العنوان : </label>
                                                                            <input type="text" class="VoiceToText form-control @error('patient_address') is-invalid @enderror" id="patient_addressNext{{$review->id}}" value="{{$review->patient->patient_address}}" name="patient_address"
                                                                            style="padding: 0.375rem 0.75rem;height:38px;text-align:center;direction: ltr;font-size: 75%;">
                                                                            @error('patient_address')
                                                                                <span class="invalid-feedback text-center" role="alert">
                                                                                    <strong >{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                            <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_addressNext{{$review->id}}">
                                                                                <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">السوابق الجراحية : </label>
                                                                        <textarea  class="form-control" name="older_surgery" rows="2" style="height:38px;font-size: 75%;padding: 0.375rem 0.75rem;text-align:center"
                                                                            placeholder=" أكتب السوابق الجراحية في حال وجودها">{{$review->patient->older_surgery}}</textarea>
                                                                    </div>
                                                                    <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">السوابق المرضية : </label>
                                                                        <textarea  class="form-control" name="older_sicky" rows="2" style="padding: 0.375rem 0.75rem;text-align:center;height:38px;font-size: 75%"
                                                                            placeholder=" أكتب السوابق المرضية في حال وجودها">{{$review->patient->older_sicky}}</textarea>
                                                                    </div>
                                                                    <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">السوابق التحسسية : </label>
                                                                        <textarea  class="form-control" name="older_sensitive" rows="2" style="padding: 0.375rem 0.75rem;text-align:center;height:38px;font-size: 75%"
                                                                            placeholder=" أكتب السوابق التحسسية في حال وجودها">{{$review->patient->older_sensitive}}</textarea>
                                                                    </div>
                                                                    <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">الأدوية الدائمة : </label>
                                                                        <textarea  class="form-control" name="permanent_medic" rows="1" style="height:38px;font-size: 75%;padding: 0.375rem 0.75rem;text-align:center"
                                                                            placeholder=" أكتب الأدوية الدائمة في حال وجودها">{{$review->patient->permanent_medic}}</textarea>
                                                                    </div>
                                                                    <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">ملاحظات حول المريض : </label>
                                                                        <input type="text" class="form-control " name="patient_state" value="{{$review->patient->patient_state}}" placeholder=" أكتب ملاحظات في حال وجودها"
                                                                            style="padding: 0.375rem 0.75rem;height:38px;font-size: 75%;text-align:center">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- collapseCardMoreDetails -->
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer p-2">
                                            <button type="submit" class="btn btn-primary btn-user">تعديل</button>
                                            <a class="btn btn-secondary btn-user" role="button" data-toggle="modal"  data-dismiss="modal" data-target="#nextReview">عودة</a>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Modal Next -->
                        @empty
                            <p class="text-center "> لا يوجد بعد</p>
                        @endforelse
                    </div>
                </div>
                <div class="modal-footer py-1" style="direction:ltr">
                    <button type="button" style="float: right" class="btn btn-primary btn-user" data-dismiss="modal">عودة</button>
                </div>
            </div>
        </div>
    </div><!-- Modal Next -->

        {{-- <div class="col-lg-6 d-none d-md-block" >

        </div> --}}
        {{--<div class="col-lg-6 col-md-12">
            <div class="card border-left-primary shadow  my-3" style="height: 300px">
                <div class="text-center text-primary  py-2 px-3"> {{Carbon\Carbon::now()->format('D d-m-Y')}} - <b>جدول المهام</b> <span>عدد  :  ({{$tasks->where('forUser_id','<>',auth()->user()->doctor_id)->count()}})</span></div><hr class="p-0 m-0">
                <div class="card-body p-2 my-2" style="overflow-y:auto">
                    @forelse ($tasks->where('forUser_id','<>',auth()->user()->doctor_id) as $task)
                        @if ($task->read_at == null )
                            @php
                            $typetask ='info'
                            @endphp
                        @else
                            @php
                            $typetask ='success'
                            @endphp
                        @endif
                        <div class="card border-bottom-{{$typetask}} p-2">
                            <div class="d-flex" >
                                <div class="d-block " style="width:20%;">
                                    <p class="text-center text-xs text-gray-800 p-0 m-0"><b>وقت الإنشاء</b></p>
                                    <p class="text-center text-xs text-gray-800 p-0 m-0">{{$task->created_at->format('h:i a')}}</p>
                                    <p class="text-center text-xs text-gray-800 p-0 m-0">{{$task->created_at->format('D d-m-Y')}}</p>
                                </div>

                                <div class="d-block " style="width:100% ; text-align:right;direction: rtl">
                                    <p class="text-center text-gray-800 p-0 m-0"><b class="text-xs font-weight-bold text-gray-900">المهمة : </b>@if ($task->forDay)
                                        <span class=" text-xs text-gray-900">- لتاريخ :  {{\Carbon\Carbon::parse($task->forDay)->diffForHumans()}} - {{\Carbon\Carbon::parse($task->forDay)->format('D d/m/Y - h:i a')}}</span>
                                    @endif</p>
                                    <p class="text-center text-xs text-gray-800 p-0 m-0"><b class="text-xs text-gray-900">{!! \Illuminate\Support\Str::limit($task->contant, 60 , '...') !!}</b></p>
                                    <p class="text-center text-xs text-gray-800 p-0 m-0"><b class="text-xs text-gray-900">
                                        @if ($task->forUser_id == null)
                                            مهمة عامة
                                        @else
                                            @if ($task->foruser && $task->foruser->doctor_id == $task->forGroup_id)
                                                مهمة لـ {{$task->foruser->name}}
                                            @else
                                                مهمة لموظف سابق
                                            @endif

                                        @endif
                                    </b>
                                    </p>
                                </div>

                                <div class="d-block ">
                                    <button type="submit" class="btn btn-primary btn-user text-xs" style="width:100%" onclick="document.getElementById('task{{$task->slug}}').submit();">إنجاز</button>
                                    <form id="task{{$task->slug}}" action="{{route('Clinic.taskDone',$task->slug)}}" method="post" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                        <hr class="my-2">
                    @empty
                        <div class="d-flex" >
                            <div class="d-block " style="width:100% ;">
                                <p class="text-center text-gray-800 p-0 m-0"><b>لا يوجد مهام للتنفيذ</b></p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div> --}}

    </div>
    <div class="form-row align-items-center justify-content-center mx-2" style="direction:ltr">
        @if ($patientReviews->where('review_type','معاينة')->count()>0)
            <div class="col-lg-6">
                <div class="card border-bottom-success shadow  mb-4"  style="height: 300px">
                    <div class="card-header py-2">
                        <p class="text-center text-success p-0 m-0"><b>المعاينات </b><span class="text-xs" >عدد :  {{count($patientReviews->where('review_type','معاينة'))}}</span></p>
                    </div>
                    <div class="card-body p-2 my-2" style="overflow-y:auto">
                        @forelse ($patientReviews->where('review_type','معاينة') as $review)
                            <div class="card border-right-success p-2">
                                <div class="d-flex" >
                                    <div class="d-block " style="width:5%; ;float: left">
                                        <!-- Default dropright button -->
                                        <div class="btn-group dropright d-md-block ">
                                            <button type="button"  class="btn btn-light btn-circle btn-sm mb-1 rounded-circle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-regular fa-lightbulb  fa-xl text-warning"></i>
                                            </button>
                                            <div class="dropdown-menu p-1" style="direction: rtl;text-align:right;width:250px">
                                                معلومات ال{{$review->review_type}} :
                                                @if ($review->outsideReviews)
                                                    <br>عائدة إلى  {{$review->outsideReviews->review_type}}
                                                    <br>سبب ال{{$review->outsideReviews->review_type}} السابقة :  <br>{{$review->outsideReviews->main_complaint}}
                                                    <br>التشخيص :  <br>{{$review->outsideReviews->medical_report}}
                                                    @if ($review->outsideReviews->doctor_notes)
                                                        <br>ملاحظات حول الزيارة :  <br>{{$review->outsideReviews->doctor_notes}}
                                                    @endif
                                                @endif
                                                <br> سبب الزيارة :  {{$review->main_complaint}}
                                                @if ($review->leave_off == 1) <br> موجود في العيادة @else <br> حجز هاتفي @endif
                                                <br>  الاسم : {{$review->patient->patient_name}}
                                                @if ($review->patient->age && $review->patient->age != date('Y')) <br> العمر : {{date('Y') - $review->patient->age}}  @endif
                                                @if ($review->patient->blood_type) <br> زمرة الدم : {{$review->patient->blood_type}}  @endif
                                                @if ($review->patient->gender == 'male') <br> الجنس :  ذكر @elseif ($review->patient->gender == 'female') <br> الجنس :  أنثى @endif
                                                @if ($review->patient->smoking == 'negative') <br> مدخن :  سلبي @elseif ($review->patient->smoking == 'positive') <br> مدخن :  إيجابي @endif
                                                @if ($review->patient->relationship == 'married') <br> الحالة الإجتماعية :  متزوج @elseif ($review->patient->relationship == 'single') <br> الحالة الإجتماعية :  عازب @endif
                                                @if ($review->pain_story)<br> القصة المرضية :  {{$review->pain_story}}  @endif
                                                @if ($review->patient->child_count) <br> الأولاد : {{$review->patient->child_count}}  @endif
                                                @if ($review->patient->older_surgery) <br> السوابق الجراحية :  {{$review->patient->older_surgery}}  @endif
                                                @if ($review->patient->older_sicky) <br> السوابق المرضية :  {{$review->patient->older_sicky}}  @endif
                                                @if ($review->patient->older_sensitive) <br> السوابق التحسسية :  {{$review->patient->older_sensitive}}  @endif
                                                @if ($review->patient->permanent_medic) <br> الأدوية الدائمة :  {{$review->patient->permanent_medic}}  @endif
                                                @if ($review->patient->patient_state) <br> حول المريض :  {{$review->patient->patient_state}}  @endif
                                                @if ($review->patient->phone) <br> رقم الهاتف : {{$review->patient->phone}}  @endif
                                            </div>
                                        </div><!-- Default dropright button -->
                                    </div>
                                    <div class="d-block px-1 text-center" style="width:80% ;">
                                        <p class="text-xs text-gray-900 p-0 m-0" style="direction:rtl"><a href="{{route('Clinic.patientProfile',$review->patient->patient_slug)}}"><b>اسم الزائر :  {{$review->patient->patient_name}}</b></a></p>
                                        <p class="text-xs text-gray-800 p-0 m-0" style="direction:rtl"><a href="{{route('Clinic.patientProfile',$review->patient->patient_slug)}}"><b>سبب الزيارة :  </b>{!! \Illuminate\Support\Str::limit($review->main_complaint, 40 , '...') !!}</a></p>
                                        @if ($review->pain_story)
                                            <p class="text-xs text-gray-800 p-0 m-0" style="direction:rtl"><a href="{{route('Clinic.patientProfile',$review->patient->patient_slug)}}"><b>القصة المرضية  :  </b>{!! \Illuminate\Support\Str::limit($review->pain_story, 40 , '...') !!}</a></p>
                                        @endif
                                    </div>
                                    <div class="d-block " style="width:17%;">
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><b>وقت الزيارة</b></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0">{{$review->created_at->format('h:i a')}}</p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0">{{$review->created_at->format('D d-m-Y')}}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        @endif

        @if ($patientReviews->where('review_type','مراجعة')->count()>0)
            <div class="col-lg-6">
                <div class="card border-bottom-warning shadow  mb-4"  style="height: 300px">
                    <div class="card-header py-2">
                        <p class="text-center text-warning p-0 m-0"><b>المراجعات </b><span class="text-xs" >عدد :  {{count($patientReviews->where('review_type','مراجعة'))}}</span></p>
                    </div>
                    <div class="card-body p-2 my-2" style="overflow-y:auto">
                        @forelse ($patientReviews->where('review_type','مراجعة') as $review)
                            <div class="card border-right-warning p-2">
                                <div class="d-flex" >
                                    <div class="d-block " style="width:5%; ;float: left">
                                        <!-- Default dropright button -->
                                        <div class="btn-group dropright d-md-block ">
                                            <button type="button"  class="btn btn-light btn-circle btn-sm mb-1 rounded-circle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-regular fa-lightbulb  fa-xl text-warning"></i>
                                            </button>
                                            <div class="dropdown-menu p-1" style="direction: rtl;text-align:right;width:250px">
                                                معلومات ال{{$review->review_type}} :
                                                @if ($review->outsideReviews)
                                                    <br>عائدة إلى  {{$review->outsideReviews->review_type}}
                                                    <br>سبب ال{{$review->outsideReviews->review_type}} السابقة :  <br>{{$review->outsideReviews->main_complaint}}
                                                    <br>التشخيص :  <br>{{$review->outsideReviews->medical_report}}
                                                    @if ($review->outsideReviews->doctor_notes)
                                                        <br>ملاحظات حول الزيارة :  <br>{{$review->outsideReviews->doctor_notes}}
                                                    @endif
                                                @endif
                                                <br> سبب الزيارة :  {{$review->main_complaint}}
                                                @if ($review->leave_off == 1) <br> موجود في العيادة @else <br> حجز هاتفي @endif
                                                <br>  الاسم : {{$review->patient->patient_name}}
                                                @if ($review->patient->age && $review->patient->age != date('Y')) <br> العمر : {{date('Y') - $review->patient->age}}  @endif
                                                @if ($review->patient->blood_type) <br> زمرة الدم : {{$review->patient->blood_type}}  @endif
                                                @if ($review->patient->gender == 'male') <br> الجنس :  ذكر @elseif ($review->patient->gender == 'female') <br> الجنس :  أنثى @endif
                                                @if ($review->patient->smoking == 'negative') <br> مدخن :  سلبي @elseif ($review->patient->smoking == 'positive') <br> مدخن :  إيجابي @endif
                                                @if ($review->patient->relationship == 'married') <br> الحالة الإجتماعية :  متزوج @elseif ($review->patient->relationship == 'single') <br> الحالة الإجتماعية :  عازب @endif
                                                @if ($review->pain_story)<br> القصة المرضية :  {{$review->pain_story}}  @endif
                                                @if ($review->patient->child_count) <br> الأولاد : {{$review->patient->child_count}}  @endif
                                                @if ($review->patient->older_surgery) <br> السوابق الجراحية :  {{$review->patient->older_surgery}}  @endif
                                                @if ($review->patient->older_sicky) <br> السوابق المرضية :  {{$review->patient->older_sicky}}  @endif
                                                @if ($review->patient->older_sensitive) <br> السوابق التحسسية :  {{$review->patient->older_sensitive}}  @endif
                                                @if ($review->patient->permanent_medic) <br> الأدوية الدائمة :  {{$review->patient->permanent_medic}}  @endif
                                                @if ($review->patient->patient_state) <br> حول المريض :  {{$review->patient->patient_state}}  @endif
                                                @if ($review->patient->phone) <br> رقم الهاتف : {{$review->patient->phone}}  @endif
                                            </div>
                                        </div><!-- Default dropright button -->
                                    </div>
                                    <div class="d-block px-1 text-center" style="width:80% ;">
                                        <p class="text-xs text-gray-900 p-0 m-0" style="direction:rtl"><a href="{{route('Clinic.patientProfile',$review->patient->patient_slug)}}"><b>اسم الزائر :  {{$review->patient->patient_name}}</b></a></p>
                                        <p class="text-xs text-gray-800 p-0 m-0" style="direction:rtl"><a href="{{route('Clinic.patientProfile',$review->patient->patient_slug)}}"><b>سبب الزيارة :  </b>{!! \Illuminate\Support\Str::limit($review->main_complaint, 40 , '...') !!}</a></p>
                                        @if ($review->pain_story)
                                            <p class="text-xs text-gray-800 p-0 m-0" style="direction:rtl"><a href="{{route('Clinic.patientProfile',$review->patient->patient_slug)}}"><b>الأعراض الجديدة :  </b>{!! \Illuminate\Support\Str::limit($review->pain_story, 40 , '...') !!}</a></p>
                                        @endif
                                    </div>
                                    <div class="d-block " style="width:17%;">
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><b>وقت الزيارة</b></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0">{{$review->created_at->format('h:i a')}}</p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0">{{$review->created_at->format('D d-m-Y')}}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        @endif

        @if ($patientReviews->where('review_type','اسعافية')->count()>0)
            <div class="col-lg-6">
                <div class="card border-bottom-danger shadow  mb-4"  style="height: 300px">
                    <div class="card-header py-2">
                        <p class="text-center text-danger p-0 m-0"><b>الإسعافيات </b><span class="text-xs" >عدد :  {{count($patientReviews->where('review_type','اسعافية'))}}</span></p>
                    </div>
                    <div class="card-body p-2 my-2" style="overflow-y:auto">
                        @forelse ($patientReviews->where('review_type','اسعافية') as $review)
                            <div class="card border-right-danger p-2">
                                <div class="d-flex" >
                                    <div class="d-block " style="width:5%; ;float: left">
                                        <!-- Default dropright button -->
                                        <div class="btn-group dropright d-md-block ">
                                            <button type="button"  class="btn btn-light btn-circle btn-sm mb-1 rounded-circle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-regular fa-lightbulb  fa-xl text-warning"></i>
                                            </button>
                                            <div class="dropdown-menu p-1" style="direction: rtl;text-align:right;width:250px">
                                                معلومات ال{{$review->review_type}} :
                                                @if ($review->outsideReviews)
                                                    <br>عائدة إلى  {{$review->outsideReviews->review_type}}
                                                    <br>سبب ال{{$review->outsideReviews->review_type}} السابقة :  <br>{{$review->outsideReviews->main_complaint}}
                                                    <br>التشخيص :  <br>{{$review->outsideReviews->medical_report}}
                                                    @if ($review->outsideReviews->doctor_notes)
                                                        <br>ملاحظات حول الزيارة :  <br>{{$review->outsideReviews->doctor_notes}}
                                                    @endif
                                                @endif
                                                <br> سبب الزيارة :  {{$review->main_complaint}}
                                                @if ($review->leave_off == 1) <br> موجود في العيادة @else <br> حجز هاتفي @endif
                                                <br>  الاسم : {{$review->patient->patient_name}}
                                                @if ($review->patient->age && $review->patient->age != date('Y')) <br> العمر : {{date('Y') -$review->patient->age}}  @endif
                                                @if ($review->patient->blood_type) <br> زمرة الدم : {{$review->patient->blood_type}}  @endif
                                                @if ($review->patient->gender == 'male') <br> الجنس :  ذكر @elseif ($review->patient->gender == 'female') <br> الجنس :  أنثى @endif
                                                @if ($review->patient->smoking == 'negative') <br> مدخن :  سلبي @elseif ($review->patient->smoking == 'positive') <br> مدخن :  إيجابي @endif
                                                @if ($review->patient->relationship == 'married') <br> الحالة الإجتماعية :  متزوج @elseif ($review->patient->relationship == 'single') <br> الحالة الإجتماعية :  عازب @endif
                                                @if ($review->pain_story)<br> القصة المرضية :  {{$review->pain_story}}  @endif
                                                @if ($review->patient->child_count) <br> الأولاد : {{$review->patient->child_count}}  @endif
                                                @if ($review->patient->older_surgery) <br> السوابق الجراحية :  {{$review->patient->older_surgery}}  @endif
                                                @if ($review->patient->older_sicky) <br> السوابق المرضية :  {{$review->patient->older_sicky}}  @endif
                                                @if ($review->patient->older_sensitive) <br> السوابق التحسسية :  {{$review->patient->older_sensitive}}  @endif
                                                @if ($review->patient->permanent_medic) <br> الأدوية الدائمة :  {{$review->patient->permanent_medic}}  @endif
                                                @if ($review->patient->patient_state) <br> حول المريض :  {{$review->patient->patient_state}}  @endif
                                                @if ($review->patient->phone) <br> رقم الهاتف : {{$review->patient->phone}}  @endif
                                            </div>
                                        </div><!-- Default dropright button -->
                                    </div>
                                    <div class="d-block px-1 text-center" style="width:80% ;">
                                        <p class="text-xs text-gray-900 p-0 m-0" style="direction:rtl"><a href="{{route('Clinic.patientProfile',$review->patient->patient_slug)}}"><b>اسم الزائر :  {{$review->patient->patient_name}}</b></a></p>
                                        <p class="text-xs text-gray-800 p-0 m-0" style="direction:rtl"><a href="{{route('Clinic.patientProfile',$review->patient->patient_slug)}}"><b>سبب الزيارة :  </b>{!! \Illuminate\Support\Str::limit($review->main_complaint, 40 , '...') !!}</a></p>
                                        @if ($review->pain_story)
                                            <p class="text-xs text-gray-800 p-0 m-0" style="direction:rtl"><a href="{{route('Clinic.patientProfile',$review->patient->patient_slug)}}"><b>الأعراض :  </b>{!! \Illuminate\Support\Str::limit($review->pain_story, 40 , '...') !!}</a></p>
                                        @endif
                                    </div>
                                    <div class="d-block " style="width:17%;">
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><b>وقت الزيارة</b></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0">{{$review->created_at->format('h:i a')}}</p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0">{{$review->created_at->format('D d-m-Y')}}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        @endif

        @if ($patientReviews->where('review_type','زيارة')->count()>0)
            <div class="col-lg-6">
                <div class="card border-bottom-info shadow  mb-4"  style="height: 300px">
                    <div class="card-header py-2">
                        <p class="text-center text-info p-0 m-0"><b>الزيارات </b><span class="text-xs" >عدد :  {{count($patientReviews->where('review_type','زيارة'))}}</span></p>
                    </div>
                    <div class="card-body p-2 my-2" style="overflow-y:auto">
                        @forelse ($patientReviews->where('review_type','زيارة') as $review)
                            <div class="card border-right-info p-2">
                                <div class="d-flex" >
                                    <div class="d-block " style="width:5%; ;float: left">
                                        <!-- Default dropright button -->
                                        <div class="btn-group dropright d-md-block ">
                                            <button type="button"  class="btn btn-light btn-circle btn-sm mb-1 rounded-circle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-regular fa-lightbulb  fa-xl text-warning"></i>
                                            </button>
                                            <div class="dropdown-menu p-1" style="direction: rtl;text-align:right;width:250px">
                                                معلومات ال{{$review->review_type}} :
                                                @if ($review->outsideReviews)
                                                    <br>عائدة إلى  {{$review->outsideReviews->review_type}}
                                                    <br>سبب ال{{$review->outsideReviews->review_type}} السابقة :  <br>{{$review->outsideReviews->main_complaint}}
                                                    <br>التشخيص :  <br>{{$review->outsideReviews->medical_report}}
                                                    @if ($review->outsideReviews->doctor_notes)
                                                        <br>ملاحظات حول الزيارة :  <br>{{$review->outsideReviews->doctor_notes}}
                                                    @endif
                                                @endif
                                                <br> سبب الزيارة :  {{$review->main_complaint}}
                                                @if ($review->leave_off == 1) <br> موجود في العيادة @else <br> حجز هاتفي @endif
                                                <br>  الاسم : {{$review->patient->patient_name}}
                                                @if ($review->patient->age && $review->patient->age != date('Y')) <br> العمر : {{date('Y') -$review->patient->age}}  @endif
                                                @if ($review->patient->blood_type) <br> زمرة الدم : {{$review->patient->blood_type}}  @endif
                                                @if ($review->patient->gender == 'male') <br> الجنس :  ذكر @elseif ($review->patient->gender == 'female') <br> الجنس :  أنثى @endif
                                                @if ($review->patient->smoking == 'negative') <br> مدخن :  سلبي @elseif ($review->patient->smoking == 'positive') <br> مدخن :  إيجابي @endif
                                                @if ($review->patient->relationship == 'married') <br> الحالة الإجتماعية :  متزوج @elseif ($review->patient->relationship == 'single') <br> الحالة الإجتماعية :  عازب @endif
                                                @if ($review->pain_story)<br> القصة المرضية :  {{$review->pain_story}}  @endif
                                                @if ($review->patient->child_count) <br> الأولاد : {{$review->patient->child_count}}  @endif
                                                @if ($review->patient->older_surgery) <br> السوابق الجراحية :  {{$review->patient->older_surgery}}  @endif
                                                @if ($review->patient->older_sicky) <br> السوابق المرضية :  {{$review->patient->older_sicky}}  @endif
                                                @if ($review->patient->older_sensitive) <br> السوابق التحسسية :  {{$review->patient->older_sensitive}}  @endif
                                                @if ($review->patient->permanent_medic) <br> الأدوية الدائمة :  {{$review->patient->permanent_medic}}  @endif
                                                @if ($review->patient->patient_state) <br> حول المريض :  {{$review->patient->patient_state}}  @endif
                                                @if ($review->patient->phone) <br> رقم الهاتف : {{$review->patient->phone}}  @endif
                                            </div>
                                        </div><!-- Default dropright button -->
                                    </div>
                                    <div class="d-block px-1 text-center" style="width:80% ;">
                                        <p class="text-xs text-gray-900 p-0 m-0" style="direction:rtl"><a href="{{route('Clinic.patientProfile',$review->patient->patient_slug)}}"><b>اسم الزائر :  {{$review->patient->patient_name}}</b></a></p>
                                        <p class="text-xs text-gray-800 p-0 m-0" style="direction:rtl"><a href="{{route('Clinic.patientProfile',$review->patient->patient_slug)}}"><b>سبب الزيارة :  </b>{!! \Illuminate\Support\Str::limit($review->main_complaint, 40 , '...') !!}</a></p>
                                    </div>
                                    <div class="d-block " style="width:17%;">
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><b>وقت الزيارة</b></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0">{{$review->created_at->format('h:i a')}}</p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0">{{$review->created_at->format('D d-m-Y')}}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        @endif

    </div>


</div>




@endsection
{{-- ------------------ --}}
@section('script')
    {{-- -------------------------- --}}
    <script src="{{ asset('assets/MyClinicApp/calender/js/waypoints.min.js') }}" ></script>
    <script src="{{ asset('assets/MyClinicApp/calender/js/moment.min.js') }}" ></script>
    <script src="{{ asset('assets/MyClinicApp/calender/js/moment-timezone.min.js') }}" ></script>
    <script src="{{ asset('assets/MyClinicApp/calender/js/tempusdominus-bootstrap-4.min.js') }}" ></script>
    <script src="{{ asset('assets/MyClinicApp/calender/js/main.js') }}" ></script>
    {{-- -------------------------- --}}
        <!-- the SummerNotes plugin JavaScript -->
        <script src="{{ asset('assets/SummerNotes/summernote-bs4.min.js') }}" ></script>

        <!-- the SummerNotes plugin JavaScript -->
        {{--  يوضع اسم كلاس للتكست ايريا مثلا (.summernote) --}}
        <script>
            $(function () {
                $('.summernote').summernote({
                    // placeholder: 'Hello stand alone ui',
                    tabsize: 2,
                    height: 120,
                    toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                    ]
                });
                // يوضع اسم ايدي للفايل انبوت مثلا (#input_image)
                $('.input_image').fileinput({
                    theme: "fa", // نوع الايقونات .. فونت اوسم
                    maxFileCount :  5 , // عدد الاقصى للصور
                    allowedFileTypes :  ['image'], // نوع الملفات المرفوعة
                    showCancel :  true , // إظهار زر الإلغاء
                    showRemove :  true , // إخفاء زر الإزالة
                    showUpload :  false, // عدم الرفع من نفس البلاجن
                    overwriteInitial :  false ,// عدم الكتابة على البلاجن شيئ
                });

            });
        </script>
        {{-- <script>  لطباعة الصفحة
            window.print();
        </script> --}}
@endsection
