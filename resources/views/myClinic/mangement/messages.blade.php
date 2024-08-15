@extends('layouts.myClinic')
@section('style')

@endsection
@section('content')

<div class="pb-5 mt-3 ">
    <ul class="nav nav-tabs pr-1">
        <li class="nav-item ">
            <a class="nav-link px-3" href="{{route('Clinic.mangementPage')}}"><b>الإدارة</b></a>
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
        <li class="nav-item dropdown">
          <a class="nav-link px-2 dropdown-toggle active" data-toggle="dropdown" role="button" aria-expanded="false"><b>الرسائل</b></a>
          <div class="dropdown-menu" style="direction:rtl;text-align:right;width: auto;">
            @if (count($messages)>0)
                <a class="dropdown-item" href="{{route('Clinic.readMessagesAll')}}" >تحديد الكل كمقروء</a>
                @if (auth()->user()->d_o_e == 1)
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('Clinic.destroyMessagesAll')}}" >حذف الجميع</a>
                @endif
            @else
                <a class="dropdown-item" >لا يوجد أي إجراء</a>
            @endif
          </div>
        </li>
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
        {{-- <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li> --}}
    </ul>

<br>
<div class="container-fluid  pb-5 mb-5">
    @forelse ($messages as $message)
        <div class=" card border-right-primary shadow h-100  @if ($message->read_at == null) bg-gray-300 @endif py-2 my-2 ">

            <div class="card-body" >
                <div class="row no-gutters align-items-center" style="direction:rtl;text-align:right" >
                    <div class="col-auto ">
                        <img class="rounded-circle ml-2" src="" style=" height: 40px;width: 40px;">
                    </div>
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{$message->name}}</div>
                       <b> الموضوع : </b><p class="mr-3 mb-0 font-weight-bold text-gray-900" >  {{$message->title}}</p>
                        <b>محتوى الرسالة : </b><div class="h6 mb-0 font-weight-bold text-gray-800"> {{$message->message}}</div>
                        <div class="text-xs text-center text-primary text-uppercase my-1"> @if ($message->mobile) <b>رقم الهاتف :</b> {{$message->mobile}} - @endif <b>الإيميل :</b> {{$message->email}} - <b>تاريخ الإرسال :</b> {{$message->created_at->format('D m y h:i a')}}</div>
                    </div>

                </div>
            </div>
            <div class="card-footer" >
                <div class="mx-4">
                    <small><b  style="text-align: right;direction: rtl;float:right"><a href="{{route('Clinic.readMessage',$message->id)}}" class="text-primary">تحديد الرسالة كمقروءة</a></b></small>
                    <small><b  style="text-align: right;direction: rtl;float:right">&nbsp;-<a href="{{route('Clinic.destroyMessage',$message->id)}}" class="text-danger"> حذف الرسالة</a></b></small>
                </div>
            </div>

        </div>
    @empty
        <div class="card border-right-primary shadow h-100 py-2 my-2">
            <div class="card-body" >
                <div class="row no-gutters align-items-center" style="direction:rtl;text-align:right" >
                    <div class="col mr-2">
                        <div class="font-weight-bold text-primary text-uppercase mb-1 mx-4">فارغ !!</div><hr>
                        <div class="h6 mb-0 font-weight-bold text-gray-800">لا يوجد لديك أي بريد على الموقع</div>
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
