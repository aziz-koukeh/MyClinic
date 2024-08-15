@extends('layouts.print')

@section('print')

<div class=" h-100 p-1" style="direction: rtl;text-align:right ;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
    <!-- Card Header - Dropdown -->

    <div class=" pt-2 pb-4 " style="display:flex">
        <a href="{{route('Clinic.index')}}"  class="text-center" style="width:30%;">
            <div>
                <p class="text-xs text-gray-700 p-0 m-0">عيادة الدكتور {{$patient->user->name}}</p>
                <p class="text-xs text-gray-700 p-0 m-0">
                    @if ($patient->user->doctor_info->university)
                        جامعة {{$patient->user->doctor_info->university}}
                    @endif
                    @if ($patient->user->doctor_info->med_specialty)
                        - {{$patient->user->doctor_info->med_specialty}}
                    @endif
                </p>
                <p class="text-xs text-gray-700 p-0 m-0" style="direction:ltr">{{$patient->user->mobile}}
                    @if ($patient->user->doctor_info->address)
                        / {{$patient->user->doctor_info->address}}
                    @endif
                </p>
            </div>
        </a>
        <div  class="text-center" style="width:50%;">
            <p class="h5 text-gray-900 p-0 m-0">&nbsp;</p>
            <a href="{{route('Clinic.patientProfile',$patient->patient_slug)}}">
                <p class="h5 text-gray-900 p-0 m-0">اسم المريض : <b>{{$patient->patient_name}}</b></p>
            </a>
        </div>
        <div style="text-align: center;width: 20%;">
            <p class="text-xs text-gray-700 p-0 m-0">تاريخ الطباعة : {{Carbon\Carbon::today()->format('D d-m-Y')}}</p>
            <p class=" text-xs text-gray-900  p-0 m-0"></p>
            <p class="text-xs text-gray-700 p-0 m-0">تاريخ الإدخال : {{$patient->created_at->format('D d-m-Y')}}</p>
            <p class=" text-xs text-gray-900  p-0 m-0"></p>


        </div>
    </div>

    <div class="table-responsive"  style="border-radius: 10px; border: 1px solid;" >
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>الجنس</th>
                    <th>العمر</th>
                    <th>زمرة الدم</th>
                    <th>التدخين</th>
                    <th>الحالة الإجتماعية</th>
                    <th>عدد الأولاد</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @if ($patient->gender)
                        <td class=" text-gray-900">@if ($patient->gender == 'male') {{'ذكر'}} @elseif ($patient->gender == 'female') {{'أنثى'}} @endif</td>
                    @else
                        <td class=" text-gray-900" style="direction:rtl;line-height: 46px;">---------------------</td>
                    @endif
                    @if ($patient->age && $patient->age!= date('Y') )
                        <td class=" text-gray-900" style="direction:rtl">{{date('Y') - $patient->age .' سنة'}}</td>
                    @else
                        <td class=" text-gray-900" style="direction:rtl;line-height: 46px;">---------------------</td>
                    @endif
                    @if ($patient->blood_type)
                        <td class=" text-gray-900" style="direction:rtl">{{$patient->blood_type}}</td>
                    @else
                        <td class=" text-gray-900" style="direction:rtl;line-height: 46px;">---------------------</td>
                    @endif
                    @if ($patient->smoking)
                        <td class=" text-gray-900" style="direction:rtl">@if ($patient->smoking == 'negative') {{'سلبي'}} @elseif ($patient->smoking == 'positive')  {{'إيجابي'}} @endif</td>
                    @else
                        <td class=" text-gray-900" style="direction:rtl;line-height: 46px;">---------------------</td>
                    @endif
                    @if ($patient->relationship)
                        <td class=" text-gray-900" style="direction:rtl">@if ($patient->relationship == 'married') {{'متزوج'}} @elseif ($patient->relationship == 'single')  {{'أعزب'}} @endif</td>
                    @else
                        <td class=" text-gray-900" style="direction:rtl;line-height: 46px;">---------------------</td>
                    @endif
                    @if ($patient->child_count)
                        <td class=" text-gray-900" style="direction:rtl">{{$patient->child_count}}</td>
                    @else
                        <td class=" text-gray-900" style="direction:rtl;line-height: 46px;">---------------------</td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>

    <div class="pt-2">
        <div class="w-100 d-inline-flex px-4">
            <div class="w-100 text-center d-inline-flex" style="width: 30%;">
                <p class="  text-gray-700 p-0 m-0">رقم الهاتف :&nbsp; </p>
                @if ($patient->phone)
                    <p class="  text-gray-900  p-0 m-0" style=" direction:ltr">{{$patient->phone}}</p>
                @else
                    <p class="  text-gray-900  p-0 m-0" style=" direction:ltr;line-height: 46px;">---------------------------------</p>
                @endif
            </div>
            <div class="w-100 text-center d-inline-flex" style="width: 20%;">
                <p class="  text-gray-700 p-0 m-0">المهنة : &nbsp;</p>
                @if ($patient->patient_job)
                    <p class="  text-gray-900  p-0 m-0" style=" direction:ltr">{{$patient->patient_job}}</p>
                @else
                    <p class="  text-gray-900  p-0 m-0" style=" direction:ltr;line-height: 46px;"> ---------------------------------</p>
                @endif
            </div>
            <div class="w-100 text-center d-inline-flex" style="width: 50%;">
                <p class="  text-gray-700 p-0 m-0">العنوان : &nbsp;</p>
                @if ($patient->patient_address)
                    <p class="  text-gray-900  p-0 m-0" style=" direction:ltr;">{{$patient->patient_address}}</p>
                @else
                    <p class="  text-gray-900  p-0 m-0" style=" direction:ltr;line-height: 46px;"> ----------------------------------------</p>
                @endif
            </div>
        </div>
    </div>

    <hr class="p-0 mb-3 mt-0">


    <div class="table-responsive"  style="border-radius: 10px; border: 1px solid;" >
        <table class="table table-bordered  mb-0">
            <thead>
                <tr >
                    <th  class="border-right-secondary" width="20%">
                        السوابق الجراحية
                    </th >
                    <th  class="border-right-secondary" width="20%">
                        السوابق المرضية
                    </th>
                    <th  class="border-right-secondary" width="20%">
                        السوابق التحسسية
                    </th>
                    <th  class="border-right-secondary" width="20%">
                        الأدوية الدائمة
                    </th>
                    <th  class="border-right-secondary" width="20%">
                        ملاحظات حول المريض
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr style="height: 150px" >
                    <td class="border-right-secondary">
                        {{$patient->older_surgery}}
                    </td>
                    <td  class="border-right-secondary">
                        {{$patient->older_sicky}}
                    </td>
                    <td  class="border-right-secondary">
                        {{$patient->older_sensitive}}
                    </td>
                    <td  class="border-right-secondary">
                        {{$patient->permanent_medic}}
                    </td>
                    <td  class="border-right-secondary">
                        {{$patient->patient_state}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <hr class="p-0 my-3">

    @foreach ($patientReviews->whereNull('patient_review_id') as $patientReview)
        <div class="card my-3" style="border: 2px solid;">
            <div class="card-header p-1">
                <div class=" p-2" style="display:flex">
                    <div class="text-right" style="width:50%;">
                        <h6 class="mt-2"><b>معلومات ال{{$patientReview->review_type}}</b></h6>
                    </div>
                    <div class="text-left" style="width:50%;">
                        <p class=" text-xs text-gray-700  p-0 my-0 ml-3">تاريخ ال{{$patientReview->review_type}}</p>
                        <p class=" text-xs  text-gray-900  p-0 m-0">{{$patientReview->created_at->format('D d-m-Y')}}</p>
                    </div>
                </div>
            </div>
            <div class="card-body p-1">
                @if ($patientReview->outsideReviews)
                    <div class="card my-2 p-1 border-top-dark border-bottom-dark" >
                        <div class="card-header p-1">
                            <div  style="display:flex">
                                <div class="text-right" style="width:50%;">
                                    <h6 class="mt-2"><b>معلومات ال{{$patientReview->outsideReviews->review_type}} الرئيسية</b></h6>
                                </div>
                                <div class="text-left" style="width:50%;">
                                    <p class=" text-xs text-gray-700  p-0 my-0 ml-3">تاريخ ال{{$patientReview->outsideReviews->review_type}}</p>
                                    <p class=" text-xs  text-gray-900  p-0 m-0">{{$patientReview->outsideReviews->created_at->format('D d-m-Y')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6 mb-2">
                                <div class="card  h-100 mb-2 p-1 border-right-secondary" style="border: 1px solid;">
                                    <div class="text-md text-dark text-uppercase mb-1"><b>سبب الزيارة الرئيسي:</b></div>
                                    @if ($patientReview->outsideReviews->main_complaint)
                                        <div class="h6 mb-0  text-gray-900">
                                            {{$patientReview->outsideReviews->main_complaint}}
                                        </div>

                                    @endif
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                                    <div class="text-md text-dark text-uppercase mb-1"><b>القصة المرضية:</b></div>
                                    @if ($patientReview->outsideReviews->pain_story)
                                        <div class="h6 mb-0  text-gray-900">
                                            {{$patientReview->outsideReviews->pain_story}}
                                        </div>

                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="text-md text-dark text-uppercase mb-1"><b>رأي الطبيب:</b></div>
                        <div class="h6 mb-0  text-gray-900">
                            {{$patientReview->outsideReviews->medical_report}}
                        </div>

                        <div class="text-md text-dark text-uppercase mb-1"><b>خطة العلاج:</b></div>
                        <div class="h6 mb-0  text-gray-900">
                            {{$patientReview->outsideReviews->treatment_plan}}
                        </div>

                    </div>
                @endif
                <div class="form-row">
                    <div class="col-6 mb-2">
                        <div class="card  h-100 mb-2 p-1 border-right-secondary" style="border: 1px solid;">
                            <div class="text-md text-dark text-uppercase mb-1"><b>سبب الزيارة:</b></div>
                            @if ($patientReview->main_complaint)
                                <div class="h6 mb-0  text-gray-900">
                                    {{$patientReview->main_complaint}}
                                </div>

                            @endif
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                            <div class="text-md text-dark text-uppercase mb-1"><b>القصة المرضية:</b></div>
                            @if ($patientReview->pain_story)
                                <div class="h6 mb-0  text-gray-900">
                                    {{$patientReview->pain_story}}
                                </div>

                            @endif
                        </div>
                    </div>
                </div>
                <div class="card mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                    <div class="text-md text-dark text-uppercase mb-1"><b>رأي الطبيب:</b></div>
                    @if ($patientReview->medical_report)
                        <div class="h6 mb-0  text-gray-900">
                            {{$patientReview->medical_report}}
                        </div>

                    @endif
                </div>
                <div class="card mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                    <div class="text-md text-dark text-uppercase mb-1"><b>خطة العلاج:</b></div>
                    @if ($patientReview->treatment_plan)
                        <div class="h6 mb-0  text-gray-900">
                            {{$patientReview->treatment_plan}}
                        </div>

                    @endif
                </div>
                <div class="form-row">
                    <div class="col-6 mb-2">
                        <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                            <div class="text-md text-dark text-uppercase mb-1"><b>نص التحليل:</b></div>
                            @if ($patientReview->med_analysis_T)
                                <div class="h6 mb-0  text-gray-900">
                                    {{$patientReview->med_analysis_T}}
                                </div>

                            @endif
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                            <div class="text-md text-dark text-uppercase mb-1"><b>محتوى الصورة:</b></div>
                            @if ($patientReview->med_photo_T)
                                <div class="h6 mb-0  text-gray-900">
                                    {{$patientReview->med_photo_T}}
                                </div>

                            @endif
                        </div>
                    </div>
                </div>
                <div class="card mb-2 p-1 border-right-secondary" >
                    <div class="text-md text-dark text-uppercase mb-1"><b>ملاحظات الطبيب:</b></div>
                    @if ($patientReview->doctor_notes)
                        <div class="h6 mb-0  text-gray-900">
                            {{$patientReview->doctor_notes}}
                        </div>

                    @endif
                </div>
                @if ($patientReview->insideReviews)
                    @foreach ($patientReview->insideReviews as $insideReview)
                        <div class="card mb-2 p-1 border-top-dark" >
                            <div class="card-header p-1">
                                <div  style="display:flex">
                                    <div class="text-right" style="width:50%;">
                                        <h6 class="mt-2"><b>معلومات ال{{$insideReview->review_type}} التابعة</b></h6>
                                    </div>
                                    <div class="text-left" style="width:50%;">
                                        <p class=" text-xs text-gray-700  p-0 my-0 ml-3">تاريخ ال{{$insideReview->review_type}}</p>
                                        <p class=" text-xs  text-gray-900  p-0 m-0">{{$insideReview->created_at->format('D d-m-Y')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-6 mb-2">
                                    <div class="card  h-100 mb-2 p-1 border-right-secondary" style="border: 1px solid;">
                                        <div class="text-md text-dark text-uppercase mb-1"><b>سبب الزيارة التابعة:</b></div>
                                        @if ($insideReview->main_complaint)
                                            <div class="h6 mb-0  text-gray-900">
                                                {{$insideReview->main_complaint}}
                                            </div>

                                        @endif
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                                        <div class="text-md text-dark text-uppercase mb-1"><b>المستجدات المرضية:</b></div>
                                        @if ($insideReview->pain_story)
                                            <div class="h6 mb-0  text-gray-900">
                                                {{$insideReview->pain_story}}
                                            </div>

                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                                <div class="text-md text-dark text-uppercase mb-1"><b>رأي الطبيب:</b></div>
                                <div class="h6 mb-0  text-gray-900">
                                    {{$insideReview->medical_report}}
                                </div>
                            </div>
                            <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                                <div class="text-md text-dark text-uppercase mb-1"><b>العلاج:</b></div>
                                <div class="h6 mb-0  text-gray-900">
                                    {{$insideReview->treatment_plan}}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-6 mb-2">
                                    <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                                        <div class="text-md text-dark text-uppercase mb-1"><b>نص التحليل الجديد:</b></div>
                                        @if ($insideReview->med_analysis_T)
                                            <div class="h6 mb-0  text-gray-900">
                                                {{$insideReview->med_analysis_T}}
                                            </div>

                                        @endif
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                                        <div class="text-md text-dark text-uppercase mb-1"><b>محتوى الصورة الجديدة:</b></div>
                                        @if ($insideReview->med_photo_T)
                                            <div class="h6 mb-0  text-gray-900">
                                                {{$insideReview->med_photo_T}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-10 mb-2">
                                    <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                                        <div class="text-md text-dark text-uppercase mb-1"><b>ملاحظات الطبيب:</b></div>
                                        @if ($insideReview->doctor_notes)
                                            <div class="h6 mb-0  text-gray-900">
                                                {{$insideReview->doctor_notes}}
                                            </div>

                                        @endif
                                    </div>
                                </div>
                                <div class="col-2 mb-2">
                                    <div class="card h-100 mb-2 p-1 border-right-secondary px-2" style="border: 1px solid;">
                                        <div class="text-center w-100" >
                                            <p class=" text-md text-dark text-uppercase mb-1"><b>تاريخ الموعد القادم</b></p>
                                            @if ($insideReview->date_expecting)
                                                <p class=" text-xs  text-gray-900  p-0 m-0"><b>{{Carbon\Carbon::parse($insideReview->date_expecting)->format('D d-m-Y')}}</b></p>
                                            @else
                                                <p class="  text-gray-900  p-0 m-0" style=" direction:ltr;line-height: 46px;"> ----------------------------</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            @if ($patientReview->date_expecting)
                <div class="card-footer p-1">
                    <div class=" px-2" style="display:flex">
                        <div class="text-left w-100" >
                            <p class=" text-xs text-gray-700  p-0 my-0">تاريخ الموعد القادم</p>
                            <p class=" text-xs  text-gray-900  p-0 m-0">{{Carbon\Carbon::parse($patientReview->date_expecting)->format('D d-m-Y')}}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endforeach






</div>


@endsection

@section('script')
    <script>
        window.print();
    </script>
@endsection
