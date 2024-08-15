@extends('layouts.myClinic')

@section('style')

@endsection

@section('content')
<div class="container-fluid mt-3 mb-5 pb-5">
        @if (count($errors)>0)
            @foreach ($errors->all() as $item)
                <div class="alert alert-secondary" role="alert">
                    {{$item}}
                </div>
            @endforeach
        @endif
        <!-- DataTales Example -->
        <div class="card shadow my-3">
            <div class="card-header p-3 " style="display:inline-flex;direction:rtl">
                <div class="d-sm-block d-md-inline-flex">
                    <div class="dropdown no-arrow ml-2" style="line-height :normal;">
                        @if ($user->doctor_id == $user->id)
                            @if (auth()->user()->doctor_id == auth()->user()->id)
                                <a class="dropdown-toggle px-1" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink" style="text-align:right">
                                    <div class="dropdown-header text-gray-800 bg-gray-300"><h6><b>الإجراءات</b></h6></div>
                                    <a class="dropdown-item " type="button" data-toggle="modal" data-target="#EditUser">
                                        <i class="fas fa-cog fa-sm fa-fw ml-2 text-gray-400"></i>
                                        تعديل الحساب
                                    </a>
                                    {{-- <a class="dropdown-item " type="button" data-toggle="modal" data-target="#SettingUser">
                                        <i class="fas fa-list fa-sm fa-fw ml-2 text-gray-400"></i>
                                        تعديل الصلاحيات
                                    </a> --}}
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item " type="button" data-toggle="modal" data-target="#DeleteUser">
                                        <i class="fas fa-trash fa-sm fa-fw ml-2 text-gray-400"></i>
                                        حذف الحساب
                                    </a>
                                </div>
                            @endif
                        @elseif ($user->doctor_id != $user->id)
                            @if (auth()->user()->d_o_e == 1)
                                <a class="dropdown-toggle px-1" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink" style="text-align:right">
                                    <div class="dropdown-header text-gray-800 bg-gray-300"><h6><b>الإجراءات</b></h6></div>
                                    <a class="dropdown-item " type="button" data-toggle="modal" data-target="#EditUser">
                                        <i class="fas fa-cog fa-sm fa-fw ml-2 text-gray-400"></i>
                                        تعديل الحساب
                                    </a>
                                    {{-- <a class="dropdown-item " type="button" data-toggle="modal" data-target="#SettingUser">
                                        <i class="fas fa-list fa-sm fa-fw ml-2 text-gray-400"></i>
                                        تعديل الصلاحيات
                                    </a> --}}
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item " type="button" data-toggle="modal" data-target="#DeleteUser">
                                        <i class="fas fa-trash fa-sm fa-fw ml-2 text-gray-400"></i>
                                        حذف الحساب
                                    </a>
                                </div>
                            @elseif ($user->id == auth()->user()->id)
                                <a class="dropdown-toggle px-1" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink" style="text-align:right">
                                    <div class="dropdown-header text-gray-800 bg-gray-300"><h6><b>الإجراءات</b></h6></div>
                                    <a class="dropdown-item " type="button" data-toggle="modal" data-target="#EditUser">
                                        <i class="fas fa-cog fa-sm fa-fw ml-2 text-gray-400"></i>
                                        تعديل الحساب
                                    </a>
                                    {{-- <a class="dropdown-item " type="button" data-toggle="modal" data-target="#SettingUser">
                                        <i class="fas fa-list fa-sm fa-fw ml-2 text-gray-400"></i>
                                        تعديل الصلاحيات
                                    </a> --}}
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item " type="button" data-toggle="modal" data-target="#DeleteUser">
                                        <i class="fas fa-trash fa-sm fa-fw ml-2 text-gray-400"></i>
                                        حذف الحساب
                                    </a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="text-center" style="width:100%;">
                    <h5 class="text-primary p-0 m-0"><b>الصفحة الشخصية</b></h5>
                </div>
            </div>
            <div class="card-body" style="text-align:right">
                <div class="form-row align-items-center justify-content-center">
                    <div class="col-sm-6">
                        <p  class="py-1 m-0"> الاسم  : <b>{{$user->name}}</b></p>
                        <ul>
                            <li>
                                <p class="py-1 m-0">  اسم الحساب :</p><b>{{$user->username}}</b>
                            </li>
                            <li>
                                <p class="py-1 m-0">  ايميل الحساب :</p><b>{{$user->email}}</b>
                            </li>
                            <li>
                                <p class="py-1 m-0"> رقم الهاتف :</p><b>{{$user->mobile}}</b>
                            </li>
                            <li>
                                <p class="py-1 m-0"> مستوى الحساب :</p>
                                <b>
                                    @if ($user->d_o_e )
                                    مشرف
                                    @else
                                    موظف
                                    @endif
                                </b>
                            </li>
                            <li>
                                <p class="py-1 m-0"> حالة الحساب :</p>
                                <b>
                                    @if ($user->status )
                                    نشط
                                    @else
                                    غير نشط
                                    @endif
                                </b>
                            </li>
                        </ul>
                    </div>
                    @if ($user->user_image)
                        <div class="col-sm-6">
                            <div class="card border-top-dark border-left-dark border-bottom-dark border-right-dark shadow m-3">
                                <img src="{{asset('assets/users/'.$user->user_image)}}" alt="" style="max-height:300px;width:auto;object-fit:contain;background:rgb(197, 197, 197)">
                            </div>
                        </div>
                    @else
                        <div class="col-sm-6">
                            <div class="card border-top-dark border-left-dark border-bottom-dark border-right-dark shadow m-3">
                                <img src="" alt="" style="max-height:300px;width:auto;object-fit:contain;background:rgb(197, 197, 197)">
                            </div>
                        </div>
                    @endif

                </div>
            </div>
            <!-- Modal Delete -->
            <div class="modal fade" id="DeleteUser" tabindex="-1" aria-labelledby="DeleteUser" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">

                                    @if ($user->id == $user->doctor_id )
                                        <h5 class="text-center text-danger">رسالة تذكير</h5>
                                        <div class="row p-3">
                                            <div class="col-lg-4 d-none d-lg-block bg-protected-image"></div>
                                            <div class="col-lg-8" style="text-align:center">
                                                <h6 class="text-center font-weight-bold text-gray-800">هذا الحساب محمي <i class="fas fa-shield fa-2x text-warning"></i></h6>
                                                <h6 class="text-center">لا يمكنك حذف الحساب حتى عن طريق الخطأ </h6>
                                                <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">تراجع</button>

                                    @else
                                        <h5 class="text-center text-danger">رسالة تأكيد</h5>
                                        <div class="row p-3">
                                            <div class="col-lg-4 d-none d-lg-block bg-deleted-image"></div>
                                            <div class="col-lg-8" style="text-align:center">
                                            <h5 class="text-center">هل أنت متأكد من حذف الحساب ؟</h5>
                                            <p> عند التأكيد سوف يتم حذف الحساب بشكل نهائي </p>
                                            <a href="{{route('mang.userDestroy',$user->username)}}" class="btn btn-danger btn-user ">تأكيد</a>
                                            <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Delete -->
            <!-- Modal EditUser -->
            <div class="modal fade" id="EditUser" tabindex="-1" aria-labelledby="EditUser" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-body" style="direction:ltr">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">تعديل الحساب</h1>
                            </div>
                            <hr>
                            <form class="user" method="post" action="{{ route('mang.userUpdate',$user->id) }}" enctype="multipart/form-data">
                                @csrf
                            <div class="form-row" style="direction: rtl">
                                <div class="col-lg-7">
                                    <div class="p-2">
                                        @if (($user->id == $user->doctor_id && auth()->user()->id == $user->id) || ($user->id != $user->doctor_id && auth()->user()->d_o_e == 0))
                                            <div class="form-row">
                                                <div class="col-lg-12 mb-3">
                                                    <label class="text-xs mr-3" style="text-align:right;float: right;">كلمة المرور الحالية :</label>
                                                    <input type="password" class="form-control form-control-user @error('old_password') is-invalid @enderror" name="old_password" placeholder="لن يتم أي تعديل بدون كلمة المرور الحالية">
                                                    @error('old_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-row">
                                            <div class="col-xl-6 col-lg-12 mb-3">
                                                <label class="text-xs mr-3" style="text-align:right;float: right;">الاسم :</label>
                                                <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{$user->name }}"  autocomplete="name" autofocus placeholder="اسم مستخدم الحساب">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-xl-6 col-lg-12 mb-3">
                                                <label class="text-xs mr-3" style="text-align:right;float: right;">اسم حسابك :</label>
                                                <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror" name="username" value="{{$user->username }}"  autocomplete="username" required placeholder="الاسم المستخدم لتسجيل الدخول">
                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-xl-6 col-lg-12 mb-3">
                                                <label class="text-xs mr-3" style="text-align:right;float: right;">كلمة المرور :</label>
                                                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="كلمة المرور">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-xl-6 col-lg-12  mb-3">
                                                <label class="text-xs mr-3" style="text-align:right;float: right;">تأكيد كلمة المرور :</label>
                                                <input type="password" class="form-control form-control-user" name="password_confirmation"  autocomplete="new-password" placeholder="كرر كلمة المرور">
                                            </div>
                                        </div>
                                        @if ($user->id != $user->doctor_id && auth()->user()->d_o_e == 1)
                                            <div class="form-row">
                                                <div class="col-lg-12  mb-3" style="direction:ltr ">
                                                    <label class="text-xs" style="text-align:right;float: right;direction:rtl;margin-bottom: 0.25rem;margin-right: 1rem;">مستوى الحساب :</label>
                                                    <select class="form-control form-control-user" name="d_o_e" style="text-align:center;padding: 0.5rem 1rem;height:50px;">
                                                        <option value="1" @if ($user->d_o_e == 1 ) selected @endif>مشرف</option>
                                                        <option value="0" @if ($user->d_o_e == 0 ) selected @endif>موظف</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @else
                                            <input type="hidden" name="d_o_e" value="{{$user->d_o_e}}">

                                        @endif

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
                                                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{$user->email }}"  autocomplete="email" placeholder="">
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-xl-6 col-lg-12  mb-3">
                                                            <label class="text-xs" style="text-align:right;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">الجوال :</label>
                                                            <input type="tel" class="form-control form-control-user @error('mobile') is-invalid @enderror" name="mobile" value="{{$user->mobile }}"  autocomplete="mobile" placeholder="">
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
                                                                <option value="male" @if ($user->gender == 'male' ) selected @endif>ذكر</option>
                                                                <option value="female" @if ($user->gender == 'female' ) selected @endif>أنثى</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- collapseCardMoreDetails -->

                                    </div>
                                </div>
                                <div class="col-lg-5 bg-profile-image">
                                    {{-- <div class="p-2">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                            <label class="custom-control-label" for="customSwitch1">Toggle this switch element</label>
                                        </div>
                                    </div>--}}
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer py-1" style="float: right;direction: ltr">
                            <button type="submit" style="float:right" class="btn btn-primary btn-user">تعديل</button>
                            <button type="button" style="float:right" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal EditUser -->
            {{-- <!-- Modal SettingUser -->
            <div class="modal fade" id="SettingUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-body" style="direction:ltr">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">تعديل الصلاحيات</h1>
                            </div>
                            <hr>
                            <form class="user" method="post" action="{{ route('mang.userUpdate',$user->id) }}" enctype="multipart/form-data">
                                @csrf
                            <div class="row" style="direction: rtl">
                                <div class="col-lg-6">
                                    <div class="p-2">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1" style="width: 2rem;z-index: 1;">
                                            <label class="custom-control-label" for="customSwitch1">تعديل ملفات الموظفين</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch2" style="width: 2rem;z-index: 1;">
                                            <label class="custom-control-label" for="customSwitch2">Toggle this switch element</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch3"  style="width: 2rem;z-index: 1;">
                                            <label class="custom-control-label" for="customSwitch3">Toggle this switch element</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch4"  style="width: 2rem;z-index: 1;">
                                            <label class="custom-control-label" for="customSwitch4">Toggle this switch element</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch5"  style="width: 2rem;z-index: 1;">
                                            <label class="custom-control-label" for="customSwitch5">Toggle this switch element</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch6"  style="width: 2rem;z-index: 1;">
                                            <label class="custom-control-label" for="customSwitch6">Toggle this switch element</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 bg-dashboard-image">
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                تعديل
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal SettingUser --> --}}
        </div>
    </div>
@endsection

@section('script')

@endsection
