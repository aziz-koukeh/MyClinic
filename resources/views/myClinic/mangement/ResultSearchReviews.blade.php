@extends('layouts.myClinic')

@section('style')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/MyClinicApp/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="pb-5">
        <!-- DataTales Example -->
        <div class="card shadow my-3">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary text-center">نتائج البحث</h5>
            </div>

            <div class="card-body p-2" >
                <div class="table-responsive" style="direction:ltr">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>تاريخ الزيارة</th>
                                <th>اسم الزائر</th>
                                <th>سبب الزيارة</th>
                                <th>القصة المرضية</th>
                                <th>رأي الطبيب</th>
                                <th>خطة العلاج</th>
                                <th>الإجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $num=0;
                            @endphp
                            @foreach ($patientReviews as $review)
                                <tr class="text-gray-900">
                                    <td>{{ ++$num}}</td>
                                    <td class="text-xs"><b>{{$review->created_at->format('Y-m-d')}}</b></td>
                                    <td class="text-xs" style="width:10%"><b>{{$review->patient->patient_name}}</b></td>
                                    <td class="text-xs"><b>
                                        @if ($review->main_complaint)
                                            {{ \Illuminate\Support\Str::limit($review->main_complaint, 20 , ' ...') }}
                                        @else
                                            ----
                                        @endif
                                    </b></td>
                                    <td class="text-xs"><b>
                                        @if ($review->pain_story)
                                            {{ \Illuminate\Support\Str::limit($review->pain_story, 20 , ' ...') }}
                                        @else
                                            ----
                                        @endif
                                    </b></td>
                                    <td class="text-xs"><b>
                                        @if ($review->medical_report)
                                            {{ \Illuminate\Support\Str::limit($review->medical_report, 20 , ' ...') }}
                                        @else
                                            ----
                                        @endif
                                    </b></td>
                                    <td class="text-xs"><b>
                                        @if ($review->treatment_plan)
                                            {{ \Illuminate\Support\Str::limit($review->treatment_plan, 20 , ' ...') }}
                                        @else
                                            ----
                                        @endif
                                    </b></td>
                                    <td>
                                        <a href="{{route('Clinic.patientProfile',$review->patient->patient_slug)}}" class="btn btn-primary btn-circle btn-sm mx-1">
                                            <i class="fas fa-sign-in-alt text-light"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>












        </div>
    </div>
@endsection

@section('script')
<script src="{{ asset('assets/MyClinicApp/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/MyClinicApp/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/MyClinicApp/js/demo/datatables-demo.js')}}"></script>
@endsection
