<!-- Topbar -->
@php
$current_page =Route::currentRouteName();
$firstReview= App\Models\PatientReview::Where('doctor_id', auth()->user()->doctor_id)->orderBy('created_at', 'asc')->pluck('created_at')->first();
$lastReview= App\Models\PatientReview::Where('doctor_id', auth()->user()->doctor_id)->orderBy('created_at', 'desc')->pluck('created_at')->first();


if (auth()->user()->id == auth()->user()->doctor_id) {
    $notifys= App\Models\Notificate::Where('forUser_id', auth()->user()->id)->orderBy('created_at', 'desc')->take(10)->get();
    $unreadnotifys = App\Models\Notificate::Where('forUser_id', auth()->user()->id)->whereNull('read_at')->count();


    $mytasks= App\Models\Task::where('forGroup_id', auth()->user()->doctor_id)
    ->Where('forUser_id', auth()->user()->id)->orderBy('read_at', 'asc')->orderBy('forDay', 'asc')->get();

    $unreadtasks = App\Models\Task::where('forGroup_id', auth()->user()->doctor_id)
    ->Where('forUser_id', auth()->user()->id)->whereNull('read_at')->count();

    $taskgenerals= App\Models\Task::where('forGroup_id', auth()->user()->doctor_id)
    //->whereIn('forUser_id', [ auth()->user()->id])
    ->orderBy('created_at', 'desc')->get();


} else {
    $notifys= App\Models\Notificate::where('forGroup_id', auth()->user()->doctor_id)
    // ->whereIn('forUser_id', [null, auth()->user()->id])
    ->where(function ($query)
            {
             $query->whereNull('forUser_id')->orWhere('forUser_id', auth()->user()->id);
            })
    ->orderBy('created_at', 'desc')->take(10)->get();

    $unreadnotifys = App\Models\Notificate::where('forGroup_id', auth()->user()->doctor_id)
    // ->whereIn('forUser_id', [null, auth()->user()->id])
    ->where(function ($query)
            {
             $query->whereNull('forUser_id')->orWhere('forUser_id', auth()->user()->id);
            })
    ->whereNull('read_at')->count();


    $mytasks= App\Models\Task::where('forGroup_id', auth()->user()->doctor_id)
    ->where(function ($query)
            {
             $query->whereNull('forUser_id')->orWhere('forUser_id', auth()->user()->id);
            })
    ->orderBy('read_at', 'asc')->orderBy('forDay', 'asc')->get();

    $unreadtasks = App\Models\Task::where('forGroup_id', auth()->user()->doctor_id)
    ->where(function ($query)
            {
             $query->whereNull('forUser_id')->orWhere('forUser_id', auth()->user()->id);
            })
    ->whereNull('read_at')->count();

    $taskgenerals= App\Models\Task::where('forGroup_id', auth()->user()->doctor_id)
    // ->whereNotIn('forUser_id', [auth()->user()->doctor_id])
    ->orderBy('read_at', 'asc')->take(10)->get();
}

$messages= App\Models\ContactUs::where('user_id',auth()->user()->doctor_id)->orderBy('created_at', 'desc')->take(10)->get();
$unreadmessages= App\Models\ContactUs::where('user_id',auth()->user()->doctor_id)->orderBy('created_at', 'desc')->whereNull('read_at')->count();

$clinicUsers= App\Models\User::where('doctor_id',auth()->user()->doctor_id)->get();
@endphp
{{-- @dd($firstReview) --}}

<nav class="navbar navbar-expand navbar-light bg-white topbar fixed-top shadow" style="direction: ltr">
    <a class="navbar-nav d-none d-md-block" href="{{route('Clinic.welcome')}}">
        <h2 class="py-1 text-primary"><b>My Clinic</b></h2>
    </a>
    @guest
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('Clinic.login') }}">{{ __('Login') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('Clinic.register') }}">{{ __('Register') }}</a>
            </li>
        </ul>

    @else
        <!-- Topbar Search -->

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
            {{-- <!-- languages -->
            <li class="nav-item dropdown no-arrow ">{{config('app.locale')}}</li>
            <!-- languages --> --}}

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow ">
                <a class="nav-link dropdown-toggle"  id="searchDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  data-toggle="tooltip" title="البحث">
                    <i class="fas fa-search fa-fw fa-lg"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in "
                    aria-labelledby="searchDropdown">
                    <form method="get" action="{{route('Clinic.Search')}}" class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group" style="width: 100% ;direction: rtl">
                            <a href="{{route('Clinic.newPatient')}}" class="btn btn-primary" style=" float: right;border-radius: 0 8px  8px 0;" type="button">
                                <i class="fas fa-fw fa-person-circle-plus fa-lg"></i>
                            </a>
                            <input type="text"  class="form-control bg-light border-0 small" name="keyword"  value="{{ old('keyword',request()->keyword) }}" placeholder="البحث عن..." aria-label="Search" aria-describedby="basic-addon2" style="border-radius: 0;">
                            <div class="input-group-append">
                                <button class="btn btn-primary" style="border-radius: 8px 0 0 8px;" type="submit">
                                    <i class="fas fa-search fa-lg"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <!-- Nav Item - Export -->
            @if (auth()->user()->d_o_e == 1)
                <li class="nav-item dropdown no-arrow ">
                    <a class="nav-link dropdown-toggle"  id="export" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  data-toggle="tooltip" title="التصدير">
                        <i class="fa-solid fa-download  fa-lg"></i>

                    </a>

                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in "
                        aria-labelledby="export">
                        <div class="d-block">
                            <form action="{{route('Clinic.export_excel_reviews_monthly')}}" method="post" style="direction:rtl" class="form-inline mr-auto w-100 navbar-search">
                                @csrf
                                <label class="text-xs pb-1 px-1 font-weight-bold" style="text-align: right">تصدير جدول الزيارات :</label>
                                <div class="input-group" style="width: 100% ;direction: rtl">
                                    <a href="{{route('Clinic.export_excel_reviews')}}" class="btn btn-primary" style=" float: right;border-radius: 0 8px  8px 0;" type="button"  data-toggle="tooltip" title="تصدير جدول الزيارات">
                                        {{-- <i class="fa-solid fa-cart-arrow-down"></i> --}}
                                        {{-- <i class="fa-solid fa-file-arrow-down"></i> --}}
                                        <i class="fa-solid fa-layer-group  fa-lg"></i>

                                    </a>
                                    <input type="month"  min="{{$firstReview->format('Y-m')}}" max="{{$lastReview->format('Y-m')}}" class="form-control bg-light border-0 small" required name="month" value="{{ old('month',request()->month) }}" placeholder="البحث عن..." aria-label="Search" aria-describedby="basic-addon2" style="border-radius: 0 8px   8px 0;">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" style="border-radius: 8px 0 0 8px;" type="submit"  data-toggle="tooltip" title="تصدير جدول زيارات الشهر المحدد ">
                                            {{-- <i class="fa-solid fa-file-arrow-down"></i> --}}
                                            <i class="fa-solid fa-calendar-days fa-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <form action="{{route('Clinic.export_excel_patients_monthly')}}" method="post" style="direction:rtl" class="form-inline mr-auto w-100 navbar-search pt-1">
                                @csrf
                                <label class="text-xs p-1 font-weight-bold" style="text-align: right">تصدير معلومات المرضى :</label>
                                <div class="input-group" style="width: 100% ;direction: rtl">
                                    <a href="{{route('Clinic.export_excel_patients')}}" class="btn btn-primary " style=" float: right;border-radius: 0 8px  8px 0;" type="button"  data-toggle="tooltip" title="تصدير جدول المرضى">
                                        {{-- <i class="fa-solid fa-cart-arrow-down"></i> --}}
                                        {{-- <i class="fa-solid fa-file-arrow-down"></i> --}}
                                        <i class="fa-solid fa-users-between-lines  fa-lg" style="font-size:large"></i>
                                        {{-- <i class="fa-solid fa-users-line"></i> --}}
                                        {{-- <i class="fa-solid fa-people-group"></i> --}}
                                        {{-- <i class="fa-solid fa-user-group"></i> --}}

                                    </a>
                                    <input type="month" min="{{$firstReview->format('Y-m')}}" max="{{$lastReview->format('Y-m')}}"  class="form-control bg-light border-0 small" required name="month" value="{{ old('month',request()->month) }}" placeholder="البحث عن..." aria-label="Search" aria-describedby="basic-addon2" style="border-radius: 0 8px   8px 0;">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" style="border-radius: 8px 0 0 8px;" type="submit"  data-toggle="tooltip" title="تصدير جدول مرضى الشهر المحدد ">
                                            {{-- <i class="fa-solid fa-file-arrow-down"></i> --}}
                                            <i class="fa-solid fa-calendar-days  fa-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </li>
            @endif
            <!-- Nav Item - task -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle"  id="taskDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  data-toggle="tooltip" title="المهام">
                    <i class="fa-regular fa-clipboard  fa-lg"></i>
                    <!-- Counter - Messages -->
                    @if ($unreadtasks >0)
                        <span class="badge badge-warning badge-counter">
                            @if ($unreadtasks > 9)
                            +9
                            @else
                            {{$unreadtasks}}
                            @endif
                        </span>
                    @endif
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in  pb-3"
                    aria-labelledby="taskDropdown"  style="height: 320px;">
                    <h1 class="dropdown-header text-center" style="font-size:1rem"><a class="text-light" type="button" href="{{route('Clinic.tasksPage')}}">
                            مركز المهام</a>
                            @if (auth()->user()->id == auth()->user()->doctor_id)
                                <a class="text-light ml-2" style="float: right" role="button"  data-toggle="modal" data-target="#newTask">
                                    <i class="fa-regular fa-pen-to-square fa-lg" data-toggle="tooltip" title="مهمة جديدة"></i>
                                </a>
                            @endif
                             <a class="text-light nav-link" style="float: right;padding:0 0.75rem;height: unset;display: unset;"  role="button"  data-toggle="modal" data-target="#myTasks">
                                <i class="fa-regular fa-clipboard fa-lg" data-toggle="tooltip" title="مهامي"></i>
                                @if ($unreadtasks >0)
                                    <span class="badge badge-warning badge-counter">
                                        @if ($unreadtasks > 9)
                                        +9
                                        @else
                                        {{$unreadtasks}}
                                        @endif
                                    </span>
                                @endif
                            </a>
                    </h1>
                    <div style="overflow-y: auto;height: 100%;padding: 0 0 25px 0;">
                        <a class="dropdown-item text-center small text-gray-700 bg-gray-100"><b>مهام العيادة
                            @if (count($taskgenerals->where('forUser_id','<>',auth()->user()->doctor_id)->where('read_at',null)) >0)
                                المتبقية - ( {{count($taskgenerals->where('forUser_id','<>',auth()->user()->doctor_id)->where('read_at',null))}} )
                            @endif

                        </b></a>

                        @forelse ($taskgenerals->where('forUser_id','<>',auth()->user()->doctor_id) as $task)

                            <a class="dropdown-item d-flex align-items-center  @if ($task->read_at == null) bg-gray-300 @endif " href="{{route('Clinic.tasksPage')}}" style="direction: rtl ;text-align:right">
                                <div class="dropdown-list-image ml-2">
                                    @if ($task->forUser_id == null )
                                        <img class="rounded-circle ml-2" src="{{asset('assets/MyClinicApp/image/1.gif')}}"  style=" height: 40px;width: 40px;">
                                        <div class="status-indicator bg-primary"></div>{{-- دائرة صغيرة بجانب صورة الأفتار --}}
                                    @else
                                        <div class=" bg-gray-200 rounded-circle ml-2" style=" height: 40px;width: 40px;">
                                            <i class=" text-center text-danger fa-solid fa-user-slash fa-xl fa-bounce  mt-4 mr-2"></i>
                                            <div class="status-indicator bg-danger"></div>{{-- دائرة صغيرة بجانب صورة الأفتار --}}
                                        </div>
                                    @endif
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">{{$task->contant}} .</div>
                                    <div class="small text-gray-500">

                                        @if ($task->forUser_id == null)
                                            مهمة عامة
                                        @else
                                            @if ($task->foruser && $task->foruser->doctor_id == $task->forGroup_id)
                                                مهمة لـ {{$task->foruser->name}}
                                            @else
                                                مهمة لموظف سابق
                                            @endif

                                        @endif

                                        · {{$task->created_at->locale('ar')->diffForHumans()}}</div>
                                </div>
                            </a>
                        @empty
                                <a class="dropdown-item text-center text-gray-700">لا يوجد أي مهمة للعيادة</a>


                        @endforelse
                            <a class="dropdown-item text-center small text-gray-500"> </a>


                    </div>
                </div>
            </li><!-- Nav Item - task -->




            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" id="alertsDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  data-toggle="tooltip" title="الإشعارات">
                    <i class="fas fa-bell fa-fw  fa-lg"></i>
                    <!-- Counter - Alerts -->
                    @if ($unreadnotifys >0)
                        <span class="badge badge-danger badge-counter">
                            @if ($unreadnotifys > 9)
                            +9
                            @else
                            {{$unreadnotifys}}
                            @endif
                        </span>
                    @endif
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in pb-3"
                    aria-labelledby="alertsDropdown" style="height: 320px;">
                    <h1 class="dropdown-header text-center" style="font-size:1rem"><a class="text-light" type="button" href="{{route('Clinic.notificationsPage')}}">
                        مركز الإشعارات</a>
                    </h1>
                    <div style="overflow-y: auto;height: 100%;padding: 0 0 25px 0;">
                    <a class="dropdown-item text-center small text-gray-700 bg-gray-100" href="{{route('Clinic.readNotificateAll')}}"><b>تحديد الكل كمقروء</b></a>

                        @forelse ($notifys as $notify)
                            <a type="button" class="dropdown-item d-flex align-items-center @if ($notify->read_at == null) bg-gray-300 @endif " style="direction: rtl ;text-align:right"
                                @if (($notify->notify_type == 'newtask' ||  $notify->notify_type == 'publictask') && $current_page == 'Clinic.index' && (auth()->user()->id != auth()->user()->doctor_id) )
                                    role="button"  data-toggle="modal" data-target="#clinicTasks">
                                @elseif (($notify->notify_type == 'newtask' ||  $notify->notify_type == 'publictask') && $current_page != 'Clinic.index')
                                    href="{{route('Clinic.tasksPage')}}"  >
                                @elseif ($notify->notify_type == 'newDevice' && $current_page != 'Clinic.D_borad')
                                    role="button"  data-toggle="modal" data-target="#dashbord">
                                @else
                                      onclick="document.getElementById('notify{{$notify->id}}').submit();">
                                @endif
                                <div class="ml-2">
                                    <div class="icon-circle
                                        @if ( $notify->notify_type == 'newReview')
                                        bg-warning
                                        @elseif ($notify->notify_type == 'newPatient' || $notify->notify_type == 'newtask' || $notify->notify_type == 'publictask' )
                                        bg-info
                                        @elseif ($notify->notify_type == 'delete' || $notify->notify_type == 'sureryDate')
                                        bg-danger
                                        @elseif ($notify->notify_type == 'donetask' || $notify->notify_type == 'reviewDate' )
                                        bg-success
                                        @elseif ($notify->notify_type == 'newDevice' )
                                        bg-secondary
                                        @endif
                                    ">
                                        {!! $notify->icon !!}
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-center text-gray-500" style="direction: rtl;">{{$notify->created_at->locale('ar')->diffForHumans()}}</div>
                                    <span @if ($notify->read_at == null) class="font-weight-bold"  @endif >
                                        <div class="text-truncate text-xs">{{$notify->mainMassage}} . </div>
                                        {{-- @if ($notify->notify_type == 'newPatient' )
                                            <a class="text-xs text-center text-gray-500" href="{{route('Clinic.patientProfile',$notify->connect)}}">لزيارة ملف المريض إضغط هنا </a>
                                        @endif --}}
                                    </span>
                                </div>
                            </a>
                            <form id="notify{{$notify->id}}" action="{{route('Clinic.readNotificate',$notify->id)}}" method="post" class="d-none">
                                @csrf
                            </form>
                        @empty
                            <a class="dropdown-item text-center text-gray-700">لا يوجد لديك أي إشعار</a>
                        @endforelse

                        <a class="dropdown-item text-center small text-gray-500"> </a>


                    </div>
                </div>
            </li>

            {{-- <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle"  id="messagesDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  data-toggle="tooltip" title="الرسائل">
                    <i class="fas fa-envelope fa-fw fa-lg"></i>
                    <!-- Counter - Messages -->
                    @if ($unreadmessages >0)
                        <span class="badge badge-danger badge-counter">
                            @if ($unreadmessages > 9)
                            +9
                            @else
                            {{$unreadmessages}}
                            @endif
                        </span>
                    @endif
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in  pb-3"
                    aria-labelledby="messagesDropdown"  style="height: 320px;">
                    <h1 class="dropdown-header text-center" style="font-size:1rem"><a class="text-light" type="button" href="{{route('Clinic.messagesPage')}}">
                         مركز الرسائل</a>
                    </h1>
                    <div style="overflow-y: auto;height: 100%;padding: 0 0 25px 0;">
                        <a class="dropdown-item text-center small text-gray-700 bg-gray-100" href="{{route('Clinic.readMessagesAll')}}"><b>تحديد الكل كمقروء</b></a>

                        @forelse ($messages as $message)

                            <a class="dropdown-item d-flex align-items-center  @if ($message->read_at == null) bg-gray-300 @endif " href="{{route('Clinic.messagesPage')}}" style="direction: rtl ;text-align:right">
                                <div class="dropdown-list-image ml-2">
                                    <img class="rounded-circle" src="">
                                     <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">{{$message->message}} .</div>
                                    <div class="small text-gray-500">{{$message->name}} · {{$message->created_at->locale('ar')->diffForHumans()}}</div>
                                </div>
                            </a>
                        @empty
                             <a class="dropdown-item text-center text-gray-700">لا يوجد لديك أي بريد</a>


                        @endforelse
                            <a class="dropdown-item text-center small text-gray-500"> </a>


                    </div>
                </div>
            </li> --}}

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle"  id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{auth()->user()->name}}</span>
                    <img class="img-profile rounded-circle" src="{{asset('/assets/users/'.auth()->user()->user_image)}}">
                    
                </a>
                <!-- Dropdown - User Information -->

                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in "
                    aria-labelledby="userDropdown" style="direction:rtl;text-align: right;width: auto;">
                    <a class="dropdown-item" href="{{route('mang.usersProfile',auth()->user()->username)}}">
                        <i class="fas fa-user fa-md fa-fw ml-2 text-gray-400"></i>
                        <span>الصفحة الشخصية</span>
                    </a>
                    @if (auth()->user()->id == auth()->user()->doctor_id)
                        <a class="dropdown-item" href="/*{{route('Clinic.D_borad')}}*/" data-toggle="modal" data-target="#dashbord">
                            <i class="fas fa-cogs fa-md fa-fw ml-2 text-gray-400"></i>
                            لوحة القيادة
                        </a>
                    @endif
                    <a class="dropdown-item" href="{{route('Clinic.mangementPage')}}">
                        <i class="fas fa-list fa-md fa-fw ml-2 text-gray-400"></i>
                        صفحة الإدارة
                    </a>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" type="button" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-md fa-fw ml-2 text-gray-400"></i>
                        تسجيل الخروج
                    </a>


                </div>
            </li>

        </ul>
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle ml-1">
            <i class="fa fa-bars  fa-lg"></i>
        </button>
    @endguest

</nav>
<!-- End of Topbar -->


<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="text-center text-primary pt-3">تسجيل الخروج</h5>
                <div class="row p-3">
                    <div class="col-lg-6 d-none d-lg-block bg-logout-image"></div>
                    <div class="col-lg-6 text-center">
                        <h5 class="text-center">هل أنت متأكد من الرحيل ؟</h5>
                        <p>إضغط تأكيد لإنهاء الجلسة الحالية</p>
                        <a class="btn btn-primary btn-user" href="{{ route('Clinic.logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            تأكيد
                        </a>

                        <form id="logout-form" action="{{ route('Clinic.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <button class="btn btn-secondary btn-user" type="button" data-dismiss="modal">تراجع</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal dashbord -->
<div class="modal fade" id="dashbord" tabindex="-1" role="dialog" aria-labelledby="dashbord"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="text-center text-primary pt-3">التحقق</h5>
                <form action="{{route('Clinic.D_boradCheck')}}" method="post">
                    @csrf
                    <div class="text-center">
                        <label class="text-xs text-gray-800 font-weight-bold" for="password">كلمة مرور لوحة القيادة :</label>
                        <input id="password" type="password" class="mb-2 form-control form-control-user @error('password') is-invalid @enderror" name="password" required placeholder="كلمة المرور">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <button class="btn btn-primary btn-user" type="submit">تأكيد</button>
                        <button class="btn btn-secondary btn-user" type="button" data-dismiss="modal">تراجع</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal newTask -->
<div class="modal fade" id="newTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header py-3 px-1">
                <h1 class="h6 font-weight-bold text-center w-100 text-primary mb-1">إنشاء مهمة جديدة
                    @if (auth()->user()->id == auth()->user()->doctor_id)
                        <a class="text-primary" style="float: right" role="button"  data-toggle="modal"  data-dismiss="modal" data-target="#myTasks">
                            <h1 class="text-xs font-weight-bold text-primary mb-1 mr-1" data-toggle="tooltip" title="المهام الخاصة">مهامي
                                <i class="fa-solid fa-clipboard-list  fa-lg"></i>
                            </h1>
                        </a>
                    @endif
                </h1>
            </div>
            <div class="modal-body py-1" style="direction:ltr">
                <form class="user" method="post" action="{{route('Clinic.storetask')}}">
                    @csrf
                    <div class="form-row ">
                        <div class="col-12 mb-1 position-relative">
                            <label class="text-xs" style="direction:rtl; text-align:right;float: right;">المهمة المطلوبة :</label>
                            <textarea  id="new_task"  class="VoiceToText form-control @error('contant') is-invalid @enderror" required name="contant" rows="7"  style="padding: 0.375rem 0.75rem;text-align:center" placeholder=""></textarea>
                                @error('contant')
                                    <span class="invalid-feedback text-center" role="alert">
                                        <strong >{{ $message }}</strong>
                                    </span>
                                @enderror
                            <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;" for="new_task">
                                <i class="fa-solid fa-microphone-lines fa-beat text-primary  fa-lg"></i>
                            </button>
                        </div>
                        <div class=" mb-1 col-12" style="direction:rtl;text-align:right">
                            <div class="custom-radio custom-control-inline">
                                <label class="text-xs"  style="text-align:right;float: right;">لـ : </label>
                            </div>
                            <div class="card d-block p-2" style="font-size: 85%" >
                                @foreach ($clinicUsers as $clinicUser)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if ($clinicUser->id == $clinicUser->doctor_id)
                                            <input type="radio" id="clinicUser{{$clinicUser->id}}" checked name="for" value="{{$clinicUser->name}}" class="custom-control-input">
                                            <label class="text-gray-900 custom-control-label" for="clinicUser{{$clinicUser->id}}">
                                                <b class="text-primary">
                                                    خاصة بي
                                                </b>
                                            </label>
                                        @else
                                            <input type="radio" id="clinicUser{{$clinicUser->id}}" name="for" value="{{$clinicUser->name}}" class="custom-control-input">
                                            <label class="text-gray-900 custom-control-label" for="clinicUser{{$clinicUser->id}}">
                                                <b>{{$clinicUser->name}}</b>
                                            </label>
                                        @endif
                                    </div>
                                @endforeach
                                @if (count($clinicUsers)>2)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="clinicUser" name="for" value="all" class="custom-control-input">
                                        <label class="custom-control-label text-gray-700" for="clinicUser"><b>الجميع</b></label>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12  mb-3" style="direction:rtl" >
                            <label class="text-xs" style="text-align:right;float: right;">الموعد :</label>
                            <input type="datetime-local"  min="{{Carbon\Carbon::today()}}" class="form-control @error('forDay') is-invalid @enderror" name="forDay" style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
                            @error('forDay')
                                <span class="invalid-feedback text-center" role="alert">
                                    <strong >{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
            </div>
            <div class="modal-footer py-1" style="direction: ltr">
                <button type="button" class="btn btn-secondary btn-user mx-1" data-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-primary btn-user mx-1" autofocus> إنشاء مهمة</button>
            </div>
                </form>
        </div>
    </div>
</div>
<!-- Modal newTask -->
<!-- Modal myTasks -->
<div class="modal fade" id="myTasks" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header py-2 px-1">
                <h1 class="h6 font-weight-bold text-center w-100 text-primary mb-1">
                @if (auth()->user()->id == auth()->user()->doctor_id)
                    ملاحظاتي
                @else
                    مهامي
                @endif
                @if ($unreadtasks>0)
                    ({{$unreadtasks}})
                @endif
                    @if (auth()->user()->id == auth()->user()->doctor_id)
                        <a class="text-primary" style="float: right" role="button"  data-toggle="modal"  data-dismiss="modal" data-target="#newTask">
                            <h1 class="text-xs font-weight-bold text-primary mb-1 mr-1" data-toggle="tooltip" title=" إنشاء مهمة جديدة">مهمة جديدة
                                <i class="fa-regular fa-pen-to-square  fa-lg"></i>
                            </h1>
                        </a>
                    @endif
                </h1>
            </div>
            <div class="modal-body p-1" style="direction:ltr">
                <div class="my-1">
                    @forelse ($mytasks as $task)
                        <div class=" card border-right-primary shadow h-100 py-1 mt-1 ">

                            <div class="card-body @if ($task->read_at == null) bg-gray-300 @endif p-2" >
                                <div class="row no-gutters align-items-center" style="direction:rtl;text-align:right" >
                                    <div class="col-auto ml-2">
                                        <img class="rounded-circle ml-2" src="{{asset('assets/MyClinicApp/image/1.gif')}}"  style=" height: 40px;width: 40px;">
                                    </div>
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">

                                            @if ($task->foruser )
                                            مهامي الشخصية :
                                            @elseif ($task->forUser_id == null )
                                            مهمة عامة  :
                                            @endif
                                            @if ($task->read_at != null && $task->doneByUser_id != null )
                                                <span class="text-success">- تم الإنجاز
                                            @else
                                                <span class="text-danger">- لم يتم الإنجاز بعد</span>

                                            @endif
                                            <div style="float: left">
                                                <!-- Default dropright button -->
                                                <div class="btn-group dropright d-md-block ">
                                                    <button type="button"  class="btn btn-light btn-circle btn-sm mb-1 rounded-circle" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-regular fa-lightbulb  fa-xl text-warning"></i>
                                                    </button>
                                                    <div class="dropdown-menu p-1" style="direction: rtl;text-align:right;width:260px;border: 1px solid;">
                                                        @if ($task->forDay)
                                                            <small class="text-xs text-gray-900"><b>- لتاريخ : {{\Carbon\Carbon::parse($task->forDay)->diffForHumans()}} <br>- {{\Carbon\Carbon::parse($task->forDay)->format('D d/m/Y - h:i a')}}</b></small><hr class="m-0 p-0">
                                                        @endif
                                                        <div style="float: right;display: grid">
                                                            <small class="text-xs" style="float: left;direction: rtl;"><b> -وقت الإنشاء : {{$task->created_at->format('D d/m/Y - h:i a')}}</b></small>
                                                            @if ($task->read_at !=null)
                                                                <small class="text-xs text-success" style="float: left;direction: rtl;"><b>- تم الإنجاز : {{\Carbon\Carbon::parse($task->read_at)->format('D d/m/Y - h:i a')}}</b></small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div><!-- Default dropright button -->
                                            </div>
                                        </div>
                                        <div class="h6 my-2 font-weight-bold text-gray-800"> {{$task->contant}}</div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer p-1" >
                                <div class="px-4 d-block">
                                    <small ><b style="text-align: right;direction: rtl;float:right"><a  type="button" class="text-primary" onclick="document.getElementById('task{{$task->slug}}').submit();"> تم إنجاز المهمة <i class="fa-regular fa-circle-check text-primary  fa-lg"></i></a></b></small>
                                    <form id="task{{$task->slug}}" action="{{route('Clinic.taskDone',$task->slug)}}" method="post" class="d-none">
                                        @csrf
                                    </form>
                                    <small ><b style="text-align: right;direction: rtl;float:right"><a  type="button" class="text-dark" href="{{route('Clinic.unDoneTask',$task->slug)}}">&nbsp;- تراجع <i class="fa-regular fa-circle-xmark  fa-lg"></i></a></b></small>

                                    @if (auth()->user()->id == auth()->user()->doctor_id)
                                        <div class="text-center h-auto" style="float: left;width: auto;">
                                            <a href="{{route('Clinic.destroyDoctorNotesTasks',$task->slug)}}"><i class="fas fa-fw fa-trash-alt text-danger fa-lg"></i></a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    @empty
                        <div class="card border-right-primary shadow h-100 py-2 my-2">
                            <div class="card-body" >
                                <div class="row no-gutters align-items-center" style="direction:rtl;text-align:right" >
                                    <div class="col mr-2">
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">لا يوجد أي مهمة</div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>
            <div class="modal-footer py-1" style="direction: ltr">
                <button type="button" class="btn btn-primary btn-user" data-dismiss="modal">عودة</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal myTasks -->
