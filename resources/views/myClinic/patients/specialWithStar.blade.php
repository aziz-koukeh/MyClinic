@extends('layouts.myClinic')

@section('style')

@endsection

@section('content')
<div class=" mb-5 pb-5 mt-3">
    {{-- <div>&nbsp;</div> --}}

        <div class=" card border-right-info shadow p-2 my-3">
            <div class="card-header py-2">
                <h5 class="text-center text-dark p-0 m-0"><b>الزيارات المميزة بنجمة</b><i class="fa-solid fa-star" style="color: #f2df0d;"></i><span class="h6" > : / {{count($patientReviews)}} /</span></h5>
            </div>
            @forelse ($patientReviews as $patientReview)
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
                        <div class="d-sm-block d-md-inline-flex" style="width:12% ;">
                            <div>
                                <a class="card_dropdown" href="#collapseCardExample{{$patientReview->id}}" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample{{$patientReview->id}}">
                                </a>
                            </div>
                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0">{{$patientReview->review_type}}</p>
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
                                                @if ($patientReview->patient->age && $patientReview->patient->age!=date('Y'))
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
                                        @if ($patientReview->date_expecting && (Carbon\Carbon::today() > Carbon\Carbon::parse($patientReview->date_expecting)))
                                            <div class="text-primary text-uppercase mb-1">
                                                @if ($patientReview->main_complaint ==' - تحديد عملية - تحليل' || $patientReview->main_complaint =='تحديد عملية' || $patientReview->main_complaint ==' - تحديد عملية - صورة - تحليل' || $patientReview->main_complaint ==' - تحديد عملية - صورة')
                                                    موعد العملية
                                                @else
                                                    الموعد القادم
                                                @endif
                                            </div>
                                            <div class="mb-0 text-gray-800">{{ $patientReview->date_expecting }}</div>
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
                <div class="card border-bottom-info shadow py-3 my-3">
                    <div class="card-body text-center text-info" >
                        <b>لا يوجد</b>
                    </div>
                </div>
            @endforelse

        </div>


    </div>
@endsection

@section('script')

@endsection
