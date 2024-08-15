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
                <h5 class="m-0 font-weight-bold text-primary text-center">سجل الزوار منذ سنة</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive" style="direction:ltr">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>تاريخ الإدخال</th>
                                <th>اسم الزائر</th>
                                <th>التواصل</th>
                                {{-- <th>زمرة الدم</th> --}}
                                <th>العمر</th>
                                <th>الزيارة مفحوصة</th>
                                <th>الأرشفة</th>
                                <th>الإجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=count($patients) +1;
                                $num=0;
                            @endphp
                            @foreach ($patients as $patient)
                                @if ($patient->created_at->diffInYears() == 0)
                                    @if (count($patient->patientReviews)>0)
                                        <tr class="text-gray-900">
                                            <td>{{ ++$num }}</td>
                                            <td>{{$patient->created_at->format('Y-m-d')}}</td>
                                            <td>{{$patient->patient_name}}</td>
                                            <td>
                                                @if ($patient->phone)
                                                    {{$patient->phone}}
                                                @else
                                                    لم يتم الإدخال
                                                @endif
                                            </td>
                                            {{-- <td>{{$patient->blood_type}}</td> --}}
                                            <td style="direction:rtl">
                                                @if ($patient->age && $patient->age!= date('Y'))
                                                {{date('Y') - $patient->age .' سنة'}}
                                                @else
                                                    لم يتم الإدخال
                                                @endif
                                            </td>
                                            <td>{{count($patient->patientReviews)}}</td>
                                            <td>{{ --$i }}</td>
                                            <td>
                                                <div class="d-sm-block d-lg-inlineflex">
                                                    <a href="{{route('Clinic.patientProfile',$patient->patient_slug)}}" class="btn btn-primary btn-circle btn-sm mx-1" data-toggle="tooltip" title="الذهاب إلى ملف الزائر" >
                                                        <i class="fas fa-sign-in-alt text-light"></i>
                                                    </a>
                                                    <a href="{{route('Clinic.softDeletesPatient',$patient->patient_slug)}}" class="btn btn-danger btn-circle btn-sm mx-1" data-toggle="tooltip" title="حذف ملف الزائر">
                                                        <i class="fas fa-fw fa-trash text-light"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
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
