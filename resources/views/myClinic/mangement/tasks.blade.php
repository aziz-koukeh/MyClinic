@extends('layouts.myClinic')

@section('style')

@endsection

@section('content')
<div class="pb-5 mt-3">

    <ul class="nav nav-tabs pr-1">
        <li class="nav-item">
            <a class="nav-link px-3" href="{{route('Clinic.mangementPage')}}"><b>الإدارة</b></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" data-toggle="dropdown" role="button" aria-expanded="false"><b>المهام</b></a>
            <div class="dropdown-menu" style="direction:rtl;text-align:right;width: auto;">
            @if (auth()->user()->id == auth()->user()->doctor_id)
                <a class="dropdown-item" type="button" data-toggle="modal" data-target="#newTask">إنشاء مهمة</a>
            @endif
            <a class="dropdown-item" href="{{route('Clinic.doneAllTasks')}}">تحديد جميع المهام كمنفذ</a>
            <div class="dropdown-divider"></div>
            @if (auth()->user()->d_o_e == 1)
                <a class="dropdown-item" href="{{route('Clinic.destroyAllDoneTasks')}}">حذف المهام المنجزة</a>
                <a class="dropdown-item" href="{{route('Clinic.destroyAllTasks')}}">حذف جميع المهام</a>
            @endif
          </div>
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
        <a class="nav-link px-2" href="{{route('Clinic.notificationsPage')}}"><b>الإشعارات</b>
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

    <div class="container-fluid pb-5 mb-5">
        @forelse ($tasks->where('forUser_id','<>',auth()->user()->doctor_id) as $task)
            <div class=" card border-right-primary shadow h-100 py-1 mt-1 ">

                <div class="card-body @if ($task->read_at == null) bg-gray-300 @endif p-2" >
                    <div class="row no-gutters align-items-center" style="direction:rtl;text-align:right" >
                        <div class="col-auto ml-2">
                            {{-- @foreach ($employeeusers as $employeeuser)--}}
                                @if ($task->forUser_id == null )
                                    <img class="rounded-circle ml-2" src="{{asset('assets/MyClinicApp/image/1.gif')}}"  style=" height: 40px;width: 40px;">
                                @else
                                    <i class="rounded-circle ml-2 fa-solid fa-user-slash fa-xl fa-bounce"></i>
                                    {{-- <i class="fa-solid fa-user-slash fa-bounce "></i> --}}
                                @endif
                     {{--   @endforeach --}}
                        </div>
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                @if ($task->forUser_id == null)
                                    مهمة عامة
                                @else
                                    @if ($task->foruser && $task->foruser->doctor_id == $task->forGroup_id)
                                        مهمة لـ {{$task->foruser->name}}
                                    @else
                                        مهمة لموظف سابق
                                    @endif

                                @endif

                                @if ($task->read_at != null)
                                    <span class="text-success">- تم الإنجاز

                                @else
                                    <span class="text-danger">- لم يتم الإنجاز بعد</span>
                                    @if ($task->forDay)
                                        <span class="text-gray-900" style="text-decoration:underline">- لتاريخ : {{\Carbon\Carbon::parse($task->forDay)->diffForHumans()}} - {{\Carbon\Carbon::parse($task->forDay)->format('D d/m/Y - h:i a')}}</span>
                                    @endif
                                @endif
                            </div>
                        <div class="h6 my-2 font-weight-bold text-gray-800"> {{$task->contant}}</div>
                        </div>

                    </div>
                </div>
                <div class="card-footer p-1" >
                    <div class="mx-4">
                        <small ><b style="text-align: right;direction: rtl;float:right"><a  type="button" class="text-primary" onclick="document.getElementById('task{{$task->slug}}').submit();"> تم إنجاز المهمة <i class="fa-regular fa-circle-check text-primary"></i></a></b></small>
                        <form id="task{{$task->slug}}" action="{{route('Clinic.taskDone',$task->slug)}}" method="post" class="d-none">
                            @csrf
                        </form>
                        <small ><b style="text-align: right;direction: rtl;float:right"><a  type="button" class="text-dark" href="{{route('Clinic.unDoneTask',$task->slug)}}">&nbsp;- تراجع <i class="fa-regular fa-circle-xmark"></i></a></b></small>
                        <div style="float: left;display: grid">
                            <small class="text-xs" ><b> -وقت الإنشاء : {{$task->created_at->format('D d/m/Y - h:i a')}}</b></small>
                            @if ($task->read_at !=null)
                                <small class="text-xs text-success"><b>- تم الإنجاز : {{\Carbon\Carbon::parse($task->read_at)->format('D d/m/Y - h:i a')}}</b></small>
                            @endif
                        </div>
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
@endsection

@section('script')

@endsection
