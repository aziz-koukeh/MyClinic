@extends('layouts.myClinic')

@section('style')

@endsection
@section('content')

<div class="pb-5 mt-3">
    @if (count($errors)>0)
        @foreach ($errors->all() as $item)
            <div class="alert alert-secondary" role="alert">
                {{$item}}
            </div>
        @endforeach
    @endif
    <ul class="nav nav-tabs pr-1">
        <li class="nav-item">
          <a class="nav-link active px-3"><b>الإدارة</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-2" href="{{route('Clinic.tasksPage')}}"><b>المهام</b>
                @if ($tasks >0)
                    <span class="badge badge-warning badge-counter">
                        @if ($tasks > 9)
                        +9
                        @else
                        {{$tasks}}
                        @endif
                    </span>
                @endif
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link px-2" href="{{route('Clinic.messagesPage')}}"><b>الرسائل</b>
                @if ($messages >0)
                    <span class="badge badge-warning badge-counter">
                        @if ($messages > 9)
                        +9
                        @else
                        {{$messages}}
                        @endif
                    </span>
                @endif
            </a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link  px-2" href="{{route('Clinic.notificationsPage')}}"><b>الإشعارات</b>
                @if ($notificates >0)
                    <span class="badge badge-warning badge-counter">
                        @if ($notificates > 9)
                        +9
                        @else
                        {{$notificates}}
                        @endif
                    </span>
                @endif
            </a>
        </li>
      </ul>

    <br>

    <ul class="nav nav-tabs font-weight-bold pr-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><b>الموظفين</b></button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false"><b>حول</b></button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row py-4 px-2">
                <div class="col-3 ">
                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-home-tab" data-toggle="pill" data-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><b>الكل</b></button>
                    @if (auth()->user()->d_o_e ==1)
                        <button class="nav-link" id="v-pills-profile-tab" data-toggle="pill" data-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><b>إضافة موظف</b></button>
                    @endif

                  </div>
                </div>
                <div class="col-9 mb-5">
                  <div class="tab-content" id="v-pills-tabContent">

                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="form-row align-items-center justify-content-center">
                            @forelse ($employeeusers as $employeeuser)
                                 @if ($employeeuser->id != $employeeuser->doctor_id)
                                    <div class="col-lg-6">
                                        <div class="card border-right-secondery shadow h-100 py-2 my-2">
                                            <div class="card-body" >
                                                <div class="row no-gutters align-items-center" >
                                                    <div class="col-auto">
                                                        
                                                            <img class="rounded-circle ml-2" src="{{asset('/assets/users/'.$employeeuser->user_image)}}" style=" height: 80px;width: 80px;">
                                                        
                                                        @if ($employeeuser->status == 1)
                                                            <div class="status-indicator1 bg-success"  data-toggle="tooltip" title="حساب نشط"></div>
                                                        @else
                                                            <div class="status-indicator1 bg-warning" data-toggle="tooltip" title="حساب غير نشط"></div>
                                                        @endif

                                                    </div>
                                                    <div class="col mr-2 ">
                                                        <div class="font-weight-bold text-center text-primary text-uppercase mb-1">{{$employeeuser->name}}</div>
                                                        <div style="text-align:right;direction:rtl" class="text-xs h6 mb-0 font-weight-bold text-gray-800">رقم الهاتف : <span >{{$employeeuser->mobile}}</span></div>
                                                        <div style="text-align:right;direction:rtl" class="text-xs h6 mb-0 font-weight-bold text-gray-800">الإيميل : <span >{{$employeeuser->email}}</span></div>
                                                        <div style="text-align:right;direction:rtl" class="text-xs h6 mb-0 font-weight-bold text-gray-800">تاريخ الإنضمام : <span >{{$employeeuser->created_at->format('D m y h:i a')}}</span></div>
                                                    </div>

                                                </div>
                                            </div>
                                            @if (auth()->user()->d_o_e ==1)
                                                <div class="card-footer text-center" >
                                                    <small><b>
                                                        <a class="text-primary" type="button" data-toggle="modal" data-target="#EditUser{{$employeeuser->id}}">تعديل الملف الشخصي</a> -
                                                        {{-- <a href="" class="text-info">تعديل الصلاحيات</a> - --}}
                                                        <a class="text-danger"  type="button" data-toggle="modal" data-target="#DeleteUser{{$employeeuser->id}}">حذف الملف</a>
                                                    </b></small>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                 @endif
                                <!-- Modal Delete -->
                                <div class="modal fade" id="DeleteUser{{$employeeuser->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body" >
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
                                <!-- Modal EditUser -->
                                <div class="modal fade" id="EditUser{{$employeeuser->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-body" style="direction:ltr">
                                                <div class="text-center">
                                                    <h1 class="h6 font-weight-bold text-primary mb-4">تعديل حساب {{$employeeuser->name}}</h1>
                                                </div>
                                                <hr>
                                                <form class="user" method="post" action="{{ route('mang.userUpdate',$employeeuser->id) }}" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="row p-2" style="direction: rtl">
                                                    <div class="col-lg-7">
                                                        <div class="p-2">

                                                            <div class="form-row">
                                                                <div class="col-xl-6 col-lg-12 mb-3">
                                                                    <label class="text-xs" style="text-align:right;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">الاسم :</label>
                                                                    <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{$employeeuser->name }}"  autocomplete="name" autofocus placeholder="اسم مستخدم الحساب">
                                                                    @error('name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-xl-6 col-lg-12">
                                                                    <label class="text-xs" style="text-align:right;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">اسم الحساب :</label>
                                                                    <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror" name="username" value="{{$employeeuser->username }}"  autocomplete="username"  placeholder="الاسم المستخدم لتسجيل الدخول">
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
                                                                    <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                                                                    @error('password')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-xl-6 col-lg-12  mb-3">
                                                                    <label class="text-xs" style="text-align:right;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">تأكيد كلمة المرور :</label>
                                                                    <input type="password" class="form-control form-control-user" name="password_confirmation"  autocomplete="new-password">
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-lg-12  mb-3" style="direction:ltr ">
                                                                    <label class="text-xs" style="text-align:right;float: right;direction:rtl;margin-bottom: 0.25rem;margin-right: 1rem;">مستوى الحساب :</label>
                                                                    <select class="form-control form-control-user" name="d_o_e" style="text-align:center;padding: 0.5rem 1rem;height:50px;">
                                                                        <option value="1" @if ($employeeuser->d_o_e == 1 ) selected @endif>مشرف</option>
                                                                        <option value="0" @if ($employeeuser->d_o_e == 0 ) selected @endif>موظف</option>
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
                                                                                <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{$employeeuser->email }}"  autocomplete="email" placeholder="">
                                                                                @error('email')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="col-xl-6 col-lg-12  mb-3">
                                                                                <label class="text-xs" style="text-align:right;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">الجوال :</label>
                                                                                <input type="tel" class="form-control form-control-user @error('mobile') is-invalid @enderror" name="mobile" value="{{$employeeuser->mobile }}"  autocomplete="mobile" placeholder="">
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
                                                                                    <option value="male" @if ($employeeuser->gender == 'male' ) selected @endif>ذكر</option>
                                                                                    <option value="female" @if ($employeeuser->gender == 'female' ) selected @endif>أنثى</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><!-- collapseCardMoreDetails -->


                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5  d-none d-lg-block bg-register-image">

                                                    </div>
                                                </div>
                                                <hr>

                                                <button type="submit" style="float:right"  class="btn btn-primary btn-user ">
                                                    تعديل
                                                </button>
                                                <button type="button" style="float:right" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal EditUser -->
                            @empty
                            @endforelse


                        </div>
                    </div>


                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                        <div class="row p-2" style="direction:ltr">
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
        </div>

        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

            <div class="container-fluid pb-5 px-2 mb-5 mt-4">
                <div class=" card border-right-primary shadow h-100 py-1 mt-1 " style="direction:rtl;text-align: right">
                    <div class="card-body px-2">

                        <div class="form-row p-2">

                            <div class="col-md-7">
                                <div class="h5 font-weight-bold text-primary text-uppercase mb-2">حول <a data-toggle="modal" data-target="#EditDoctorInfo">ا</a>لطبيب</div>
                                <hr class="text-primary">
                                @if($doctor_info->university || $doctor_info->med_specialty)<div class="h6 mb-1 font-weight-bold text-gray-800">@if($doctor_info->university) - درس الطبيب في جامعة {{$doctor_info->university}} @endif @if($doctor_info->med_specialty) حاز على شهادة  {{$doctor_info->med_specialty}} @endif.</div> @endif
                                @if($doctor_info->exp_about || $doctor_info->exp_work_year) <div class="h6 mb-1 font-weight-bold text-gray-800">@if($doctor_info->exp_about) - مجالات التخصص تشمل : {{$doctor_info->exp_about}} @endif @if($doctor_info->exp_work_year)  خبرة عمل ما يقارب <span class="text-primary" >
                                @if ($doctor_info->exp_work_year > 0 )
                                    @if ($doctor_info->exp_work_year == 1 || $doctor_info->exp_work_year >= 11 ) {{$doctor_info->exp_work_year}}   سنة
                                    @elseif ($doctor_info->exp_work_year == 2 ) سنتين
                                    @elseif ($doctor_info->exp_work_year >= 3 && $doctor_info->exp_work_year <= 10 ) {{$doctor_info->exp_work_year}}   سنوات
                                    @endif
                                @endif
                                </span>  @endif .</div> @endif
                                @if($doctor_info->bio) <div class="h6 mb-1 font-weight-bold text-gray-800"> - نبذة عن الطبيب : {{$doctor_info->bio}} .</div> @endif
                                @if($doctor_info->address) <div class=" mb-1 font-weight-bold text-gray-800"> - عنوان العيادة : {{$doctor_info->address}} .</div><hr> @endif




                                @if($doctor_info->facepage) <div class="text-xs mb-0 font-weight-bold text-gray-900"> - رابط العيارة على الفيس بوك : <a href="{{$doctor_info->facepage}}">{{$doctor_info->facepage}}</a> </div> @endif
                                @if($doctor_info->whatsapp) <div class="text-xs mb-0 font-weight-bold text-gray-900"> - رابط العيارة على الواتس أب : <a href="{{$doctor_info->whatsapp}}">{{$doctor_info->whatsapp}}</a> </div> @endif
                                @if($doctor_info->telegram) <div class="text-xs mb-0 font-weight-bold text-gray-900"> - رابط العيارة على التلجرام : <a href="{{$doctor_info->telegram}}">{{$doctor_info->telegram}}</a> </div> @endif
                                @if($doctor_info->instagram) <div class="text-xs mb-0 font-weight-bold text-gray-900"> - رابط العيارة على الإنستغرام : <a href="{{$doctor_info->instagram}}">{{$doctor_info->instagram}}</a> </div> @endif
                                @if($doctor_info->youtube) <div class="text-xs mb-0 font-weight-bold text-gray-900"> - رابط قناة العيارة على اليوتيوب : <a href="{{$doctor_info->youtube}}">{{$doctor_info->youtube}}</a> </div> @endif
                                @if($doctor_info->twitter) <div class="text-xs mb-0 font-weight-bold text-gray-900"> - رابط العيارة على التويتر : <a href="{{$doctor_info->twitter}}">{{$doctor_info->twitter}}</a> </div> @endif
                                @if($doctor_info->linked_in) <div class="text-xs mb-0 font-weight-bold text-gray-900"> - رابط العيارة على اللينكدإين : <a href="{{$doctor_info->linked_in}}">{{$doctor_info->linked_in}}</a> </div> @endif



                            </div>

                            <div class="col-md-5 bg-aboutUs-image">
                                @if($doctor_info->map_emb)
                                <div class="card border-top-dark border-left-dark border-bottom-dark border-right-dark" style="background:rgb(197, 197, 197);height: 537px;">
                                    {!! $doctor_info->map_emb !!}
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="card-footer py-2 px-5">
                        {{-- @dd($doctor_info->opentime)
                        @php
                            $date = Carbon::createFromFormat('Y-m', $month);
                            $formattedMonth = $date->format('m');
                            $formattedYear = $date->format('Y');
                            $this->month = $formattedMonth;
                            $this->year = $formattedYear;
                        @endphp --}}
                        {{-- @dd($doctor_info->opentime) --}}
                        <div class="text-xs mb-0 font-weight-bold text-gray-900 text-center"> - أوقات الدوام : من الساعة <span style="text-align: left">{{ \Carbon\Carbon::parse($doctor_info->opentime)->format('h:i a')}}</span> إلى الساعة <span style="text-align: left">{{ \Carbon\Carbon::parse($doctor_info->closetime)->format('h:i a')}}</span> .</div>
                        @if (auth()->user()->id == auth()->user()->doctor_id )
                            {{-- <a class="text-xs mb-0 font-weight-bold text-primary " type="button" data-toggle="modal" data-target="#EditDoctorInfo"> تعديل المعلومات </a> --}}
                            <!-- Modal EditDoctorInfo -->
                            <div class="modal fade" id="EditDoctorInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-body my-3" style="direction:ltr">
                                            <div class="text-center">
                                                <h1 class="h6 font-weight-bold text-primary mb-4">تعديل معلومات الطبيب والعيادة</h1>
                                            </div>
                                            <hr>
                                            <form class="user" method="post" action="{{ route('Clinic.editDoctorInfo')}}">
                                                @csrf
                                            <div class="row p-2" style="direction: rtl">
                                                <div class="col-lg-7">
                                                    <div class="p-2">

                                                        <div class="form-row">
                                                            <div class="col-xl-6 col-lg-12 mb-1">
                                                                <label class="text-xs text-gray-800 font-weight-bold">الجامعة :</label>
                                                                <input type="text" class="form-control form-control-user @error('university') is-invalid @enderror" name="university" value="{{$doctor_info->university }}"  autocomplete="university" autofocus placeholder="اسم الجامعة">
                                                                @error('university')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-xl-6 col-lg-12 mb-1">
                                                                <label class="text-xs text-gray-800 font-weight-bold">التخصص :</label>
                                                                <input type="text" class="form-control form-control-user @error('med_specialty') is-invalid @enderror" name="med_specialty" value="{{$doctor_info->med_specialty }}"  autocomplete="med_specialty"  placeholder="نوع التخصص">
                                                                @error('med_specialty')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-row" >
                                                            <div class="col-xl-6 col-lg-12 mb-1" >
                                                                <label class="text-xs text-gray-800 font-weight-bold">سنوات الخبرة :</label>
                                                                <input type="number" class="form-control form-control-user @error('exp_work_year') is-invalid @enderror" name="exp_work_year" value="{{$doctor_info->exp_work_year }}"  autocomplete="exp_work_year" placeholder="سنوات الخبرةوالعمل">
                                                                @error('exp_work_year')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-xl-6 col-lg-12  mb-1">
                                                                <label class="text-xs text-gray-800 font-weight-bold">خبرة في التخصصات :</label>
                                                                <input type="text" class="form-control form-control-user @error('exp_about') is-invalid @enderror" name="exp_about" value="{{$doctor_info->exp_about }}"  autocomplete="exp_about" placeholder="أكتب تخصصات الخبرة">
                                                                @error('exp_about')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-row" >
                                                            <div class="col-lg-12 mb-1">
                                                                <label class="text-xs text-gray-800 font-weight-bold">نبذة عن الطبيب :</label>
                                                                <input type="text" class="form-control form-control-user @error('bio') is-invalid @enderror" name="bio" value="{{$doctor_info->bio }}"  autocomplete="bio" placeholder="نبذة أو سيرة ذاتية قصيرة للعرض على الصفحة الرئيسية">
                                                                @error('bio')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-row" >
                                                            <div class="col-lg-12 mb-1">
                                                                <label class="text-xs text-gray-800 font-weight-bold">عنوان العيادة :</label>
                                                                <input type="text" class="form-control form-control-user @error('address') is-invalid @enderror" name="address" value="{{$doctor_info->address }}"  autocomplete="address" placeholder="">
                                                                @error('address')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-row" >
                                                            <div class="col-xl-6 col-lg-12  mb-1">
                                                                <label class="text-xs text-gray-800 font-weight-bold">بداية الدوام :</label>
                                                                <input id="opentime" type="time" class="form-control form-control-user @error('opentime') is-invalid @enderror" name="opentime" value="{{$doctor_info->opentime }}"  autocomplete="opentime">
                                                                @error('opentime')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-xl-6 col-lg-12 mb-1" >
                                                                <label class="text-xs text-gray-800 font-weight-bold" for="closetime">نهاية الدوام :</label>
                                                                <input id="closetime" type="time" class="form-control form-control-user @error('closetime') is-invalid @enderror" name="closetime" value="{{$doctor_info->closetime }}"  autocomplete="closetime">
                                                                @error('closetime')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-6 mb-1 mb-sm-0">
                                                                <label class="text-xs text-gray-800 font-weight-bold" for="password">كلمة مرور لوحة القيادة :</label>
                                                                <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                                                @error('password')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-sm-6  mb-1 mb-sm-0">
                                                                <label class="text-xs text-gray-800 font-weight-bold" for="password_confirmation">تأكيد كلمة المرور  :</label>
                                                                <input id="password_confirmation" type="password" class="form-control form-control-user" name="password_confirmation" autocomplete="new-password">

                                                            </div>
                                                        </div>
                                                        <!-- collapseCardMoreDetails -->
                                                        <div class="card mb-4 " style="border-radius: 35px 35px 35px 35px " >
                                                            <!-- Card Header - Accordion -->
                                                            <a href="#collapseMoreDoctorInfoDetails" class="d-block py-3" data-toggle="collapse"
                                                                role="button" aria-expanded="true" aria-controls="collapseMoreDoctorInfoDetails">
                                                                <p class="text-xs font-weight-bold text-primary text-center mb-0">'المزيد من التفاصيل للعرض ..'</p>
                                                            </a>
                                                            <!-- Card Content - Collapse -->
                                                            <div class="collapse" id="collapseMoreDoctorInfoDetails">
                                                                <div class="card-body px-1 py-3">
                                                                    <div class="form-row" >
                                                                        <div class="col-lg-12 mb-1">
                                                                            <label class="text-xs text-gray-800 font-weight-bold">رابط صفحة الفيس :</label>
                                                                            <input type="text" class="form-control form-control-user @error('facepage') is-invalid @enderror" name="facepage" value="{{$doctor_info->facepage }}"  autocomplete="facepage" placeholder="">
                                                                            @error('facepage')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row" >
                                                                        <div class="col-lg-12 mb-1">
                                                                            <label class="text-xs text-gray-800 font-weight-bold">رابط الإتصال بالواتس :</label>
                                                                            <input type="text" class="form-control form-control-user @error('whatsapp') is-invalid @enderror" name="whatsapp" value="{{$doctor_info->whatsapp }}"  autocomplete="whatsapp" placeholder="">
                                                                            @error('whatsapp')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-row" >
                                                                        <div class="col-lg-12 mb-1">
                                                                            <label class="text-xs text-gray-800 font-weight-bold">رابط حساب تلغرام :</label>
                                                                            <input type="text" class="form-control form-control-user @error('telegram') is-invalid @enderror" name="telegram" value="{{$doctor_info->telegram }}"  autocomplete="telegram" placeholder="">
                                                                            @error('telegram')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row" >
                                                                        <div class="col-lg-12 mb-1">
                                                                            <label class="text-xs text-gray-800 font-weight-bold">رابط حساب إنستغرام :</label>
                                                                            <input type="text" class="form-control form-control-user @error('instagram') is-invalid @enderror" name="instagram" value="{{$doctor_info->instagram }}"  autocomplete="instagram" placeholder="">
                                                                            @error('instagram')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row" >
                                                                        <div class="col-lg-12 mb-1">
                                                                            <label class="text-xs text-gray-800 font-weight-bold">رابط قناة يوتيوب :</label>
                                                                            <input type="text" class="form-control form-control-user @error('youtube') is-invalid @enderror" name="youtube" value="{{$doctor_info->youtube }}"  autocomplete="youtube" placeholder="">
                                                                            @error('youtube')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row" >
                                                                        <div class="col-lg-12 mb-1">
                                                                            <label class="text-xs text-gray-800 font-weight-bold">رابط حساب تويتر :</label>
                                                                            <input type="text" class="form-control form-control-user @error('twitter') is-invalid @enderror" name="twitter" value="{{$doctor_info->twitter }}"  autocomplete="twitter" placeholder="">
                                                                            @error('twitter')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row" >
                                                                        <div class="col-lg-12 mb-1">
                                                                            <label class="text-xs text-gray-800 font-weight-bold">رابط جساب لينكدإن :</label>
                                                                            <input type="text" class="form-control form-control-user @error('linked_in') is-invalid @enderror" name="linked_in" value="{{$doctor_info->linked_in }}"  autocomplete="linked_in" placeholder="">
                                                                            @error('linked_in')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row" >
                                                                        <div class="col-lg-12 mb-1">
                                                                            <label class="text-xs text-gray-800 font-weight-bold">رابط تضمين خرائط جوجل :</label>
                                                                            <input type="text" class="form-control form-control-user @error('map_emb') is-invalid @enderror" name="map_emb" value="{{$doctor_info->map_emb }}"  autocomplete="map_emb" placeholder="">
                                                                            @error('map_emb')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div><!-- collapseCardMoreDetails -->

                                                    </div>
                                                </div>
                                                <div class="col-lg-5  d-none d-lg-block bg-register-image">

                                                </div>
                                            </div>
                                            <hr>
                                            <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                            <button type="submit" class="btn btn-primary btn-user">
                                                تعديل
                                            </button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal EditDoctorInfo -->
                        @endif
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('script')

@endsection
