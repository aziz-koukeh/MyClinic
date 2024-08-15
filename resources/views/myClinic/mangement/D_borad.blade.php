@extends('layouts.myClinic')
@section('style')

@endsection
@section('content')

    <div class="container-fluid pb-5" style="direction:ltr">

        <!-- Content Row -->
        <div class="pt-3 form-row" style="direction:rtl">

            {{-- جدول إحصاء للزيارات --}}
            <div class="col-xl-8 col-lg-7  mb-4" >
                <div class="card border-top-primary border-right-primary shadow mb-2"  style="height:300px">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col ml-2" style="text-align:right">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-3">إحصائية الزيارات
                                </div>
                                <div class="font-weight-bold text-gray-600 text-uppercase mb-4">العدد الإجمالي : /{{$allDonePatientReviews + $allNotDonePatientReviews}}/
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
                                            <th class="text-danger" colspan="2">الإسعافيات</th>
                                            <th class="text-warning" colspan="2">المراجعات</th>
                                            <th class="text-info" colspan="2">الزيارات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-gray-800 text-xs">تم الفحص</td>
                                            <td class="text-gray-800 text-xs">غير مفحوص</td>
                                            <td class="text-gray-800 text-xs">تم الفحص</td>
                                            <td class="text-gray-800 text-xs">غير مفحوص</td>
                                            <td class="text-gray-800 text-xs">تم الفحص</td>
                                            <td class="text-gray-800 text-xs">غير مفحوص</td>
                                            <td class="text-gray-800 text-xs">تم الفحص</td>
                                            <td class="text-gray-800 text-xs">غير مفحوص</td>
                                        </tr>
                                        <tr>

                                            <td class="text-gray-900">{{$doneViews}}</td>
                                            <td class="text-gray-900">{{$notDoneViews}}</td>
                                            <td class="text-gray-900">{{$doneEmengs}}</td>
                                            <td class="text-gray-900">{{$notDoneEmengs}}</td>
                                            <td class="text-gray-900">{{$doneReviews}}</td>
                                            <td class="text-gray-900">{{$notDoneReviews}}</td>
                                            <td class="text-gray-900">{{$doneVisits}}</td>
                                            <td class="text-gray-900">{{$notDoneVisits}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row" >
                    <div class="col-md-6">
                        <div class="card border-bottom-primary border-right-primary shadow" >
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col ml-2" style="text-align:right">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">عدد الزوار
                                        </div>
                                        <div class="font-weight-bold text-gray-600 text-uppercase mb-1">العدد الإجمالي : /{{$allpatients}}/
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-bottom-primary shadow" >
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col ml-2" style="text-align:right">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">الزيارات المكتملة
                                        </div>
                                        <div class="font-weight-bold text-gray-600 text-uppercase mb-1">العدد الإجمالي : /{{$allDonePatientReviews}}/
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- جدول إحصاء للزيارات --}}

            <!-- Donut Chart -->
            <div class="col-xl-4 col-lg-5  mb-4">
                <div class="card border-top-primary border-bottom-primary  border-left-primary shadow "  style="height:100%">
                    <div class="card-body">
                        <div class="chart-pie pt-4">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small" id="names_js">
                        </div>
                        <hr class="text-center text-primary p-0 m-0">
                        <p class="text-center text-primary p-0 m-0">النسبة المئوية للزيارات</p>

                    </div>
                </div>
            </div><!-- Donut Chart -->
        </div>

        <div class="form-row">
            <div class="col-lg-6">
                <!-- Area Chart -->
                <div class="card border-top-primary border-left-primary border-bottom-primary shadow mb-4">
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                        <hr class="text-center text-primary p-0 m-0">
                        <p class="text-center text-primary p-0 m-0">الزيارت المفحوصة والزيارات الفائتة لعام ( {{Carbon\Carbon::now()->format('Y')}} )</p>
                    </div>
                </div><!-- Area Chart -->
            </div>
            <div class="col-lg-6">
                <!-- Bar Chart -->
                <div class="card border-top-primary border-right-primary border-bottom-primary shadow mb-4">
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="myBarChart"></canvas>
                        </div>
                        <hr class="text-center text-primary p-0 m-0">
                        <p class="text-center text-primary p-0 m-0">معدل الزيارات الشهري لعام ( {{Carbon\Carbon::now()->format('Y')}} )</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- DataTales Example -->

        <nav>
            <div class="nav nav-tabs font-weight-bold pr-3" id="nav-tab" role="tablist" style="direction: rtl">
                {{-- <button class="nav-link font-weight-bold  px-2" id="nav-check_device-tab" data-toggle="tab" data-target="#nav-check_device" type="button" role="tab" aria-controls="nav-check_device" aria-selected="false"><i class="fa-solid fa-house-laptop" data-toggle="tooltip" title="الأجهزة"></i></button> --}}
                <button class="nav-link font-weight-bold active px-2" id="nav-employees-tab" data-toggle="tab" data-target="#nav-employees" type="button" role="tab" aria-controls="nav-employees" aria-selected="true"><i class="fa-solid fa-users"  data-toggle="tooltip" title="الموظفين"></i>
                    @if (count($employeeusers) >0)
                        <span class="badge badge-primary badge-counter">
                            @if (count($employeeusers) > 9)
                            +9
                            @else
                            {{count($employeeusers)}}
                            @endif
                        </span>
                    @endif
                </button>
                <button class="nav-link font-weight-bold px-2" id="nav-Patient-tab" data-toggle="tab" data-target="#nav-Patient" type="button" role="tab" aria-controls="nav-Patient" aria-selected="false"><i class="fa-solid fa-user-clock" data-toggle="tooltip" title="آخر الزوار"></i></button>
                <button class="nav-link font-weight-bold px-2" id="nav-Review-tab" data-toggle="tab" data-target="#nav-Review" type="button" role="tab" aria-controls="nav-Review" aria-selected="false"><i class="fa-solid fa-elevator"  data-toggle="tooltip" title="آخر الزيارات"></i></button>
                {{-- <button class="nav-link font-weight-bold px-2" id="nav-messages-tab" data-toggle="tab" data-target="#nav-messages" type="button" role="tab" aria-controls="nav-messages" aria-selected="false"><i class="fa-regular fa-envelope"  data-toggle="tooltip" title="الرسائل"></i>
                    @if (count($messages) >0)
                        <span class="badge badge-info badge-counter">
                            @if (count($messages) > 9)
                            +9
                            @else
                            {{count($messages)}}
                            @endif
                        </span>
                    @endif
                </button> --}}
                <button class="nav-link font-weight-bold px-2" id="nav-tasks-tab" data-toggle="tab" data-target="#nav-tasks" type="button" role="tab" aria-controls="nav-tasks" aria-selected="false"><i class="fa-solid fa-list-check" data-toggle="tooltip" title="المهام"></i>
                    @if (count($tasks) >0)
                        <span class="badge badge-info badge-counter">
                            @if (count($tasks) > 9)
                            +9
                            @else
                            {{count($tasks)}}
                            @endif
                        </span>
                    @endif
                </button>
                <button class="nav-link font-weight-bold px-2" id="nav-notify-tab" data-toggle="tab" data-target="#nav-notify" type="button" role="tab" aria-controls="nav-notify" aria-selected="false"><i class="fa-regular fa-bell" data-toggle="tooltip" title="الإشعارات"></i>
                    @if (count($notificates) >0)
                        <span class="badge badge-warning badge-counter">
                            @if (count($notificates) > 9)
                            +9
                            @else
                            {{count($notificates)}}
                            @endif
                        </span>
                    @endif
                </button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            {{------------------------ check_device ------------------------------}}
            {{-- <div class="tab-pane fade show active" id="nav-check_device" role="tabpanel" aria-labelledby="nav-check_device-tab">

                <div class="card border-top-primary border-left-primary border-bottom-primary border-right-primary shadow my-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-center">جدول الأجهزة والتصريح</h6>
                    </div>
                    <div class="card-body">
                        <div>

                        </div>
                         <div class="form-row align-items-center justify-content-center" style="direction: rtl">
                            @forelse ($deviceChecks as $deviceCheck)
                                @if ($deviceCheck->state == '1' && $deviceCheck->browser_state == '1')
                                    @php
                                        $colortype='success' ;
                                    @endphp
                                @elseif ($deviceCheck->state == '0'|| $deviceCheck->browser_state == '0')
                                    @php
                                        $colortype='danger' ;
                                    @endphp
                                @elseif ($deviceCheck->state === null && $deviceCheck->browser_state === null)
                                    @php
                                        $colortype='warning' ;
                                    @endphp
                                @else
                                    @php
                                        $colortype='secondary' ;
                                    @endphp
                                @endif
                            <div class=" col-md-6 col-lg-4">


                                <div class="card border-top-{{$colortype}} border-bottom-{{$colortype}} border-right-{{$colortype}} border-left-{{$colortype}}  shadow my-2" >
                                    <div class="card-header p-2" >
                                        @if ($deviceCheck->deviceType == 'Mobile')
                                            <i class="fa-solid fa-mobile-screen text-gray-800 border-top-{{$colortype}} border-bottom-{{$colortype}} border-right-{{$colortype}} border-left-{{$colortype}} bg-gray-200 p-2" style="border-radius: 100% 100% 100% 100%; float: left;" data-toggle="tooltip" title="موبايل @if ($deviceCheck->state === null)بحاجة لتصريح@elseif ($deviceCheck->state == '1')مصرح@elseif ($deviceCheck->state == '0')محظور@endif" ></i>
                                        @elseif ($deviceCheck->deviceType == 'Tablet')
                                            <i class="fa-solid fa-tablet-screen-button text-gray-800 border-top-{{$colortype}} border-bottom-{{$colortype}} border-right-{{$colortype}} border-left-{{$colortype}} bg-gray-200 p-2" style="border-radius: 100% 100% 100% 100%; float: left;" data-toggle="tooltip" title="تاب @if ($deviceCheck->state === null)بحاجة لتصريح@elseif ($deviceCheck->state == '1')مصرح@elseif ($deviceCheck->state == '0')محظور@endif"></i>
                                        @elseif ($deviceCheck->deviceType == 'Desktop')
                                            <i class="fa-solid fa-laptop text-gray-800  border-top-{{$colortype}} border-bottom-{{$colortype}} border-right-{{$colortype}} border-left-{{$colortype}} bg-gray-200 p-2" style="border-radius: 100% 100% 100% 100%; float: left;" data-toggle="tooltip" title="مستخدم @if ($deviceCheck->state === null)بحاجة لتصريح@elseif ($deviceCheck->state == '1')مصرح@elseif ($deviceCheck->state == '0')محظور@endif"></i>
                                        @endif
                                            <a type="button"  class="mx-auto  mt-3"  onclick="document.getElementById('delete{{$deviceCheck->id}}').submit();" data-toggle="tooltip" title="حذف التصريح">
                                                <span class="badge badge-light badge-counter" ><i class="fas fa-fw fa-trash-alt text-danger fa-lg"></i></span></a>
                                            <form  id="delete{{$deviceCheck->id}}" action="{{route('mang.deleteDevice',$deviceCheck->id)}}" method="post" class="d-none">
                                                @csrf
                                            </form>
                                        <div style="float:right">
                                            @if ($deviceCheck->state != '1')
                                                <button type="submit" class="btn1 btn-circle" style="width: 0;" data-toggle="tooltip" title="إعطاء تصريح" onclick="document.getElementById('check{{$deviceCheck->id}}').submit();">
                                                    <i class="fa-regular fa-circle-check fa-xl text-success"></i>
                                                </button>
                                                <form  id="check{{$deviceCheck->id}}" action="{{route('mang.allowed_blocked_device',$deviceCheck->id)}}" method="post" class="d-none">
                                                    @csrf
                                                    <input type="hidden" name="state" value="1">
                                                </form>
                                            @endif
                                            @if ($deviceCheck->state !== null)
                                                <button type="submit" class="btn1 btn-circle" style="width: 0;" data-toggle="tooltip" title="إيقاف التصريح" onclick="document.getElementById('pause{{$deviceCheck->id}}').submit();">
                                                    <i class="fa-regular fa-circle-pause fa-xl text-warning"></i>
                                                </button>
                                                <form  id="pause{{$deviceCheck->id}}" action="{{route('mang.allowed_blocked_device',$deviceCheck->id)}}" method="post" class="d-none">
                                                    @csrf
                                                    <input type="hidden" name="state" value="">
                                                </form>
                                            @endif
                                            @if ($deviceCheck->state != '0')
                                                <button type="submit" class="btn1 btn-circle" style="width: 0;" data-toggle="tooltip" title="حظر الجهاز" onclick="document.getElementById('xmark{{$deviceCheck->id}}').submit();">
                                                    <i class="fa-regular fa-circle-xmark fa-xl text-danger"></i>
                                                </button>
                                                <form  id="xmark{{$deviceCheck->id}}" action="{{route('mang.allowed_blocked_device',$deviceCheck->id)}}" method="post" class="d-none">
                                                    @csrf
                                                    <input type="hidden" name="state" value="0">
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-body p-1" style="direction:rtl;text-align:right;height: 200px" >
                                        <ul class="text-gray-800 text-xs font-weight-bold" style="padding-right: 30px">
                                            <li> نوع الجهاز : {{$deviceCheck->deviceType}} .</li>
                                            @if ($deviceCheck->deviceType != 'Desktop')
                                                <li> اسم الجهاز : {{$deviceCheck->deviceFamily}} - {{$deviceCheck->deviceModel}} .</li>
                                            @endif
                                            <li> نظام الجهاز : {{$deviceCheck->platformName}} .</li>
                                            <li> مستعرض الجهاز : <span
                                                @if ($deviceCheck->browser_state == '1')
                                                class="text-success" data-toggle="tooltip" title="مصرح"
                                                @elseif ($deviceCheck->browser_state == '0')
                                                class="text-danger" data-toggle="tooltip" title=" محظور"
                                                @elseif ($deviceCheck->browser_state === null)
                                                class="text-warning" data-toggle="tooltip" title="بإنتظار التصريح"
                                                @endif
                                                >{{$deviceCheck->browserName}}</span> .
                                                @if ($deviceCheck->browser_state != '1')
                                                    <button type="submit" class="btn1 btn-circle" style="width: 0;height: 0;" data-toggle="tooltip" title="إعطاء تصريح للمستعرض {{$deviceCheck->browserName}}" onclick="document.getElementById('check{{$deviceCheck->browserName}}').submit();">
                                                        <i class="fa-regular fa-circle-check fa-lg text-success"></i>
                                                    </button>
                                                    <form  id="check{{$deviceCheck->browserName}}" action="{{route('mang.allowed_blocked_browser',$deviceCheck->browserName)}}" method="post" class="d-none">
                                                        @csrf
                                                        <input type="hidden" name="state" value="1">
                                                    </form>
                                                @endif
                                                @if ($deviceCheck->browser_state != null)
                                                    <button type="submit" class="btn1 btn-circle" style="width: 0;height: 0;" data-toggle="tooltip" title="إيقاف التصريح للمستعرض {{$deviceCheck->browserName}}" onclick="document.getElementById('pause{{$deviceCheck->browserName}}').submit();">
                                                        <i class="fa-regular fa-circle-pause fa-lg text-warning"></i>
                                                    </button>
                                                    <form  id="pause{{$deviceCheck->browserName}}" action="{{route('mang.allowed_blocked_browser',$deviceCheck->browserName)}}" method="post" class="d-none">
                                                        @csrf
                                                        <input type="hidden" name="state" value="">
                                                    </form>
                                                @endif
                                                @if ($deviceCheck->browser_state != '0')
                                                    <button type="submit" class="btn1 btn-circle" style="width: 0;height: 0;" data-toggle="tooltip" title="حظر المستعرض {{$deviceCheck->browserName}}" onclick="document.getElementById('xmark{{$deviceCheck->browserName}}').submit();">
                                                        <i class="fa-regular fa-circle-xmark fa-lg text-danger"></i>
                                                    </button>
                                                    <form  id="xmark{{$deviceCheck->browserName}}" action="{{route('mang.allowed_blocked_browser',$deviceCheck->browserName)}}" method="post" class="d-none">
                                                        @csrf
                                                        <input type="hidden" name="state" value="0">
                                                    </form>
                                                @endif
                                            </li>
                                            <li> ---------------------------------- </li>
                                            <li> محاولة الدخول : <span class="text-primary">{{$deviceCheck->userName}}</span> .
                                                
                                            </li>
                                            <li> الحالة :
                                                @if ($deviceCheck->state == '1')
                                                    <span class="text-{{$colortype}}">مصرح له <i class="fa-regular fa-circle-check"></i></span>
                                                @elseif ($deviceCheck->state == '0')
                                                    <span class="text-{{$colortype}}">محظور <i class="fa-regular fa-circle-xmark"></i></span>
                                                @elseif ($deviceCheck->state === null)
                                                    <span class="text-{{$colortype}}">بإنتظار التصريح <i class="fa-regular fa-circle-pause"></i></span>
                                                    @endif
                                                .</li>
                                            <li> تاريخ الطلب : {{$deviceCheck->created_at->format('D d-m-Y')}} .</li>
                                            <li> آخر تسجيل دخول: {{Carbon\Carbon::parse($deviceCheck->last_seen)->diffForHumans()}} .</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="card border-right-primary shadow h-100 py-2 my-2 mr-5">
                                <div class="card-body" >
                                    <div class="row no-gutters align-items-center" style="direction:rtl;text-align:right" >
                                        <div class="col mr-2">
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">لا يوجد أي تصريح</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endforelse
                         </div>
                    </div>
                </div>

            </div> --}}
            {{------------------------ check_device ------------------------------}}
            {{------------------------ employees ------------------------------}}
            <div class="tab-pane fade  show active" id="nav-employees" role="tabpanel" aria-labelledby="nav-employees-tab">

                <div class="card border-top-primary border-left-primary border-bottom-primary border-right-primary shadow my-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-center">جدول الموظفين</h6>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary mx-2 mb-3" style="float: right" data-toggle="modal" data-target="#CreateUser" >إضافة موظف</button>

                        <!-- Modal CreateUser -->
                        <div class="modal fade" id="CreateUser" tabindex="-1" aria-labelledby="CreateUser" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-body" style="direction:ltr">
                                        <div class="row p-2">
                                            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                                            <div class="col-lg-7">
                                                <div class="p-2">
                                                    <div class="text-center">
                                                        <h1 class="h4 text-gray-900 mb-4">إنشاء حساب</h1>
                                                    </div>
                                                    <form class="user" method="post" action="{{ route('mang.userStore') }}" style="direction:rtl" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-row">
                                                            <div class="col-xl-6 col-lg-12 mb-3">
                                                                <label class="text-xs" style="text-align:right;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">الاسم :</label>
                                                                <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" autocomplete="name" autofocus placeholder="اسم مستخدم الحساب">
                                                                @error('name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-xl-6 col-lg-12">
                                                                <label class="text-xs" style="text-align:right;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">اسم الحساب :</label>
                                                                <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror" name="username" autocomplete="username"  placeholder="الاسم المستخدم لتسجيل الدخول">
                                                                @error('username')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col-xl-6 col-lg-12 mb-3">
                                                                <label class="text-xs" style="text-align:right;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">كلمة المرور :</label>
                                                                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="كلمة المرور">
                                                                @error('password')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-xl-6 col-lg-12  mb-3">
                                                                <label class="text-xs" style="text-align:right;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">تأكيد كلمة المرور :</label>
                                                                <input type="password" class="form-control form-control-user" name="password_confirmation"  autocomplete="new-password" placeholder="تأكيد كلمة المرور">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col-lg-12  mb-3" style="direction:ltr ">
                                                                <label class="text-xs" style="text-align:right;float: right;direction:rtl;margin-bottom: 0.25rem;margin-right: 1rem;">مستوى الحساب :</label>
                                                                <select class="form-control form-control-user" name="d_o_e" style="text-align:center;padding: 0.5rem 1rem;height:50px;">
                                                                    <option value="0"  selected >موظف</option>
                                                                    <option value="1">مشرف</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <label class="text-xs" style="text-align:right;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">المزيد :</label>
                                                        <br class="m-0 p-0">
                                                        <div class="card mb-4 " style="border-radius: 35px 35px 35px 35px " >
                                                            <!-- Card Header - Accordion -->
                                                            <a href="#collapseEditMoreDetails" class="d-block py-3" data-toggle="collapse" style=""
                                                                role="button" aria-expanded="true" aria-controls="collapseEditMoreDetails">
                                                                <p class="text-xs font-weight-bold text-primary text-center mb-0">' الإيميل - الجوال - صورة الحساب - الجنس '</p>
                                                            </a>
                                                            <!-- Card Content - Collapse -->
                                                            <div class="collapse" id="collapseEditMoreDetails">
                                                                <div class="card-body px-1 py-3">
                                                                    <div class="form-row" >
                                                                        <div class="col-xl-6 col-lg-12 mb-3" style="direction:ltr">
                                                                            <label class="text-xs" style="text-align:right;direction:rtl;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">الإيميل :</label>
                                                                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" autocomplete="email" placeholder="">
                                                                            @error('email')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-12  mb-3">
                                                                            <label class="text-xs" style="text-align:right;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">الجوال :</label>
                                                                            <input type="tel" class="form-control form-control-user @error('mobile') is-invalid @enderror" name="mobile" autocomplete="mobile" placeholder="">
                                                                            @error('mobile')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-row">
                                                                        <div class="col-xl-6 col-lg-12 mb-3">
                                                                            <label class="text-xs" style="text-align:right;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">صورة الحساب :</label>
                                                                            <input type="file" class="form-control form-control-user" style="padding: 1rem; height: 50px;" name="user_image">
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-12  mb-3" style="direction:ltr ">
                                                                            <label class="text-xs" style="text-align:right;float: right;direction:rtl;margin-bottom: 0.25rem;margin-right: 1rem;">الجنس :</label>
                                                                            <select class="form-control form-control-user" name="gender" style="text-align:center;padding: 0.5rem 1rem;height:50px;">
                                                                                <option value="female" selected>أنثى</option>
                                                                                <option value="male">ذكر</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- collapseCardMoreDetails -->
                                                        <button type="submit" style="float:right"  class="btn btn-primary btn-user ">
                                                            إنشاء حساب جديد
                                                        </button>
                                                        <button type="button" style="float:right" class="btn btn-secondary btn-user">إلغاء</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal CreateUser -->

                        <div class="table-responsive text-center" style="direction:rtl">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم الموظف</th>
                                        <th>اسم الحساب</th>
                                        <th>الايميل</th>
                                        <th>رقم الجوال</th>
                                        <th>مستوى الحساب</th>
                                        <th>حالة الحساب</th>
                                        <th>الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=0
                                    @endphp
                                    @foreach ($employeeusers as $employeeuser)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$employeeuser->name}}</td>
                                            <td>{{$employeeuser->username}}</td>
                                            <td>{{$employeeuser->email}}</td>
                                            <td>{{$employeeuser->mobile}}</td>
                                            <td>
                                                @if ($employeeuser->d_o_e)
                                                    {{'مشرف'}}
                                                @else
                                                    {{'موظف'}}
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-success font-weight-bold">@if ($employeeuser->status) {{'مفعل'}} @else {{'غير مفعل'}} @endif</span>
                                            </td>
                                            <td>
                                                <div class="d-sm-block d-lg-inlineflex">
                                                    <a href="{{ route('mang.usersProfile',$employeeuser->username) }}" class="btn btn-primary btn-circle btn-sm mx-1"  data-toggle="tooltip" title="الملف الشخصي" >
                                                        <i class="fas fa-sign-in-alt text-light"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-circle btn-sm mx-1" data-toggle="modal" data-target="#DeleteUser{{$employeeuser->id}}">
                                                        <i class="fas fa-fw fa-trash text-light"  data-toggle="tooltip" title="حذف الحساب"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="DeleteUser{{$employeeuser->id}}" tabindex="-1" aria-labelledby="DeleteUser{{$employeeuser->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content" >
                                                    <div class="modal-body" style="direction: ltr">
                                                        <h5 class="text-center text-danger">رسالة تأكيد</h5>
                                                        <div class="row p-3">
                                                            <div class="col-lg-4 d-none d-lg-block bg-deleted-image"></div>
                                                            <div class="col-lg-8" style="text-align:center">
                                                                <h5 class="text-center">هل أنت متأكد من حذف الحساب ؟</h5>
                                                                <p> عند التأكيد سوف يتم حذف الحساب بشكل نهائي </p>
                                                                <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                                                <a href="{{route('mang.userDestroy',$employeeuser->username)}}" class="btn btn-danger btn-user ">تأكيد</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Delete -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
            {{------------------------ employees ------------------------------}}

            {{------------------------ Patient ------------------------------}}
            <div class="tab-pane fade" id="nav-Patient" role="tabpanel" aria-labelledby="nav-Patient-tab">

                <div class="card border-top-success border-left-success border-bottom-success border-right-success shadow my-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success text-center">آخر 15 زائر</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-center" style="direction:rtl">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المريض</th>
                                        <th>العمر</th>
                                        <th>الجنس</th>
                                        {{-- <th>زمرة الدم</th> --}}
                                        <th>هاتف</th>
                                        <th>تاريخ الزيارة</th>
                                        <th>الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=count($patients);
                                    @endphp
                                    @foreach ($patients as $patient)
                                        <tr>
                                            <td>{{$i--}}</td>
                                            <td>{{$patient->patient_name}}</td>
                                            @if ($patient->age && $patient->age != date('Y'))
                                                <td style="direction:rtl">{{date('Y') - $patient->age .' سنة'}}</td>
                                            @else
                                                <td class="text-gray-800" style="direction:rtl">--------------</td>
                                            @endif
                                            @if ($patient->gender)
                                                <td class="text-gray-800">@if ($patient->gender == 'male') {{'ذكر'}} @elseif ($patient->gender == 'female') {{'أنثى'}} @endif</td>
                                            @else
                                                <td class="text-gray-800" style="direction:rtl">--------------</td>
                                            @endif
                                            {{-- <td>
                                                @if ($patient->blood_type)
                                                {{$patient->blood_type}}
                                                @else
                                                    --------------
                                                @endif

                                            </td> --}}
                                            @if ($patient->phone)
                                                <td class="text-gray-800" style="direction:rtl">{{$patient->phone}}</td>
                                            @else
                                                <td class="text-gray-800" style="direction:rtl">--------------</td>
                                            @endif

                                            <td>{{$patient->created_at->format('D d-m-Y H:i a')}}</td>

                                            <td>
                                                <div class="d-sm-block d-lg-inlineflex">
                                                    <a href="{{ route('Clinic.patientProfile',$patient->patient_slug) }}" class="btn btn-primary btn-circle btn-sm mx-1"  data-toggle="tooltip" title="الذهاب إلى ملف المريض" >
                                                        <i class="fas fa-sign-in-alt text-light"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-circle btn-sm mx-1" data-toggle="modal" data-target="#DeletePatient{{$patient->id}}">
                                                        <i class="fas fa-fw fa-trash text-light"  data-toggle="tooltip" title="حذف ملف المريض"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="DeletePatient{{$patient->id}}" tabindex="-1" aria-labelledby="DeletePatient{{$patient->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content" >
                                                    <div class="modal-body" style="direction: ltr">
                                                        <h5 class="text-center text-danger">رسالة تأكيد</h5>
                                                        <div class="row p-3">
                                                            <div class="col-lg-4 d-none d-lg-block bg-deleted-image"></div>
                                                            <div class="col-lg-8" style="text-align:center">
                                                                <p> عند التأكيد سوف يتم نقل ملف المريض مع جميع زياراته إلى سلة المحذوفات </p>
                                                                <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                                                <a href="{{route('Clinic.softDeletesPatient',$patient->patient_slug)}}" class="btn btn-danger btn-user ">تأكيد</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Delete -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
            {{------------------------ Patient ------------------------------}}

            {{------------------------ Review ------------------------------}}
            <div class="tab-pane fade" id="nav-Review" role="tabpanel" aria-labelledby="nav-Review-tab">

                <div class="card border-top-warning border-left-warning border-bottom-warning border-right-warning shadow my-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-warning text-center">آخر 15 زيارة</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-center" style="direction:rtl">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المريض</th>
                                        <th>نوع الزيارة</th>
                                        <th>الشكاية</th>
                                        <th>القصة المرضية</th>
                                        <th>رأي الطبيب</th>
                                        <th>خطة العلاج</th>
                                        <th>تاريخ الزيارة</th>
                                        <th>الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=count($patientReviews)
                                    @endphp
                                    @foreach ($patientReviews as $patientReview)
                                        <tr>
                                            <td>{{ $i-- }}</td>
                                            <td>{{$patientReview->patient->patient_name}}</td>
                                            <td>{{$patientReview->review_type}}</td>
                                            @if ($patientReview->main_complaint)
                                                <td data-toggle="tooltip" title="{{$patientReview->main_complaint}}" style="direction:rtl">{{ \Illuminate\Support\Str::limit($patientReview->main_complaint, 40 , '...') }}</td>
                                            @else
                                                <td class="text-gray-800" style="direction:rtl">--------------</td>
                                            @endif
                                            @if ($patientReview->pain_story)
                                                <td data-toggle="tooltip" title="{{$patientReview->pain_story}}" style="direction:rtl">{{ \Illuminate\Support\Str::limit($patientReview->pain_story, 40 , '...') }}</td>
                                            @else
                                                <td class="text-gray-800" style="direction:rtl">--------------</td>
                                            @endif
                                            @if ($patientReview->medical_report)
                                                <td data-toggle="tooltip" title="{{$patientReview->medical_report}}" style="direction:rtl">{{ \Illuminate\Support\Str::limit($patientReview->medical_report, 40 , '...') }}</td>
                                            @else
                                                <td class="text-gray-800" style="direction:rtl">--------------</td>
                                            @endif
                                            @if ($patientReview->treatment_plan)
                                                <td data-toggle="tooltip" title="{{$patientReview->treatment_plan}}" style="direction:rtl">{{ \Illuminate\Support\Str::limit($patientReview->treatment_plan, 40 , '...') }}</td>
                                            @else
                                                <td class="text-gray-800" style="direction:rtl">--------------</td>
                                            @endif
                                            <td>{{$patientReview->created_at->format('D d-m-Y H:i a')}}</td>
                                            <td>
                                                <div class="d-sm-block d-lg-inlineflex">
                                                    <a href="{{ route('Clinic.patientProfile',$patientReview->patient->patient_slug) }}" class="btn btn-primary btn-circle btn-sm mx-1"  data-toggle="tooltip" title="الذهاب إلى ملف المريض" >
                                                        <i class="fas fa-sign-in-alt text-light"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-circle btn-sm mx-1" data-toggle="modal" data-target="#DeleteReview{{$patientReview->id}}">
                                                        <i class="fas fa-fw fa-trash text-light" data-toggle="tooltip" title="حذف الزيارة"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="DeleteReview{{$patientReview->id}}" tabindex="-1" aria-labelledby="DeleteReview{{$patientReview->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content" >
                                                    <div class="modal-body" style="direction: ltr">
                                                        <h5 class="text-center text-danger">رسالة تأكيد</h5>
                                                        <div class="row p-3">
                                                            <div class="col-lg-4 d-none d-lg-block bg-deleted-image"></div>
                                                            <div class="col-lg-8" style="text-align:center">
                                                                <p> عند التأكيد سوف يتم نقل الزيارة إلى سلة المحذوفات </p>
                                                                <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                                                <a href="{{route('Clinic.softDeleteReview',$patientReview->id)}}" class="btn btn-danger btn-user ">تأكيد</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Delete -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
            {{------------------------ Review ------------------------------}}

            {{------------------------ messages ------------------------------}}
            {{-- <div class="tab-pane fade" id="nav-messages" role="tabpanel" aria-labelledby="nav-messages-tab">

                <div class="card border-top-info border-left-info border-bottom-info border-right-info shadow my-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-info text-center">رسائل الموقع</h6>
                    </div>
                    <div class="card-body">
                        <a href="{{route('Clinic.readMessagesAll')}}" class="btn btn-info mx-2 mb-3" style="float: right"  >تحديد الكل كمقروء</a>
                        <a href="{{route('Clinic.destroyMessagesAll')}}" class="btn btn-danger mx-2 mb-3" style="float: right"  >حذف جميع الرسائل</a>

                        <div class="table-responsive text-center" style="direction:rtl">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>المرسل</th>
                                        <th>الايميل</th>
                                        <th>رقم الجوال</th>
                                        <th>الموضوع</th>
                                        <th>الرسالة</th>
                                        <th>الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=count($messages)
                                    @endphp
                                    @foreach ($messages as $message)
                                        <tr class="@if ($message->read_at === null) bg-gray-200 @endif">
                                            <td>{{ $i-- }}</td>
                                            <td>{{$message->name}}</td>
                                            <td>{{$message->email}}</td>
                                            <td>{{$message->mobile}}</td>
                                            <td>{{$message->title}}</td>
                                            <td data-toggle="tooltip" title="{{$message->message}}" style="direction:rtl">{{ \Illuminate\Support\Str::limit($message->message, 40 , '...') }}</td>


                                            <td>
                                                <div class="d-sm-block d-lg-inlineflex">
                                                    <a href="{{ route('Clinic.readMessage',$message->id) }}" class="btn btn-primary btn-circle btn-sm mx-1"  >
                                                        @if ($message->read_at === null)
                                                        <i class="fas fa-eye-slash text-light" data-toggle="tooltip" title="رسالة غير مقروءة"></i>
                                                        @else
                                                        <i class="fas fa-eye text-light" data-toggle="tooltip" title="رسالة مقروءة"></i>
                                                        @endif
                                                    </a>
                                                    <a class="btn btn-danger btn-circle btn-sm mx-1" data-toggle="modal" data-target="#DeleteMessage{{$message->id}}">
                                                        <i class="fas fa-fw fa-trash text-light" data-toggle="tooltip" title="حذف الرسالة"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="DeleteMessage{{$message->id}}" tabindex="-1" aria-labelledby="DeleteMessage{{$message->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content" >
                                                    <div class="modal-body" style="direction: ltr">
                                                        <h5 class="text-center text-danger">رسالة تأكيد</h5>
                                                        <div class="row p-3">
                                                            <div class="col-lg-4 d-none d-lg-block bg-deleted-image"></div>
                                                            <div class="col-lg-8" style="text-align:center">
                                                                <h5 class="text-center">هل أنت متأكد من حذف الرسالة ؟</h5>
                                                                <p> عند التأكيد سوف يتم حذف الرسالة بشكل نهائي </p>
                                                                <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                                                <a href="{{route('Clinic.destroyMessage',$message->id)}}" class="btn btn-danger btn-user ">تأكيد</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Delete -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div> --}}
            {{------------------------ messages ------------------------------}}


            {{------------------------ tasks ------------------------------}}
            <div class="tab-pane fade" id="nav-tasks" role="tabpanel" aria-labelledby="nav-tasks-tab">

                <div class="card border-top-info border-left-info border-bottom-info border-right-info shadow my-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-info text-center">جميع المهام في الموقع </h6>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary mx-2 mb-3" style="float: right" data-toggle="modal" data-target="#newTask" >إنشاء مهمة جديدة</button>
                        <a href="{{route('Clinic.doneAllTasks')}}" class="btn btn-warning mx-2 mb-3" style="float: right" >تحديد الجميع كمنفذ</a>
                        <a href="{{route('Clinic.destroyAllDoneTasks')}}" class="btn btn-success mx-2 mb-3" style="float: left" >حذف جميع المهام المنفذة</a>
                        <a href="{{route('Clinic.destroyAllTasks')}}" class="btn btn-danger mx-2 mb-3" style="float: left" >حذف جميع المهام</a>

                        <div class="table-responsive text-center" style="direction:rtl">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>موجه إلى</th>
                                        <th>المهمة</th>
                                        <th>إنجزت بواسطة</th>
                                        <th>الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=count($tasks);
                                    @endphp
                                    @foreach ($tasks as $task)
                                        <tr class="@if ($task->read_at === null) bg-gray-200 @endif">
                                            <td>{{$i--}}</td>
                                            <td>
                                                @if ($task->forUser_id === null)
                                                    الجميع
                                                @else
                                                    @if ($task->foruser)
                                                        {{$task->foruser->name}}
                                                    @else
                                                        لموظف سابق
                                                    @endif
                                                @endif
                                            </td>
                                            <td data-toggle="tooltip" title="{{$task->contant}}" style="direction:rtl">{!! \Illuminate\Support\Str::limit($task->contant, 50 , '...') !!}</td>
                                            <td>
                                                @if ($task->doneByUser_id === null)
                                                    -
                                                @else
                                                    @if ($task->donebyuser)
                                                        {{$task->donebyuser->name}}
                                                    @else
                                                        لموظف سابق
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-sm-block d-lg-inlineflex">
                                                    @if ($task->read_at === null)
                                                        <a  type="button"class="btn btn-success btn-circle btn-sm mx-1"  onclick="document.getElementById('task{{$task->slug}}').submit();" data-toggle="tooltip" title="تحديد كمنفذ">
                                                            <i class="fa-solid fa-check text-light"></i>
                                                        </a>
                                                        <form id="task{{$task->slug}}" action="{{route('Clinic.taskDone',$task->slug)}}" method="post" class="d-none">
                                                            @csrf
                                                        </form>
                                                    @else
                                                        <a href="{{ route('Clinic.unDoneTask',$task->slug) }}" class="btn btn-info btn-circle btn-sm mx-1" data-toggle="tooltip" title="تحديد كغير منفذ">
                                                            <i class="fa-solid fa-xmark text-light"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
            {{------------------------ tasks ------------------------------}}

            {{------------------------ notify ------------------------------}}
            <div class="tab-pane fade" id="nav-notify" role="tabpanel" aria-labelledby="nav-notify-tab">

                <div class="card border-top-warning border-left-warning border-bottom-warning border-right-warning shadow my-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-warning text-center">جدول إشعارات الموقع</h6>
                    </div>
                    <div class="card-body">
                        <a href="{{route('Clinic.readNotificateAll')}}" class="btn btn-info mx-2 mb-3" style="float: right">تحديد جميع الإشعارات كمقروء</a>
                        <a href="{{route('Clinic.destroyReadNotificateAll')}}" class="btn btn-warning mx-2 mb-3" style="float: left">حذف جميع الإشعارات المقروءة</a>


                        <div class="table-responsive text-center" style="direction:rtl">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>نوع الإشعار</th>
                                        <th>المصدر</th>
                                        <th>نص الإشعار</th>
                                        <th>خاص بـ</th>
                                        <th>الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=count($notificates);
                                    @endphp
                                    @foreach ($notificates as $notificate)
                                        <tr  class="@if ($notificate->read_at === null) bg-gray-200 @endif" >
                                            <td>{{$i--}}</td>

                                                {{-- {{$notificate->notify_type}} --}}
                                            @if ( $notificate->notify_type == 'newReview')
                                                <td>زيارة جديدة</td>
                                            @elseif ($notificate->notify_type == 'publictask' )
                                                <td>مهمة عامة</td>
                                            @elseif ($notificate->notify_type == 'newDevice' )
                                                <td>تصريح جديد</td>
                                            @elseif ($notificate->notify_type == 'reviewDate' )
                                                <td>حجز موعد</td>
                                            @elseif ($notificate->notify_type == 'sureryDate' )
                                                <td>حجز عملية</td>
                                            @elseif ($notificate->notify_type == 'newtask')
                                                <td>مهمة جديدة</td>
                                            @elseif ($notificate->notify_type == 'newPatient' )
                                                <td>زائر جديد</td>
                                            @elseif ($notificate->notify_type == 'delete')
                                                <td>عملية حذف</td>
                                            @elseif ($notificate->notify_type == 'donetask' )
                                                <td>إنجاز مهمة</td>
                                            @endif

                                            @if ($notificate->user->doctor_id == $notificate->user->id && $notificate->notify_type != 'newDevice' )
                                                <td>{{$notificate->user->name}}</td>
                                            @else
                                                <td>مركز الإشعارات</td>
                                            @endif

                                            <td>{{$notificate->mainMassage}}</td>
                                            @if ($notificate->nforuser != null)
                                                <td>{{$notificate->nforuser->name}}</td>
                                            @else
                                                <td>الجميع</td>
                                            @endif
                                            <td>
                                                <div class="d-sm-block d-lg-inlineflex">
                                                    @if ($notificate->read_at === null)
                                                        <a  type="button"class="btn btn-success btn-circle btn-sm mx-1"  onclick="document.getElementById('notificate{{$notificate->id}}').submit();"  data-toggle="tooltip" title="تحديد كمقروء">
                                                            <i class="fa-solid fa-check text-light"></i>
                                                        </a>
                                                        <form id="notificate{{$notificate->id}}" action="{{route('Clinic.readNotificate',$notificate->id)}}" method="post" class="d-none">
                                                            @csrf
                                                        </form>
                                                    @else
                                                        <a href="{{ route('Clinic.unReadNotificate',$notificate->id) }}" class="btn btn-info btn-circle btn-sm mx-1"  data-toggle="tooltip" title="تحديد كغير مقروء">
                                                            <i class="fa-solid fa-eye-slash text-light"></i>

                                                        </a>
                                                    @endif

                                                </div>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
            {{------------------------ notify ------------------------------}}

        </div>




    </div>

@endsection

@section('script')

    <!-- Page level plugins -->
    <script src="{{ asset('assets/MyClinicApp/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/MyClinicApp/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{ asset('assets/MyClinicApp/js/demo/chart-pie-demo.js')}}"></script>
    <script src="{{ asset('assets/MyClinicApp/js/demo/chart-bar-demo.js')}}"></script>
    {{-- @livewireScripts --}}
@endsection
