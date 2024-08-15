@extends('layouts.myClinic')

@section('style')

@endsection

@section('content')
<div class=" mb-5 pb-5 mt-3">
        <ul class="nav nav-tabs font-weight-bold pr-1" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                @php
                    $lastday=0;
                    $lastweek=0;
                    $lastmonth=0;
                @endphp
                @foreach ($patientReviews as $patientReview)
                    @if ($patientReview->created_at->format('Y-m-d') == Carbon\Carbon::today()->format('Y-m-d'))
                        @php
                            ++$lastday;
                        @endphp
                    @endif
                @endforeach
            <button class="nav-link text-xs px-2" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><b>الحديث</b></button>
            </li>
            <li class="nav-item" role="presentation">
                @foreach ($patientReviews as $patientReview)
                    @if ($patientReview->created_at->diffInWeeks() == 0 && $patientReview->created_at->format('Y-m-d') < Carbon\Carbon::today() && $patientReview->created_at->diffInHours() >=24)
                        @php
                            ++$lastweek;
                        @endphp
                    @endif
                @endforeach
            <button class="nav-link text-xs px-2" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><b>هذا الأسبوع</b></button>
            </li>
            <li class="nav-item" role="presentation">
                @foreach ($patientReviews as $patientReview)
                    @if ($patientReview->created_at->diffInMonths() == 0 && $patientReview->created_at->format('Y-m-d') < Carbon\Carbon::today() && $patientReview->created_at->diffInHours() >=24)
                        @php
                            ++$lastmonth;
                        @endphp
                    @endif
                @endforeach
            <button class="nav-link text-xs px-2" id="month-tab" data-toggle="tab" data-target="#month" type="button" role="tab" aria-controls="month" aria-selected="false"><b>هذا الشهر</b></button>
            </li>
            <li class="nav-item" role="presentation">

            <button class="nav-link text-xs px-2  active" id="unWriteReport-tab" data-toggle="tab" data-target="#unWriteReport" type="button" role="tab" aria-controls="unWriteReport" aria-selected="false"><b>بدون تشخيص</b></button>
            </li>
            <li class="nav-item" role="presentation">

            <button class="nav-link text-xs px-2" id="phoneTurn-tab" data-toggle="tab" data-target="#phoneTurn" type="button" role="tab" aria-controls="phoneTurn" aria-selected="false"><b>حجوزات هاتفية</b></button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class=" card border-right-dark shadow p-2 my-3">
                    <div class="card-header p-3">
                        <h5 class="text-center text-dark p-0 m-0"><b>الحديث</b><span class="badge btn-light btn-circle text-dark badge-counter">{{$lastday}}</span></h5>
                    </div>
                    @forelse ($patientReviews as $patientReview)
                        @if ($patientReview->created_at->format('Y-m-d') == Carbon\Carbon::today()->format('Y-m-d'))
                            @if ($patientReview->review_type == 'معاينة')
                                @php
                                $type ='success'
                                @endphp
                            @elseif ($patientReview->review_type == 'مراجعة')
                                @php
                                $type ='warning'
                                @endphp
                            @elseif ($patientReview->review_type == 'اسعافية')
                                @php
                                $type ='danger'
                                @endphp
                            @else
                                @php
                                $type ='info'
                                @endphp
                            @endif
                            <div class="card border-bottom-{{$type}} mb-2">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header p-2 " style="display:inline-flex;direction:rtl">
                                    <div class="d-sm-block d-md-inline-flex" style="width:10% ;">
                                        <div>
                                            <a class="card_dropdown" href="#collapseCardExample{{$patientReview->id}}" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample{{$patientReview->id}}">
                                            </a>
                                        </div>
                                        <div class="d-inline-block w-100 text-center">
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0">{{$patientReview->review_type}}</p>
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0">#{{ $lastday-- }}</p>
                                        </div>
                                    </div>
                                    <div class="text-center" style="width:70% ;">
                                        <p class="text-xs text-gray-900 p-0 m-0">اسم الزائر :</p>
                                        <h6 class="text-primary p-0 m-0"><a href="{{route('Clinic.patientProfile',$patientReview->patient->patient_slug)}}"><b>{{$patientReview->patient->patient_name}}</b></a></h6>
                                    </div>
                                    <div class="" style="width: 20%;float: left;">
                                        <p class="text-xs text-gray-800 p-0 m-0">{{$patientReview->created_at->format('D d-m-Y')}}</p>
                                        <p class="text-xs text-gray-800 p-0 m-0"  style="direction:ltr">{{$patientReview->created_at->format('h:i a')}}</p>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseCardExample{{$patientReview->id}}">
                                    <div class="card-body p-2">
                                        <div class="form-row">
                                            <div class="col-lg-8" style="direction:ltr">
                                                <table class="table table-bordered text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>الجنس</th>
                                                            <th>العمر</th>
                                                            <th>التدخين</th>
                                                            @if ($patientReview->patient->blood_type)
                                                                <th>زمرة الدم</th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-gray-800">@if ($patientReview->patient->gender == 'male') {{'ذكر'}} @elseif ($patientReview->patient->gender == 'female') {{'أنثى'}} @else لم يتم الإدخال @endif</td>
                                                            @if ($patientReview->patient->age && $patientReview->patient->age != date('Y') )
                                                            <td class="text-gray-800" style="direction:rtl">{{date('Y') - $patientReview->patient->age .' سنة'}}</td>
                                                            @else
                                                            <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                                            @endif
                                                            @if ($patientReview->patient->smoking)
                                                            <td class="text-gray-800" style="direction:rtl">@if ($patientReview->patient->smoking == 'negative') {{'سلبي'}} @elseif ($patientReview->patient->smoking == 'positive')  {{'إيجابي'}} @endif</td>
                                                            @else
                                                                <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                                            @endif
                                                            @if ($patientReview->patient->blood_type)
                                                                <td class="text-gray-800" style="direction:rtl">{{$patientReview->patient->blood_type}}</td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="card  border-right-dark p-2 my-2" style="direction:rtl;text-align:right">
                                                    <div class="text-primary text-uppercase mb-1">سبب الزيارة</div>
                                                    <div class="mb-0 text-gray-800">{{$patientReview->main_complaint}}</div>
                                                    @if ($patientReview->pain_story)
                                                        <div class="text-primary text-uppercase mb-1">القصة المرضية</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->pain_story }}</div>
                                                    @endif
                                                    @if ($patientReview->medical_report)
                                                        <div class="text-primary text-uppercase mb-1 px-3">رأي الطبيب</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->medical_report }}</div>
                                                    @endif
                                                    @if ($patientReview->treatment_plan)
                                                        <div class="text-primary text-uppercase mb-1 px-3">خطة العلاج</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->treatment_plan }}</div>
                                                    @endif
                                                    @if ($patientReview->med_analysis_T)
                                                        <div class="text-primary text-uppercase mb-1 px-3">التحليل مكتوب</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->med_analysis_T }}</div>
                                                    @endif
                                                    @if ($patientReview->med_photo_T)
                                                        <div class="text-primary text-uppercase mb-1 px-3">الصورة مكتوب</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->med_photo_T }}</div>
                                                    @endif
                                                    @if ($patientReview->doctor_notes)
                                                        <div class="text-primary text-uppercase mb-1">ملاحظات الطبيب</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->doctor_notes }}</div>
                                                    @endif
                                                    @if ($patientReview->date_expecting && (Carbon\Carbon::today() < Carbon\Carbon::parse($patientReview->date_expecting)))
                                                        <div class="text-primary text-uppercase mb-1">
                                                            @if ($patientReview->main_complaint ==' - تحديد عملية - تحليل' || $patientReview->main_complaint =='تحديد عملية' || $patientReview->main_complaint ==' - تحديد عملية - صورة - تحليل' || $patientReview->main_complaint ==' - تحديد عملية - صورة')
                                                                    موعد العملية
                                                                @else
                                                                    الموعد القادم
                                                                @endif
                                                            </div>
                                                        <div class="mb-0 text-gray-800">{{ Carbon\Carbon::parse($patientReview->date_expecting)->format('D d-m-Y') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                        @if ($patientReview->reviewMedias->count() > 0)
                                        <div class="col-lg-4 bg-gradient-dark my-1" style="direction:rtl;height:360px;border-radius: 0.35rem;">
                                            <div id="carouselIndicatorsReview{{$patientReview->id}}" class="carousel slide" data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    @foreach ($patientReview->reviewMedias as $media)
                                                        <li data-target="#carouselIndicatorsReview{{$patientReview->id}}" data-slide-to="{{ $loop->index }}" class="{{ $loop->index == 0 ? 'active' : ''}}"></li>
                                                    @endforeach
                                                </ol>
                                                <div class="carousel-inner">
                                                    @foreach ($patientReview->reviewMedias as $media)
                                                        <div class="carousel-item {{ $loop->index == 0 ? 'active' : ''}}">
                                                            <img src="{{ asset('assets/Clinic/'.auth()->user()->doctor_id.'/'.$media->file_name) }}" class="d-block" style="border-radius: 0.35rem;height:360px;object-fit:contain;width:100%;" alt="...">
                                                            <a class="position-absolute text-danger" style="right: 40px;bottom: 10px; border:1px solid;border-radius: 100%" href="{{route('Clinic.destroyReviewMedia',$media->id)}}"><i class=" fas fa-fw  fa-2x fa-trash-alt"></i></a>

                                                        </div>
                                                    @endforeach
                                                </div>
                                                @if ($patientReview->reviewMedias->count() > 1)
                                                <button class="carousel-control-prev" type="button" data-target="#carouselIndicatorsReview{{$patientReview->id}}" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-target="#carouselIndicatorsReview{{$patientReview->id}}" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only  text-primary">Next</span>
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-lg-4 bg-review-image"></div>
                                        @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    @empty
                        <div class="card border-bottom-info shadow py-1 my-1">
                            <div class="card-body text-center text-info" >
                                <b>لا يوجد</b>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>

            <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class=" card border-right-dark shadow p-2 my-3">
                    <div class="card-header p-3">
                        <h5 class="text-center text-dark p-0 m-0"><b>هذا الأسبوع</b><span class="badge btn-light btn-circle text-dark badge-counter">{{$lastweek}}</span></h5>
                    </div>
                    @forelse ($patientReviews as $patientReview)
                        @if ($patientReview->created_at->diffInWeeks() == 0 && $patientReview->created_at->format('Y-m-d') < Carbon\Carbon::today() && $patientReview->created_at->diffInHours() >=24)
                            @if ($patientReview->review_type == 'معاينة')
                                @php
                                $type ='success'
                                @endphp
                            @elseif ($patientReview->review_type == 'مراجعة')
                                @php
                                $type ='warning'
                                @endphp
                            @elseif ($patientReview->review_type == 'اسعافية')
                                @php
                                $type ='danger'
                                @endphp
                            @else
                                @php
                                $type ='info'
                                @endphp
                            @endif

                            <div class="card border-bottom-{{$type}} mb-2">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header p-2 " style="display:inline-flex;direction:rtl">
                                    <div class="d-sm-block d-md-inline-flex" style="width:10% ;">
                                        <div>
                                            <a class="card_dropdown" href="#collapseCardExample{{$patientReview->id}}" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample{{$patientReview->id}}">
                                            </a>
                                        </div>
                                        <div class="d-inline-block w-100 text-center">
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0">{{$patientReview->review_type}}</p>
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0">#{{ $lastweek-- }}</p>
                                        </div>
                                    </div>
                                    <div class="text-center" style="width:70% ;">
                                        <p class="text-xs text-gray-900 p-0 m-0">اسم الزائر :</p>
                                        <h6 class="text-primary p-0 m-0"><a href="{{route('Clinic.patientProfile',$patientReview->patient->patient_slug)}}"><b>{{$patientReview->patient->patient_name}}</b></a></h6>
                                    </div>
                                    <div class="" style="width: 20%;">
                                        <p class="text-xs text-gray-800 p-0 m-0">{{$patientReview->created_at->format('D d-m-Y')}}</p>
                                        <p class="text-xs text-gray-800 p-0 m-0"  style="direction:ltr">{{$patientReview->created_at->format('h:i a')}}</p>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseCardExample{{$patientReview->id}}">
                                    <div class="card-body p-2">
                                        <div class="form-row">
                                            <div class="col-lg-8" style="direction:ltr">
                                                <table class="table table-bordered text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>الجنس</th>
                                                            <th>العمر</th>
                                                            <th>التدخين</th>
                                                            @if ($patientReview->patient->blood_type)
                                                                <th>زمرة الدم</th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-gray-800">@if ($patientReview->patient->gender == 'male') {{'ذكر'}} @elseif ($patientReview->patient->gender == 'female') {{'أنثى'}} @else لم يتم الإدخال @endif</td>
                                                            @if ($patientReview->patient->age && $patientReview->patient->age != date('Y') )
                                                            <td class="text-gray-800" style="direction:rtl">{{date('Y') - $patientReview->patient->age .' سنة'}}</td>
                                                            @else
                                                            <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                                            @endif
                                                            @if ($patientReview->patient->smoking)
                                                            <td class="text-gray-800" style="direction:rtl">@if ($patientReview->patient->smoking == 'negative') {{'سلبي'}} @elseif ($patientReview->patient->smoking == 'positive')  {{'إيجابي'}} @endif</td>
                                                            @else
                                                                <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                                            @endif
                                                            @if ($patientReview->patient->blood_type)
                                                                <td class="text-gray-800" style="direction:rtl">{{$patientReview->patient->blood_type}}</td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="card  border-right-dark p-2 my-2" style="direction:rtl;text-align:right">
                                                    <div class="text-primary text-uppercase mb-1">سبب الزيارة</div>
                                                    <div class="mb-0 text-gray-800">{{$patientReview->main_complaint}}</div>
                                                    @if ($patientReview->pain_story)
                                                        <div class="text-primary text-uppercase mb-1">القصة المرضية</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->pain_story }}</div>
                                                    @endif
                                                    @if ($patientReview->medical_report)
                                                        <div class="text-primary text-uppercase mb-1 px-3">رأي الطبيب</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->medical_report }}</div>
                                                    @endif
                                                    @if ($patientReview->treatment_plan)
                                                        <div class="text-primary text-uppercase mb-1 px-3">خطة العلاج</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->treatment_plan }}</div>
                                                    @endif
                                                    @if ($patientReview->med_analysis_T)
                                                        <div class="text-primary text-uppercase mb-1 px-3">التحليل مكتوب</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->med_analysis_T }}</div>
                                                    @endif
                                                    @if ($patientReview->med_photo_T)
                                                        <div class="text-primary text-uppercase mb-1 px-3">الصورة مكتوب</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->med_photo_T }}</div>
                                                    @endif
                                                    @if ($patientReview->doctor_notes)
                                                        <div class="text-primary text-uppercase mb-1">ملاحظات الطبيب</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->doctor_notes }}</div>
                                                    @endif
                                                    @if ($patientReview->date_expecting && (Carbon\Carbon::today() < Carbon\Carbon::parse($patientReview->date_expecting)))
                                                        <div class="text-primary text-uppercase mb-1">
                                                            @if ($patientReview->main_complaint ==' - تحديد عملية - تحليل' || $patientReview->main_complaint =='تحديد عملية' || $patientReview->main_complaint ==' - تحديد عملية - صورة - تحليل' || $patientReview->main_complaint ==' - تحديد عملية - صورة')
                                                                موعد العملية
                                                            @else
                                                                الموعد القادم
                                                            @endif
                                                        </div>
                                                        <div class="mb-0 text-gray-800">{{ Carbon\Carbon::parse($patientReview->date_expecting)->format('D d-m-Y') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                        @if ($patientReview->reviewMedias->count() > 0)
                                        <div class="col-lg-4 bg-gradient-dark my-1" style="direction:rtl;height:360px;border-radius: 0.35rem;">
                                            <div id="carouselIndicatorsReview{{$patientReview->id}}" class="carousel slide" data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    @foreach ($patientReview->reviewMedias as $media)
                                                        <li data-target="#carouselIndicatorsReview{{$patientReview->id}}" data-slide-to="{{ $loop->index }}" class="{{ $loop->index == 0 ? 'active' : ''}}"></li>
                                                    @endforeach
                                                </ol>
                                                <div class="carousel-inner">
                                                    @foreach ($patientReview->reviewMedias as $media)
                                                        <div class="carousel-item {{ $loop->index == 0 ? 'active' : ''}}">
                                                            <img src="{{ asset('assets/Clinic/'.auth()->user()->doctor_id.'/'.$media->file_name) }}" class="d-block" style="border-radius: 0.35rem;height:360px;object-fit:contain;width:100%;" alt="...">
                                                            <a class="position-absolute text-danger" style="right: 40px;bottom: 10px; border:1px solid;border-radius: 100%" href="{{route('Clinic.destroyReviewMedia',$media->id)}}"><i class=" fas fa-fw  fa-2x fa-trash-alt"></i></a>

                                                        </div>
                                                    @endforeach
                                                </div>
                                                @if ($patientReview->reviewMedias->count() > 1)
                                                <button class="carousel-control-prev" type="button" data-target="#carouselIndicatorsReview{{$patientReview->id}}" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-target="#carouselIndicatorsReview{{$patientReview->id}}" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only  text-primary">Next</span>
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-lg-4 bg-review-image"></div>
                                        @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="card border-bottom-info shadow py-1 my-1">
                            <div class="card-body text-center text-info" >
                                <b>لا يوجد</b>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>

            <div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="month-tab">
                <div class=" card border-right-dark shadow p-2 my-3">
                    <div class="card-header p-3">
                        <h5 class="text-center text-dark p-0 m-0"><b>هذا الشهر</b><span class="badge btn-light btn-circle text-dark badge-counter">{{$lastmonth}}</span></h5>
                    </div>
                    @forelse ($patientReviews as $patientReview)
                        @if ($patientReview->created_at->diffInMonths() == 0 && $patientReview->created_at->format('Y-m-d') < Carbon\Carbon::today()  &&  $patientReview->created_at->diffInHours() >=24)
                            @if ($patientReview->review_type == 'معاينة')
                                @php
                                $type ='success'
                                @endphp
                            @elseif ($patientReview->review_type == 'مراجعة')
                                @php
                                $type ='warning'
                                @endphp
                            @elseif ($patientReview->review_type == 'اسعافية')
                                @php
                                $type ='danger'
                                @endphp
                            @else
                                @php
                                $type ='info'
                                @endphp
                            @endif
                            <div class="card border-bottom-{{$type}} mb-2">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header p-2 " style="display:inline-flex;direction:rtl">
                                    <div class="d-sm-block d-md-inline-flex" style="width:10% ;">
                                        <div>
                                            <a class="card_dropdown" href="#collapseCardExample{{$patientReview->id}}" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample{{$patientReview->id}}">
                                            </a>
                                        </div>
                                        <div class="d-inline-block w-100 text-center">
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0">{{$patientReview->review_type}}</p>
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0">#{{ $lastmonth-- }}</p>
                                        </div>
                                    </div>
                                    <div class="text-center" style="width:70% ;">
                                        <p class="text-xs text-gray-900 p-0 m-0">اسم الزائر :</p>
                                        <h6 class="text-primary p-0 m-0"><a href="{{route('Clinic.patientProfile',$patientReview->patient->patient_slug)}}"><b>{{$patientReview->patient->patient_name}}</b></a></h6>
                                    </div>
                                    <div class="" style="width: 20%;">
                                        <p class="text-xs text-gray-800 p-0 m-0">{{$patientReview->created_at->format('D d-m-Y')}}</p>
                                        <p class="text-xs text-gray-800 p-0 m-0"  style="direction:ltr">{{$patientReview->created_at->format('h:i a')}}</p>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseCardExample{{$patientReview->id}}">
                                    <div class="card-body p-2">
                                        <div class="form-row">
                                            <div class="col-lg-8" style="direction:ltr">
                                                <table class="table table-bordered text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>الجنس</th>
                                                            <th>العمر</th>
                                                            <th>التدخين</th>
                                                            @if ($patientReview->patient->blood_type)
                                                                <th>زمرة الدم</th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-gray-800">@if ($patientReview->patient->gender == 'male') {{'ذكر'}} @elseif ($patientReview->patient->gender == 'female') {{'أنثى'}} @else لم يتم الإدخال @endif</td>
                                                            @if ($patientReview->patient->age && $patientReview->patient->age !=date('Y') )
                                                            <td class="text-gray-800" style="direction:rtl">{{date('Y') - $patientReview->patient->age .' سنة'}}</td>
                                                            @else
                                                            <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                                            @endif
                                                            @if ($patientReview->patient->smoking)
                                                            <td class="text-gray-800" style="direction:rtl">@if ($patientReview->patient->smoking == 'negative') {{'سلبي'}} @elseif ($patientReview->patient->smoking == 'positive')  {{'إيجابي'}} @endif</td>
                                                            @else
                                                                <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                                            @endif
                                                            @if ($patientReview->patient->blood_type)
                                                                <td class="text-gray-800" style="direction:rtl">{{$patientReview->patient->blood_type}}</td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="card  border-right-dark p-2 my-2" style="direction:rtl;text-align:right">
                                                    <div class="text-primary text-uppercase mb-1">سبب الزيارة</div>
                                                    <div class="mb-0 text-gray-800">{{$patientReview->main_complaint}}</div>
                                                    @if ($patientReview->pain_story)
                                                        <div class="text-primary text-uppercase mb-1">القصة المرضية</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->pain_story }}</div>
                                                    @endif
                                                    @if ($patientReview->medical_report)
                                                        <div class="text-primary text-uppercase mb-1 px-3">رأي الطبيب</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->medical_report }}</div>
                                                    @endif
                                                    @if ($patientReview->treatment_plan)
                                                        <div class="text-primary text-uppercase mb-1 px-3">خطة العلاج</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->treatment_plan }}</div>
                                                    @endif
                                                    @if ($patientReview->med_analysis_T)
                                                        <div class="text-primary text-uppercase mb-1 px-3">التحليل مكتوب</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->med_analysis_T }}</div>
                                                    @endif
                                                    @if ($patientReview->med_photo_T)
                                                        <div class="text-primary text-uppercase mb-1 px-3">الصورة مكتوب</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->med_photo_T }}</div>
                                                    @endif
                                                    @if ($patientReview->doctor_notes)
                                                        <div class="text-primary text-uppercase mb-1">ملاحظات الطبيب</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->doctor_notes }}</div>
                                                    @endif
                                                    @if ($patientReview->date_expecting && (Carbon\Carbon::today() < Carbon\Carbon::parse($patientReview->date_expecting)))
                                                        <div class="text-primary text-uppercase mb-1">
                                                            @if ($patientReview->main_complaint ==' - تحديد عملية - تحليل' || $patientReview->main_complaint =='تحديد عملية' || $patientReview->main_complaint ==' - تحديد عملية - صورة - تحليل' || $patientReview->main_complaint ==' - تحديد عملية - صورة')
                                                                موعد العملية
                                                            @else
                                                                الموعد القادم
                                                            @endif
                                                        </div>
                                                        <div class="mb-0 text-gray-800">{{ Carbon\Carbon::parse($patientReview->date_expecting)->format('D d-m-Y') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                        @if ($patientReview->reviewMedias->count() > 0)
                                        <div class="col-lg-4 bg-gradient-dark my-1" style="direction:rtl;height:360px;border-radius: 0.35rem;">
                                            <div id="carouselIndicatorsReview{{$patientReview->id}}" class="carousel slide" data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    @foreach ($patientReview->reviewMedias as $media)
                                                        <li data-target="#carouselIndicatorsReview{{$patientReview->id}}" data-slide-to="{{ $loop->index }}" class="{{ $loop->index == 0 ? 'active' : ''}}"></li>
                                                    @endforeach
                                                </ol>
                                                <div class="carousel-inner">
                                                    @foreach ($patientReview->reviewMedias as $media)
                                                        <div class="carousel-item {{ $loop->index == 0 ? 'active' : ''}}">
                                                            <img src="{{ asset('assets/Clinic/'.auth()->user()->doctor_id.'/'.$media->file_name) }}" class="d-block" style="border-radius: 0.35rem;height:360px;object-fit:contain;width:100%;" alt="...">
                                                            <a class="position-absolute text-danger" style="right: 40px;bottom: 10px; border:1px solid;border-radius: 100%" href="{{route('Clinic.destroyReviewMedia',$media->id)}}"><i class=" fas fa-fw  fa-2x fa-trash-alt"></i></a>

                                                        </div>
                                                    @endforeach
                                                </div>
                                                @if ($patientReview->reviewMedias->count() > 1)
                                                <button class="carousel-control-prev" type="button" data-target="#carouselIndicatorsReview{{$patientReview->id}}" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-target="#carouselIndicatorsReview{{$patientReview->id}}" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only  text-primary">Next</span>
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-lg-4 bg-review-image"></div>
                                        @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="card border-bottom-info shadow py-1 my-1">
                            <div class="card-body text-center text-info" >
                                <b>لا يوجد</b>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>

            <div class="tab-pane fade show active" id="unWriteReport" role="tabpanel" aria-labelledby="unWriteReport-tab">
                <div class=" card border-right-dark shadow p-2 my-3">
                    <div class="card-header p-3">
                        @php
                            $countUnReporteds =$unReporteds->count();
                        @endphp
                        <h5 class="text-center text-dark p-0 m-0"><b>الزيارات بدون تشخيص </b><span class="badge btn-light btn-circle text-dark badge-counter">{{$countUnReporteds }}</span></h5>
                    </div>
                    @forelse ($unReporteds as $unReported)

                            @if ($unReported->review_type == 'معاينة')
                                @php
                                $type ='success'
                                @endphp
                            @elseif ($unReported->review_type == 'مراجعة')
                                @php
                                $type ='warning'
                                @endphp
                            @elseif ($unReported->review_type == 'اسعافية')
                                @php
                                $type ='danger'
                                @endphp
                            @else
                                @php
                                $type ='info'
                                @endphp
                            @endif
                            <div class="card border-bottom-{{$type}} mb-2">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header p-2 " style="display:inline-flex;direction:rtl">
                                    <div class="d-sm-block d-md-inline-flex" style="width:10% ;">
                                        <div>
                                            <a class="card_dropdown" href="#collapseCardExample{{$unReported->id}}" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample{{$unReported->id}}">
                                            </a>
                                        </div>
                                        <div class="d-inline-block w-100 text-center">
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0">{{$unReported->review_type}}</p>
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0">#{{ $countUnReporteds--}}</p>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-sm mb-1 rounded-circle" style="float: right"  data-toggle="modal" data-target="#EditReview{{$unReported->id}}">
                                        {{-- <span class="d-none d-lg-block text-xs">تشخيصي</span> --}}
                                        {{-- <i class="fa-solid fa-comment-medical fa-lg text-light"></i> --}}
                                        <i class="fa-solid fa-stethoscope  fa-xl text-light"></i>
                                    </button>
                                    <div class="text-center" style="width:65% ;">
                                        <p class="text-xs text-gray-900 p-0 m-0">اسم الزائر :</p>
                                        <h6 class="text-primary p-0 m-0"><a href="{{route('Clinic.patientProfile',$unReported->patient->patient_slug)}}"><b>{{$unReported->patient->patient_name}}</b></a></h6>
                                    </div>
                                    <div class="" style="width: 20%;">
                                        <p class="text-xs text-gray-800 p-0 m-0">{{$unReported->created_at->format('D d-m-Y')}}</p>
                                        <p class="text-xs text-gray-800 p-0 m-0"  style="direction:ltr">{{$unReported->created_at->format('h:i a')}}</p>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseCardExample{{$unReported->id}}">
                                    <div class="card-body p-2">
                                        <div class="form-row">
                                            <div class="col-lg-8" style="direction:ltr">
                                                <table class="table table-bordered text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>الجنس</th>
                                                            <th>العمر</th>
                                                            <th>التدخين</th>
                                                            @if ($unReported->patient->blood_type)
                                                                <th>زمرة الدم</th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-gray-800">@if ($unReported->patient->gender == 'male') {{'ذكر'}} @elseif ($unReported->patient->gender == 'female') {{'أنثى'}} @else لم يتم الإدخال @endif</td>
                                                            @if ($unReported->patient->age && $unReported->patient->age != date('Y') )
                                                            <td class="text-gray-800" style="direction:rtl">{{date('Y') - $unReported->patient->age .' سنة'}}</td>
                                                            @else
                                                            <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                                            @endif
                                                            @if ($unReported->patient->smoking)
                                                            <td class="text-gray-800" style="direction:rtl">@if ($unReported->patient->smoking == 'negative') {{'سلبي'}} @elseif ($unReported->patient->smoking == 'positive')  {{'إيجابي'}} @endif</td>
                                                            @else
                                                                <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                                            @endif
                                                            @if ($unReported->patient->blood_type)
                                                                <td class="text-gray-800" style="direction:rtl">{{$unReported->patient->blood_type}}</td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="card  border-right-dark p-2 my-2" style="direction:rtl;text-align:right">
                                                    <div class="text-primary text-uppercase mb-1">سبب الزيارة</div>
                                                    <div class="mb-0 text-gray-800">{{$unReported->main_complaint}}</div>
                                                    @if ($unReported->pain_story)
                                                        <div class="text-primary text-uppercase mb-1">القصة المرضية</div>
                                                        <div class="mb-0 text-gray-800">{{ $unReported->pain_story }}</div>
                                                    @endif
                                                    @if ($unReported->medical_report)
                                                        <div class="text-primary text-uppercase mb-1 px-3">رأي الطبيب</div>
                                                        <div class="mb-0 text-gray-800">{{ $unReported->medical_report }}</div>
                                                    @endif
                                                    @if ($unReported->treatment_plan)
                                                        <div class="text-primary text-uppercase mb-1 px-3">خطة العلاج</div>
                                                        <div class="mb-0 text-gray-800">{{ $unReported->treatment_plan }}</div>
                                                    @endif
                                                    @if ($unReported->med_analysis_T)
                                                        <div class="text-primary text-uppercase mb-1 px-3">التحليل مكتوب</div>
                                                        <div class="mb-0 text-gray-800">{{ $unReported->med_analysis_T }}</div>
                                                    @endif
                                                    @if ($unReported->med_photo_T)
                                                        <div class="text-primary text-uppercase mb-1 px-3">الصورة مكتوب</div>
                                                        <div class="mb-0 text-gray-800">{{ $unReported->med_photo_T }}</div>
                                                    @endif
                                                    @if ($unReported->doctor_notes)
                                                        <div class="text-primary text-uppercase mb-1">ملاحظات الطبيب</div>
                                                        <div class="mb-0 text-gray-800">{{ $unReported->doctor_notes }}</div>
                                                    @endif
                                                    @if ($unReported->date_expecting && (Carbon\Carbon::today() > Carbon\Carbon::parse($unReported->date_expecting)))
                                                        <div class="text-primary text-uppercase mb-1">
                                                            @if ($unReported->main_complaint ==' - تحديد عملية - تحليل' || $unReported->main_complaint =='تحديد عملية' || $unReported->main_complaint ==' - تحديد عملية - صورة - تحليل' || $unReported->main_complaint ==' - تحديد عملية - صورة')
                                                                    موعد العملية
                                                            @else
                                                                    الموعد القادم
                                                            @endif
                                                        </div>
                                                        <div class="mb-0 text-gray-800">{{ Carbon\Carbon::parse($unReported->date_expecting)->format('D d-m-Y') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                        @if ($unReported->reviewMedias->count() > 0)
                                        <div class="col-lg-4 bg-gradient-dark my-1" style="direction:rtl;height:360px;border-radius: 0.35rem;">
                                            <div id="carouselIndicatorsReview{{$unReported->id}}" class="carousel slide" data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    @foreach ($unReported->reviewMedias as $media)
                                                        <li data-target="#carouselIndicatorsReview{{$unReported->id}}" data-slide-to="{{ $loop->index }}" class="{{ $loop->index == 0 ? 'active' : ''}}"></li>
                                                    @endforeach
                                                </ol>
                                                <div class="carousel-inner">
                                                    @foreach ($unReported->reviewMedias as $media)
                                                        <div class="carousel-item {{ $loop->index == 0 ? 'active' : ''}}">
                                                            <img src="{{ asset('assets/Clinic/'.auth()->user()->doctor_id.'/'.$media->file_name) }}" class="d-block" style="border-radius: 0.35rem;height:360px;object-fit:contain;width:100%;" alt="...">
                                                            <a class="position-absolute text-danger" style="right: 40px;bottom: 10px; border:1px solid;border-radius: 100%" href="{{route('Clinic.destroyReviewMedia',$media->id)}}"><i class=" fas fa-fw  fa-2x fa-trash-alt"></i></a>

                                                        </div>
                                                    @endforeach
                                                </div>
                                                @if ($unReported->reviewMedias->count() > 1)
                                                <button class="carousel-control-prev" type="button" data-target="#carouselIndicatorsReview{{$unReported->id}}" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-target="#carouselIndicatorsReview{{$unReported->id}}" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only  text-primary">Next</span>
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-lg-4 bg-review-image"></div>
                                        @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Doctor Repory -->
                        <div class="modal fade" id="EditReview{{$unReported->id}}" tabindex="-1" aria-labelledby="EditReview{{$unReported->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content" style="direction: ltr">
                                    <div class="modal-body py-1" style="direction: rtl">
                                        <form action="{{route('Clinic.updateReview_doctor',$unReported->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="d-block py-2" style="width:100% ;direction: rtl">


                                                {{-- <p class="text-center text-{{$type}} p-0 m-0">{{$unReported->review_type}}</p> --}}
                                                <p class="text-center text-gray-800 p-0 m-0"><span class="text-{{$type}} font-weight-bold">{{$unReported->review_type}} للمريض :  </span><a class="text-center text-gray-800 p-0 m-0" href="{{route('Clinic.patientProfile',$unReported->patient->patient_slug)}}"><b>{{$unReported->patient->patient_name}}</b></a></p>
                                                <p class="text-center text-xs text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0" href="{{route('Clinic.patientProfile',$unReported->patient->patient_slug)}}"><b class="text-xs text-gray-900">وقت الزيارة : </b> {{$unReported->created_at->format('D d/m - h:i a')}}</a></p>
                                                <p class="text-center text-xs text-gray-800 p-0 m-0">سبب الزيارة : <b>{{$unReported->main_complaint}}</b></p>
                                            </div>
                                        <hr class="m-0">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                        <label class="text-xs">رأي الطبيب : </label>
                                                        <textarea id="editReview-medical_report{{$unReported->id}}" class="VoiceToText form-control @error('medical_report') is-invalid @enderror" name="medical_report" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" >{{$unReported->medical_report}}</textarea>
                                                            @error('medical_report')
                                                                <span class="invalid-feedback text-center" role="alert">
                                                                    <strong >{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-medical_report{{$unReported->id}}">
                                                            <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                        </button>
                                                    </div>

                                                    <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                        <label class="text-xs">خطة العلاج : </label>
                                                        <textarea id="editReview-treatment_plan{{$unReported->id}}" class="VoiceToText form-control @error('treatment_plan') is-invalid @enderror" name="treatment_plan" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" >{{$unReported->treatment_plan}}</textarea>
                                                            @error('treatment_plan')
                                                                <span class="invalid-feedback text-center" role="alert">
                                                                    <strong >{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-treatment_plan{{$unReported->id}}">
                                                            <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                        </button>
                                                    </div>
                                                    <!-- Collapse Modal InsideReviews InsideEmergency -->
                                                    <div class="card mb-2">
                                                        <!-- Card Header - Accordion -->
                                                        <a href="#CollapseEditViewReviewEmergency{{$unReported->id}}" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                            role="button" aria-expanded="true" aria-controls="CollapseEditViewReviewEmergency{{$unReported->id}}">
                                                            <h6 class="m-0 text-xs font-weight-bold text-gray-600 text-center">المزيد  :
                                                                <span class=" @if ($unReported->main_complaint)
                                                                text-primary
                                                                @endif">سبب الزيارة</span>
                                                                - <span class=" @if ($unReported->pain_story)
                                                                text-primary
                                                                @endif">القصة المرضية</span>
                                                                - <span class=" @if ($unReported->med_analysis_T)
                                                                text-primary
                                                                @endif">نص التحليل</span>
                                                                - <span class=" @if ($unReported->med_photo_T)
                                                                text-primary
                                                                @endif">محتوى الصورة</span>
                                                                - <span class=" @if ($unReported->doctor_notes)
                                                                text-primary
                                                                @endif">ملاحظات الزيارة</span>
                                                                @if (Carbon\Carbon::today() < Carbon\Carbon::parse($unReported->date_expecting))
                                                                    - <span class=" @if ($unReported->date_expecting)
                                                                        text-primary
                                                                        @endif">@if ($unReported->main_complaint ==' - تحديد عملية - تحليل' || $unReported->main_complaint =='تحديد عملية' || $unReported->main_complaint ==' - تحديد عملية - صورة - تحليل' || $unReported->main_complaint ==' - تحديد عملية - صورة')
                                                                             موعد العملية
                                                                        @else
                                                                             الموعد القادم
                                                                        @endif</span>
                                                                @endif

                                                            </h6>
                                                        </a>
                                                        <!-- Card Content - Collapse -->
                                                        <div class="collapse" id="CollapseEditViewReviewEmergency{{$unReported->id}}">
                                                            <div class="card-body px-1 py-1">
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">نص التحليل : </label>
                                                                    <textarea id="editReview-med_analysis_T{{$unReported->id}}" class="VoiceToText form-control @error('med_analysis_T') is-invalid @enderror" name="med_analysis_T" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" >{{$unReported->med_analysis_T}}</textarea>
                                                                        @error('med_analysis_T')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:39px;" for="editReview-med_analysis_T{{$unReported->id}}">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">محتوى الصورة : </label>
                                                                    <textarea id="editReview-med_photo_T{{$unReported->id}}" class="VoiceToText form-control @error('med_photo_T') is-invalid @enderror" name="med_photo_T" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" >{{$unReported->med_photo_T}}</textarea>
                                                                        @error('med_photo_T')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:39px;" for="editReview-med_photo_T{{$unReported->id}}">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="form-group mb-2" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">@if ($unReported->main_complaint ==' - تحديد عملية - تحليل' || $unReported->main_complaint =='تحديد عملية' || $unReported->main_complaint ==' - تحديد عملية - صورة - تحليل' || $unReported->main_complaint ==' - تحديد عملية - صورة')
                                                                             موعد العملية
                                                                        @else
                                                                             الموعد القادم
                                                                        @endif : </label>
                                                                    {{-- @if ($unReported->date_expecting) --}}

                                                                        {{-- @dd(\Carbon\Carbon::parse($unReported->date_expecting)->format('Y-m-d')) --}}
                                                                    {{-- @endif --}}
                                                                    <input type="date" min="{{Carbon\Carbon::tomorrow()->format('Y-m-d')}}" @if ($unReported->date_expecting)
                                                                        value="{{Carbon\Carbon::parse($unReported->date_expecting)->format('Y-m-d')}}"
                                                                    @endif  class="form-control @error('date_expecting') is-invalid @enderror" name="date_expecting" style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
                                                                    @error('date_expecting')
                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                            <strong >{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">ملاحظات الزيارة : </label>
                                                                    <textarea id="editReview-doctor_notes{{$unReported->id}}" class=" VoiceToText form-control @error('doctor_notes') is-invalid @enderror" name="doctor_notes" rows="3" style="padding: 0.375rem 0.75rem;text-align:center">{{$unReported->doctor_notes}}</textarea>
                                                                        @error('doctor_notes')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-doctor_notes{{$unReported->id}}">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>

                                                                {{-- <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">سبب الزيارة : </label>
                                                                    <textarea id="editReview-main_complaint{{$unReported->id}}" class=" VoiceToText form-control @error('main_complaint') is-invalid @enderror" name="main_complaint" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" >{{$unReported->main_complaint}}</textarea>
                                                                        @error('main_complaint')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-main_complaint{{$unReported->id}}">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div> --}}
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">القصة المرضية : </label>
                                                                    <textarea id="editReview-pain_story{{$unReported->id}}" class=" VoiceToText form-control @error('pain_story') is-invalid @enderror" name="pain_story" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" >{{$unReported->pain_story}}</textarea>
                                                                        @error('pain_story')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-pain_story{{$unReported->id}}">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>

                                                                {{-- علق لأن المشروع الحالي لا يمكن رفع الصور --}}
                                                                {{-- <div class="form-group mb-2" style="direction:ltr;text-align:right" >
                                                                    <label class="text-xs" style="text-align:right;direction: rtl;">صور مرفقة : </label>
                                                                    <input type="file" class="input_image form-control @error('images') is-invalid @enderror" name="images[]" multiple style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
                                                                    @error('images')
                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                            <strong >{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div><!-- Collapse Modal View Review Emergency -->
                                                </div>
                                                <div class="col-lg-4 bg-new-image"></div>

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
                    @empty
                        <div class="card border-bottom-info shadow py-1 my-1">
                            <div class="card-body text-center text-info" >
                                <b>لا يوجد</b>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>

            <div class="tab-pane fade" id="phoneTurn" role="tabpanel" aria-labelledby="phoneTurn-tab">
                <div class=" card border-right-dark shadow p-2 my-3">
                    <div class="card-header p-3">
                        @php
                            $countPhoneTurns =$phoneTurns->count();
                        @endphp
                        <h5 class="text-center text-dark p-0 m-0 " ><b>حجوزات هاتفية</b><span class="badge btn-light btn-circle text-dark badge-counter">{{$countPhoneTurns}}</span></h5>
                        @if ($countPhoneTurns>0)
                            <a href="{{route('Clinic.destroyReviewPhoneTurns')}}" class="text-danger" type="button" style="float:right"><i class="fas fa-fw fa-trash-alt"></i><b class="d-none d-md-inline-block">حذف الجميع</b></a>
                        @endif
                    </div>
                    @forelse ($phoneTurns as $patientReview)
                            @if ($patientReview->review_type == 'معاينة')
                                @php
                                $type ='success'
                                @endphp
                            @elseif ($patientReview->review_type == 'مراجعة')
                                @php
                                $type ='warning'
                                @endphp
                            @elseif ($patientReview->review_type == 'اسعافية')
                                @php
                                $type ='danger'
                                @endphp
                            @else
                                @php
                                $type ='info'
                                @endphp
                            @endif
                            <div class="card border-bottom-{{$type}} mb-2">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header p-2 " style="display:inline-flex;direction:rtl">
                                    <div class="d-sm-block d-md-inline-flex" style="width:10% ;">
                                        <div>
                                            <a class="card_dropdown" href="#collapseCardExample{{$patientReview->id}}" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample{{$patientReview->id}}">
                                            </a>
                                        </div>
                                        <div class="d-inline-block w-100 text-center">
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0">{{$patientReview->review_type}}</p>
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0">#{{$countPhoneTurns--}}</p>
                                        </div>
                                    </div>
                                    <div class="text-center" style="width:70% ;">
                                        <p class="text-xs text-gray-900 p-0 m-0">اسم الزائر :</p>
                                        <h6 class="text-primary p-0 m-0"><a href="{{route('Clinic.patientProfile',$patientReview->patient->patient_slug)}}"><b>{{$patientReview->patient->patient_name}}</b></a></h6>
                                    </div>
                                    <div class="" style="width: 20%;">
                                        <p class="text-xs text-gray-800 p-0 m-0">{{$patientReview->created_at->format('D d-m-Y')}}</p>
                                        <p class="text-xs text-gray-800 p-0 m-0"  style="direction:ltr">{{$patientReview->created_at->format('h:i a')}}</p>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseCardExample{{$patientReview->id}}">
                                    <div class="card-body p-2">
                                        <div class="form-row">
                                            <div class="col-lg-8" style="direction:ltr">
                                                <table class="table table-bordered text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>الجنس</th>
                                                            <th>العمر</th>
                                                            <th>التدخين</th>
                                                            @if ($patientReview->patient->blood_type)
                                                                <th>زمرة الدم</th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-gray-800">@if ($patientReview->patient->gender == 'male') {{'ذكر'}} @elseif ($patientReview->patient->gender == 'female') {{'أنثى'}} @else لم يتم الإدخال @endif</td>
                                                            @if ($patientReview->patient->age  && $patientReview->patient->age != date('Y'))
                                                            <td class="text-gray-800" style="direction:rtl">{{date('Y') - $patientReview->patient->age .' سنة'}}</td>
                                                            @else
                                                            <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                                            @endif
                                                            @if ($patientReview->patient->smoking)
                                                            <td class="text-gray-800" style="direction:rtl">@if ($patientReview->patient->smoking == 'negative') {{'سلبي'}} @elseif ($patientReview->patient->smoking == 'positive')  {{'إيجابي'}} @endif</td>
                                                            @else
                                                                <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                                            @endif
                                                            @if ($patientReview->patient->blood_type)
                                                                <td class="text-gray-800" style="direction:rtl">{{$patientReview->patient->blood_type}}</td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="card  border-right-dark p-2 my-2" style="direction:rtl;text-align:right">
                                                    <div class="text-primary text-uppercase mb-1">سبب الزيارة</div>
                                                    <div class="mb-0 text-gray-800">{{$patientReview->main_complaint}}</div>
                                                    @if ($patientReview->pain_story)
                                                        <div class="text-primary text-uppercase mb-1">القصة المرضية</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->pain_story }}</div>
                                                    @endif
                                                    @if ($patientReview->medical_report)
                                                        <div class="text-primary text-uppercase mb-1 px-3">رأي الطبيب</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->medical_report }}</div>
                                                    @endif
                                                    @if ($patientReview->treatment_plan)
                                                        <div class="text-primary text-uppercase mb-1 px-3">خطة العلاج</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->treatment_plan }}</div>
                                                    @endif
                                                    @if ($patientReview->med_analysis_T)
                                                        <div class="text-primary text-uppercase mb-1 px-3">التحليل مكتوب</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->med_analysis_T }}</div>
                                                    @endif
                                                    @if ($patientReview->med_photo_T)
                                                        <div class="text-primary text-uppercase mb-1 px-3">الصورة مكتوب</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->med_photo_T }}</div>
                                                    @endif
                                                    @if ($patientReview->doctor_notes)
                                                        <div class="text-primary text-uppercase mb-1">ملاحظات الطبيب</div>
                                                        <div class="mb-0 text-gray-800">{{ $patientReview->doctor_notes }}</div>
                                                    @endif
                                                    @if ($patientReview->date_expecting && (Carbon\Carbon::today() < Carbon\Carbon::parse($patientReview->date_expecting)))
                                                        <div class="text-primary text-uppercase mb-1">
                                                            @if ($patientReview->main_complaint ==' - تحديد عملية - تحليل' || $patientReview->main_complaint =='تحديد عملية' || $patientReview->main_complaint ==' - تحديد عملية - صورة - تحليل' || $patientReview->main_complaint ==' - تحديد عملية - صورة')
                                                                موعد العملية
                                                            @else
                                                                الموعد القادم
                                                            @endif
                                                        </div>
                                                        <div class="mb-0 text-gray-800">{{ Carbon\Carbon::parse($patientReview->date_expecting)->format('D d-m-Y') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                        @if ($patientReview->reviewMedias->count() > 0)
                                        <div class="col-lg-4 bg-gradient-dark my-1" style="direction:rtl;height:360px;border-radius: 0.35rem;">
                                            <div id="carouselIndicatorsReview{{$patientReview->id}}" class="carousel slide" data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    @foreach ($patientReview->reviewMedias as $media)
                                                        <li data-target="#carouselIndicatorsReview{{$patientReview->id}}" data-slide-to="{{ $loop->index }}" class="{{ $loop->index == 0 ? 'active' : ''}}"></li>
                                                    @endforeach
                                                </ol>
                                                <div class="carousel-inner">
                                                    @foreach ($patientReview->reviewMedias as $media)
                                                        <div class="carousel-item {{ $loop->index == 0 ? 'active' : ''}}">
                                                            <img src="{{ asset('assets/Clinic/'.auth()->user()->doctor_id.'/'.$media->file_name) }}" class="d-block" style="border-radius: 0.35rem;height:360px;object-fit:contain;width:100%;" alt="...">
                                                            <a class="position-absolute text-danger" style="right: 40px;bottom: 10px; border:1px solid;border-radius: 100%" href="{{route('Clinic.destroyReviewMedia',$media->id)}}"><i class=" fas fa-fw  fa-2x fa-trash-alt"></i></a>

                                                        </div>
                                                    @endforeach
                                                </div>
                                                @if ($patientReview->reviewMedias->count() > 1)
                                                <button class="carousel-control-prev" type="button" data-target="#carouselIndicatorsReview{{$patientReview->id}}" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-target="#carouselIndicatorsReview{{$patientReview->id}}" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only  text-primary">Next</span>
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-lg-4 bg-review-image"></div>
                                        @endif

                                        </div>
                                    </div>
                                </div>
                            </div>

                    @empty
                        <div class="card border-bottom-info shadow py-1 my-1">
                            <div class="card-body text-center text-info" >
                                <b>لا يوجد</b>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')

@endsection
