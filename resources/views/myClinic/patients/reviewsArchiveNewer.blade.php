@extends('layouts.myClinic')

@section('style')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/MyClinicApp/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class=" mb-5 pb-5 mt-3">
        <!-- DataTales Example -->
        <div class="card shadow my-3">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary text-center">سجل الزيارات منذ سنة</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive" style="direction:ltr">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الزائر</th>
                                <th>نوع الزيارة</th>
                                <th>سبب الزيارة</th>
                                <th>تاريخ الزيارة</th>
                                <th>الأرشفة</th>
                                <th>الإجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=count($patientReviews) +1;
                                $num=0;
                            @endphp
                            @foreach ($patientReviews as $review)
                            @if ($review->created_at->diffInYears() == 0)
                                <tr class="text-gray-900">
                                    <td>{{ ++$num}}</td>
                                    <td>{{$review->patient->patient_name}}</td>
                                    <td>{{$review->review_type}}</td>
                                    <td  data-toggle="tooltip" title="{{$review->main_complaint}}" style="direction:rtl">{!! \Illuminate\Support\Str::limit($review->main_complaint, 40 , '...') !!}</td>
                                    <td>{{$review->created_at->format('Y-m-d')}}</td>
                                    <td>{{ --$i}}</td>
                                    <td>
                                        <div class="d-sm-block d-lg-inlineflex">
                                            <a href="{{route('Clinic.patientProfile',$review->patient->patient_slug)}}" class="btn btn-primary btn-circle btn-sm mx-1"  data-toggle="tooltip" title="الذهاب إلى ملف الزائر" >
                                                <i class="fas fa-sign-in-alt text-light"></i>
                                            </a>
                                            <a href="{{route('Clinic.softDeleteReview',$review->id)}}" class="btn btn-danger btn-circle btn-sm mx-1" data-toggle="tooltip" title="حذف الزيارة">
                                                <i class="fas fa-fw fa-trash text-light"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endif
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
