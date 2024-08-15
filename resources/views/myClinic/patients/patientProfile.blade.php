@extends('layouts.myClinic')

@section('content')
    <div class="mb-5 pb-5 mt-3" style="direction:ltr;text-align:right">
        @if (count($errors)>0)
            @foreach ($errors->all() as $item)
                <div class="alert alert-secondary" role="alert">
                    {{$item}}
                </div>
            @endforeach
        @endif
        <div class="row" >
            <div class="col-lg-4 bg-profile-image"></div>
            <div class="col-lg-8">
                <div class="card border-left-primary shadow h-100">
                    <!-- Card Header - Dropdown -->

                    @if ($patient->deleted_at == null)
                        <div class="card-header p-3 " style="display:inline-flex;direction:rtl">
                    @else
                        <div class="card-header bg-gradient-danger p-3 " style="display:inline-flex;direction:rtl">
                    @endif
                        <div class="d-sm-block d-md-inline-flex">
                            @if ($patient->deleted_at == null)
                                <div class="dropdown no-arrow ml-2" style="line-height :normal;">
                                    <a class="dropdown-toggle px-1" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink" style="text-align:right">
                                        <div class="dropdown-header text-gray-800 bg-gray-300"><h6><b>الإجراءات</b></h6></div>
                                        {{-- <a class="dropdown-item " type="button" data-toggle="modal" data-target="#ViewReviewEmergency">إضافة زيارة جديدة</a> --}}
                                        <a href="{{route('Clinic.printPatientProfile' ,$patient->patient_slug)}}" class="dropdown-item " type="button"><i class="fa-solid fa-lg fa-print"></i> طباعة ملف الزائر</a>
                                        <a class="dropdown-item " type="button" data-toggle="modal" data-target="#Edit">تعديل ملف الزائر</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item " type="button" data-toggle="modal" data-target="#Delete">حذف الملف</a>
                                    </div>
                                </div>
                            @else
                                <div>
                                    <a class="btn btn-primary btn-circle btn-sm" type="button" href="{{route('Clinic.restorePatient',$patient->patient_slug)}}"  data-toggle="tooltip" title="استعادة ملف الزائر">
                                        <i class="fa-solid fa-retweet"></i>
                                    </a>
                                </div>
                            @endif
                            <div>
                                <a class="card_dropdown" href="#collapseCardExample" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                </a>
                            </div>
                        </div>
                        <div class="text-center" style="width:100%;">
                            <p class="text-xs text-gray-900 p-0 m-0">اسم الزائر :</p>
                            <h6 class="text-primary p-0 m-0"><b>{{$patient->patient_name}}</b></h6>
                        </div>
                        <div style="text-align: left;width: 30%;">
                            <p class="text-xs text-gray-900 p-0 m-0">تاريخ الإدخال :</p>
                            <p class="text-xs text-gray-800  p-0 m-0">{{$patient->created_at->format('D d-m-Y')}}</p>
                            <p class="text-xs text-gray-800  p-0 m-0" style="direction: ltr">{{$patient->created_at->format('h:i a')}}</p>

                        </div>
                    </div>
                    <div class="collapse show" id="collapseCardExample">
                        <div class="card-body pb-2 pt-4" style="direction: rtl">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" >
                                    <thead>
                                        <tr>
                                            <th>الجنس</th>
                                            <th>العمر</th>
                                            <th>الحالة الإجتماعية</th>
                                            <th>عدد الأولاد</th>
                                            <th>التدخين</th>
                                            @if ($patient->blood_type)
                                            <th>زمرة الدم</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @if ($patient->gender)
                                                <td class="text-gray-800">@if ($patient->gender == 'male') {{'ذكر'}} @elseif ($patient->gender == 'female') {{'أنثى'}} @endif</td>
                                            @else
                                                <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                            @endif
                                            @if ($patient->age && $patient->age!= date('Y') )
                                                <td class="text-gray-800" style="direction:rtl">{{date('Y') - $patient->age .' سنة'}}</td>
                                            @else
                                                <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                            @endif
                                            @if ($patient->relationship)
                                                <td class="text-gray-800" style="direction:rtl">@if ($patient->relationship == 'married') {{'متزوج'}} @elseif ($patient->relationship == 'single')  {{'أعزب'}} @endif</td>
                                            @else
                                                <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                            @endif
                                            @if ($patient->child_count)
                                                <td class="text-gray-800" style="direction:rtl">{{$patient->child_count}}</td>
                                            @else
                                                <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                            @endif
                                            @if ($patient->smoking)
                                                <td class="text-gray-800" style="direction:rtl">@if ($patient->smoking == 'negative') {{'سلبي'}} @elseif ($patient->smoking == 'positive')  {{'إيجابي'}} @endif</td>
                                            @else
                                                <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                            @endif
                                            @if ($patient->blood_type)
                                                <td class="text-gray-800" style="direction:rtl">{{$patient->blood_type}}</td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Collapsable Card Example -->
                            <div class="card mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#CardMoreDetails" class="d-block card-header py-3" data-toggle="collapse" style=""
                                    role="button" aria-expanded="true" aria-controls="CardMoreDetails">
                                    <h6 class="m-0 font-weight-bold text-gray-900 text-center"><span>السوابق</span> :
                                         ( <span class=" @if ($patient->older_surgery)
                                        text-primary
                                        @else
                                            text-gray-700
                                        @endif">الجراحية</span>

                                        - <span class=" @if ($patient->older_sicky)
                                        text-primary
                                        @else
                                            text-gray-700
                                        @endif">المرضية</span>

                                        - <span class=" @if ($patient->older_sensitive)
                                        text-primary
                                        @else
                                            text-gray-700
                                        @endif">التحسسية</span> )

                                        - <span class=" @if ($patient->permanent_medic)
                                        text-primary
                                        @else
                                            text-gray-700
                                        @endif">الأدوية الدائمة</span>

                                        - <span class=" @if ($patient->patient_state)
                                        text-primary
                                        @else
                                            text-gray-700
                                        @endif">حول المريض</span>
                                    </h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse" id="CardMoreDetails">
                                    <div class="card-body p-1">
                                        <div class="card mb-2 px-2 py-3 border-right-primary">
                                            <div class="text-lg text-primary text-uppercase mb-1">السوابق الجراحية</div>
                                            <div class="h6 mb-0 text-gray-800">
                                                @if ($patient->older_surgery)
                                                    {{$patient->older_surgery}}
                                                @else
                                                    لا يوجد
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card mb-2 px-2 py-3 border-right-primary">
                                            <div class="text-lg text-primary text-uppercase mb-1">السوابق المرضية</div>
                                            <div class="h6 mb-0 text-gray-800">
                                                @if ($patient->older_sicky)
                                                    {{$patient->older_sicky}}
                                                @else
                                                    لا يوجد
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card mb-2 px-2 py-3 border-right-primary">
                                            <div class="text-lg text-primary text-uppercase mb-1">السوابق التحسسية</div>
                                            <div class="h6 mb-0 text-gray-800">
                                                @if ($patient->older_sensitive)
                                                    {{$patient->older_sensitive}}
                                                @else
                                                    لا يوجد
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card mb-2 px-2 py-3 border-right-primary">
                                            <div class="text-lg text-primary text-uppercase mb-1">الأدوية الدائمة</div>
                                            <div class="h6 mb-0 text-gray-800">
                                                @if ($patient->permanent_medic)
                                                    {{$patient->permanent_medic}}
                                                @else
                                                    لا يوجد
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card mb-2 px-2 py-3 border-right-primary">
                                            <div class="text-lg text-primary text-uppercase mb-1">ملاحظات حول الزائر:</div>
                                            <div class="h6 mb-0 text-gray-800">
                                                @if ($patient->patient_state)
                                                    {{$patient->patient_state}}
                                                @else
                                                    لا يوجد
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-foot p-2" style=";direction:rtl">
                       <div class="w-100 d-inline-flex px-4">
                            <div class="mb-3 w-100 text-center d-block d-md-inline-flex" style="width: 30%;">
                                <p class="text-xs text-primary p-0 m-0">رقم الهاتف :&nbsp; </p>
                                <p class="text-xs text-gray-900  p-0 m-0" style=" direction:ltr"> <b>
                                    @if ($patient->phone)
                                        {{$patient->phone}}
                                    @else
                                        ---------------------
                                    @endif
                                </b></p>
                            </div>
                            <div class="mb-3 w-100 text-center d-block d-md-inline-flex" style="width: 20%;">
                                <p class="text-xs text-primary p-0 m-0">المهنة : &nbsp;</p>
                                <p class="text-xs text-gray-900  p-0 m-0" style=" direction:ltr"> <b>
                                    @if ($patient->patient_job)
                                        {{$patient->patient_job}}
                                    @else
                                        ---------------------
                                    @endif
                                </b></p>
                            </div>
                            <div class="mb-3 w-100 text-center d-block d-md-inline-flex" style="width: 50%;">
                                <p class="text-xs text-primary p-0 m-0">العنوان : &nbsp;</p>
                                <p class="text-xs text-gray-900  p-0 m-0" style=" direction:ltr"> <b>
                                    @if ($patient->patient_address)
                                        {{$patient->patient_address}}
                                    @else
                                        ---------------------
                                    @endif
                                </b></p>
                            </div>
                       </div>
                    </div>
                    <!-- Modal Profile -->
                    <div style="direction:ltr">
                        <!-- Modal Patient Delete -->
                        <div class="modal fade" id="Delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h5 class="text-center text-danger">رسالة تأكيد</h5>
                                        <div class="row p-3">
                                            <div class="col-lg-4 d-none d-lg-block bg-deleted-image"></div>
                                            <div class="col-lg-8" style="text-align:center">
                                                <h5 class="text-center">هل أنت متأكد من حذف الملف ؟</h5>
                                                <p> عند التأكيد سوف يتم إرسال الملف مع جميع الزيارات إلى سلة المحذوفات </p>
                                                <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                                <a href="{{route('Clinic.softDeletesPatient',$patient->patient_slug)}}" class="btn btn-danger btn-user ">تأكيد</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Modal Patient Delete -->

                        <!-- Modal Edit Profile -->
                        {{-- <div class="modal fade" id="Edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h5 class="text-center py-2">تعديل ملف الزائر</h5><hr>
                                        <form action="{{route('Clinic.updatePatient',$patient->id)}}" method="post">
                                            @csrf
                                            <div class="row" style="direction: rtl">

                                                <div class="col-lg-12 ">
                                                    <div class="form-group" style="direction:rtl">
                                                        <label class="text-xs">اسم الزائر :</label>
                                                        <input type="text" class="form-control @error('patient_name') is-invalid @enderror" name="patient_name" value="{{ $patient->patient_name }}" placeholder="اسم الزائر" style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
                                                            @error('patient_name')
                                                                <span class="invalid-feedback text-center" role="alert">
                                                                    <strong >{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                    <div class="form-group" style="direction:rtl">
                                                        <label class="text-xs">رقم الهاتف :</label>
                                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $patient->phone }}" placeholder="رقم الهاتف"style="padding: 0.375rem 0.75rem;height:50px;text-align:center;direction: ltr">
                                                            @error('phone')
                                                                <span class="invalid-feedback text-center" role="alert">
                                                                    <strong >{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                    <div class="form-row" >
                                                        <div class="form-group col-6">
                                                            @php
                                                                $genders=['male'=>'ذكر','female'=>'أنثى']
                                                            @endphp
                                                            <label class="text-xs">الجنس :</label>
                                                            <select class="form-control @error('gender') is-invalid @enderror" value="{{ $patient->gender }}" name="gender"required style="padding: 0.375rem 0.75rem;height:50px;text-align:center;direction: ltr">
                                                                @error('gender')
                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                        <strong >{{ $message }}</strong>
                                                                    </span>
                                                                @enderror

                                                                @foreach ($genders as $value => $key )
                                                                <option value="{{$value}}"
                                                                    @if ($value == $patient->gender )
                                                                        selected
                                                                    @endif
                                                                    > {{$key}} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-6" style="direction: rtl">
                                                            <label class="text-xs">العمر :</label>
                                                            <input type="number" max="99" min="1" class="form-control form-control @error('age') is-invalid @enderror" name="age" value="{{ date('Y') -$patient->age }}" placeholder="العمر" style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
                                                                @error('age')
                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                        <strong >{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                        </div>
                                                    </div>

                                                    <!-- Collapsable Card Example -->
                                                    <div class="card mb-4">
                                                        <!-- Card Header - Accordion -->
                                                        <a href="#collapseCardMoreDetails" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                            role="button" aria-expanded="true" aria-controls="collapseCardMoreDetails">
                                                            <h6 class="m-0 font-weight-bold text-gray-900 text-center"><span>السوابق</span> :
                                                                ( <span class=" @if ($patient->older_surgery)
                                                               text-primary
                                                               @else
                                                                   text-gray-700
                                                               @endif">الجراحية</span>

                                                               - <span class=" @if ($patient->older_sicky)
                                                               text-primary
                                                               @else
                                                                   text-gray-700
                                                               @endif">المرضية</span>

                                                               - <span class=" @if ($patient->older_sensitive)
                                                               text-primary
                                                               @else
                                                                   text-gray-700
                                                               @endif">التحسسية</span> )

                                                               - <span class=" @if ($patient->permanent_medic)
                                                               text-primary
                                                               @else
                                                                   text-gray-700
                                                               @endif">الأدوية الدائمة</span>

                                                               - <span class=" @if ($patient->patient_state)
                                                               text-primary
                                                               @else
                                                                   text-gray-700
                                                               @endif">حول المريض</span>
                                                           </h6>                                                        </a>
                                                        <!-- Card Content - Collapse -->
                                                        <div class="collapse" id="collapseCardMoreDetails">
                                                            <div class="card-body p-1">
                                                                <div class="form-group" style="direction:rtl">
                                                                    <label class="text-xs">السوابق الجراحية :</label>
                                                                    <textarea  class="form-control" name="older_surgery" rows="2" style="padding: 0.375rem 0.75rem;text-align:center" placeholder="السوابق الجراحية">{{ $patient->older_surgery }}</textarea>
                                                                </div>
                                                                <div class="form-group" style="direction:rtl">
                                                                    <label class="text-xs">السوابق المرضية :</label>
                                                                    <textarea  class="form-control" name="older_sicky" rows="2" style="padding: 0.375rem 0.75rem;text-align:center" placeholder="السوابق المرضية">{{ $patient->older_sicky }}</textarea>
                                                                </div>
                                                                <div class="form-group" style="direction:rtl">
                                                                    <label class="text-xs">السوابق التحسسية :</label>
                                                                    <textarea  class="form-control" name="older_sensitive" rows="2" style="padding: 0.375rem 0.75rem;text-align:center" placeholder="السوابق التحسسية">{{ $patient->older_sensitive }}</textarea>
                                                                </div>
                                                                <div class="form-group" style="direction:rtl">
                                                                    <label class="text-xs">الأدوية الدائمة :</label>
                                                                    <textarea  class="form-control" name="permanent_medic" rows="1" style="height:50px;padding: 0.375rem 0.75rem;text-align:center" placeholder="الأدوية الدائمة">{{ $patient->permanent_medic }}</textarea>
                                                                </div>
                                                                <div class="form-group" style="direction:rtl">
                                                                    <label class="text-xs">ملاحظات :</label>
                                                                    <input type="text" class="form-control " name="patient_state" value="{{ $patient->patient_state }}" placeholder="ملاحظات" style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                    </div>
                                    <div class="modal-footer py-1">
                                        <button type="submit" class="btn btn-primary btn-user">تعديل</button>
                                        <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Modal Edit Profile --> --}}

                        <!-- Modal Patient Profile -->
                        <div class="modal fade" id="Edit" tabindex="-1" aria-labelledby="patientEdit" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content border-right-primary">
                                    <div class="modal-body">
                                        <div class="card-body p-0" style="direction:ltr">
                                            <!-- Nested Row within Card Body -->
                                            <div  style="overflow-y:auto ;height: 100%;">
                                            <div class="text-center">
                                                <h1 class="h6 font-weight-bold text-gray-900 my-2 text-center" style="direction:rtl;">تعديل على ملف  {{$patient->patient_name}}</h1>
                                            </div>


                                                <form  class="user px-2" method="POST" action="{{route('Clinic.updatePatient',$patient->patient_slug)}}">
                                                    @csrf

                                                    <div class="form-group mb-2" style="direction: rtl;margin-bottom: 0.5rem;">
                                                        {{-- <div class="form-row card px-0 mx-0 d-inine-block" style="flex-direction: unset;">
                                                            <div class="form-group mb-0 col-md-12 col-sm-12 " style="direction:rtl;text-align:right">
                                                                <div class="custom-radio custom-control-inline mr-1">
                                                                    <label class="text-xs">حجز الموعد : </label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline mr-2">
                                                                    <input type="radio" id="editbyPhoneSide{{$review->id}}" name="leave_off" value="0" class="custom-control-input" @if ($review->leave_off == 0) checked  @endif>
                                                                    <label class="text-xs custom-control-label" for="editbyPhoneSide{{$review->id}}">هاتفي</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline mr-2">
                                                                    <input type="radio" id="editinClinicSide{{$review->id}}" name="leave_off" @if ($review->leave_off == 1) checked  @endif  value="1" class="custom-control-input">
                                                                    <label class="text-xs custom-control-label" for="editinClinicSide{{$review->id}}">في العيادة</label>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        {{-- <div class="form-group mb-2" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                            <div class="custom-radio custom-control-inline">
                                                                <label class="text-xs mr-3">سبب الزيارة : </label>
                                                            </div>
                                                            <div class="card d-block" >
                                                                <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                    <input type="radio" id="editviewSide{{$review->id}}" name="main_complaint[]" @if ($review->main_complaint == "معاينة جديدة") checked  @endif value="معاينة جديدة" class="custom-control-input">
                                                                    <label class="text-xs text-success font-weight-bold custom-control-label" for="editviewSide{{$review->id}}" >معاينة</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                    <input type="radio" id="editnewreviewSide{{$review->id}}" name="main_complaint[]" @if ($review->main_complaint == "مراجعة") checked  @endif  value="مراجعة" class="custom-control-input">
                                                                    <label class="text-xs text-warning font-weight-bold custom-control-label" for="editnewreviewSide{{$review->id}}" >مراجعة</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                    <input type="radio" id="editEmergencySide{{$review->id}}" name="main_complaint[]"  @if ($review->main_complaint == "اسعافية") checked  @endif value="اسعافية" class="custom-control-input">
                                                                    <label class="text-xs text-danger font-weight-bold custom-control-label" for="editEmergencySide{{$review->id}}" >اسعافية</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                    <input type="radio" id="editselectSergraySide{{$review->id}}" name="main_complaint[]"  @if ($review->main_complaint == "تحديد عملية") checked  @endif value="تحديد عملية" class="custom-control-input">
                                                                    <label class="text-xs text-info font-weight-bold custom-control-label" for="editselectSergraySide{{$review->id}}">تحديد عملية</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                    <input type="radio" id="editreviewSergraySide{{$review->id}}" name="main_complaint[]"  @if ($review->main_complaint == "مراجعة عملية") checked  @endif value="مراجعة عملية" class="custom-control-input">
                                                                    <label class="text-xs text-info font-weight-bold custom-control-label" for="editreviewSergraySide{{$review->id}}">مراجعة عملية</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox custom-control-inline" style="direction:ltr;text-align:right">
                                                                    <input type="checkbox" id="editforPhotoSide{{$review->id}}" name="main_complaint[]" @if ($review->main_complaint == "صورة") checked  @endif value="صورة" class="custom-control-input">
                                                                    <label class="text-xs text-info font-weight-bold custom-control-label" for="editforPhotoSide{{$review->id}}" >زيارة من أجل صورة</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox custom-control-inline" style="direction:ltr;text-align:right">
                                                                    <input type="checkbox" id="editforAnalysisSide{{$review->id}}" name="main_complaint[]"  @if ($review->main_complaint == "تحليل") checked  @endif value="تحليل" class="custom-control-input">
                                                                    <label class="text-xs text-info font-weight-bold custom-control-label" for="editforAnalysisSide{{$review->id}}" >زيارة من أجل تحليل</label>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        <div class="form-group mb-2 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                            <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">اسم الزائر : </label>
                                                            <input class="VoiceToText form-control @error('patient_name') is-invalid @enderror" type="text" id="patient_name" value="{{$patient->patient_name}}" name="patient_name" required placeholder=" أكتب الاسم والكنية "
                                                            style="padding: 0.375rem 0.75rem;height:38px;font-size: 75%;text-align:center;" >
                                                                @error('patient_name')
                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                        <strong >{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:38px;" for="patient_name">
                                                                <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                            </button>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">رقم الهاتف : </label>
                                                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" value="{{$patient->phone}}" name="phone" placeholder=" أكتب رقم الهاتف"
                                                                style="padding: 0.375rem 0.75rem;height:38px;text-align:center;direction: ltr;font-size: 75%;">
                                                                @error('phone')
                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                        <strong >{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">العمر : </label>
                                                                <input type="tel" max="99" min="1" class="form-control form-control @error('age') is-invalid @enderror" value="@if ($patient->age != null){{date('Y') -$patient->age}} @endif" name="age" placeholder="1~99"
                                                                    style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                                @error('age')
                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                        <strong >{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                <div class="custom-radio custom-control-inline">
                                                                    <label class="text-xs mr-3">الجنس : </label>
                                                                </div>
                                                                <div class="card d-block" style="height: 38px">
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="editgenderMale" name="gender" @if ($patient->gender == 'male') checked  @endif  value="male" class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editgenderMale">ذكر</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="editgenderFemale" name="gender" @if ($patient->gender == 'female') checked  @endif  value="female" class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editgenderFemale">أنثى</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                <div class="custom-radio custom-control-inline">
                                                                    <label class="text-xs mr-3">التدخين : </label>
                                                                </div>
                                                                <div class="card d-block" style="height: 38px">
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="editnegative" name="smoking" value="negative" @if ($patient->smoking == 'negative') checked  @endif class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editnegative">سلبي</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="editpositive" name="smoking"  value="positive" @if ($patient->smoking == 'positive') checked  @endif class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editpositive">إيجابي</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- collapsePatientProfile -->
                                                        <div class="card mb-2">
                                                            <!-- Card Header - Accordion -->
                                                            <a href="#collapsePatientProfile" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                                role="button" aria-expanded="true" aria-controls="collapsePatientProfile">
                                                                <h6 class="m-0 text-xs font-weight-bold text-primary text-center">المزيد ...</h6>
                                                            </a>
                                                            <!-- Card Content - Collapse -->
                                                            <div class="collapse" id="collapsePatientProfile">
                                                                <div class="card-body px-1 py-3">
                                                                    <div class="form-row">
                                                                        <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                            <label class="text-xs mb-0 mr-3" style="padding-bottom: 0.2rem;text-align:right;direction:rtl;">الحالة الإجتماعية : </label>
                                                                            <div class="card d-block" style="height: 38px">
                                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                                    <input type="radio" id="editRelationshipMarried" name="relationship" value="married" @if ( $patient->relationship == 'married') checked  @endif  class="custom-control-input">
                                                                                    <label class="text-xs custom-control-label" for="editRelationshipMarried">متزوج</label>
                                                                                </div>
                                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                                    <input type="radio" id="editRelationshipSingle" name="relationship"  value="single" @if ( $patient->relationship == 'single') checked  @endif class="custom-control-input">
                                                                                    <label class="text-xs custom-control-label" for="editRelationshipSingle">أعزب</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                            <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">عدد الأولاد : </label>
                                                                            <input type="tel" max="20" min="0" class="form-control form-control @error('child_count') is-invalid @enderror" value="{{$patient->child_count}}" name="child_count"
                                                                                style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                                            @error('child_count')
                                                                                <span class="invalid-feedback text-center" role="alert">
                                                                                    <strong >{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group mb-2 col-md-6 col-sm-12 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                            <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">المهنة : </label>
                                                                            <input type="text"class="VoiceToText form-control form-control @error('patient_job') is-invalid @enderror" value="{{$patient->patient_job}}" id="patient_job" name="patient_job"
                                                                                style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                                                @error('patient_job')
                                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                                        <strong >{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_job">
                                                                                <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                            </button>
                                                                        </div>
                                                                            <div class="form-group mb-2 col-md-6 col-sm-12 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                            <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">العنوان : </label>
                                                                            <input type="text" class="VoiceToText form-control @error('patient_address') is-invalid @enderror" id="patient_address" value="{{$patient->patient_address}}" name="patient_address"
                                                                            style="padding: 0.375rem 0.75rem;height:38px;text-align:center;direction: ltr;font-size: 75%;">
                                                                            @error('patient_address')
                                                                                <span class="invalid-feedback text-center" role="alert">
                                                                                    <strong >{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                            <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_address">
                                                                                <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">السوابق الجراحية : </label>
                                                                        <textarea  class="form-control" name="older_surgery" rows="2" style="height:38px;font-size: 75%;padding: 0.375rem 0.75rem;text-align:center"
                                                                            placeholder=" أكتب السوابق الجراحية في حال وجودها">{{$patient->older_surgery}}</textarea>
                                                                    </div>
                                                                    <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">السوابق المرضية : </label>
                                                                        <textarea  class="form-control" name="older_sicky" rows="2" style="padding: 0.375rem 0.75rem;text-align:center;height:38px;font-size: 75%"
                                                                            placeholder=" أكتب السوابق المرضية في حال وجودها">{{$patient->older_sicky}}</textarea>
                                                                    </div>
                                                                    <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">السوابق التحسسية : </label>
                                                                        <textarea  class="form-control" name="older_sensitive" rows="2" style="padding: 0.375rem 0.75rem;text-align:center;height:38px;font-size: 75%"
                                                                            placeholder=" أكتب السوابق التحسسية في حال وجودها">{{$patient->older_sensitive}}</textarea>
                                                                    </div>
                                                                    <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">الأدوية الدائمة : </label>
                                                                        <textarea  class="form-control" name="permanent_medic" rows="1" style="height:38px;font-size: 75%;padding: 0.375rem 0.75rem;text-align:center"
                                                                            placeholder=" أكتب الأدوية الدائمة في حال وجودها">{{$patient->permanent_medic}}</textarea>
                                                                    </div>
                                                                    <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">ملاحظات حول المريض : </label>
                                                                        <input type="text" class="form-control " name="patient_state" value="{{$patient->patient_state}}" placeholder=" أكتب ملاحظات في حال وجودها"
                                                                            style="padding: 0.375rem 0.75rem;height:38px;font-size: 75%;text-align:center">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- collapsePatientProfile -->
                                                    </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer py-1">
                                        <button type="submit" class="btn btn-primary btn-user">تعديل</button>
                                        <a class="btn btn-secondary btn-user"  data-dismiss="modal">عودة</a>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Modal Patient Profile -->

                        {{-- <!-- Modal View Review Emergency -->
                        <div class="modal fade" id="ViewReviewEmergency" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="{{route('Clinic.storeReview',$patient->id)}}" method="post" enctype="multipart/form-data" >
                                            @csrf
                                        <h5 class="text-center text-primary py-2">زيارة جديدة</h5><hr>
                                            <div class="row" style="direction: rtl">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label class="text-xs" style="text-align:right">نوع الزيارة :</label>
                                                        <select name="review_type" class="form-control @error('review_type') is-invalid @enderror" required style="padding: 0.375rem 0.75rem;height:50px;text-align:center;direction: ltr">
                                                            @error('review_type')
                                                                <span class="invalid-feedback text-center" role="alert">
                                                                    <strong >{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <option value="معاينة" selected>معاينة</option>
                                                            <option value="مراجعة" >مراجعة</option>
                                                            <option value="اسعافية" >اسعافية</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group position-relative" style="direction:rtl">
                                                        <label class="text-xs">سبب الزيارة :</label>
                                                        <textarea id="newReview-Main_complaint" class="VoiceToText form-control @error('main_complaint') is-invalid @enderror" name="main_complaint" required  rows="3" style="padding: 0.375rem 0.75rem;text-align:center" placeholder="سبب الزيارة"></textarea>
                                                            @error('main_complaint')
                                                                <span class="invalid-feedback text-center" role="alert">
                                                                    <strong >{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="newReview-Main_complaint">
                                                            <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                        </button>
                                                    </div>

                                                    <div class="form-group position-relative" style="direction:rtl" >
                                                        <label class="text-xs">القصة المرضية :</label>
                                                        <textarea id="newReview-pain_story" class=" VoiceToText form-control @error('pain_story') is-invalid @enderror" name="pain_story" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" placeholder="القصة المرضية"></textarea>
                                                            @error('pain_story')
                                                                <span class="invalid-feedback text-center" role="alert">
                                                                    <strong >{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="newReview-pain_story">
                                                            <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                        </button>
                                                    </div>
                                                <!-- Collapse Modal View Review Emergency -->
                                                <div class="card mb-4">
                                                    <!-- Card Header - Accordion -->
                                                    <a href="#CollapseViewReviewEmergency" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                        role="button" aria-expanded="true" aria-controls="CollapseViewReviewEmergency">
                                                        <h6 class="m-0 font-weight-bold text-gray-500 text-center">" رأي الطبيب - خطة العلاج - @if ($review->main_complaint ==' - تحديد عملية - تحليل' || $review->main_complaint =='تحديد عملية' || $review->main_complaint ==' - تحديد عملية - صورة - تحليل' || $review->main_complaint ==' - تحديد عملية - صورة') موعد العملية @elseالموعد القادم@endif - صور مرفقة "</h6>
                                                    </a>
                                                    <!-- Card Content - Collapse -->
                                                    <div class="collapse" id="CollapseViewReviewEmergency">
                                                        <div class="card-body px-1 py-3">

                                                            <div class="form-group position-relative" style="direction:rtl" >
                                                                <label class="text-xs">رأي الطبيب :</label>
                                                                <textarea id="newReview-medical_report" class="VoiceToText form-control @error('medical_report') is-invalid @enderror" name="medical_report" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" placeholder="رأي الطبيب"></textarea>
                                                                    @error('medical_report')
                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                            <strong >{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-medical_report">
                                                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                </button>
                                                            </div>

                                                            <div class="form-group position-relative" style="direction:rtl" >
                                                                <label class="text-xs">خطة العلاج :</label>
                                                                <textarea id="newReview-treatment_plan" class="VoiceToText form-control @error('treatment_plan') is-invalid @enderror" name="treatment_plan" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" placeholder="خطة العلاج"></textarea>
                                                                    @error('treatment_plan')
                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                            <strong >{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-treatment_plan">
                                                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                </button>
                                                            </div>

                                                            <div class="form-group" style="direction:rtl" >
                                                                <label class="text-xs">الموعد القادم :</label>
                                                                <input type="date" class="form-control @error('date_expecting') is-invalid @enderror" name="date_expecting" style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
                                                                @error('date_expecting')
                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                        <strong >{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group" style="direction:ltr" >
                                                                <label class="text-xs" style="text-align: right;direction:rtl;">صور مرفقة :</label>
                                                                <input type="file" class="input_image form-control @error('images') is-invalid @enderror" name="images[]" multiple style="padding: 0.375rem 0.75rem;height:50px;text-align:center;">
                                                                @error('images')
                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                        <strong >{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- Collapse Modal View Review Emergency -->

                                                </div>

                                                <div class="col-lg-4 bg-new-image">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer py-1">
                                            <button type="submit" class="btn btn-primary btn-user">إضافة</button>
                                            <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                        </form>
                                        </div>
                                </div>
                            </div>
                        </div><!-- Modal View Review Emergency --> --}}

                    </div><!-- Modal Profile -->
                </div>
            </div>
        </div>
        <hr>
        {{-------------- Reviews --------------}}
            @forelse ($patientReviews->whereNull('patient_review_id') as $review)
                @if ($review->review_type == 'معاينة')
                @php
                $type ='success'
                @endphp
                @elseif ($review->review_type == 'مراجعة')
                @php
                $type ='warning'
                @endphp
                @elseif ($review->review_type == 'اسعافية' || $review->review_type == 'عمل جراحي')
                @php
                $type ='danger'
                @endphp
                @else
                @php
                $type ='info'
                @endphp
                @endif
                <div class="card my-2 shadow border-bottom-{{$type}} border-top-{{$type}}">
                {{-- ------------------ nav Reviews ------------------- --}}
                    @if ($review->patient->deleted_at == null)
                        <div class="card-header p-3 " style="display:inline-flex;direction:rtl">
                    @else
                        <div class="card-header bg-gradient-danger p-3 " style="display:inline-flex;direction:rtl">
                    @endif
                        <div class="d-sm-block d-md-inline-flex">
                            @if ($patient->deleted_at == null)
                                <div class="dropdown no-arrow ml-2" style="line-height :normal;">
                                    <a class="dropdown-toggle px-1" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink" style="text-align:right">
                                        <div class="dropdown-header text-gray-800 bg-gray-300"><h6><b>الإجراءات</b></h6></div>
                                        {{-- <a class="dropdown-item " type="button" data-toggle="modal" data-target="#InsideReview">إضافة زيارة تابعة</a> --}}
                                        <a href="{{route('Clinic.printReview' ,$review->id)}}" class="dropdown-item " type="button"><i class="fa-solid fa-lg fa-print"></i> طباعة ال{{$review->review_type}}</a>
                                        <a class="dropdown-item " type="button" data-toggle="modal" data-target="#EditReview{{$review->id}}">تعديل ال{{$review->review_type}}</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item " type="button" data-toggle="modal" data-target="#DeleteReview{{$review->id}}">حذف ال{{$review->review_type}}</a>
                                    </div>
                                </div>
                            @endif
                            <div  class="ml-2">
                                <a class="card_dropdown" href="#collapse{{$review->id}}" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapse{{$review->id}}">
                                </a>
                            </div>
                            <div >
                                <a  class="mx-2" type="button" onclick="document.getElementById('specialWithStar{{$review->id}}').submit();" >
                                    @if ($review->special_with_star == 1)
                                        <i class="fa-solid fa-star" style="color: #f2df0d;"  data-toggle="tooltip" title="إلغاء التمييز"></i>
                                    @elseif ($review->special_with_star == 0)
                                        <i class="fa-solid fa-star text-gray-400"  data-toggle="tooltip" title="تمييز بنجمة"></i>
                                    @endif
                                </a>
                                <form id="specialWithStar{{$review->id}}" action="{{route('Clinic.specialWithStar_do',$review->id)}}" method="post" class="d-none">
                                    @csrf
                                    <input type="hidden" name="special_with_star" @if ($review->special_with_star == 1)
                                    value="0"
                                    @else
                                    value="1"
                                    @endif >
                                </form>
                            </div>
                        </div>
                        <div class="text-center" style="width:100%;">
                            <h5 class="text-{{$type}} p-0 m-0"><b>{{$review->review_type}}</b>
                                @if ($review->done == 0)
                                    <span class="text-xs text-gray-900">لم يتم الفحص</span>
                                    <div >
                                        <form  action="{{route('Clinic.tasksReview',$review->id)}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-white" style="width:20%" name="done" value="1" ><i class="fa-regular fa-circle-check text-gray-400"></i></button>
                                        </form>
                                    </div>
                                @elseif ($review->done == 1)
                                    <i class="fa-regular fa-circle-check text-primary"></i>
                                @endif
                            </h5>
                        </div>
                        <div style="text-align: left;width: 30%;">
                            <p class="text-xs text-gray-900 p-0 m-0">تاريخ الزيارة :</p>
                            <p class="text-xs text-gray-800  p-0 m-0">{{$review->created_at->format('D d-m-Y')}}</p>
                            <p class="text-xs text-gray-800  p-0 m-0" style="direction: ltr">{{$patient->created_at->format('h:i a')}}</p>
                        </div>
                    </div>{{-- ------------------ nav Reviews ------------------- --}}
                    {{-- ------------------ body Reviews ------------------- --}}
                    <div class="collapse show" id="collapse{{$review->id}}">
                        <div class="card-body p-2 @if($review->done != 1) bg-empty-image @endif ">
                            <div class="row px-1" style="direction:rtl;height:auto ;">
                                <div class="col-lg-6 card my-1 p-2" style="direction:ltr;height:360px ;overflow-y:auto">
                                    <ul style="direction:rtl;">
                                        <li><div class="text-xs text-{{$type}} text-uppercase mx-1"><b>سبب الزيارة</b> :</div></li>
                                        <div class="h6 mb-0 text-gray-800">{{$review->main_complaint}}</div>

                                        <li><div class="text-xs text-{{$type}} text-uppercase mx-1"><b>القصة المرضية</b> :</div></li>
                                        <div class="h6 mb-0 text-gray-800">
                                            @if ($review->pain_story)
                                                {{$review->pain_story}}
                                            @else
                                                ------------------------------
                                            @endif
                                        </div>

                                        <li><div class="text-xs text-{{$type}} text-uppercase mx-1"><b>التحليل مكتوب</b> :</div></li>
                                        <div class="h6 mb-0 text-gray-800">
                                            @if ($review->med_analysis_T)
                                                {{$review->med_analysis_T}}
                                            @else
                                                ------------------------------
                                            @endif
                                        </div>
                                        <li><div class="text-xs text-{{$type}} text-uppercase mx-1"><b>محتوى الصورة</b> :</div></li>
                                        <div class="h6 mb-0 text-gray-800">
                                            @if ($review->med_photo_T)
                                                {{$review->med_photo_T}}
                                            @else
                                                ------------------------------
                                            @endif
                                        </div>
                                        <li><div class="text-xs text-{{$type}} text-uppercase mx-1"><b>رأي الطبيب</b> :</div></li>
                                        <div class="h6 mb-0 text-gray-800">
                                            @if ($review->medical_report)
                                                {{$review->medical_report}}
                                            @else
                                                ------------------------------
                                            @endif
                                        </div>

                                        <li><div class="text-xs text-{{$type}} text-uppercase mx-1"><b>خطة العلاج</b> :</div></li>
                                        <div class="h6 mb-0 text-gray-800">
                                            @if ($review->treatment_plan)
                                                {{$review->treatment_plan}}
                                            @else
                                                ------------------------------
                                            @endif
                                        </div>

                                        <li><div class="text-xs text-{{$type}} text-uppercase mx-1"><b>
                                            @if ($review->main_complaint ==' - تحديد عملية - تحليل' || $review->main_complaint =='تحديد عملية' || $review->main_complaint ==' - تحديد عملية - صورة - تحليل' || $review->main_complaint ==' - تحديد عملية - صورة')
                                                تاريخ موعد العملية المتوقع
                                            @else
                                                تاريخ الموعد القادم
                                            @endif
                                        </b> :</div></li>
                                        <div class="h6 mb-0 text-gray-800">
                                            @if ($review->date_expecting == null)
                                                لا يوجد زيارة متوقعة
                                            @else
                                                {{Carbon\Carbon::parse($review->date_expecting)->format('D d-m-Y')}}
                                            @endif
                                        </div>

                                        <li><div class="text-xs text-{{$type}} text-uppercase mx-1"><b>ملاحظات الطبيب</b> :</div></li>
                                        <div class="h6 mb-0 text-gray-800">
                                            @if ($review->doctor_notes)
                                                {{$review->doctor_notes}}
                                            @else
                                                ------------------------------
                                            @endif
                                        </div>

                                        <li><div class="text-xs text-{{$type}} text-uppercase mx-1"><b>تاريخ الزيارة</b> :</div></li>
                                        <div class="h6 mb-0 text-gray-800">{{$review->created_at->format('D d-m-Y')}}</div>

                                    </ul>

                                </div>
                                {{-- ------------------ photos Reviews ------------------- --}}
                                @if ($review->reviewMedias->count() > 0)
                                    <div class="col-lg-6 bg-gradient-dark my-1" style="direction:rtl;height:360px;border-radius: 0.35rem;">
                                        <div id="carouselIndicatorsReview{{$review->id}}" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                @foreach ($review->reviewMedias as $media)
                                                    <li data-target="#carouselIndicatorsReview{{$review->id}}" data-slide-to="{{ $loop->index }}" class="{{ $loop->index == 0 ? 'active' : ''}}"></li>
                                                @endforeach
                                            </ol>
                                            <div class="carousel-inner">
                                                @foreach ($review->reviewMedias as $media)
                                                    <div class="carousel-item {{ $loop->index == 0 ? 'active' : ''}}">
                                                        <img src="{{ asset('assets/Clinic/'.auth()->user()->doctor_id.'/'.$media->file_name) }}" class="d-block" style="border-radius: 0.35rem;height:360px;object-fit:contain;width:100%;" alt="...">
                                                        <a class="position-absolute text-danger" style="right: 40px;bottom: 10px; border:1px solid;border-radius: 100%" href="{{route('Clinic.destroyReviewMedia',$media->id)}}"><i class=" fas fa-fw  fa-2x fa-trash-alt"></i></a>

                                                    </div>
                                                @endforeach
                                            </div>
                                            @if ($review->reviewMedias->count() > 1)
                                            <button class="carousel-control-prev" type="button" data-target="#carouselIndicatorsReview{{$review->id}}" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-target="#carouselIndicatorsReview{{$review->id}}" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only  text-primary">Next</span>
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-6 bg-register-image"></div>
                                @endif{{-- ------------------ photos Reviews ------------------- --}}
                            </div>
                            <hr>

                            {{-- ------------------ InsideReviews ------------------- --}}
                            <div class="row mr-2" style="direction:rtl">
                                @forelse ($review->insideReviews as $insideReview)
                                    @if ($insideReview->review_type == 'معاينة')
                                        @php
                                        $type1 ='success'
                                        @endphp
                                    @elseif ($insideReview->review_type == 'مراجعة')
                                        @php
                                        $type1 ='warning'
                                        @endphp
                                    @elseif ($insideReview->review_type == 'اسعافية' || $insideReview->review_type == 'عمل جراحي')
                                        @php
                                        $type1 ='danger'
                                        @endphp
                                        @else
                                        @php
                                        $type1 ='info'
                                        @endphp
                                    @endif
                                    <div class="col-lg-12 col-md-12">

                                        <div class=" my-1 card border-right-{{$type1}}" >
                                            {{-- ------------------ Nav InsideReviews ------------------- --}}
                                            @if ($patient->deleted_at == null)
                                                <div class="card-header p-3 " style="display:inline-flex;direction:rtl">
                                            @else
                                                <div class="card-header bg-gradient-danger p-3 " style="display:inline-flex;direction:rtl">
                                            @endif
                                                <div class="d-sm-block d-md-inline-flex">
                                                    @if ($patient->deleted_at == null)
                                                        <div class="dropdown no-arrow ml-2" style="line-height :normal;">
                                                            <a class="dropdown-toggle px-1" href="#" role="button" id="dropdownMenuLink"
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                                aria-labelledby="dropdownMenuLink" style="text-align:right">
                                                                <div class="dropdown-header text-gray-800 bg-gray-300"><h6><b>الإجراءات</b></h6></div>
                                                                <a href="{{route('Clinic.printReview' ,$insideReview->id)}}" class="dropdown-item " type="button"><i class="fa-solid fa-lg fa-print"></i> طباعة ال{{$insideReview->review_type}} التابعة</a>
                                                                <a class="dropdown-item " type="button" data-toggle="modal" data-target="#EditInsideReview{{$insideReview->id}}">تعديل ال{{$insideReview->review_type}} التابعة</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item " type="button" data-toggle="modal" data-target="#DeleteInsideReview{{$insideReview->id}}">حذف ال{{$insideReview->review_type}} التابعة</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="ml-2">
                                                        <a class="card_dropdown" href="#collapse{{$insideReview->id}}" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapse{{$insideReview->id}}">
                                                        </a>
                                                    </div>
                                                    <div >
                                                        <a  class="mx-2" type="button" onclick="document.getElementById('specialWithStar{{$insideReview->id}}').submit();" >
                                                            @if ($insideReview->special_with_star == 1)
                                                                <i class="fa-solid fa-star" style="color: #f2df0d;"  data-toggle="tooltip" title="إلغاء التمييز"></i>
                                                            @elseif ($insideReview->special_with_star == 0)
                                                                <i class="fa-solid fa-star text-gray-400"  data-toggle="tooltip" title="تمييز بنجمة"></i>
                                                            @endif
                                                        </a>
                                                        <form id="specialWithStar{{$insideReview->id}}" action="{{route('Clinic.specialWithStar_do',$insideReview->id)}}" method="post" class="d-none">
                                                            @csrf
                                                            <input type="hidden" name="special_with_star" @if ($insideReview->special_with_star == 1)
                                                            value="0"
                                                            @else
                                                            value="1"
                                                            @endif >
                                                        </form>
                                                    </div>

                                                </div>
                                                <div class="text-center" style="width:100%;">
                                                    <h5 class="text-{{$type1}} p-0 m-0"><b>{{$insideReview->review_type}}</b>
                                                        @if ($insideReview->done == 0)
                                                            <span class="text-xs text-gray-900">لم يتم الفحص</span>
                                                            <div >
                                                                <form  action="{{route('Clinic.tasksReview',$insideReview->id)}}" method="post">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-white" style="width:20%" name="done" value="1" ><i class="fa-regular fa-circle-check text-gray-400"></i></button>
                                                                </form>
                                                            </div>
                                                        @elseif ($insideReview->done == 1)
                                                            <i class="fa-regular fa-circle-check text-primary"></i>
                                                        @endif
                                                    </h5>
                                                </div>
                                                <div style="text-align: left;width: 35%;">
                                                    <p class="text-xs text-gray-900 p-0 m-0">تاريخ الزيارة :</p>
                                                    <p class="text-xs text-gray-800  p-0 m-0">{{$insideReview->created_at->format('D d-m-Y')}}</p>
                                                    <p class="text-xs text-gray-800  p-0 m-0" style="direction: ltr">{{$patient->created_at->format('h:i a')}}</p>
                                                </div>
                                            </div>{{-- ------------------Nav InsideReviews ------------------- --}}

                                            {{-- ------------------Body InsideReviews ------------------- --}}
                                            <div class="collapse" id="collapse{{$insideReview->id}}">
                                                <div class="card-body p-2
                                                @if ($insideReview->done != 1)
                                                bg-empty-image
                                                @endif
                                                ">
                                                    <div class="form-row">
                                                            <div class="col-lg-6 col-md-7 my-1 card p-2" style="direction:ltr;height:360px ;overflow-y:auto">
                                                            <ul style="direction:rtl;">
                                                                <li><div class=" text-{{$type1}} text-uppercase mx-1"><b>سبب الزيارة</b> :</div></li>
                                                                <div class="h6 mb-0 text-gray-800">{{$insideReview->main_complaint}}</div>

                                                                <li><div class=" text-{{$type1}} text-uppercase mx-1"><b>الحالة الحديثة</b> :</div></li>
                                                                <div class="h6 mb-0 text-gray-800">
                                                                    @if ($insideReview->pain_story)
                                                                        {{$insideReview->pain_story}}
                                                                    @else
                                                                        ------------------------------
                                                                    @endif
                                                                </div>

                                                                <li><div class=" text-{{$type1}} text-uppercase mx-1"><b>التحليل مكتوب</b> :</div></li>
                                                                <div class="h6 mb-0 text-gray-800">
                                                                    @if ($insideReview->med_analysis_T)
                                                                        {{$insideReview->med_analysis_T}}
                                                                    @else
                                                                        ------------------------------
                                                                    @endif
                                                                </div>
                                                                <li><div class=" text-{{$type1}} text-uppercase mx-1"><b>محتوى الصورة</b> :</div></li>
                                                                <div class="h6 mb-0 text-gray-800">
                                                                    @if ($insideReview->med_photo_T)
                                                                        {{$insideReview->med_photo_T}}
                                                                    @else
                                                                        ------------------------------
                                                                    @endif
                                                                </div>
                                                                <li><div class=" text-{{$type1}} text-uppercase mx-1"><b>رأي الطبيب</b> :</div></li>
                                                                <div class="h6 mb-0 text-gray-800">
                                                                    @if ($insideReview->medical_report)
                                                                        {{$insideReview->medical_report}}
                                                                    @else
                                                                        ------------------------------
                                                                    @endif
                                                                </div>

                                                                <li><div class=" text-{{$type1}} text-uppercase mx-1"><b>خطة العلاج</b> :</div></li>
                                                                <div class="h6 mb-0 text-gray-800">
                                                                    @if ($insideReview->treatment_plan)
                                                                        {{$insideReview->treatment_plan}}
                                                                    @else
                                                                        ------------------------------
                                                                    @endif
                                                                </div>

                                                                <li><div class=" text-{{$type1}} text-uppercase mx-1"><b>
                                                                    @if ($insideReview->main_complaint ==' - تحديد عملية - تحليل' || $insideReview->main_complaint =='تحديد عملية' || $insideReview->main_complaint ==' - تحديد عملية - صورة - تحليل' || $insideReview->main_complaint ==' - تحديد عملية - صورة')
                                                                        تاريخ موعد العملية المتوقع
                                                                    @else
                                                                        تاريخ الموعد القادم
                                                                    @endif</b> :</div></li>
                                                                <div class="h6 mb-0 text-gray-800">
                                                                    @if ($insideReview->date_expecting == null)
                                                                        لا يوجد زيارة متوقعة
                                                                    @else
                                                                        {{Carbon\Carbon::parse($insideReview->date_expecting)->format('D d-m-Y')}}
                                                                    @endif
                                                                </div>

                                                                <li><div class=" text-{{$type1}} text-uppercase mx-1"><b>ملاحظات الطبيب</b> :</div></li>
                                                                <div class="h6 mb-0 text-gray-800">
                                                                    @if ($insideReview->doctor_notes)
                                                                        {{$insideReview->doctor_notes}}
                                                                    @else
                                                                        ------------------------------
                                                                    @endif
                                                                </div>

                                                                <li><div class=" text-{{$type1}} text-uppercase mx-1"><b>تاريخ الزيارة</b> :</div></li>
                                                                <div class="h6 mb-0 text-gray-800">{{$insideReview->created_at->format('D d-m-Y')}}</div>

                                                            </ul>
                                                        </div>
                                                        @if ($insideReview->reviewMedias->count() > 0)
                                                            <div class="col-lg-6 col-md-5 my-1 bg-gradient-dark" style="direction:rtl;height:360px;border-radius: 0.35rem;" >
                                                                <div id="carouselIndicatorsInsideReview{{$insideReview->id}}" class="carousel slide" data-ride="carousel">
                                                                    <ol class="carousel-indicators">
                                                                        @foreach ($insideReview->reviewMedias as $media)
                                                                            <li data-target="#carouselIndicatorsInsideReview{{$insideReview->id}}" data-slide-to="{{ $loop->index }}" class="{{ $loop->index == 0 ? 'active' : ''}}"></li>
                                                                        @endforeach
                                                                    </ol>
                                                                    <div class="carousel-inner">
                                                                        @foreach ($insideReview->reviewMedias as $media)
                                                                            <div class=" carousel-item {{ $loop->index == 0 ? 'active' : ''}}">
                                                                                <img src="{{ asset('assets/Clinic/'.auth()->user()->doctor_id.'/'.$media->file_name) }}" style=" border-radius: 0.35rem;height:360px;object-fit:contain;width:100%;" class="d-block" alt="...">
                                                                                    <a class="position-absolute text-danger" style="right: 40px;bottom: 10px; border:1px solid;border-radius: 100% " href="{{route('Clinic.destroyReviewMedia',$media->id)}}"><i class=" fas fa-fw  fa-2x fa-trash-alt"></i></a>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    @if ($insideReview->reviewMedias->count() > 1)
                                                                    <button class="carousel-control-prev" type="button" data-target="#carouselIndicatorsInsideReview{{$insideReview->id}}" data-slide="prev">
                                                                    <span class="carousel-control-prev-icon text-primary" aria-hidden="true"></span>
                                                                    <span class="sr-only">Previous</span>
                                                                    </button>
                                                                    <button class="carousel-control-next" type="button" data-target="#carouselIndicatorsInsideReview{{$insideReview->id}}" data-slide="next">
                                                                    <span class="carousel-control-next-icon " aria-hidden="true"></span>
                                                                    <span class="sr-only text-primary">Next</span>
                                                                    </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="col-lg-6 col-md-5 my-1 bg-register-image"></div>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>{{-- ------------------Body InsideReviews ------------------- --}}

                                            <div style="direction:ltr">
                                                <!-- Modal Delete InsideReview-->
                                                <div class="modal fade" id="DeleteInsideReview{{$insideReview->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog  modal-dialog-centered ">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <h5 class="text-center text-danger">رسالة تأكيد</h5>
                                                                <div class="row p-3">
                                                                    <div class="col-lg-4 d-none d-lg-block bg-deleted-image"></div>
                                                                    <div class="col-lg-8" style="text-align:center">
                                                                        <h5 class="text-center">هل أنت متأكد من حذف ال{{$insideReview->review_type}} ؟</h5>
                                                                        <p> عند التأكيد سوف يتم إرسال ال{{$insideReview->review_type}} إلى سلة المحذوفات </p>
                                                                        <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                                                        <a href="{{route('Clinic.softDeleteReview',$insideReview->id)}}" class="btn btn-danger btn-user ">تأكيد</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- Modal Delete InsideReview-->


                                                <!-- Modal Edit InsideReview-->
                                                <div class="modal fade" id="EditInsideReview{{$insideReview->id}}" tabindex="-1" aria-labelledby="EditInsideReview{{$insideReview->id}}" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-body py-1">
                                                                <form action="{{route('Clinic.updateReview_doctor',$insideReview->id)}}" method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="d-block py-2" style="width:100% ;direction: rtl">


                                                                        {{-- <p class="text-center text-{{$type}} p-0 m-0">{{$review->review_type}}</p> --}}
                                                                        <p class="text-center text-gray-800 p-0 m-0"><span class="text-{{$type}} font-weight-bold">{{$insideReview->review_type}} للمريض :  </span><a class="text-center text-gray-800 p-0 m-0" href="{{route('Clinic.patientProfile',$insideReview->patient->patient_slug)}}"><b>{{$insideReview->patient->patient_name}}</b></a></p>
                                                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0" href="{{route('Clinic.patientProfile',$insideReview->patient->patient_slug)}}"><b class="text-xs text-gray-900">وقت الزيارة : </b> {{$insideReview->created_at->format('D d/m - h:i a')}}</a></p>
                                                                        <p class="text-center text-xs text-gray-800 p-0 m-0">سبب الزيارة : <b>{{$insideReview->main_complaint}}</b></p>
                                                                    </div>
                                                                <hr class="m-0">
                                                                    <div class="row">
                                                                        <div class="col-lg-4 bg-new-image"></div>
                                                                        <div class="col-lg-8">
                                                                            <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                                <label class="text-xs">رأي الطبيب : </label>
                                                                                <textarea id="editReview-medical_report{{$insideReview->id}}" class="VoiceToText form-control @error('medical_report') is-invalid @enderror" name="medical_report" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" >{{$insideReview->medical_report}}</textarea>
                                                                                    @error('medical_report')
                                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                                            <strong >{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-medical_report{{$insideReview->id}}">
                                                                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                                </button>
                                                                            </div>

                                                                            <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                                <label class="text-xs">خطة العلاج : </label>
                                                                                <textarea id="editReview-treatment_plan{{$insideReview->id}}" class="VoiceToText form-control @error('treatment_plan') is-invalid @enderror" name="treatment_plan" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" >{{$insideReview->treatment_plan}}</textarea>
                                                                                    @error('treatment_plan')
                                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                                            <strong >{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-treatment_plan{{$insideReview->id}}">
                                                                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                                </button>
                                                                            </div>
                                                                            <!-- Collapse Modal InsideReviews InsideEmergency -->
                                                                            <div class="card mb-2">
                                                                                <!-- Card Header - Accordion -->
                                                                                <a href="#CollapseEditViewReviewEmergency{{$insideReview->id}}" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                                                    role="button" aria-expanded="true" aria-controls="CollapseEditViewReviewEmergency">
                                                                                    <h6 class="m-0 text-xs font-weight-bold text-gray-600 text-center">المزيد  :
                                                                                        <span class=" @if ($insideReview->main_complaint)
                                                                                        text-primary
                                                                                        @endif">سبب الزيارة</span>
                                                                                        - <span class=" @if ($insideReview->pain_story)
                                                                                        text-primary
                                                                                        @endif">الحالة الحديثة</span>
                                                                                        - <span class=" @if ($insideReview->med_analysis_T)
                                                                                        text-primary
                                                                                        @endif">نص التحليل</span>
                                                                                        - <span class=" @if ($insideReview->med_photo_T)
                                                                                        text-primary
                                                                                        @endif">محتوى الصورة</span>
                                                                                        - <span class=" @if ($insideReview->doctor_notes)
                                                                                        text-primary
                                                                                        @endif">ملاحظات الزيارة</span>
                                                                                        @if (Carbon\Carbon::today() < Carbon\Carbon::parse($insideReview->date_expecting))
                                                                                            - <span class=" @if ($insideReview->date_expecting)
                                                                                                text-primary
                                                                                                @endif">
                                                                                            @if ($insideReview->main_complaint ==' - تحديد عملية - تحليل' || $insideReview->main_complaint =='تحديد عملية' || $insideReview->main_complaint ==' - تحديد عملية - صورة - تحليل' || $insideReview->main_complaint ==' - تحديد عملية - صورة')
                                                                                                 موعد العملية
                                                                                            @else
                                                                                                 الموعد القادم
                                                                                            @endif</span>
                                                                                        @endif

                                                                                    </h6>
                                                                                </a>
                                                                                <!-- Card Content - Collapse -->
                                                                                <div class="collapse" id="CollapseEditViewReviewEmergency{{$insideReview->id}}">
                                                                                    <div class="card-body px-1 py-1">
                                                                                        <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                                            <label class="text-xs">نص التحليل : </label>
                                                                                            <textarea id="editReview-med_analysis_T{{$insideReview->id}}" class="VoiceToText form-control @error('med_analysis_T') is-invalid @enderror" name="med_analysis_T" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" >{{$insideReview->med_analysis_T}}</textarea>
                                                                                                @error('med_analysis_T')
                                                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                                                        <strong >{{ $message }}</strong>
                                                                                                    </span>
                                                                                                @enderror
                                                                                            <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:39px;" for="editReview-med_analysis_T{{$insideReview->id}}">
                                                                                                <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                                            <label class="text-xs">محتوى الصورة : </label>
                                                                                            <textarea id="editReview-med_photo_T{{$insideReview->id}}" class="VoiceToText form-control @error('med_photo_T') is-invalid @enderror" name="med_photo_T" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" >{{$insideReview->med_photo_T}}</textarea>
                                                                                                @error('med_photo_T')
                                                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                                                        <strong >{{ $message }}</strong>
                                                                                                    </span>
                                                                                                @enderror
                                                                                            <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:39px;" for="editReview-med_photo_T{{$insideReview->id}}">
                                                                                                <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="form-group mb-2" style="direction:rtl;text-align:right" >
                                                                                            <label class="text-xs">
                                                                                                @if ($insideReview->main_complaint ==' - تحديد عملية - تحليل' || $insideReview->main_complaint =='تحديد عملية' || $insideReview->main_complaint ==' - تحديد عملية - صورة - تحليل' || $insideReview->main_complaint ==' - تحديد عملية - صورة')
                                                                                                    تاريخ موعد العملية المتوقع
                                                                                                @else
                                                                                                    تاريخ الموعد القادم
                                                                                                @endif : </label>
                                                                                            {{-- @if ($review->date_expecting) --}}

                                                                                                {{-- @dd(\Carbon\Carbon::parse($review->date_expecting)->format('Y-m-d')) --}}
                                                                                            {{-- @endif --}}
                                                                                            <input type="date" min="{{Carbon\Carbon::tomorrow()->format('Y-m-d')}}" @if ($insideReview->date_expecting)
                                                                                                value="{{Carbon\Carbon::parse($insideReview->date_expecting)->format('Y-m-d')}}"
                                                                                            @endif  class="form-control @error('date_expecting') is-invalid @enderror" name="date_expecting" style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
                                                                                            @error('date_expecting')
                                                                                                <span class="invalid-feedback text-center" role="alert">
                                                                                                    <strong >{{ $message }}</strong>
                                                                                                </span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                                            <label class="text-xs">ملاحظات الزيارة : </label>
                                                                                            <textarea id="editReview-doctor_notes{{$insideReview->id}}" class=" VoiceToText form-control @error('doctor_notes') is-invalid @enderror" name="doctor_notes" rows="3" style="padding: 0.375rem 0.75rem;text-align:center">{{$insideReview->doctor_notes}}</textarea>
                                                                                                @error('doctor_notes')
                                                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                                                        <strong >{{ $message }}</strong>
                                                                                                    </span>
                                                                                                @enderror
                                                                                            <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-doctor_notes{{$insideReview->id}}">
                                                                                                <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                                            </button>
                                                                                        </div>

                                                                                        {{-- <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                                            <label class="text-xs">سبب الزيارة : </label>
                                                                                            <textarea id="editReview-main_complaint{{$insideReview->id}}" class=" VoiceToText form-control @error('main_complaint') is-invalid @enderror" name="main_complaint" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" >{{$insideReview->main_complaint}}</textarea>
                                                                                                @error('main_complaint')
                                                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                                                        <strong >{{ $message }}</strong>
                                                                                                    </span>
                                                                                                @enderror
                                                                                            <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-main_complaint{{$insideReview->id}}">
                                                                                                <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                                            </button>
                                                                                        </div> --}}
                                                                                        <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                                            <label class="text-xs">الحالة الحديثة : </label>
                                                                                            <textarea id="editReview-pain_story{{$insideReview->id}}" class=" VoiceToText form-control @error('pain_story') is-invalid @enderror" name="pain_story" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" >{{$insideReview->pain_story}}</textarea>
                                                                                                @error('pain_story')
                                                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                                                        <strong >{{ $message }}</strong>
                                                                                                    </span>
                                                                                                @enderror
                                                                                            <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-pain_story{{$insideReview->id}}">
                                                                                                <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                                            </button>
                                                                                        </div>

                                                                                        {{-- علق لأن المشروع الحالي لا يمكن رفع الصور --}}
                                                                                        <div class="form-group mb-2" style="direction:ltr;text-align:right" >
                                                                                            <label class="text-xs" style="text-align:right;direction: rtl;">صور مرفقة : </label>
                                                                                            <input type="file" class="input_image form-control @error('images') is-invalid @enderror" name="images[]" multiple style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
                                                                                            @error('images')
                                                                                                <span class="invalid-feedback text-center" role="alert">
                                                                                                    <strong >{{ $message }}</strong>
                                                                                                </span>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div><!-- Collapse Modal View Review Emergency -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer py-1">
                                                                    <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                                                    <button type="submit" class="btn btn-primary btn-user">حفظ</button>
                                                                </form>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div><!-- Modal Edit InsideReview-->

                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <div class="card mr-2 my-1 p-3 w-100 border-right-dark">
                                        <h5 class="">لا يوجد زيارات لاحقة</h5>
                                    </div>
                                @endforelse
                            </div>{{-- ------------------ InsideReviews ------------------- --}}

                        </div>
                    </div>{{-- ------------------ body Reviews ------------------- --}}

                    <!-- Modals Review InsideReviews -->
                    <div  style="direction:ltr">
                        <!-- Modal Delete Review-->
                        <div class="modal fade" id="DeleteReview{{$review->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered ">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h5 class="text-center text-danger">رسالة تأكيد</h5>
                                        <div class="row p-3">
                                            <div class="col-lg-4 d-none d-lg-block bg-deleted-image"></div>
                                            <div class="col-lg-8" style="text-align:center">
                                                <h5 class="text-center">هل أنت متأكد من حذف ال{{$review->review_type}} الرئيسية ؟</h5>
                                                <p> عند التأكيد سوف يتم إرسال ال{{$review->review_type}} مع جميع الزيارات الفرعية إلى سلة المحذوفات </p>
                                                <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                                <a href="{{route('Clinic.softDeleteReview',$review->id)}}" class="btn btn-danger btn-user ">تأكيد</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Delete Review-->

                        <!-- Modal Edit View Review Emergency-->
                        <div class="modal fade" id="EditReview{{$review->id}}" tabindex="-1" aria-labelledby="EditReview{{$review->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-body py-1">
                                        <form action="{{route('Clinic.updateReview_doctor',$review->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="d-block py-2" style="width:100% ;direction: rtl">
                                                <p class="text-center text-gray-800 p-0 m-0"><span class="text-{{$type}} font-weight-bold">{{$review->review_type}} للمريض :  </span><a class="text-center text-gray-800 p-0 m-0" href="{{route('Clinic.patientProfile',$review->patient->patient_slug)}}"><b>{{$review->patient->patient_name}}</b></a></p>
                                                <p class="text-center text-xs text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0" href="{{route('Clinic.patientProfile',$review->patient->patient_slug)}}"><b class="text-xs text-gray-900">وقت الزيارة : </b> {{$review->created_at->format('D d/m - h:i a')}}</a></p>
                                                <p class="text-center text-xs text-gray-800 p-0 m-0">سبب الزيارة : <b>{{$review->main_complaint}}</b></p>
                                            </div>
                                        <hr class="m-0">
                                            <div class="row">
                                                <div class="col-lg-4 bg-new-image"></div>
                                                <div class="col-lg-8">
                                                    <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                        <label class="text-xs">رأي الطبيب : </label>
                                                        <textarea id="editReview-medical_report{{$review->id}}" class="VoiceToText form-control @error('medical_report') is-invalid @enderror" name="medical_report" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" >{{$review->medical_report}}</textarea>
                                                            @error('medical_report')
                                                                <span class="invalid-feedback text-center" role="alert">
                                                                    <strong >{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-medical_report{{$review->id}}">
                                                            <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                        </button>
                                                    </div>

                                                    <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                        <label class="text-xs">خطة العلاج : </label>
                                                        <textarea id="editReview-treatment_plan{{$review->id}}" class="VoiceToText form-control @error('treatment_plan') is-invalid @enderror" name="treatment_plan" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" >{{$review->treatment_plan}}</textarea>
                                                            @error('treatment_plan')
                                                                <span class="invalid-feedback text-center" role="alert">
                                                                    <strong >{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-treatment_plan{{$review->id}}">
                                                            <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                        </button>
                                                    </div>
                                                    <!-- Collapse Modal InsideReviews InsideEmergency -->
                                                    <div class="card mb-2">
                                                        <!-- Card Header - Accordion -->
                                                        <a href="#CollapseEditViewReviewEmergency{{$review->id}}" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                            role="button" aria-expanded="true" aria-controls="CollapseEditViewReviewEmergency">
                                                            <h6 class="m-0 text-xs font-weight-bold text-gray-600 text-center">المزيد  :
                                                                <span class=" @if ($review->main_complaint)
                                                                text-primary
                                                                @endif">سبب الزيارة</span>
                                                                - <span class=" @if ($review->pain_story)
                                                                text-primary
                                                                @endif">القصة المرضية</span>
                                                                - <span class=" @if ($review->med_analysis_T)
                                                                text-primary
                                                                @endif">نص التحليل</span>
                                                                - <span class=" @if ($review->med_photo_T)
                                                                text-primary
                                                                @endif">محتوى الصورة</span>
                                                                - <span class=" @if ($review->doctor_notes)
                                                                text-primary
                                                                @endif">ملاحظات الزيارة</span>
                                                                @if (Carbon\Carbon::today() < Carbon\Carbon::parse($review->date_expecting))
                                                                    - <span class=" @if ($review->date_expecting)
                                                                        text-primary
                                                                        @endif">
                                                                        @if ($review->main_complaint ==' - تحديد عملية - تحليل' || $review->main_complaint =='تحديد عملية' || $review->main_complaint ==' - تحديد عملية - صورة - تحليل' || $review->main_complaint ==' - تحديد عملية - صورة')
                                                                            موعد العملية
                                                                        @else
                                                                            الموعد القادم
                                                                        @endif
                                                                </span>
                                                                @endif

                                                            </h6>
                                                        </a>
                                                        <!-- Card Content - Collapse -->
                                                        <div class="collapse" id="CollapseEditViewReviewEmergency{{$review->id}}">
                                                            <div class="card-body px-1 py-1">
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">نص التحليل : </label>
                                                                    <textarea id="editReview-med_analysis_T{{$review->id}}" class="VoiceToText form-control @error('med_analysis_T') is-invalid @enderror" name="med_analysis_T" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" >{{$review->med_analysis_T}}</textarea>
                                                                        @error('med_analysis_T')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:39px;" for="editReview-med_analysis_T{{$review->id}}">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">محتوى الصورة : </label>
                                                                    <textarea id="editReview-med_photo_T{{$review->id}}" class="VoiceToText form-control @error('med_photo_T') is-invalid @enderror" name="med_photo_T" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" >{{$review->med_photo_T}}</textarea>
                                                                        @error('med_photo_T')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:39px;" for="editReview-med_photo_T{{$review->id}}">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="form-group mb-2" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">
                                                                        @if ($review->main_complaint ==' - تحديد عملية - تحليل' || $review->main_complaint =='تحديد عملية' || $review->main_complaint ==' - تحديد عملية - صورة - تحليل' || $review->main_complaint ==' - تحديد عملية - صورة')
                                                                             موعد العملية
                                                                        @else
                                                                             الموعد القادم
                                                                        @endif : </label>
                                                                    <input type="date" min="{{Carbon\Carbon::tomorrow()->format('Y-m-d')}}" @if ($review->date_expecting)
                                                                        value="{{Carbon\Carbon::parse($review->date_expecting)->format('Y-m-d')}}"
                                                                    @endif  class="form-control @error('date_expecting') is-invalid @enderror" name="date_expecting" style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
                                                                    @error('date_expecting')
                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                            <strong >{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">ملاحظات الزيارة : </label>
                                                                    <textarea id="editReview-doctor_notes{{$review->id}}" class=" VoiceToText form-control @error('doctor_notes') is-invalid @enderror" name="doctor_notes" rows="3" style="padding: 0.375rem 0.75rem;text-align:center">{{$review->doctor_notes}}</textarea>
                                                                        @error('doctor_notes')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-doctor_notes{{$review->id}}">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">القصة المرضية : </label>
                                                                    <textarea id="editReview-pain_story{{$review->id}}" class=" VoiceToText form-control @error('pain_story') is-invalid @enderror" name="pain_story" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" >{{$review->pain_story}}</textarea>
                                                                        @error('pain_story')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-pain_story{{$review->id}}">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>

                                                                {{-- علق لأن المشروع الحالي لا يمكن رفع الصور --}}
                                                                <div class="form-group mb-2" style="direction:ltr;text-align:right" >
                                                                    <label class="text-xs" style="text-align:right;direction: rtl;">صور مرفقة : </label>
                                                                    <input type="file" class="input_image form-control @error('images') is-invalid @enderror" name="images[]" multiple style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
                                                                    @error('images')
                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                            <strong >{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>{{-- علق لأن المشروع الحالي لا يمكن رفع الصور --}}
                                                            </div>
                                                        </div>
                                                    </div><!-- Collapse Modal View Review Emergency -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer py-1">
                                            <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                            <button type="submit" class="btn btn-primary btn-user">حفظ</button>
                                        </form>
                                        </div>
                                </div>
                            </div>
                        </div><!-- Modal Edit View Review Emergency-->


                        {{-- <!-- Modal Add InsideReviews InsideEmergency -->
                        <div class="modal fade" id="InsideReview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="{{route('Clinic.storeReview',$patient->id)}}" method="post" enctype="multipart/form-data" >
                                            @csrf
                                        <h5 class="text-center text-primary py-2">زيارة تابعة</h5><hr>
                                            <div class="row" style="direction: rtl">
                                                <div class="col-lg-8">
                                                    <div class="form-group" style="direction: ltr">
                                                        <label class="text-xs" style="text-align:right;direction: rtl;">نوع الزيارة :</label>
                                                        <select name="review_type" class="form-control @error('review_type') is-invalid @enderror" required style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
                                                            @error('review_type')
                                                                <span class="invalid-feedback text-center" role="alert">
                                                                    <strong >{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <option value="مراجعة" selected >مراجعة</option>
                                                            <option value="اسعافية" >اسعافية</option>
                                                        </select>
                                                    </div>
                                                    <input type="hidden" value="{{$review->id}}" name="patient_review_id">
                                                    <div class="form-group  position-relative" style="direction:rtl">
                                                        <label class="text-xs">سبب الزيارة :</label>
                                                        <textarea id="newInsideReview-Main_complaint" class="VoiceToText form-control @error('main_complaint') is-invalid @enderror" name="main_complaint" required  rows="3" style="padding: 0.375rem 0.75rem;text-align:center" placeholder="سبب الزيارة"></textarea>
                                                            @error('main_complaint')
                                                                <span class="invalid-feedback text-center" role="alert">
                                                                    <strong >{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="newInsideReview-Main_complaint">
                                                            <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                        </button>
                                                    </div>
                                                    <div class="form-group position-relative" style="direction:rtl" >
                                                        <label class="text-xs">الحالة الحديثة :</label>
                                                        <textarea id="newInsideReview-pain_story" class=" VoiceToText form-control @error('pain_story') is-invalid @enderror" name="pain_story" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" placeholder="الحالة الحديثة"></textarea>
                                                            @error('pain_story')
                                                                <span class="invalid-feedback text-center" role="alert">
                                                                    <strong >{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="newInsideReview-pain_story">
                                                            <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                        </button>
                                                    </div>

                                                    <!-- Collapse Modal InsideReviews InsideEmergency -->
                                                    <div class="card mb-4">
                                                        <!-- Card Header - Accordion -->
                                                        <a href="#CollapseInsideReviewsInsideEmergency" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                            role="button" aria-expanded="true" aria-controls="CollapseInsideReviewsInsideEmergency">
                                                            <h6 class="m-0 font-weight-bold text-gray-500 text-center">" رأي الطبيب - خطة العلاج - الموعد القادم - صور مرفقة "</h6>
                                                        </a>
                                                        <!-- Card Content - Collapse -->
                                                        <div class="collapse" id="CollapseInsideReviewsInsideEmergency">
                                                            <div class="card-body px-1 py-3">
                                                                <div class="form-group position-relative" style="direction:rtl" >
                                                                    <label class="text-xs">رأي الطبيب :</label>
                                                                    <textarea id="newInsideReview-medical_report" class="VoiceToText form-control @error('medical_report') is-invalid @enderror" name="medical_report" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" placeholder="رأي الطبيب"></textarea>
                                                                        @error('medical_report')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="newInsideReview-medical_report">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>

                                                                <div class="form-group position-relative" style="direction:rtl" >
                                                                    <label class="text-xs">خطة العلاج :</label>
                                                                    <textarea id="newInsideReview-treatment_plan" class="VoiceToText form-control @error('treatment_plan') is-invalid @enderror" name="treatment_plan" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" placeholder="خطة العلاج"></textarea>
                                                                        @error('treatment_plan')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="newInsideReview-treatment_plan">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>

                                                                <div class="form-group" style="direction:rtl" >
                                                                    <label class="text-xs">الموعد القادم :</label>
                                                                    <input type="date" class="form-control @error('date_expecting') is-invalid @enderror" name="date_expecting" style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
                                                                    @error('date_expecting')
                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                            <strong >{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group" style="direction:ltr" >
                                                                    <label class="text-xs" style="text-align:right;direction: rtl;">صور مرفقة :</label>
                                                                    <input type="file" class="input_image form-control @error('images') is-invalid @enderror" name="images[]" multiple style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
                                                                    @error('images')
                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                            <strong >{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- Collapse Modal  InsideReviews InsideEmergenc -->
                                                </div>

                                                <div class="col-lg-4 bg-new-image">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer py-1">
                                            <button type="submit" class="btn btn-primary btn-user">إضافة</button>
                                            <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                        </form>
                                        </div>
                                </div>
                            </div>
                        </div><!-- Modal Add InsideReviews InsideEmergency --> --}}

                    </div><!-- Modals Review InsideReviews -->

                </div>
            @empty
                <div class="card my-4 shadow border-bottom-dark">
                    <div class="card-head py-3 px-5">
                            <h5 class="mr-2 text-dark"><b>عذراً!!</b>
                            </h5>
                        <hr>
                    </div>
                    <div class="card-body p-2 bg-deleted-image" style="height: 300px">
                        <b class="px-5">المريض لم يكمل الزيارة</b>
                    </div>
                </div>
            @endforelse
        {{-------------- End Reviews --------------}}

    </div>
@endsection

@section('script')
    <!-- the SummerNotes plugin JavaScript -->
    <script src="{{ asset('assets/SummerNotes/summernote-bs4.min.js') }}" ></script>

    <!-- the SummerNotes plugin JavaScript -->
    {{--  يوضع اسم كلاس للتكست ايريا مثلا (.summernote) --}}
    <script>
        $(function () {
            $('.summernote').summernote({
                // placeholder: 'Hello stand alone ui',
                tabsize: 2,
                height: 120,
                toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
            // يوضع اسم ايدي للفايل انبوت مثلا (#input_image)
            $('.input_image').fileinput({
                theme: "fa", // نوع الايقونات .. فونت اوسم
                maxFileCount : 5 , // عدد الاقصى للصور
                allowedFileTypes : ['image'], // نوع الملفات المرفوعة
                showCancel : true , // إظهار زر الإلغاء
                showRemove : true , // إخفاء زر الإزالة
                showUpload : false, // عدم الرفع من نفس البلاجن
                overwriteInitial : false ,// عدم الكتابة على البلاجن شيئ
            });

        });
    </script>
@endsection
