@extends('layouts.myClinic')

@section('content')

{{--
    " - صورة"
    " - صورة - تحليل"
    " - معاينة جديدة - صورة - تحليل"
    " - تحديد عملية - صورة - تحليل"
    --}}
<div class="container-fluid pb-5 mt-3 mb-5">
        @if (count($errors)>0)
            @foreach ($errors->all() as $item)
                <div class="alert alert-secondary" role="alert">
                    {{$item}}
                </div>
            @endforeach
        @endif
        @if (count($patientReviews)>0)

            <a type="button"  class="btn btn-primary btn-sm rounded-left px-1 d-lg-none d-xl-none d-md-none"
                style="position: fixed;right:0%;top:11%;overflow:visible;z-index:2;"  role="button"  data-toggle="modal" data-target="#ourPatients">
                الموجودين<br>( {{count($patientReviews)}} )
            </a>

        @endif


    <div class="row" >
        <div class="col-md-4 d-none d-lg-block d-md-block card o-hidden  border-right-primary border-bottom-primary border-top-primary border-0 py-2 px-1"
             style="direction:ltr;">
             <div style="min-height: calc(100vh - 95px)" >
                <div class="h6 d-flex text-primary font-weight-bold text-center py-1 px-1" style="text-align: right ;direction:rtl">
                    @if (count($patientReviews)>0)
                        - العدد الموجود :  ( {{count($patientReviews)}} )
                    @else
                        لا يوجد بعد
                    @endif
                </div>
                <hr class="my-1">
                <div class="pb-4" style="overflow-y:auto ;height: 100%;">

                        @php
                            $pantientNum=count($patientReviews);
                        @endphp
                        @forelse ($patientReviews as $review)
                            @if ($review->review_type == 'معاينة')
                                @php
                                $type ='success'
                                @endphp
                            @elseif ($review->review_type == 'مراجعة')
                                @php
                                $type ='warning'
                                @endphp
                            @elseif ($review->review_type == 'اسعافية'  || $review->review_type == 'عمل جراحي')
                                @php
                                $type ='danger'
                                @endphp
                            @else
                                @php
                                $type ='info'
                                @endphp
                            @endif
                            <div class="card border-bottom-{{$type}} py-2 px-1
                                @if ($review->leave_off == 0)
                                bg-gray-200
                                @endif ">

                                <div class="d-flex" >
                                    <div class="d-block"  style="width:12% ;direction: rtl">
                                        @if ($review->leave_off == 1)
                                            <a class="btn btn-light btn-circle btn-sm mb-1" type="button" onclick="document.getElementById('button{{$review->id}}').submit();" name="leave_off" >
                                                <i class="fa-solid fa-link fa-xl text-dark"></i>
                                            </a>
                                        @else
                                            <a class="btn btn-dark btn-circle btn-sm mb-1" class="ml-2" type="button" onclick="document.getElementById('button{{$review->id}}').submit();" name="leave_off" >
                                                <i class="fa-solid fa-link-slash text-light"></i>
                                            </a>
                                        @endif

                                        <form id="button{{$review->id}}" action="{{route('Clinic.tasksReview',$review->id)}}" method="post" class="d-none">
                                            @csrf
                                            <input type="hidden" name="leave_off" @if ($review->leave_off == 1)
                                            value="0"
                                            @else
                                            value="1"
                                            @endif >
                                        </form>
                                        <a class="btn btn-light btn-circle btn-sm" type="button" href="{{route('Clinic.destroyReviewEmployee',$review->id)}}"  data-toggle="tooltip" title=" حذف الزيارة ">
                                            <i class="fas fa-trash fa-lg text-danger"></i>
                                        </a>
                                    </div>

                                    <div class="d-block " style="width:80% ;direction: rtl">
                                        <p class="text-center text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0"  role="button" data-toggle="modal" data-target="#sidepatientNum{{$review->id}}"><b class="text-xs text-gray-900">اسم المريض: </b><b>{{$review->patient->patient_name}}</b></a></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0"  role="button" data-toggle="modal" data-target="#sidepatientNum{{$review->id}}"><b class="text-xs text-gray-900">سبب الزيارة: </b>{!! \Illuminate\Support\Str::limit($review->main_complaint, 40 , '...') !!}</a></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><b >وقت الزيارة</b><span> {{$review->created_at->format('h:i a')}}</span></p>
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
                                                @if ($review->patient->age && $review->patient->age != date('Y')) <br> العمر : {{ date('Y') -$review->patient->age}}  @endif
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
                            <!-- Modal Patient Number -->
                            <div class="modal fade" id="sidepatientNum{{$review->id}}" tabindex="-1" aria-labelledby="patientNum{{$review->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content border-right-{{$type}}" style="width: 95%;height: 95%;">
                                        <div class="modal-header py-1">
                                            <div class="text-center  w-100">
                                                <h1 class="h6 font-weight-bold text-gray-900 my-2 text-center" style="direction:rtl;">تعديل على زيارة {{$review->patient->patient_name}}</h1>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body p-0" style="direction:ltr">
                                                <!-- Nested Row within Card Body -->
                                                <div  style="overflow-y:auto ;height: 100%;">
                                                    <form  class="user px-2" method="POST" action="{{route('Clinic.updateReview_insert',$review->id)}}" enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="form-group mb-2" style="direction: rtl;margin-bottom: 0.5rem;">
                                                            <div class="form-row card px-0 mx-0 d-inine-block" style="flex-direction: unset;">
                                                                <div class="form-group mb-0 col-md-12 col-sm-12 " style="direction:rtl;text-align:right">
                                                                    <div class="custom-radio custom-control-inline mr-1">
                                                                        <label class="text-xs">حجز الموعد : </label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline mr-2">
                                                                        <input type="radio" id="editbyPhoneSide{{$review->id}}" name="leave_off" value="0" class="custom-control-input" @if ($review->leave_off == 0) checked  @endif>
                                                                        <label class="text-xs custom-control-label" for="editbyPhoneSide{{$review->id}}">هاتفي</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline mr-2">
                                                                        <input type="radio" id="editinClinicSide{{$review->id}}" name="leave_off" @if ($review->leave_off == 1) checked  @endif  value="1" class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editinClinicSide{{$review->id}}">في العيادة</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="form-group mb-2" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                <div class="custom-radio custom-control-inline">
                                                                    <label class="text-xs mr-3">سبب الزيارة : </label>
                                                                </div>
                                                                <div class="card d-block" >
                                                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                        <input type="radio" id="editviewSide{{$review->id}}" name="main_complaint[]" @if ($review->main_complaint == "معاينة جديدة") checked  @endif value="معاينة جديدة" class="custom-control-input">
                                                                        <label class="text-xs text-success font-weight-bold custom-control-label" for="editviewSide{{$review->id}}" >معاينة</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                        <input type="radio" id="editnewreviewSide{{$review->id}}" name="main_complaint[]" @if ($review->main_complaint == "مراجعة") checked  @endif  value="مراجعة" class="custom-control-input">
                                                                        <label class="text-xs text-warning font-weight-bold custom-control-label" for="editnewreviewSide{{$review->id}}" >مراجعة</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                        <input type="radio" id="editEmergencySide{{$review->id}}" name="main_complaint[]"  @if ($review->main_complaint == "اسعافية") checked  @endif value="اسعافية" class="custom-control-input">
                                                                        <label class="text-xs text-danger font-weight-bold custom-control-label" for="editEmergencySide{{$review->id}}" >اسعافية</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                        <input type="radio" id="editselectSergraySide{{$review->id}}" name="main_complaint[]"  @if ($review->main_complaint == "تحديد عملية") checked  @endif value="تحديد عملية" class="custom-control-input">
                                                                        <label class="text-xs text-info font-weight-bold custom-control-label" for="editselectSergraySide{{$review->id}}">تحديد عملية</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                        <input type="radio" id="editreviewSergraySide{{$review->id}}" name="main_complaint[]"  @if ($review->main_complaint == "مراجعة عملية") checked  @endif value="مراجعة عملية" class="custom-control-input">
                                                                        <label class="text-xs text-info font-weight-bold custom-control-label" for="editreviewSergraySide{{$review->id}}">مراجعة عملية</label>
                                                                    </div>
                                                                    <div class="custom-control custom-checkbox custom-control-inline" style="direction:ltr;text-align:right">
                                                                        <input type="checkbox" id="editforPhotoSide{{$review->id}}" name="main_complaint[]" @if ($review->main_complaint == "صورة") checked  @endif value="صورة" class="custom-control-input">
                                                                        <label class="text-xs text-info font-weight-bold custom-control-label" for="editforPhotoSide{{$review->id}}" >زيارة من أجل صورة</label>
                                                                    </div>
                                                                    <div class="custom-control custom-checkbox custom-control-inline" style="direction:ltr;text-align:right">
                                                                        <input type="checkbox" id="editforAnalysisSide{{$review->id}}" name="main_complaint[]"  @if ($review->main_complaint == "تحليل") checked  @endif value="تحليل" class="custom-control-input">
                                                                        <label class="text-xs text-info font-weight-bold custom-control-label" for="editforAnalysisSide{{$review->id}}" >زيارة من أجل تحليل</label>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                            <div class="form-group mb-2 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">اسم الزائر : </label>
                                                                <input class="VoiceToText form-control @error('patient_name') is-invalid @enderror" type="text" id="patient_name{{$review->id}}" value="{{$review->patient->patient_name}}" name="patient_name" required placeholder=" أكتب الاسم والكنية "
                                                                style="padding: 0.375rem 0.75rem;height:38px;font-size: 75%;text-align:center;" >
                                                                    @error('patient_name')
                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                            <strong >{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:38px;" for="patient_name{{$review->id}}">
                                                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                </button>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                    <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">رقم الهاتف : </label>
                                                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" value="{{$review->patient->phone}}" name="phone" placeholder=" أكتب رقم الهاتف"
                                                                    style="padding: 0.375rem 0.75rem;height:38px;text-align:center;direction: ltr;font-size: 75%;">
                                                                    @error('phone')
                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                            <strong >{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                    <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">العمر : </label>
                                                                    <input type="tel" max="99" min="1" class="form-control form-control @error('age') is-invalid @enderror" value="@if ($review->patient->age != null){{date('Y') -$review->patient->age}} @endif" name="age" placeholder="1~99"
                                                                        style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                                    @error('age')
                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                            <strong >{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                    <div class="custom-radio custom-control-inline">
                                                                        <label class="text-xs mr-3">الجنس : </label>
                                                                    </div>
                                                                    <div class="card d-block" style="height: 38px">
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="editgenderMaleSide{{$review->id}}" name="gender" @if ($review->patient->gender == 'male') checked  @endif  value="male" class="custom-control-input">
                                                                            <label class="text-xs custom-control-label" for="editgenderMaleSide{{$review->id}}">ذكر</label>
                                                                        </div>
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="editgenderFemaleSide{{$review->id}}" name="gender" @if ($review->patient->gender == 'female') checked  @endif  value="female" class="custom-control-input">
                                                                            <label class="text-xs custom-control-label" for="editgenderFemaleSide{{$review->id}}">أنثى</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                    <div class="custom-radio custom-control-inline">
                                                                        <label class="text-xs mr-3">التدخين : </label>
                                                                    </div>
                                                                    <div class="card d-block" style="height: 38px">
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="editnegativeSide{{$review->id}}" name="smoking" value="negative" @if ($review->patient->smoking == 'negative') checked  @endif class="custom-control-input">
                                                                            <label class="text-xs custom-control-label" for="editnegativeSide{{$review->id}}">سلبي</label>
                                                                        </div>
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="editpositiveSide{{$review->id}}" name="smoking"  value="positive" @if ($review->patient->smoking == 'positive') checked  @endif class="custom-control-input">
                                                                            <label class="text-xs custom-control-label" for="editpositiveSide{{$review->id}}">إيجابي</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- collapseCardMoreDetailsPatients -->
                                                            <div class="card mb-2">
                                                                <!-- Card Header - Accordion -->
                                                                <a href="#collapseCardMoreDetailsPatientssidepatientNum{{$review->id}}" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                                    role="button" aria-expanded="true" aria-controls="collapseCardMoreDetailsPatientssidepatientNum{{$review->id}}">
                                                                    <h6 class="m-0 text-xs font-weight-bold text-primary text-center">المزيد ...</h6>
                                                                </a>
                                                                <!-- Card Content - Collapse -->
                                                                <div class="collapse" id="collapseCardMoreDetailsPatientssidepatientNum{{$review->id}}">
                                                                    <div class="card-body px-1 py-3">
                                                                        <div class="form-row">
                                                                            <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                                <label class="text-xs mb-0 mr-3" style="padding-bottom: 0.2rem;text-align:right;direction:rtl;">الحالة الإجتماعية : </label>
                                                                                <div class="card d-block" style="height: 38px">
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <input type="radio" id="editRelationshipMarriedSide{{$review->id}}" name="relationship" value="married" @if ( $review->patient->relationship == 'married') checked  @endif  class="custom-control-input">
                                                                                        <label class="text-xs custom-control-label" for="editRelationshipMarriedSide{{$review->id}}">متزوج</label>
                                                                                    </div>
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <input type="radio" id="editRelationshipSingleSide{{$review->id}}" name="relationship"  value="single" @if ( $review->patient->relationship == 'single') checked  @endif class="custom-control-input">
                                                                                        <label class="text-xs custom-control-label" for="editRelationshipSingleSide{{$review->id}}">أعزب</label>
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
                                                                                <input type="text"class="VoiceToText form-control form-control @error('patient_job') is-invalid @enderror" value="{{$review->patient->patient_job}}" id="patient_job{{$review->id}}" name="patient_job"
                                                                                 style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                                                    @error('patient_job')
                                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                                            <strong >{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_job{{$review->id}}">
                                                                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                                </button>
                                                                            </div>
                                                                                <div class="form-group mb-2 col-md-6 col-sm-12 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                                <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">العنوان : </label>
                                                                                <input type="text" class="VoiceToText form-control @error('patient_address') is-invalid @enderror" id="patient_address{{$review->id}}" value="{{$review->patient->patient_address}}" name="patient_address"
                                                                                style="padding: 0.375rem 0.75rem;height:38px;text-align:center;direction: ltr;font-size: 75%;">
                                                                                @error('patient_address')
                                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                                        <strong >{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_address{{$review->id}}">
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
                                                            </div><!-- collapseCardMoreDetails -->
                                                        </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer py-1">
                                            <button type="submit" class="btn btn-primary btn-user">تعديل</button>
                                            <a class="btn btn-secondary btn-user"  data-dismiss="modal">عودة</a>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Modal Patient Number -->
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
        <div class="col-md-8 card o-hidden border-left-primary border-right-primary  border-bottom-primary border-top-primary border-0 px-0 py-2" style="min-height: calc(100vh - 200px)">
            <div class="card-body p-0" style="min-height: calc(100vh - 200px);direction:ltr">
                <!-- Nested Row within Card Body -->
                <div  style="overflow-y:auto ;min-height: calc(100vh - 200px)">
                    <div class="d-flex mx-2" style="direction: rtl">

                        <a href="{{route('Clinic.newPatientFully')}}" class="btn btn-outline-primary text-xs font-weight-bold mt-1" style="width: 100px">إدخال كامل</a>
                        <div class="text-center" style="width: 100%">
                            <h1 class="h5 text-gray-900 my-2" ><b>إدخال سريع</b></h1>
                        </div>
                    </div>



                    <form  class="user px-2" method="POST" action="{{route('Clinic.storePatient')}}" enctype="multipart/form-data">
                        @csrf
                        <hr class="my-1 p-0">
                        <div class="form-group mb-2" style="direction: rtl;margin-bottom: 0.5rem;">
                            <div class="form-row card px-0 mx-0 d-inine-block" style="flex-direction: unset;">
                                <div class="form-group mb-0 col-md-6 col-sm-12 " style="direction:rtl;text-align:right">
                                    <div class="custom-radio custom-control-inline">
                                        <label class="text-xs">حجز الموعد : </label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="byPhone" name="leave_off" value="0" class="custom-control-input">
                                        <label class="text-xs custom-control-label" for="byPhone">هاتفي</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="inClinic" name="leave_off" checked value="1" class="custom-control-input">
                                        <label class="text-xs custom-control-label" for="inClinic">في العيادة</label>
                                    </div>
                                </div>
                                <div class="form-row mx-0 mb-0 col-md-6 col-sm-12 px-0">
                                    <div class="form-group mb-0 col-4 px-0 " style="direction:rtl;text-align:right">
                                        {{-- <div class="custom-radio custom-control-inline"> --}}
                                            <a type="button" class="text-xs btn" style="text-decoration-line:underline"
                                                role="button"  data-toggle="modal" data-target="#nextReview">
                                                -المواعيد :
                                                @if (count($nextReviews) >0)
                                                    <span><b>( {{count($nextReviews)}} )</b></span>
                                                @endif
                                            </a>
                                        {{-- </div> --}}
                                    </div>
                                    <div class="form-group mb-0 col-8 px-0 " style="direction:rtl;text-align:right">
                                        <input type="date" min="{{Carbon\Carbon::tomorrow()->format('Y-m-d')}}" class="form-control form-control @error('review_forDay') is-invalid @enderror" name="review_forDay" placeholder="حجز موعد"
                                            style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                        @error('review_forDay')
                                            <span class="invalid-feedback text-center" role="alert">
                                                <strong >{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                <div class="custom-radio custom-control-inline">
                                    <label class="text-xs">سبب الزيارة : </label>
                                </div>
                                <div class="card d-block">
                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                        <input type="radio" id="view" name="main_complaint[]" value="معاينة جديدة"  class="custom-control-input">
                                        <label class="text-xs text-success font-weight-bold custom-control-label" for="view" >معاينة</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                        <input type="radio" id="newreview" name="main_complaint[]"  value="مراجعة" checked class="custom-control-input">
                                        <label class="text-xs text-warning font-weight-bold custom-control-label" for="newreview" >مراجعة</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                        <input type="radio" id="Emergency" name="main_complaint[]"  value="اسعافية" class="custom-control-input">
                                        <label class="text-xs text-danger font-weight-bold custom-control-label" for="Emergency" >اسعافية</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                        <input type="radio" id="selectSergray" name="main_complaint[]"  value="تحديد عملية" class="custom-control-input">
                                        <label class="text-xs text-info font-weight-bold custom-control-label" for="selectSergray">تحديد عملية</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                        <input type="radio" id="reviewSergray" name="main_complaint[]"  value="مراجعة عملية" class="custom-control-input">
                                        <label class="text-xs text-info font-weight-bold custom-control-label" for="reviewSergray">مراجعة عملية</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                        <input type="radio" id="nulls" name="main_complaint[]" value="" class="custom-control-input">
                                        <label class="text-xs text-dark font-weight-bold custom-control-label" for="nulls">زيارة</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline" style="direction:ltr;text-align:right">
                                        <input type="checkbox" id="forPhoto" name="main_complaint[]" value="صورة" class="custom-control-input">
                                        <label class="text-xs text-info font-weight-bold custom-control-label" for="forPhoto" >صورة</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline" style="direction:ltr;text-align:right">
                                        <input type="checkbox" id="forAnalysis" name="main_complaint[]"  value="تحليل" class="custom-control-input">
                                        <label class="text-xs text-info font-weight-bold custom-control-label" for="forAnalysis" >تحليل</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">اسم الزائر : </label>
                                <input class="VoiceToText form-control @error('patient_name') is-invalid @enderror" type="text" id="patient_name"  name="patient_name" required placeholder=" أكتب الاسم والكنية "
                                style="padding: 0.375rem 0.75rem;height:38px;font-size: 75%;text-align:center;">
                                    @error('patient_name')
                                        <span class="invalid-feedback text-center" role="alert">
                                            <strong >{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:38px;" for="patient_name">
                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                </button>
                            </div>
                            <div class="form-row">
                                <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                    <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">رقم الهاتف : </label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder=" أكتب رقم الهاتف"
                                    style="padding: 0.375rem 0.75rem;height:38px;text-align:center;direction: ltr;font-size: 75%;">
                                    @error('phone')
                                        <span class="invalid-feedback text-center" role="alert">
                                            <strong >{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                    <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">العمر : </label>
                                    <input type="tel" max="99" min="1" class="form-control form-control @error('age') is-invalid @enderror" name="age" placeholder=""
                                     style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                    @error('age')
                                        <span class="invalid-feedback text-center" role="alert">
                                            <strong >{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                    <div class="custom-radio custom-control-inline">
                                        <label class="text-xs">الجنس : </label>
                                    </div>
                                    <div class="card d-block" style="height: 38px">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="genderMale" name="gender" value="male" class="custom-control-input">
                                            <label class="text-xs custom-control-label" for="genderMale">ذكر</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="genderFemale" name="gender" value="female" class="custom-control-input">
                                            <label class="text-xs custom-control-label" for="genderFemale">أنثى</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                    <div class="custom-radio custom-control-inline">
                                        <label class="text-xs">التدخين : </label>
                                    </div>
                                    <div class="card d-block" style="height: 38px">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="negative" name="smoking" value="negative"  class="custom-control-input">
                                            <label class="text-xs custom-control-label" for="negative">سلبي</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="positive" name="smoking"  value="positive" class="custom-control-input">
                                            <label class="text-xs custom-control-label" for="positive">إيجابي</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- collapseCardMoreDetails -->
                            <div class="card mb-2">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardMoreDetails" class="d-block card-header py-3" data-toggle="collapse" style=""
                                    role="button" aria-expanded="true" aria-controls="collapseCardMoreDetails">
                                    <h6 class="m-0 text-xs font-weight-bold text-primary text-center">المزيد ...</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse " id="collapseCardMoreDetails">
                                    <div class="card-body px-1 py-3">
                                        <div class="form-row">
                                            <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                <label class="text-xs mb-0 mr-3" style="padding-bottom: 0.2rem;text-align:right;direction:rtl;">الحالة الإجتماعية : </label>
                                                <div class="card d-block" style="height: 38px">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="relationshipMarried" name="relationship" value="married" class="custom-control-input">
                                                        <label class="text-xs custom-control-label" for="relationshipMarried">متزوج</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="relationshipSingle" name="relationship"  value="single" class="custom-control-input">
                                                        <label class="text-xs custom-control-label" for="relationshipSingle">أعزب</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">عدد الأولاد : </label>
                                                <input type="tel" max="20" min="0" class="form-control form-control @error('child_count') is-invalid @enderror" name="child_count"
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
                                                <input type="text"class="VoiceToText form-control form-control @error('patient_job') is-invalid @enderror" id="patient_job" name="patient_job"
                                                 style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                    @error('patient_job')
                                                        <span class="invalid-feedback text-center" role="alert">
                                                            <strong >{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_job">
                                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                </button>
                                            </div>
                                                <div class="form-group mb-2 col-md-6 col-sm-12 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">العنوان : </label>
                                                <input type="text" class="VoiceToText form-control @error('patient_address') is-invalid @enderror" id="patient_address"  name="patient_address"
                                                style="padding: 0.375rem 0.75rem;height:38px;text-align:center;direction: ltr;font-size: 75%;">
                                                @error('patient_address')
                                                    <span class="invalid-feedback text-center" role="alert">
                                                        <strong >{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_address">
                                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                            <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">السوابق الجراحية : </label>
                                            <textarea  class="form-control" name="older_surgery" rows="2" style="height:38px;font-size: 75%;padding: 0.375rem 0.75rem;text-align:center" placeholder=" أكتب السوابق الجراحية في حال وجودها"></textarea>
                                        </div>
                                        <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                            <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">السوابق المرضية : </label>
                                            <textarea  class="form-control" name="older_sicky" rows="2" style="padding: 0.375rem 0.75rem;text-align:center;height:38px;font-size: 75%" placeholder=" أكتب السوابق المرضية في حال وجودها"></textarea>
                                        </div>
                                        <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                            <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">السوابق التحسسية : </label>
                                            <textarea  class="form-control" name="older_sensitive" rows="2" style="padding: 0.375rem 0.75rem;text-align:center;height:38px;font-size: 75%" placeholder=" أكتب السوابق التحسسية في حال وجودها"></textarea>
                                        </div>
                                        <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                            <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">الأدوية الدائمة : </label>
                                            <textarea  class="form-control" name="permanent_medic" rows="1" style="height:38px;font-size: 75%;padding: 0.375rem 0.75rem;text-align:center" placeholder=" أكتب الأدوية الدائمة في حال وجودها"></textarea>
                                        </div>
                                        <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                            <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">ملاحظات حول المريض : </label>
                                            <input type="text" class="form-control " name="patient_state" placeholder=" أكتب ملاحظات في حال وجودها" style="padding: 0.375rem 0.75rem;height:38px;font-size: 75%;text-align:center">
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
                            </div><!-- collapseCardMoreDetails -->
                        </div>
                        <div class="form-group mb-2" style="direction:ltr">
                            <button type="submit" class="btn btn-primary btn-block">
                                إضافة
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ourPatients" tabindex="-1" aria-labelledby="ourPatients" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="width: 95%;height: 95%;">
                <div class="modal-header py-1">
                    <div class="h6 d-flex text-xs text-primary font-weight-bold text-center py-1 px-1" style="text-align: right ;direction:rtl">
                        @if (count($patientReviews)>0)
                            - العدد الموجود :  ( {{count($patientReviews)}} )

                        @else
                            لا يوجد بعد
                        @endif
                    </div>
                </div>
                <div class="modal-body p-1" style="direction:ltr;" >
                    <div class="py-2">
                        @php
                            $pantientNum=count($patientReviews);
                        @endphp
                        @forelse ($patientReviews as $review)
                            @if ($review->review_type == 'معاينة')
                                @php
                                $type ='success'
                                @endphp
                            @elseif ($review->review_type == 'مراجعة')
                                @php
                                $type ='warning'
                                @endphp
                            @elseif ($review->review_type == 'اسعافية'  || $review->review_type == 'عمل جراحي')
                                @php
                                $type ='danger'
                                @endphp
                            @else
                                @php
                                $type ='info'
                                @endphp
                            @endif
                            <div class="card border-bottom-{{$type}} py-2 px-1
                            @if ($review->leave_off == 0)
                            bg-gray-200
                            @endif ">
                                <div class="d-flex" >
                                    <div class="d-block"  style="width:12% ;direction: rtl">
                                        @if ($review->leave_off == 1)
                                            <a class="btn btn-light btn-circle btn-sm mb-1" type="button" onclick="document.getElementById('button{{$review->id}}').submit();" name="leave_off" >
                                                <i class="fa-solid fa-link fa-xl text-dark"></i>
                                            </a>
                                        @else
                                            <a class="btn btn-dark btn-circle btn-sm mb-1" class="ml-2" type="button" onclick="document.getElementById('button{{$review->id}}').submit();" name="leave_off" >
                                                <i class="fa-solid fa-link-slash text-light"></i>
                                            </a>
                                        @endif

                                        <form id="button{{$review->id}}" action="{{route('Clinic.tasksReview',$review->id)}}" method="post" class="d-none">
                                            @csrf
                                            <input type="hidden" name="leave_off" @if ($review->leave_off == 1)
                                            value="0"
                                            @else
                                            value="1"
                                            @endif >
                                        </form>
                                        <a class="btn btn-light btn-circle btn-sm" type="button" href="{{route('Clinic.destroyReviewEmployee',$review->id)}}"  data-toggle="tooltip" title=" حذف الزيارة ">
                                            <i class="fas fa-trash fa-lg text-danger"></i>
                                        </a>
                                    </div>

                                    <div class="d-block " style="width:80% ;direction: rtl">
                                        <p class="text-center text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0" role="button" data-toggle="modal" data-target="#patientNum{{$review->id}}"><b class="text-xs text-gray-900">اسم المريض: </b><b>{{$review->patient->patient_name}}</b></a></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0" role="button" data-toggle="modal" data-target="#patientNum{{$review->id}}"><b class="text-xs text-gray-900">سبب الزيارة: </b>{!! \Illuminate\Support\Str::limit($review->main_complaint, 40 , '...') !!}</a></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><b >وقت الزيارة</b><span> {{$review->created_at->format('h:i a')}}</span></p>
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
                                                @if ($review->patient->age  && $review->patient->age != date('Y')) <br> العمر : {{date('Y') - $review->patient->age}}  @endif
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
                            <!-- Modal Patient Number -->
                            <div class="modal fade" id="patientNum{{$review->id}}" tabindex="-1" aria-labelledby="patientNum{{$review->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content border-right-{{$type}}" style="width: 95%;height: 95%;">
                                        <div class="modal-header py-1">
                                            <div class="text-center  w-100">
                                                <h1 class="h6 font-weight-bold text-gray-900 my-2 text-center" style="direction:rtl;">تعديل على زيارة {{$review->patient->patient_name}}</h1>
                                            </div>
                                        </div>
                                        <div class="modal-body p-1">
                                            <div class="card-body p-0" style="height: 530px;direction:ltr">
                                                <!-- Nested Row within Card Body -->
                                                <div  style="overflow-y:auto ;height: 100%;">

                                                    <form  class="user px-2" method="POST" action="{{route('Clinic.updateReview_insert',$review->id)}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group mb-2" style="direction: rtl;margin-bottom: 0.5rem;">

                                                            <div class="form-row card px-0 mx-0 d-inine-block" style="flex-direction: unset;">
                                                                <div class="form-group mb-0 col-md-12 col-sm-12 " style="direction:rtl;text-align:right">
                                                                    <div class="custom-radio custom-control-inline mr-1">
                                                                        <label class="text-xs">حجز الموعد : </label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline mr-2">
                                                                        <input type="radio" id="editbyPhone{{$review->id}}" name="leave_off" value="0" class="custom-control-input" @if ($review->leave_off == 0) checked  @endif>
                                                                        <label class="text-xs custom-control-label" for="editbyPhone{{$review->id}}">هاتفي</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline mr-2">
                                                                        <input type="radio" id="editinClinic{{$review->id}}" name="leave_off" @if ($review->leave_off == 1) checked  @endif  value="1" class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editinClinic{{$review->id}}">في العيادة</label>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            {{-- <div class="form-group mb-2" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                <div class="custom-radio custom-control-inline">
                                                                    <label class="text-xs mr-3">سبب الزيارة : </label>
                                                                </div>
                                                                <div class="card d-block">
                                                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                        <input type="radio" id="editview{{$review->id}}" name="main_complaint[]" @if ($review->main_complaint == "معاينة جديدة") checked  @endif value="معاينة جديدة" class="custom-control-input">
                                                                        <label class="text-xs text-success font-weight-bold custom-control-label" for="editview{{$review->id}}" >معاينة</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                        <input type="radio" id="editnewreview{{$review->id}}" name="main_complaint[]" @if ($review->main_complaint == "مراجعة") checked  @endif  value="مراجعة" class="custom-control-input">
                                                                        <label class="text-xs text-warning font-weight-bold custom-control-label" for="editnewreview{{$review->id}}" >مراجعة</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                        <input type="radio" id="editEmergency{{$review->id}}" name="main_complaint[]"  @if ($review->main_complaint == "اسعافية") checked  @endif value="اسعافية" class="custom-control-input">
                                                                        <label class="text-xs text-danger font-weight-bold custom-control-label" for="editEmergency{{$review->id}}" >اسعافية</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                        <input type="radio" id="editselectSergray{{$review->id}}" name="main_complaint[]"  @if ($review->main_complaint == "تحديد عملية") checked  @endif value="تحديد عملية" class="custom-control-input">
                                                                        <label class="text-xs text-info font-weight-bold custom-control-label" for="editselectSergray{{$review->id}}">تحديد عملية</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                        <input type="radio" id="editreviewSergray{{$review->id}}" name="main_complaint[]"  @if ($review->main_complaint == "مراجعة عملية") checked  @endif value="مراجعة عملية" class="custom-control-input">
                                                                        <label class="text-xs text-info font-weight-bold custom-control-label" for="editreviewSergray{{$review->id}}">مراجعة عملية</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                        <input type="radio" id="editforPhoto{{$review->id}}" name="main_complaint[]" @if ($review->main_complaint == "صورة") checked  @endif value="صورة" class="custom-control-input">
                                                                        <label class="text-xs text-info font-weight-bold custom-control-label" for="editforPhoto{{$review->id}}" >زيارة من أجل صورة</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                        <input type="radio" id="editforAnalysis{{$review->id}}" name="main_complaint[]"  @if ($review->main_complaint == "تحليل") checked  @endif value="تحليل" class="custom-control-input">
                                                                        <label class="text-xs text-info font-weight-bold custom-control-label" for="editforAnalysis{{$review->id}}" >زيارة من أجل تحليل</label>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                            <div class="form-group mb-2 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">اسم الزائر : </label>
                                                                <input class="VoiceToText form-control @error('patient_name') is-invalid @enderror" type="text" id="patient_name{{$review->id}}" value="{{$review->patient->patient_name}}" name="patient_name" required placeholder=" أكتب الاسم والكنية "
                                                                style="padding: 0.375rem 0.75rem;height:38px;font-size: 75%;text-align:center;">
                                                                    @error('patient_name')
                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                            <strong >{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:38px;" for="patient_name{{$review->id}}">
                                                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                </button>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                    <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">رقم الهاتف : </label>
                                                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" value="{{$review->patient->phone}}" name="phone" placeholder=" أكتب رقم الهاتف"
                                                                    style="padding: 0.375rem 0.75rem;height:38px;text-align:center;direction: ltr;font-size: 75%;">
                                                                    @error('phone')
                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                            <strong >{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                    <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">العمر : </label>
                                                                    <input type="tel" max="99" min="1" class="form-control form-control @error('age') is-invalid @enderror" value="@if ($review->patient->age !=null){{date('Y') -$review->patient->age}} @endif" name="age" placeholder="1~99"
                                                                     style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                                    @error('age')
                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                            <strong >{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                    <div class="custom-radio custom-control-inline">
                                                                        <label class="text-xs mr-3">الجنس : </label>
                                                                    </div>
                                                                    <div class="card d-block" style="height: 38px">
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="editgenderMale{{$review->id}}" name="gender" @if ($review->patient->gender == 'male') checked  @endif  value="male" class="custom-control-input">
                                                                            <label class="text-xs custom-control-label" for="editgenderMale{{$review->id}}">ذكر</label>
                                                                        </div>
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="editgenderFemale{{$review->id}}" name="gender" @if ($review->patient->gender == 'female') checked  @endif  value="female" class="custom-control-input">
                                                                            <label class="text-xs custom-control-label" for="editgenderFemale{{$review->id}}">أنثى</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                    <div class="custom-radio custom-control-inline">
                                                                        <label class="text-xs mr-3">التدخين : </label>
                                                                    </div>
                                                                    <div class="card d-block" style="height: 38px">
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="editnegative{{$review->id}}" name="smoking" value="negative" @if ($review->patient->smoking == 'negative') checked  @endif class="custom-control-input">
                                                                            <label class="text-xs custom-control-label" for="editnegative{{$review->id}}">سلبي</label>
                                                                        </div>
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="editpositive{{$review->id}}" name="smoking"  value="positive" @if ( $review->patient->smoking == 'positive') checked  @endif class="custom-control-input">
                                                                            <label class="text-xs custom-control-label" for="editpositive{{$review->id}}">إيجابي</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- collapseCardMoreDetailsPatients -->
                                                            <div class="card mb-2">
                                                                <!-- Card Header - Accordion -->
                                                                <a href="#collapseCardMoreDetailsPatientspatientNum{{$review->id}}" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                                    role="button" aria-expanded="true" aria-controls="collapseCardMoreDetailsPatientspatientNum{{$review->id}}">
                                                                    <h6 class="m-0 text-xs font-weight-bold text-primary text-center">المزيد ...</h6>
                                                                </a>
                                                                <!-- Card Content - Collapse -->
                                                                <div class="collapse" id="collapseCardMoreDetailsPatientspatientNum{{$review->id}}">
                                                                    <div class="card-body px-1 py-3">
                                                                        <div class="form-row">
                                                                            <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                                <label class="text-xs mb-0 mr-3" style="padding-bottom: 0.2rem;text-align:right;direction:rtl;">الحالة الإجتماعية : </label>
                                                                                <div class="card d-block" style="height: 38px">
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <input type="radio" id="editRelationshipMarried{{$review->id}}" name="relationship" value="married" @if ( $review->patient->relationship == 'married') checked  @endif  class="custom-control-input">
                                                                                        <label class="text-xs custom-control-label" for="editRelationshipMarried{{$review->id}}">متزوج</label>
                                                                                    </div>
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <input type="radio" id="editRelationshipSingle{{$review->id}}" name="relationship"  value="single" @if ( $review->patient->relationship == 'single') checked  @endif class="custom-control-input">
                                                                                        <label class="text-xs custom-control-label" for="editRelationshipSingle{{$review->id}}">أعزب</label>
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
                                                                                <input type="text"class="VoiceToText form-control form-control @error('patient_job') is-invalid @enderror" value="{{$review->patient->patient_job}}" id="patient_job{{$review->id}}" name="patient_job"
                                                                                 style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                                                    @error('patient_job')
                                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                                            <strong >{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_job{{$review->id}}">
                                                                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                                </button>
                                                                            </div>
                                                                                <div class="form-group mb-2 col-md-6 col-sm-12 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                                <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">العنوان : </label>
                                                                                <input type="text" class="VoiceToText form-control @error('patient_address') is-invalid @enderror" id="patient_address{{$review->id}}" value="{{$review->patient->patient_address}}" name="patient_address"
                                                                                style="padding: 0.375rem 0.75rem;height:38px;text-align:center;direction: ltr;font-size: 75%;">
                                                                                @error('patient_address')
                                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                                        <strong >{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_address{{$review->id}}">
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
                                                            </div><!-- collapseCardMoreDetails -->
                                                        </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer py-1">
                                            <button type="submit" class="btn btn-primary btn-user">تعديل</button>
                                            <a class="btn btn-secondary btn-user" role="button" data-toggle="modal"  data-dismiss="modal" data-target="#ourPatients">عودة</a>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Modal Patient Number -->
                        @empty
                        <p class=" text-center text-gray-500">لا يوجد بعد</p>

                        @endforelse
                    </div>
                </div>
                <div class="modal-footer py-1" style="direction:ltr">
                    <button type="button" style="float: right" class="btn btn-primary btn-user" data-dismiss="modal">عودة</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Next -->
    <div class="modal fade" id="nextReview" tabindex="-1" aria-labelledby="nextReview" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="width: 95%;height: 95%;">
                <div class="modal-header py-1">
                    <div class="h6 d-flex text-primary font-weight-bold text-center py-1 px-1" style="text-align: right ;direction:rtl">
                        @if (count($nextReviews)>0)
                            - الزيارات القادمة :  ( {{count($nextReviews)}} )

                        @else
                            لا يوجد بعد
                        @endif
                    </div>
                </div>
                <div class="modal-body p-1" style="direction:ltr;" >
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
                            @elseif ($review->review_type == 'اسعافية'  || $review->review_type == 'عمل جراحي')
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


                                </div>
                            </div>

                            <hr class="my-1">
                            @php
                            --$pantientNum;
                            @endphp
                            <!-- Modal Next -->
                            <div class="modal fade" id="nextReview{{$review->id}}" tabindex="-1" aria-labelledby="nextReview{{$review->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content" style="width: 95%;height: 95%;">
                                        <div class="modal-header py-1">
                                            <div class="text-center w-100">
                                                <h1 class="h6 font-weight-bold text-gray-900 my-2 text-center" style="direction:rtl;">تعديل على موعد {{$review->patient->patient_name}}</h1>
                                            </div>
                                        </div>
                                        <div class="modal-body py-0">
                                            <div class="card-body p-0" style="direction:ltr">
                                                <!-- Nested Row within Card Body -->

                                                <form  class="user" method="POST" action="{{route('Clinic.updateReview_insert',$review->id)}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group mb-3" style="direction: rtl;margin-bottom: 0.5rem;">
                                                        <div class="form-group mb-2" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
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
                                                        {{--<div class="form-group mb-3" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                            <div class="custom-radio custom-control-inline">
                                                                <label class="text-xs mr-3">سبب الزيارة : </label>
                                                            </div>
                                                            <div class="card d-block">
                                                                <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                    <input type="radio" id="editviewNext{{$review->id}}" name="main_complaint[]" @if ($review->review_type == "معاينة") checked  @endif value="معاينة جديدة" class="custom-control-input">
                                                                    <label class="text-xs text-success font-weight-bold custom-control-label" for="editviewNext{{$review->id}}" >معاينة</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                    <input type="radio" id="editnewreviewNext{{$review->id}}" name="main_complaint[]" @if ($review->review_type == "مراجعة") checked  @endif  value="مراجعة" class="custom-control-input">
                                                                    <label class="text-xs text-warning font-weight-bold custom-control-label" for="editnewreviewNext{{$review->id}}" >مراجعة</label>
                                                                </div>
                                                                 <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                    <input type="radio" id="editEmergencyNext{{$review->id}}" name="main_complaint"  @if ($review->main_complaint == "اسعافية") checked  @endif value="اسعافية" class="custom-control-input">
                                                                    <label class="text-xs text-danger font-weight-bold custom-control-label" for="editEmergencyNext{{$review->id}}" >اسعافية</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                    <input type="radio" id="editselectSergrayNext{{$review->id}}" name="main_complaint"  @if ($review->main_complaint == "تحديد عملية") checked  @endif value="تحديد عملية" class="custom-control-input">
                                                                    <label class="text-xs text-info font-weight-bold custom-control-label" for="editselectSergrayNext{{$review->id}}">تحديد عملية</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                    <input type="radio" id="editreviewSergrayNext{{$review->id}}" name="main_complaint"  @if ($review->main_complaint == "مراجعة عملية") checked  @endif value="مراجعة عملية" class="custom-control-input">
                                                                    <label class="text-xs text-info font-weight-bold custom-control-label" for="editreviewSergrayNext{{$review->id}}">مراجعة عملية</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                    <input type="radio" id="editforPhotoNext{{$review->id}}" name="main_complaint" @if ($review->main_complaint == "صورة") checked  @endif value="صورة" class="custom-control-input">
                                                                    <label class="text-xs text-info font-weight-bold custom-control-label" for="editforPhotoNext{{$review->id}}" >زيارة من أجل صورة</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                    <input type="radio" id="editforAnalysisNext{{$review->id}}" name="main_complaint"  @if ($review->main_complaint == "تحليل") checked  @endif value="تحليل" class="custom-control-input">
                                                                    <label class="text-xs text-info font-weight-bold custom-control-label" for="editforAnalysisNext{{$review->id}}" >زيارة من أجل تحليل</label>
                                                                </div> 
                                                            </div>
                                                        </div>--}}
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
                                                                <input type="tel" max="99" min="1" class="form-control form-control @error('age') is-invalid @enderror" value="@if ($review->patient->age != null){{date('Y') -$review->patient->age}} @endif" name="age" placeholder="1~99"
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
                                                        </div><!-- collapseCardMoreDetails -->
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer py-1">
                                            <button type="submit" class="btn btn-primary btn-user">تعديل</button>
                                            <a class="btn btn-secondary btn-user" role="button" data-toggle="modal"  data-dismiss="modal" data-target="#nextReview">عودة</a>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Modal Next -->
                        @empty
                        <p class=" text-center text-gray-500">لا يوجد بعد</p>
                        @endforelse
                    </div>
                </div>
                <div class="modal-footer py-1" style="direction:ltr">
                    <button type="button" style="float: right" class="btn btn-primary btn-user" data-dismiss="modal">عودة</button>
                </div>
            </div>
        </div>
    </div><!-- Modal Next -->
</div>
@endsection


@section('script')
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
@endsection
