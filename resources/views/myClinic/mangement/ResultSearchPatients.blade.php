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
                                <th>اسم الزائر</th>
                                <th>تاريخ الإدخال</th>
                                <th>الرقم</th>
                                <th>العمر</th>
                                <th>الجنس</th>
                                <th>الإجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $num=0;
                            @endphp
                            @foreach ($patients as $patient)
                                <tr class="text-gray-900">
                                    <td>{{ ++$num}}</td>
                                    <td class="text-xs" ><b>{{$patient->patient_name}}</b></td>
                                    <td class="text-xs"><b>{{$patient->created_at->format('Y-m-d')}}</b></td>
                                    <td class="text-xs"><b>
                                        @if ($patient->phone)
                                            {{$patient->phone}}
                                        @else
                                            ----
                                        @endif
                                    </b></td>
                                    <td class="text-xs"><b>
                                        @if ($patient->age && $patient->age != date('Y'))
                                            {{date('Y') -$patient->age}} سنة
                                        @else
                                            ----
                                        @endif
                                    </b></td>
                                    <td class="text-xs"><b>
                                        @if ($patient->gender)
                                            @if ($patient->gender == 'male') {{'ذكر'}} @elseif ($patient->gender == 'female') {{'أنثى'}} @endif
                                        @else
                                            ----
                                        @endif

                                    </b></td>
                                    <td>
                                        <a href="{{route('Clinic.patientProfile',$patient->patient_slug)}}" class="btn btn-primary btn-circle btn-sm mx-1">
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
