@extends('layouts.myClinic')

@section('content')
<div class="container-fluid pb-5 mt-1 mb-5">
    <div>&nbsp;</div>
        @if (count($errors)>0)
            @foreach ($errors->all() as $item)
                <div class="alert alert-secondary" role="alert">
                    {{$item}}
                </div>
            @endforeach
        @endif




        <div class="card o-hidden border-left-primary border-right-primary  border-bottom-primary border-top-primary border-0 py-2" style="direction:ltr;min-height: calc(100vh - 100px)" >
            <div class="card-body p-0" >
                <form  class="user p-1" method="POST" action="{{route('Clinic.storePatientfully')}}" enctype="multipart/form-data">
                    @csrf
                    <!-- Nested Row within Card Body -->
                    <div class="d-flex mx-2" style="direction: rtl">

                        <a href="{{route('Clinic.newPatient')}}" class="btn btn-outline-primary text-xs font-weight-bold mt-1" style="width: 100px">إدخال سريع</a>
                        <div class="text-center" style="width: 100%">
                            <h1 class="h5 text-gray-900 my-2" ><b>إدخال كامل المعطيات</b></h1>
                        </div>
                    </div>
                    {{-- <hr> --}}
                    <div class="table-responsive mt-1" style="direction:rtl">
                        <table class="table table-bordered text-center" width="100%" cellspacing="0" >
                            <thead>
                                <tr>
                                    {{-- <th >
                                        #
                                    </th> --}}
                                    <th style="min-width: 490px;">
                                        اسم الزائر ومعلوماته
                                    </th>
                                    <th style="min-width: 400px;">
                                        معلومات الزيارة
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td style="padding: 0%">
                                            <!-- collapseCardMoreDetails -->
                                            <div class="card">
                                                <!-- Card Header - Accordion -->
                                                <div class="d-flex ">
                                                    <label for="patientName" class="text-xs card m-0" style="width: 20%;height: 40px;"><b class="mt-2">اسم الزائر :</b></label>
                                                    <input class="form-control @error('patient_name') is-invalid @enderror" id="patientName" type="text" autofocus required  name="patient_name" style="width: 80%; padding: 0;height: auto;text-align:center">
                                                    @error('patient_name')
                                                        <span class="invalid-feedback text-center" role="alert">
                                                            <strong >{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <a href="#patientInfo" class="form-control card-header" data-toggle="collapse" style="height: 40px;width: auto;"
                                                        role="button" aria-expanded="true" aria-controls="patientInfo">
                                                    </a>
                                                </div>
                                                <hr class="m-0 p-0">
                                                <!-- Card Content - Collapse -->
                                                <div class="collapse show" id="patientInfo">
                                                    <div  style="height:260px;">
                                                        <div class="card-body px-2 py-0" style="overflow-y: auto;height: 100%;direction: ltr">
                                                            <div style="direction: rtl">
                                                                <div class="form-row">
                                                                    <div class="form-group mb-2 col-4" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mb-0 mr-3" style="padding-bottom: 0.2rem;text-align:right;direction:rtl;">الجنس : </label>
                                                                        <div class="card d-block" style="height: 38px; margin-top: 2px;">
                                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                                <input type="radio" id="editgenderMale" name="gender"  value="male" class="custom-control-input">
                                                                                <label class="text-xs custom-control-label" for="editgenderMale">ذكر</label>
                                                                            </div>
                                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                                <input type="radio" id="editgenderFemale" name="gender" value="female" class="custom-control-input">
                                                                                <label class="text-xs custom-control-label" for="editgenderFemale">أنثى</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group mb-2 col-2" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">العمر:</label>
                                                                        <input type="tel" max="99" min="1" class="form-control form-control @error('age') is-invalid @enderror" name="age"
                                                                            style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                                        @error('age')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group mb-2 col-2" style="direction: ltr;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-2" style="text-align:right;float: right;  direction:rtl;">زمرةالدم:</label>
                                                                    <select class="form-control " name="blood_type" style="padding: 0.375rem 0.75rem;height:38px;text-align:center">
                                                                            <option value="" selected> </option>
                                                                            <option value="AB+" > AB+ </option>
                                                                            <option value="A+" > A+ </option>
                                                                            <option value="B+" > B+ </option>
                                                                            <option value="O+" > O+ </option>
                                                                            <option value="O-" > O- </option>
                                                                            <option value="B-" > B- </option>
                                                                            <option value="A-" > A- </option>
                                                                            <option value="AB-" > AB- </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mb-2 col-4" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mb-0 mr-3" style="padding-bottom: 0.2rem;text-align:right;direction:rtl;">التدخين : </label>
                                                                        <div class="card d-block" style="height: 38px; margin-top: 2px;">
                                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                                <input type="radio" id="editnegative" name="smoking" value="negative" class="custom-control-input">
                                                                                <label class="text-xs custom-control-label" for="editnegative">سلبي</label>
                                                                            </div>
                                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                                <input type="radio" id="editpositive" name="smoking"  value="positive" class="custom-control-input">
                                                                                <label class="text-xs custom-control-label" for="editpositive">إيجابي</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group mb-2 col-4" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mb-0 mr-3" style="padding-bottom: 0.2rem;text-align:right;direction:rtl;">الحالة الإجتماعية : </label>
                                                                        <div class="card d-block" style="height: 38px; margin-top: 2px;">
                                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                                <input type="radio" id="editRelationshipMarried" name="relationship" value="married" class="custom-control-input">
                                                                                <label class="text-xs custom-control-label" for="editRelationshipMarried">متزوج</label>
                                                                            </div>
                                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                                <input type="radio" id="editRelationshipSingle" name="relationship"  value="single" class="custom-control-input">
                                                                                <label class="text-xs custom-control-label" for="editRelationshipSingle">أعزب</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group mb-2 col-2" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-1" style="text-align:right;float: right;  direction:rtl;">عددالأولاد:</label>
                                                                        <input type="tel" max="30" min="0" class="form-control form-control @error('child_count') is-invalid @enderror" name="child_count"
                                                                        style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                                        @error('child_count')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">رقم الهاتف :</label>
                                                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                                        style="padding: 0.375rem 0.75rem;height:38px;text-align:center;direction: ltr;font-size: 75%;">
                                                                        @error('phone')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group mb-1 col-5 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
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
                                                                        <div class="form-group mb-1 col-7 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">العنوان : </label>
                                                                        <input type="text" class="VoiceToText form-control @error('patient_address') is-invalid @enderror" id="patient_address" name="patient_address"
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
                                                                <!-- collapseCardMoreDetails -->
                                                                <div class="card">
                                                                    <!-- Card Header - Accordion -->
                                                                    <div class="d-flex ">
                                                                        <a href="#patientMoreInfo" class="form-control card-header" data-toggle="collapse" style="height: 40px;width: 100%;"
                                                                            role="button" aria-expanded="true" aria-controls="patientMoreInfo">
                                                                            <h6 class="m-0 text-xs font-weight-bold text-primary text-center">' المزيد '</h6>
                                                                        </a>
                                                                    </div>
                                                                    <!-- Card Content - Collapse -->
                                                                    <div class="collapse" id="patientMoreInfo" >
                                                                        <div class="card-body p-0" >
                                                                            <div class="form-group mt-2"  style="direction:rtl">
                                                                                <label class="text-xs mb-0 mr-3" style="text-align:right;float: right; direction:rtl;">السوابق الجراحية :</label>
                                                                                <textarea  class="form-control text-xs" name="older_surgery" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" placeholder=" أكتب السوابق الجراحية في حال وجودها"></textarea>
                                                                            </div>
                                                                            <div class="form-group"  style="direction:rtl">
                                                                                <label class="text-xs mb-0 mr-3" style="text-align:right;float: right; direction:rtl;">السوابق المرضية :</label>
                                                                                <textarea  class="form-control text-xs" name="older_sicky" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" placeholder=" أكتب السوابق المرضية في حال وجودها"></textarea>
                                                                            </div>
                                                                            <div class="form-group"  style="direction:rtl">
                                                                                <label class="text-xs mb-0 mr-3" style="text-align:right;float: right; direction:rtl;">السوابق التحسسية :</label>
                                                                                <textarea  class="form-control text-xs" name="older_sensitive" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" placeholder=" أكتب السوابق التحسسية في حال وجودها"></textarea>
                                                                            </div>
                                                                            <div class="form-group"  style="direction:rtl">
                                                                                <label class="text-xs mb-0 mr-3" style="text-align:right;float: right; direction:rtl;">الأدوية الدائمة :</label>
                                                                                <textarea  class="form-control text-xs" name="permanent_medic" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" placeholder=" أكتب الأدوية الدائمة في حال وجودها"></textarea>
                                                                            </div>
                                                                            <div class="form-group"  style="direction:rtl">
                                                                                <label class="text-xs mb-0 mr-3" style="text-align:right;float: right; direction:rtl;">ملاحظات حول المريض :</label>
                                                                                <input type="text" class="form-control text-xs" name="patient_state" placeholder=" أكتب ملاحظات في حال وجودها" style="padding: 0.375rem 0.75rem;text-align:center">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><!-- collapseCardMoreDetails -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- collapseCardMoreDetails -->
                                        </td>

                                        <td style="padding: 0%">
                                            <!-- collapseCardMoreDetails -->
                                            <div class="card">
                                                <!-- Card Header - Accordion -->
                                                <div class="d-flex ">
                                                    <label for="created_at" class="text-xs m-0 card" style="width: 60%;height: 40px;"><b class="mt-2 mr-1">تاريخ الزيارة :</b></label>
                                                    <input class="text-xs form-control @error('created_at') is-invalid @enderror" id="created_at" max="{{Carbon\Carbon::today()->format('Y-m-d')}}" type="date" required  name="created_at" style="width: auto; padding: 0;height: 40px;text-align:center">
                                                    @error('created_at')
                                                    <span class="invalid-feedback text-center" role="alert">
                                                        <strong >{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    <div class="card" style="width: -webkit-fill-available">
                                                        <select name="review_type" required class="text-xs form-control @error('review_type') is-invalid @enderror" style="width: 100%; padding: 0;height: 38px;text-align:center;direction:ltr" >
                                                            @error('review_type')
                                                                <span class="invalid-feedback text-center" role="alert">
                                                                    <strong >{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <option value="" selected>حدد نوع الزيارة</option>
                                                            <option class="text-success  font-weight-bold" value="معاينة" >معاينة</option>
                                                            <option class="text-warning  font-weight-bold" value="مراجعة" >مراجعة</option>
                                                            <option class="text-info  font-weight-bold" value="صورة" >صورة</option>
                                                            <option class="text-info  font-weight-bold" value="تحليل" >تحليل</option>
                                                            <option class="text-info  font-weight-bold" value="تحديد عملية" >تحديد عملية</option>
                                                            <option class="text-info  font-weight-bold" value="مراجعة عملية" >مراجعة عملية</option>
                                                            <option class="text-danger  font-weight-bold" value="عمل جراحي" >عمل جراحي</option>
                                                            <option class="text-danger  font-weight-bold" value="اسعافية" >اسعافية</option>
                                                        </select>
                                                    </div>
                                                    <a href="#patientReviewInfo" class="form-control card-header" data-toggle="collapse"style="height: 40px;width: auto;"
                                                        role="button" aria-expanded="true" aria-controls="patientReviewInfo">
                                                    </a>
                                                </div>
                                                <hr class="p-0 m-0">
                                                <!-- Card Content - Collapse -->
                                                <div class="collapse show" id="patientReviewInfo">
                                                    <div  style="height:260px;">
                                                        <div class="card-body px-2 py-0" style="overflow-y: auto;height: 100%;direction: ltr">
                                                            <div style="direction: rtl">
                                                                <div class="form-group mt-1 position-relative" style="direction:rtl;text-align:right;margin-bottom: 0.3rem" >
                                                                    <label class="text-xs mb-0 mr-3">الشكوى الرئيسية : </label>
                                                                    <textarea id="main_complaint" required class=" VoiceToText form-control @error('main_complaint') is-invalid @enderror" name="main_complaint" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" ></textarea>
                                                                        @error('main_complaint')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="main_complaint">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="form-group position-relative" style="direction:rtl;text-align:right;margin-bottom: 0.3rem" >
                                                                    <label class="text-xs mr-3">رأي الطبيب : </label>
                                                                    <textarea id="medical_report" class="VoiceToText form-control @error('medical_report') is-invalid @enderror" name="medical_report" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" ></textarea>
                                                                        @error('medical_report')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="medical_report">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>

                                                                <div class="form-group mb-1 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs mr-3">خطة العلاج : </label>
                                                                    <textarea id="treatment_plan" class="VoiceToText form-control @error('treatment_plan') is-invalid @enderror" name="treatment_plan" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" ></textarea>
                                                                        @error('treatment_plan')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="treatment_plan">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>
                                                                <!-- Collapse Modal InsideReviews InsideEmergency -->
                                                                <div class="card">
                                                                    <!-- Card Header - Accordion -->
                                                                    <a href="#patientReviewMoreInfo" class="form-control card-header" data-toggle="collapse" style="height: 40px;width: 100%;"
                                                                        role="button" aria-expanded="true" aria-controls="patientReviewMoreInfo">
                                                                        <h6 class="m-0 text-xs font-weight-bold text-primary text-center">' المزيد '</h6>
                                                                    </a>
                                                                    <!-- Card Content - Collapse -->
                                                                    <div class="collapse" id="patientReviewMoreInfo">
                                                                        <div class="card-body px-1 py-1">
                                                                            <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                                <label class="text-xs mb-0 mr-3">نص التحليل : </label>
                                                                                <textarea id="med_analysis_T" class="VoiceToText form-control @error('med_analysis_T') is-invalid @enderror" name="med_analysis_T" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" ></textarea>
                                                                                    @error('med_analysis_T')
                                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                                            <strong >{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:39px;" for="med_analysis_T">
                                                                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                                </button>
                                                                            </div>
                                                                            <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                                <label class="text-xs mb-0 mr-3">محتوى الصورة : </label>
                                                                                <textarea id="med_photo_T" class="VoiceToText form-control @error('med_photo_T') is-invalid @enderror" name="med_photo_T" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" ></textarea>
                                                                                    @error('med_photo_T')
                                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                                            <strong >{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:39px;" for="med_photo_T">
                                                                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                                </button>
                                                                            </div>
                                                                            <div class="form-group mb-0 mb-2" style="direction:rtl;text-align:right" >
                                                                                <label class="text-xs mr-3"> الموعد القادم : </label>
                                                                                <input type="date" min="{{Carbon\Carbon::tomorrow()->format('Y-m-d')}}" class="form-control @error('date_expecting') is-invalid @enderror" name="date_expecting" style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
                                                                                @error('date_expecting')
                                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                                        <strong >{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                                <label class="text-xs mb-0 mr-3">القصة المرضية : </label>
                                                                                <textarea id="pain_story" class=" VoiceToText form-control @error('pain_story') is-invalid @enderror" name="pain_story" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" ></textarea>
                                                                                    @error('pain_story')
                                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                                            <strong >{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="pain_story">
                                                                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                                </button>
                                                                            </div>
                                                                            <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                                <label class="text-xs mb-0 mr-3">ملاحظات الزيارة : </label>
                                                                                <textarea id="doctor_notes" class=" VoiceToText form-control @error('doctor_notes') is-invalid @enderror" name="doctor_notes" rows="1" style="padding: 0.375rem 0.75rem;text-align:center"></textarea>
                                                                                    @error('doctor_notes')
                                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                                            <strong >{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="doctor_notes">
                                                                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                                </button>
                                                                            </div>


                                                                            {{-- علق لأن المشروع الحالي لا يمكن رفع الصور --}}
                                                                            <div class="form-group mb-2" style="direction:ltr;text-align:right" >
                                                                                <label class="text-xs mb-0 mr-3" style="text-align:right;direction: rtl;">صور مرفقة : </label>
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
                                                </div>
                                            </div><!-- collapseCardMoreDetails -->
                                        </td>
                                    </tr
                                {{-- @endfor --}}
                               >
                            </tbody>
                        </table>
                    </div>



                    <div class="form-group" style="direction:ltr">
                        <button type="submit" class="btn btn-primary btn-block">
                            إضافة
                        </button>
                    </div>
                </form>
            </div>
        </div>



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





