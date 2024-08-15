@extends('layouts.myClinic')

@section('style')

@endsection

@section('content')
    <div class="pb-5 mt-3 mb-5">
        @if (count($errors)>0)
            @foreach ($errors->all() as $item)
                <div class="alert alert-secondary" role="alert">
                    {{$item}}
                </div>
            @endforeach
        @endif
        <div class="card bg-gradient-dark o-hidden border-left-primary border-right-primary border-bottom-primary border-top-primary border-0 shadow-lg">
            <div class="form-row p-2">
                {{-- جدول إحصاء للزيارات --}}
                <div class="col-md-6" >
                    <div class="card border-right-info shadow py-2 my-3"  style="height:300px">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col ml-2" style="text-align:right">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">ملفات الزيارات
                                    </div>
                                    <div class="font-weight-bold text-gray-600 text-uppercase mb-1">العدد الإجمالي : /{{count($patientReviews)}}/
                                    </div>

                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th class="text-success" colspan="2">المعاينات</th>
                                                <th class="text-warning" colspan="2">المراجعات</th>
                                                <th class="text-danger" colspan="2">الإسعافيات</th>
                                                <th class="text-info" colspan="2">الزيارات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-gray-800 text-xs">تم الفحص</td>
                                                <td class="text-gray-800 text-xs">لم يتم الفحص</td>
                                                <td class="text-gray-800 text-xs">تم الفحص</td>
                                                <td class="text-gray-800 text-xs">لم يتم الفحص</td>
                                                <td class="text-gray-800 text-xs">تم الفحص</td>
                                                <td class="text-gray-800 text-xs">لم يتم الفحص</td>
                                                <td class="text-gray-800 text-xs">تم الفحص</td>
                                                <td class="text-gray-800 text-xs">لم يتم الفحص</td>
                                            </tr>
                                            <tr>
                                                @if (count($patientReviews->where('review_type','معاينة')->where('done',1)) > 0)
                                                    <td class="text-danger" style="text-decoration: underline;">{{count($patientReviews->where('review_type','معاينة')->where('done',1))}}</td>
                                                @else
                                                    <td class="text-gray-900">{{count($patientReviews->where('review_type','معاينة')->where('done',1))}}</td>
                                                @endif
                                                @if (count($patientReviews->where('review_type','معاينة')->where('done',0)) > 0)
                                                    <td class="text-primary">{{count($patientReviews->where('review_type','معاينة')->where('done',0))}}</td>
                                                @else
                                                    <td class="text-gray-900">{{count($patientReviews->where('review_type','معاينة')->where('done',0))}}</td>
                                                @endif
                                                @if (count($patientReviews->where('review_type','مراجعة')->where('done',1)) > 0)
                                                    <td class="text-danger"  style="text-decoration: underline;">{{count($patientReviews->where('review_type','مراجعة')->where('done',1))}}</td>
                                                @else
                                                    <td class="text-gray-900">{{count($patientReviews->where('review_type','مراجعة')->where('done',1))}}</td>
                                                @endif
                                                @if (count($patientReviews->where('review_type','مراجعة')->where('done',0)) > 0)
                                                    <td class="text-primary">{{count($patientReviews->where('review_type','مراجعة')->where('done',0))}}</td>
                                                @else
                                                    <td class="text-gray-900">{{count($patientReviews->where('review_type','مراجعة')->where('done',0))}}</td>
                                                @endif
                                                @if (count($patientReviews->where('review_type','اسعافية')->where('done',1)) > 0)
                                                    <td class="text-danger"  style="text-decoration: underline;">{{count($patientReviews->where('review_type','اسعافية')->where('done',1))}}</td>
                                                @else
                                                    <td class="text-gray-900">{{count($patientReviews->where('review_type','اسعافية')->where('done',1))}}</td>
                                                @endif
                                                @if (count($patientReviews->where('review_type','اسعافية')->where('done',0)) > 0)
                                                    <td class="text-primary">{{count($patientReviews->where('review_type','اسعافية')->where('done',0))}}</td>
                                                @else
                                                    <td class="text-gray-900">{{count($patientReviews->where('review_type','اسعافية')->where('done',0))}}</td>
                                                @endif
                                                @if (count($patientReviews->where('review_type','زيارة')->where('done',1)) > 0)
                                                    <td class="text-danger"  style="text-decoration: underline;">{{count($patientReviews->where('review_type','زيارة')->where('done',1))}}</td>
                                                @else
                                                    <td class="text-gray-900">{{count($patientReviews->where('review_type','زيارة')->where('done',1))}}</td>
                                                @endif
                                                @if (count($patientReviews->where('review_type','زيارة')->where('done',0)) > 0)
                                                    <td class="text-primary">{{count($patientReviews->where('review_type','زيارة')->where('done',0))}}</td>
                                                @else
                                                    <td class="text-gray-900">{{count($patientReviews->where('review_type','زيارة')->where('done',0))}}</td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>{{-- جدول إحصاء للزيارات --}}

                {{-- جدول الزوار  --}}
                <div class="col-md-6">
                    <div class="card border-right-info shadow py-2 my-3"  style="height:300px">
                        <div class="card-body p-0 m-0">
                            <div class="row no-gutters align-items-center m-2">
                                <div class="col ml-2" style="text-align:right">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">ملفات الزوار
                                    </div>
                                    <div class="font-weight-bold text-gray-600 text-uppercase mb-1">العدد الإجمالي : /{{count($patients)}}/
                                    </div>

                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-fw fa-user fa-2x text-gray-300"></i>
                                </div>
                            </div>
                            <hr class="sidebar-divider my-0">
                            <div class="m-2" style="overflow-y:auto;height:212px;">
                                @php
                                    $n=0
                                @endphp
                                @forelse ($patients as $patient)
                                    <div class="d-flex" style="direction:rtl" >
                                        <div class="d-block ">
                                            <p class="text-center text-xs  p-0 m-0"><b>{{ ++$n }}</b></p>
                                        </div>
                                        <div class="d-block " style="width:75% ;">
                                            <a href="{{route('Clinic.patientProfile',$patient->patient_slug)}}">
                                                <p class="text-center text-xs  p-0 m-0"><b>اسم الزائر</b></p>
                                                <p class="text-center p-0 m-0"><b>{{$patient->patient_name}}</b></p>
                                            </a>
                                        </div>
                                        <div class="d-block " style="width:113px;">
                                            <p class="text-center text-xs text-gray-800 p-0 m-0"><b>وقت الحذف :</b></p>
                                            <p class="text-center text-xs text-gray-800 p-0 m-0">{{$patient->deleted_at->format('h:i a')}}</p>
                                            <p class="text-center text-xs text-gray-800 p-0 m-0">{{$patient->deleted_at->format('D d-m-Y')}}</p>
                                        </div>
                                        <div class="d-block">
                                            <a class="btn btn-primary btn-circle btn-sm" type="button" href="{{route('Clinic.restorePatient',$patient->patient_slug)}}"  data-toggle="tooltip" title="استعادة ملف الزائر">
                                                <i class="fa-solid fa-retweet"></i>
                                            </a>
                                            @if (auth()->user()->d_o_e == 0)
                                                <a class="btn bg-gradient-secondary btn-circle btn-sm" type="button"  data-toggle="tooltip" title="تأكد من صلاحياتك">
                                                    <i class="fas fa-fw fa-trash text-light"></i>
                                                </a>
                                            @else
                                                <a class="btn btn-danger btn-circle btn-sm" type="button" href="{{route('Clinic.destroyPatient',$patient->patient_slug)}}"  data-toggle="tooltip" title="حذف ملف الزائر">
                                                    <i class="fas fa-trash text-light"></i>
                                                </a>
                                            @endif

                                        </div>

                                    </div>
                                    <hr class="sidebar-divider my-1">
                                @empty
                                    <p class="text-center text-primary"><b>لا يوجد</b></p>
                                    <hr class="sidebar-divider my-0">
                                @endforelse
                                <p class="text-center text-xs my-2"><b>النهاية</b></p>

                            </div>
                        </div>
                    </div>
                </div>{{-- جدول الزوار  --}}

            </div>
        </div>
        <div class="mt-2 card bg-gradient-secondary o-hidden border-left-danger border-right-danger border-bottom-danger border-top-danger border-0 shadow-lg">
            <div class="form-row p-2">
                {{-- جدول المفحوص  --}}
                <div class="col-md-6" >
                    <div class="card border-right-danger shadow py-2 my-3"   style="height:300px">
                        <div class="card-header py-2">
                            <h6 class="text-center text-danger p-0 m-0"><b>الزيارات المفحوصة</b><span class="h6" > : / {{count($patientReviews->where('done',1))}} /</span></h6>
                        </div>
                        <div class="m-2" style="overflow-y:auto;height:229px;direction:ltr">
                            @forelse ($patientReviews->where('done',1) as $reviewDone)
                                @if ($reviewDone->review_type == 'معاينة')
                                @php
                                $type ='success'
                                @endphp
                                @elseif ($reviewDone->review_type == 'مراجعة')
                                @php
                                $type ='warning'
                                @endphp
                                @elseif ($reviewDone->review_type == 'اسعافية')
                                @php
                                $type ='danger'
                                @endphp
                                @else
                                @php
                                $type ='info'
                                @endphp
                                @endif
                                <div class="card border-bottom-{{$type}} shadow-3 my-1">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header p-2 " style="display:inline-flex;direction:rtl">
                                        <div class="d-flex">
                                            <div>
                                                <a class="card_dropdown" href="#collapseCardExample{{$reviewDone->id}}" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample{{$reviewDone->id}}">
                                                </a>
                                            </div>

                                        </div>
                                        <div class="text-center" style="width:75% ;">
                                            <p class="text-xs text-gray-900 p-0 m-0">اسم الزائر :</p>
                                            @if ($reviewDone->patient->deleted_at == null)
                                                <a href="{{route('Clinic.patientProfile',$reviewDone->patient->patient_slug)}}"><h6 class="text-primary p-0 m-0"><b>{{$reviewDone->patient->patient_name}}</b></h6></a>
                                            @else
                                                <h6 class="text-danger p-0 m-0"><b>{{$reviewDone->patient->patient_name}}</b> <span class="text-xs">الملف في سلة المحذوفات</span></h6>
                                            @endif
                                        </div>
                                        <div class="text-center" style="width: 113px;">
                                            <p class="text-xs text-gray-900 p-0 m-0">وقت الحذف :</p>
                                            {{-- <p class="text-xs text-gray-800  p-0 m-0">{{$reviewDone->created_at->format('D m Y h:i a')}}</p> --}}
                                            <p class="text-xs text-gray-800 p-0 m-0"  style="direction:ltr">{{$reviewDone->deleted_at->format('h:i a')}}</p>
                                            <p class="text-xs text-gray-800 p-0 m-0">{{$reviewDone->deleted_at->format('D-m-Y')}}</p>
                                        </div>
                                        <div class="d-block">
                                            @if ($reviewDone->patient->deleted_at != null)
                                                <a class="btn bg-gradient-secondary btn-circle btn-sm" type="button"  data-toggle="tooltip" title="لايمكنك قبل إستعادة ملف الزائر">
                                                    <i class="fa-solid fa-retweet"></i>
                                                </a>
                                            @else
                                                <a class="btn btn-primary btn-circle btn-sm" type="button" href="{{route('Clinic.restoreReview',['id'=>$reviewDone->id])}}"  data-toggle="tooltip" title=" استعادة الزيارة">
                                                    <i class="fa-solid fa-retweet"></i>
                                                </a>
                                            @endif
                                            @if (auth()->user()->d_o_e == 0)
                                                <a class="btn bg-gradient-secondary btn-circle btn-sm" type="button"  data-toggle="tooltip" title="تأكد من صلاحياتك">
                                                    <i class="fas fa-fw fa-trash text-light"></i>
                                                </a>
                                            @else
                                                <a class="btn btn-danger btn-circle btn-sm" type="button" href="{{route('Clinic.destroyReview',['id'=>$reviewDone->id])}}"  data-toggle="tooltip" title=" حذف الزيارة ">
                                                    <i class="fas fa-trash text-light"></i>
                                                </a>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="collapse" id="collapseCardExample{{$reviewDone->id}}">
                                        <div class="card-body p-2">
                                            <div class="card  border-right-dark p-2 my-2" style="direction:rtl;text-align:right">
                                                <div class="text-primary text-uppercase mb-1">الشكوى</div>
                                                <div class="mb-0 text-gray-800">{!! \Illuminate\Support\Str::limit($reviewDone->main_complaint, 200 , ' ...') !!}</div>
                                                <div class="text-primary text-uppercase mb-1">الأعراض</div>
                                                <div class="mb-0 text-gray-800">{!! \Illuminate\Support\Str::limit($reviewDone->pain_story, 200 , ' ...') !!}</div>
                                                <div class="text-primary text-uppercase mb-1">تاريخ الزيارة</div>
                                                <div class="mb-0 text-gray-800" style="direction:ltr">{{$reviewDone->created_at->format('h:i a')}}</div>
                                                <div class="mb-0 text-gray-800" >{{$reviewDone->created_at->format('D-m-Y')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="sidebar-divider my-0">
                            @empty
                                <div class="card border-bottom-info shadow py-2 my-1" >
                                    <div class="card-body text-center text-info" >
                                        <b>لا يوجد</b>
                                    </div>
                                </div>
                                <hr class="sidebar-divider my-0">
                            @endforelse
                            <p class="text-center text-xs my-2"><b>النهاية</b></p>
                        </div>
                    </div>
                </div>{{-- جدول المفحوص  --}}

                {{-- جدول الغير مفحوص  --}}
                <div class="col-md-6" >
                    <div class="card border-right-danger shadow py-2 my-3"   style="height:300px">
                        <div class="card-header py-2">
                            <h6 class="text-center text-primary p-0 m-0"><b>الزيارات التي لم يتم فحصها</b><span class="h6" > : / {{count($patientReviews->where('done',0))}} /</span></h6>
                        </div>
                        <div class="m-2" style="overflow-y:auto;height:229px;direction:ltr">
                            @forelse ($patientReviews->where('done',0) as $reviewNotDone)
                                @if ($reviewNotDone->review_type == 'معاينة')
                                @php
                                $type ='success'
                                @endphp
                                @elseif ($reviewNotDone->review_type == 'مراجعة')
                                @php
                                $type ='warning'
                                @endphp
                                @elseif ($reviewNotDone->review_type == 'اسعافية')
                                @php
                                $type ='danger'
                                @endphp
                                @else
                                @php
                                $type ='info'
                                @endphp
                                @endif
                                <div class="card border-bottom-{{$type}} shadow-3 my-1">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header p-2 " style="display:inline-flex;direction:rtl">
                                        <div class="d-flex">
                                            <div>
                                                <a class="card_dropdown" href="#collapseCardExample{{$reviewNotDone->id}}" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample{{$reviewNotDone->id}}">
                                                </a>
                                            </div>

                                        </div>
                                        <div class="text-center" style="width:75% ;">
                                            <p class="text-xs text-gray-900 p-0 m-0">اسم الزائر :</p>
                                            @if ($reviewNotDone->patient->deleted_at == null)
                                                <a href="{{route('Clinic.patientProfile',$reviewNotDone->patient->patient_slug)}}"><h6 class="text-primary p-0 m-0"><b>{{$reviewNotDone->patient->patient_name}}</b></h6></a>
                                            @else
                                                <h6 class="text-danger p-0 m-0"><b>{{$reviewNotDone->patient->patient_name}}</b> <span class="text-xs">الملف في سلة المحذوفات</span></h6>
                                            @endif
                                        </div>
                                        <div class="text-center" style="width: 113px;">
                                            <p class="text-xs text-gray-900 p-0 m-0">وقت الحذف :</p>
                                            {{-- <p class="text-xs text-gray-800  p-0 m-0">{{$reviewNotDone->created_at->format('D m Y h:i a')}}</p> --}}
                                            <p class="text-xs text-gray-800 p-0 m-0"  style="direction:ltr">{{$reviewNotDone->deleted_at->format('h:i a')}}</p>
                                            <p class="text-xs text-gray-800 p-0 m-0">{{$reviewNotDone->deleted_at->format('D-m-Y')}}</p>
                                        </div>
                                        <div class="d-block">
                                            @if ($reviewNotDone->patient->deleted_at != null)
                                                <a class="btn bg-gradient-dark btn-circle btn-sm" type="button"  data-toggle="tooltip" title="لايمكنك قبل إستعادة ملف الزائر">
                                                    <i class="fas fa-fw fa-retweet text-secondary"></i>
                                                </a>
                                            @else
                                                <a class="btn btn-primary btn-circle btn-sm" type="button" href="{{route('Clinic.restoreReview',['id'=>$reviewNotDone->id])}}" data-toggle="tooltip" title=" استعادة الزيارة">
                                                    <i class="fa-solid fa-retweet"></i>
                                                </a>
                                            @endif
                                            <a class="btn btn-danger btn-circle btn-sm" type="button" href="{{route('Clinic.destroyReview',['id'=>$reviewNotDone->id])}}" data-toggle="tooltip" title="حذف الزيارة">
                                                <i class="fas fa-trash text-light"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="collapse" id="collapseCardExample{{$reviewNotDone->id}}">
                                        <div class="card-body p-2">
                                            <div class="card  border-right-dark p-2 my-2" style="direction:rtl;text-align:right">
                                                <div class="text-primary text-uppercase mb-1">الشكوى</div>
                                                <div class="mb-0 text-gray-800">{!! \Illuminate\Support\Str::limit($reviewNotDone->main_complaint, 200 , ' ...') !!}</div>
                                                <div class="text-primary text-uppercase mb-1">الأعراض</div>
                                                <div class="mb-0 text-gray-800">{!! \Illuminate\Support\Str::limit($reviewNotDone->pain_story, 200 , ' ...') !!}</div>
                                                <div class="text-primary text-uppercase mb-1">تاريخ الزيارة</div>
                                                <div class="mb-0 text-gray-800" style="direction:ltr">{{$reviewNotDone->created_at->format('h:i a')}}</div>
                                                <div class="mb-0 text-gray-800" >{{$reviewNotDone->created_at->format('D-m-Y')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="sidebar-divider my-0">
                            @empty
                                <div class="card border-bottom-info shadow py-2 my-1" >
                                    <div class="card-body text-center text-info" >
                                        <b>لا يوجد</b>
                                    </div>
                                </div>
                                <hr class="sidebar-divider my-0">
                            @endforelse
                            <p class="text-center text-xs my-2"><b>النهاية</b></p>
                        </div>
                    </div>
                </div>{{-- جدول الغير مفحوص  --}}

            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
