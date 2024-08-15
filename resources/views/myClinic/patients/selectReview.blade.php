@extends('layouts.myClinic')

@section('content')
    {{-- value="{{ old('month',request()->month) }}" --}}
    <div class="container-fluid mb-5 pb-5 mt-3" style="direction:ltr;text-align:right">
        @if (count($errors)>0)
            @foreach ($errors->all() as $item)
                <div class="alert alert-secondary" role="alert">
                    {{$item}}
                </div>
            @endforeach
        @endif
        <div class="row" >
            <div class="col-lg-12">
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
                                        {{-- <a class="dropdown-item " type="button" data-toggle="modal" data-target="#AddViewReviewEmergency{{$review->id}}">إضافة زيارة جديدة</a> --}}
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
                        <div style="text-align: left;width: 112px;">
                            <p class="text-xs text-gray-900 p-0 m-0">تاريخ الزيارة :</p>
                            <p class="text-xs text-gray-800  p-0 m-0">{{$patient->created_at->format('D d-m-Y')}}</p>
                            <p class="text-xs text-gray-800  p-0 m-0" style="direction: ltr">{{$patient->created_at->format('h:i a')}}</p>
                        </div>
                    </div>
                    <div class="collapse" id="collapseCardExample">
                        <div class="card-body">
                            <table class="table table-bordered text-center" style="direction: rtl">
                                <thead>
                                    <tr>
                                        <th>الجنس</th>
                                        <th>العمر</th>
                                        <th>التدخين</th>
                                        @if ($patient->blood_type)
                                            <th>زمرة الدم</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-gray-800">@if ($patient->gender == 'male') {{'ذكر'}} @elseif ($patient->gender == 'female') {{'أنثى'}} @else لم يتم الإدخال @endif</td>
                                        @if ($patient->age && $patient->age != date('Y') )
                                        <td class="text-gray-800" style="direction:rtl">{{date('Y') - $patient->age .' سنة'}}</td>
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
                    <div class="card-foot p-2" style="display:inline-flex;direction:rtl">
                        <div class="ml-2 mb-3" style="float: left;width: auto;">
                            <p class="text-xs text-primary p-0 m-0">رقم الهاتف :</p>
                            <p class="text-xs text-gray-900  p-0 m-0" style=" direction:ltr"><b>{{$patient->phone}}</b></p>
                        </div>
                    </div>
                    <!-- Modal Profile -->
                    <div style="direction:ltr">
                        <!-- Modal Delete -->
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
                        </div>
                        <!-- Modal Delete -->
                        <!-- Modal Edit Profile -->
                        <div class="modal fade" id="Edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-body py-1">
                                        <h6 class="text-center text-gray-900 font-weight-bold text-uppercase py-2" style="direction: rtl">تعديل ملف المريض {{$patient->patient_name}}</h6><hr class="p-0 m-0">
                                        <form action="{{route('Clinic.updatePatient',$patient->patient_slug)}}" method="post">
                                            @csrf
                                            <div style="direction: rtl">

                                                {{-- <div class="col-lg-12 ">
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
                                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $patient->phone }}" placeholder="رقم الهاتف"style="padding: 0.375rem 0.75rem;height:50px;text-align:center;direction: ltr">
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
                                                            <input type="tel" max="99" min="1" class="form-control form-control @error('age') is-invalid @enderror" name="age" value="{{ date('Y') -$patient->age }}" placeholder="العمر" style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
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
                                                </div> --}}

                                                <div class="form-group mb-2 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                    <label class="text-xs" style="text-align:right;float: right;  direction:rtl;">اسم الزائر :</label>
                                                    <input class="VoiceToText form-control @error('patient_name') is-invalid @enderror" type="text" id="patient_name"  value="{{$patient->patient_name}}"  name="patient_name" placeholder=" أكتب الاسم والكنية "
                                                    style="padding: 0.375rem 0.75rem;height:38px;font-size: 75%;text-align:center;">
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
                                                        <label class="text-xs" style="text-align:right;float: right;  direction:rtl;">رقم الهاتف :</label>
                                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone"  value="{{$patient->phone}}" placeholder=" أكتب رقم الهاتف"
                                                        style="padding: 0.375rem 0.75rem;height:38px;text-align:center;direction: ltr;font-size: 75%;">
                                                        @error('phone')
                                                            <span class="invalid-feedback text-center" role="alert">
                                                                <strong >{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                        <label class="text-xs" style="text-align:right;float: right;  direction:rtl;">العمر :</label>
                                                        <input type="tel" max="99" min="1" class="form-control form-control @error('age') is-invalid @enderror"  value="{{date('Y') -$patient->age}}" name="age" placeholder="1~99"
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
                                                            <label class="text-xs">الجنس :</label><br>
                                                        </div>
                                                        <div class="card d-block">
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
                                                            <label class="text-xs">التدخين :</label><br>
                                                        </div>
                                                        <div class="card d-block">
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
                                                <div class="form-row">
                                                    <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                        <label class="text-xs mb-0 mr-3" style="padding-bottom: 0.2rem;text-align:right;direction:rtl;">الحالة الإجتماعية : </label>
                                                        <div class="card d-block" style="height: 38px">
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="editRelationshipMarriedSide" name="relationship" value="married" @if ( $patient->relationship == 'married') checked  @endif  class="custom-control-input">
                                                                <label class="text-xs custom-control-label" for="editRelationshipMarriedSide">متزوج</label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="editRelationshipSingleSide" name="relationship"  value="single" @if ( $patient->relationship == 'single') checked  @endif class="custom-control-input">
                                                                <label class="text-xs custom-control-label" for="editRelationshipSingleSide">أعزب</label>
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
                                                <!-- collapseCardMoreDetails -->
                                                <div class="card mb-2">
                                                    <!-- Card Header - Accordion -->
                                                    <a href="#collapseCardMoreDetails{{$patient->id}}" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                        role="button" aria-expanded="true" aria-controls="collapseCardMoreDetails{{$patient->id}}">
                                                        <h6 class="m-0 text-xs font-weight-bold text-primary text-center">المزيد ...</h6>
                                                    </a>
                                                    <!-- Card Content - Collapse -->
                                                    <div class="collapse" id="collapseCardMoreDetails{{$patient->id}}">
                                                        <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                            <label class="text-xs" style="text-align:right;float: right; direction:rtl;">السوابق الجراحية :</label>
                                                            <textarea  class="form-control" name="older_surgery" rows="2" style="height:38px;font-size: 75%;padding: 0.375rem 0.75rem;text-align:center" placeholder=" أكتب السوابق الجراحية في حال وجودها">{{ $patient->older_surgery }}</textarea>
                                                        </div>
                                                        <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                            <label class="text-xs" style="text-align:right;float: right; direction:rtl;">السوابق المرضية :</label>
                                                            <textarea  class="form-control" name="older_sicky" rows="2" style="padding: 0.375rem 0.75rem;text-align:center;height:38px;font-size: 75%" placeholder=" أكتب السوابق المرضية في حال وجودها">{{ $patient->older_sicky }}</textarea>
                                                        </div>
                                                        <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                            <label class="text-xs" style="text-align:right;float: right; direction:rtl;">السوابق التحسسية :</label>
                                                            <textarea  class="form-control" name="older_sensitive" rows="2" style="padding: 0.375rem 0.75rem;text-align:center;height:38px;font-size: 75%" placeholder=" أكتب السوابق التحسسية في حال وجودها">{{ $patient->older_sensitive }}</textarea>
                                                        </div>
                                                        <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                            <label class="text-xs" style="text-align:right;float: right; direction:rtl;">الأدوية الدائمة :</label>
                                                            <textarea  class="form-control" name="permanent_medic" rows="1" style="height:38px;font-size: 75%;padding: 0.375rem 0.75rem;text-align:center" placeholder=" أكتب الأدوية الدائمة في حال وجودها">{{ $patient->permanent_medic }}</textarea>
                                                        </div>
                                                        <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                            <label class="text-xs" style="text-align:right;float: right; direction:rtl;">ملاحظات حول المريض :</label>
                                                            <input type="text" class="form-control " name="patient_state" value="{{ $patient->patient_state }}" placeholder=" أكتب ملاحظات في حال وجودها" style="padding: 0.375rem 0.75rem;height:38px;font-size: 75%;text-align:center">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn-user">تعديل</button>
                                        <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Edit Profile -->


                    </div><!-- Modal Profile -->
                </div>
            </div>
        </div>
        <hr>
        {{-------------- Reviews --------------}}
        <div class="form-row align-items-center justify-content-center" style="direction: rtl">
            @forelse ($patientReviews->whereNull('patient_review_id') as $review)

                @if ($review->review_type == 'معاينة')
                @php
                $type ='success'
                @endphp
                @elseif ($review->review_type == 'مراجعة')
                @php
                $type ='warning'
                @endphp
                @elseif ($review->review_type == 'اسعافية')
                @php
                $type ='danger'
                @endphp
                @else
                @php
                $type ='info'
                @endphp
                @endif




                <div class="col-lg-4 col-md-6">
                    <div class="card my-2 shadow border-bottom-{{$type}} border-top-{{$type}}" style="direction:ltr">
                    {{-- ------------------ nav Reviews ------------------- --}}

                        <div class="card-header pt-3 pb-1 px-1 " style="display:inline-flex;direction:rtl">
                            <a class="text-center" style="width:70%;" type="button" data-toggle="modal" data-target="#AddViewReviewEmergency{{$review->id}}">
                            <div >
                                <h6 class="text-{{$type}} p-0 m-0"><b>{{$review->review_type}}</b></h6>
                            </div>
                            </a>
                            <div style="text-align: center;width: 30%;">
                                <p class="text-xs text-gray-900 p-0 m-0">تاريخ الزيارة :</p>
                                <p class="text-xs text-gray-800  p-0 m-0">{{$review->created_at->format('D d-m-Y')}}</p>
                                <p class="text-xs text-gray-800  p-0 m-0" style="direction:ltr">{{$review->created_at->format('h:i a')}}</p>
                            </div>
                        </div>{{-- ------------------ nav Reviews ------------------- --}}
                        {{-- ------------------ body Reviews ------------------- --}}
                            <div class="card-body px-2 py-0 @if($review->done != 1) bg-empty-image @endif ">
                                <div class="row px-1" style="direction:rtl;height:auto ;">

                                    @if ($review->reviewMedias->count() > 0)
                                        {{-- ------------------ photos Reviews ------------------- --}}
                                        <div class="col-lg-12 bg-gradient-secondary" style="direction:rtl;height:260px;border-radius: 0.35rem;">
                                            <div id="carouselIndicatorsReview{{$review->id}}" class="carousel slide" data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    @foreach ($review->reviewMedias as $media)
                                                        <li data-target="#carouselIndicatorsReview{{$review->id}}" data-slide-to="{{ $loop->index }}" class="{{ $loop->index == 0 ? 'active' : ''}} border-top-secondary"></li>
                                                    @endforeach
                                                </ol>
                                                <div class="carousel-inner">
                                                    @foreach ($review->reviewMedias as $media)
                                                        <div class="carousel-item {{ $loop->index == 0 ? 'active' : ''}}">
                                                            <img src="{{ asset('assets/Clinic/'.auth()->user()->doctor_id.'/'.$media->file_name) }}" class="d-block" style="border-radius: 0.35rem;height:260px;object-fit:contain;width:100%;" alt="...">
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
                                        </div>{{-- ------------------ photos Reviews ------------------- --}}
                                        <div class="col-lg-12 card my-1 p-2 my-2 text-xs" style="direction:ltr;height:150px ;overflow-y:auto">
                                            <a  type="button" data-toggle="modal" data-target="#AddViewReviewEmergency{{$review->id}}">
                                            <ul  style="direction:rtl;" >
                                                <li><div class=" text-{{$type}} text-uppercase mx-1"><b>سبب الزيارة</b> :</div></li>
                                                <div class="h6 mb-0 text-gray-800  text-xs">{!! $review->main_complaint !!}</div>

                                                <li><div class=" text-{{$type}} text-uppercase mx-1"><b>القصة المرضية</b> :</div></li>
                                                <div class="h6 mb-0 text-gray-800  text-xs">{!! $review->pain_story !!}</div>

                                                <li><div class=" text-{{$type}} text-uppercase mx-1"><b>رأي الطبيب</b> :</div></li>
                                                <div class="h6 mb-0 text-gray-800  text-xs">{{$review->medical_report}}</div>

                                                <li><div class=" text-{{$type}} text-uppercase mx-1"><b>خطة العلاج</b> :</div></li>
                                                <div class="h6 mb-0 text-gray-800  text-xs">{{$review->treatment_plan}}</div>

                                                <li><div class=" text-{{$type}} text-uppercase mx-1"><b>
                                                    @if ($review->main_complaint ==' - تحديد عملية - تحليل' || $review->main_complaint =='تحديد عملية' || $review->main_complaint ==' - تحديد عملية - صورة - تحليل' || $review->main_complaint ==' - تحديد عملية - صورة')
                                                        موعد العملية
                                                    @else
                                                        الموعد القادم
                                                    @endif</b> :</div></li>
                                                <div class="h6 mb-0 text-gray-800  text-xs">
                                                    @if ($review->date_expecting == null)
                                                        {{'لا يوجد زيارة متوقعة'}}
                                                    @else
                                                        {{$review->date_expecting}}
                                                    @endif
                                                </div>

                                                <li><div class=" text-{{$type}} text-uppercase mx-1"><b>تاريخ الزيارة </b> :</div></li>
                                                <div class="h6 mb-0 text-gray-800  text-xs">{{$review->created_at->format('D-m-Y')}}</div>

                                            </ul>

                                        </a>
                                        </div>
                                    @else
                                        <div class="col-lg-12 card my-1 p-2 my-2 text-xs" style="direction:ltr;height:410px ;overflow-y:auto">
                                            <a  type="button" data-toggle="modal" data-target="#AddViewReviewEmergency{{$review->id}}">
                                            <ul  style="direction:rtl;" >
                                                <li><div class=" text-{{$type}} text-uppercase mx-1"><b>سبب الزيارة</b> :</div></li>
                                                <div class="h6 mb-0 text-gray-800  text-xs">{!! $review->main_complaint !!}</div>

                                                <li><div class=" text-{{$type}} text-uppercase mx-1"><b>القصة المرضية</b> :</div></li>
                                                <div class="h6 mb-0 text-gray-800  text-xs">{!! $review->pain_story !!}</div>

                                                <li><div class=" text-{{$type}} text-uppercase mx-1"><b>رأي الطبيب</b> :</div></li>
                                                <div class="h6 mb-0 text-gray-800  text-xs">{{$review->medical_report}}</div>

                                                <li><div class=" text-{{$type}} text-uppercase mx-1"><b>خطة العلاج</b> :</div></li>
                                                <div class="h6 mb-0 text-gray-800  text-xs">{{$review->treatment_plan}}</div>

                                                <li><div class=" text-{{$type}} text-uppercase mx-1"><b>تاريخ الموعد القادم</b> :</div></li>
                                                <div class="h6 mb-0 text-gray-800  text-xs">
                                                    @if ($review->date_expecting == null)
                                                        {{'لا يوجد زيارة متوقعة'}}
                                                    @else
                                                        {{$review->date_expecting}}
                                                    @endif
                                                </div>

                                                <li><div class=" text-{{$type}} text-uppercase mx-1"><b>تاريخ الزيارة </b> :</div></li>
                                                <div class="h6 mb-0 text-gray-800  text-xs">{{$review->created_at->format('D-m-Y')}}</div>

                                            </ul>

                                        </a>
                                        </div>
                                    @endif


                                </div>

                            </div>{{-- ------------------ body Reviews ------------------- --}}

                                                    <!-- Modal Add View Review Emergency -->
                        <div class="modal fade" id="AddViewReviewEmergency{{$review->id}}" tabindex="-1" aria-labelledby="AddViewReviewEmergency{{$review->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-body p-2">
                                        <div class="card-body p-0" style="direction:ltr">
                                            <!-- Nested Row within Card Body -->
                                            <div class="text-center my-2">
                                                <h1 class="h6 font-weight-bold text-gray-900 my-2" style="direction:rtl">زيارة للمريض :{{$review->patient->patient_name}}</h1>
                                                <p class="text-xs text-gray-900 p-0 m-0">سبب الزيارة : <span class="text-{{$type}}">{{$review->main_complaint}}</span></p>

                                            </div>


                                            <form  class="user px-2" method="POST" action="{{route('Clinic.storeReview',$review->patient->id)}}">
                                                @csrf

                                                <div class="form-group mb-2" style="direction: rtl;margin-bottom: 0.5rem;">

                                                    <div class="form-row card px-0 mx-0 d-inine-block" style="flex-direction: unset;">
                                                        <div class="form-group mb-0 col-md-6 col-sm-12 " style="direction:rtl;text-align:right">
                                                            <div class="custom-radio custom-control-inline mr-1">
                                                                <label class="text-xs">حجز الموعد : </label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline mr-2">
                                                                <input type="radio" id="editbyPhone{{$review->id}}" name="leave_off" value="0" class="custom-control-input">
                                                                <label class="text-xs custom-control-label" for="editbyPhone{{$review->id}}">هاتفي</label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline mr-2">
                                                                <input type="radio" id="editinClinic{{$review->id}}" name="leave_off" checked value="1" class="custom-control-input">
                                                                <label class="text-xs custom-control-label" for="editinClinic{{$review->id}}">في العيادة</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mx-0 mb-0 col-md-6 col-sm-12 px-0">
                                                            <div class="form-group mb-0 col-4 px-0 " style="direction:rtl;text-align:right">
                                                                <div class="custom-radio custom-control-inline">
                                                                    <label class="text-xs">- حجز قادم :</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0 col-8 px-0 " style="direction:rtl;text-align:right">
                                                                <input type="date" min="{{Carbon\Carbon::tomorrow()->format('Y-m-d')}}"
                                                                class="form-control form-control @error('review_forDay') is-invalid @enderror" name="review_forDay" placeholder="حجز موعد"
                                                                    style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                                @error('review_forDay')
                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                        <strong >{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-2" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                        <div class="custom-radio custom-control-inline">
                                                            <label class="text-xs">سبب الزيارة :</label><br>
                                                        </div>
                                                        <div class="card d-block">
                                                            <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                <input type="hidden" value="{{$review->id}}" name="patient_review_id">
                                                                <input type="radio" id="editnewreview{{$review->id}}" name="main_complaint[]" checked value="مراجعة" class="custom-control-input">
                                                                <label class="text-xs text-warning font-weight-bold custom-control-label" for="editnewreview{{$review->id}}" >مراجعة</label>
                                                            </div><br>
                                                            {{-- <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                <input type="radio" id="editEmergency{{$review->id}}" name="main_complaint[]" value="اسعافية" class="custom-control-input">
                                                                <label class="text-xs text-danger font-weight-bold custom-control-label" for="editEmergency{{$review->id}}" >اسعافية</label>
                                                            </div> --}}
                                                            <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                <input type="radio" id="editselectSergray{{$review->id}}" name="main_complaint[]" value="تحديد عملية" class="custom-control-input">
                                                                <label class="text-xs text-info font-weight-bold custom-control-label" for="editselectSergray{{$review->id}}">تحديد عملية</label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                <input type="radio" id="editreviewSergray{{$review->id}}" name="main_complaint[]" value="مراجعة عملية" class="custom-control-input">
                                                                <label class="text-xs text-info font-weight-bold custom-control-label" for="editreviewSergray{{$review->id}}">مراجعة عملية</label>
                                                            </div><br>
                                                            <div class="custom-control custom-checkbox custom-control-inline" style="direction:ltr;text-align:right">
                                                                <input type="checkbox" id="editforPhoto{{$review->id}}" name="main_complaint[]" value="صورة" class="custom-control-input">
                                                                <label class="text-xs text-info font-weight-bold custom-control-label" for="editforPhoto{{$review->id}}" >زيارة من أجل صورة</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox custom-control-inline" style="direction:ltr;text-align:right">
                                                                <input type="checkbox" id="editforAnalysis{{$review->id}}" name="main_complaint[]" value="تحليل" class="custom-control-input">
                                                                <label class="text-xs text-info font-weight-bold custom-control-label" for="editforAnalysis{{$review->id}}" >زيارة من أجل تحليل</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- collapseCardMoreDetails -->
                                                    <div class="card mb-2">
                                                        <!-- Card Header - Accordion -->
                                                        <a href="#collapseCardMoreDetails{{$review->id}}" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                            role="button" aria-expanded="true" aria-controls="collapseCardMoreDetails{{$review->id}}">
                                                            <h6 class="m-0 text-xs font-weight-bold text-primary text-center">المزيد ...</h6>
                                                        </a>
                                                        <!-- Card Content - Collapse -->
                                                        <div class="collapse" id="collapseCardMoreDetails{{$review->id}}">
                                                            <div class="card-body px-1 py-3">
                                                                <div class="form-group mb-2 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                    <label class="text-xs" style="text-align:right;float: right;  direction:rtl;">اسم الزائر :</label>
                                                                    <input class="VoiceToText form-control @error('patient_name') is-invalid @enderror" type="text" id="patient_name{{$review->id}}"  value="{{$review->patient->patient_name}}"  name="patient_name" placeholder=" أكتب الاسم والكنية "
                                                                    style="padding: 0.375rem 0.75rem;height:38px;font-size: 75%;text-align:center;">
                                                                        @error('patient_name')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:38px;" for="patient_name{{$review->id}}">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs" style="text-align:right;float: right;  direction:rtl;">رقم الهاتف :</label>
                                                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone"  value="{{$review->patient->phone}}" placeholder=" أكتب رقم الهاتف"
                                                                        style="padding: 0.375rem 0.75rem;height:38px;text-align:center;direction: ltr;font-size: 75%;">
                                                                        @error('phone')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs" style="text-align:right;float: right;  direction:rtl;">العمر :</label>
                                                                        <input type="tel" max="99" min="1" class="form-control form-control @error('age') is-invalid @enderror"  value="{{date('Y') -$review->patient->age}}" name="age" placeholder="1~99"
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
                                                                            <label class="text-xs">الجنس :</label><br>
                                                                        </div>
                                                                        <div class="card d-block">
                                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                                <input type="radio" id="editgenderMale{{$review->id}}" name="gender" @if ($review->patient->gender == 'male') checked  @endif  value="male" class="custom-control-input">
                                                                                <label class="text-xs custom-control-label" for="editgenderMale{{$review->id}}">ذكر</label>
                                                                            </div>
                                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                                <input type="radio" id="editgenderFemale{{$review->id}}" name="gender" @if ($review->patient->gender == 'female') checked  @endif  value="female" class="custom-control-input">
                                                                                <label class="text-xs custom-control-label" for="editgenderFemale{{$review->id}}">أنثى</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                        <div class="custom-radio custom-control-inline">
                                                                            <label class="text-xs">التدخين :</label><br>
                                                                        </div>
                                                                        <div class="card d-block">
                                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                                <input type="radio" id="editnegative{{$review->id}}" name="smoking" value="negative" @if ($review->patient->smoking == 'negative') checked  @endif class="custom-control-input">
                                                                                <label class="text-xs custom-control-label" for="editnegative{{$review->id}}">سلبي</label>
                                                                            </div>
                                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                                <input type="radio" id="editpositive{{$review->id}}" name="smoking"  value="positive" @if ($review->patient->smoking == 'positive') checked  @endif class="custom-control-input">
                                                                                <label class="text-xs custom-control-label" for="editpositive{{$review->id}}">إيجابي</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mb-0 mr-3" style="padding-bottom: 0.2rem;text-align:right;direction:rtl;">الحالة الإجتماعية : </label>
                                                                        <div class="card d-block" style="height: 38px">
                                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                                <input type="radio" id="editRelationshipMarriedSide{{$review->id}}" name="relationship" value="married" @if ( $review->patient->relationship == 'married') checked  @endif  class="custom-control-input">
                                                                                <label class="text-xs custom-control-label" for="editRelationshipMarriedSide{{$review->id}}">متزوج</label>
                                                                            </div>
                                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                                <input type="radio" id="editRelationshipSingleSide{{$review->id}}" name="relationship"  value="single" @if ( $review->patient->relationship == 'single') checked  @endif class="custom-control-input">
                                                                                <label class="text-xs custom-control-label" for="editRelationshipSingleSide{{$review->id}}">أعزب</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">عدد الأولاد : </label>
                                                                        <input type="tel" max="20" min="0" class="form-control form-control @error('child_count') is-invalid @enderror" value="{{$review->patient->child_count}}" name="child_count"
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
                                                                        <input type="text"class="VoiceToText form-control form-control @error('patient_job') is-invalid @enderror" value="{{$review->patient->patient_job}}" id="patient_job{{$review->id}}" name="patient_job"
                                                                         style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                                            @error('patient_job')
                                                                                <span class="invalid-feedback text-center" role="alert">
                                                                                    <strong >{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_job{{$review->id}}">
                                                                            <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                        </button>
                                                                    </div>
                                                                        <div class="form-group mb-2 col-md-6 col-sm-12 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">العنوان : </label>
                                                                        <input type="text" class="VoiceToText form-control @error('patient_address') is-invalid @enderror" id="patient_address{{$review->id}}" value="{{$review->patient->patient_address}}" name="patient_address"
                                                                        style="padding: 0.375rem 0.75rem;height:38px;text-align:center;direction: ltr;font-size: 75%;">
                                                                        @error('patient_address')
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong >{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                        <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_address{{$review->id}}">
                                                                            <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                    <label class="text-xs" style="text-align:right;float: right; direction:rtl;">السوابق الجراحية :</label>
                                                                    <textarea  class="form-control" name="older_surgery" rows="2" style="height:38px;font-size: 75%;padding: 0.375rem 0.75rem;text-align:center" placeholder=" أكتب السوابق الجراحية في حال وجودها">{{ $review->patient->older_surgery }}</textarea>
                                                                </div>
                                                                <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                    <label class="text-xs" style="text-align:right;float: right; direction:rtl;">السوابق المرضية :</label>
                                                                    <textarea  class="form-control" name="older_sicky" rows="2" style="padding: 0.375rem 0.75rem;text-align:center;height:38px;font-size: 75%" placeholder=" أكتب السوابق المرضية في حال وجودها">{{ $review->patient->older_sicky }}</textarea>
                                                                </div>
                                                                <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                    <label class="text-xs" style="text-align:right;float: right; direction:rtl;">السوابق التحسسية :</label>
                                                                    <textarea  class="form-control" name="older_sensitive" rows="2" style="padding: 0.375rem 0.75rem;text-align:center;height:38px;font-size: 75%" placeholder=" أكتب السوابق التحسسية في حال وجودها">{{ $review->patient->older_sensitive }}</textarea>
                                                                </div>
                                                                <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                    <label class="text-xs" style="text-align:right;float: right; direction:rtl;">الأدوية الدائمة :</label>
                                                                    <textarea  class="form-control" name="permanent_medic" rows="1" style="height:38px;font-size: 75%;padding: 0.375rem 0.75rem;text-align:center" placeholder=" أكتب الأدوية الدائمة في حال وجودها">{{ $review->patient->permanent_medic }}</textarea>
                                                                </div>
                                                                <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                    <label class="text-xs" style="text-align:right;float: right; direction:rtl;">ملاحظات حول المريض :</label>
                                                                    <input type="text" class="form-control " name="patient_state" value="{{ $review->patient->patient_state }}" placeholder=" أكتب ملاحظات في حال وجودها" style="padding: 0.375rem 0.75rem;height:38px;font-size: 75%;text-align:center">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- collapseCardMoreDetails -->
                                                </div>


                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn-user">إضافة زيارة تابعة</button>
                                        <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Modal Add View Review Emergency -->
                    </div>

                </div>

            @empty

            @endforelse
        </div>
        {{-------------- End Reviews --------------}}

    </div>
@endsection

@section('script')

@endsection
