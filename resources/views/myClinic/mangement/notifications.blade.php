@extends('layouts.myClinic')
@section('style')

@endsection
@section('content')

<div class="pb-5 mt-3">

    <ul class="nav nav-tabs pr-1">
        <li class="nav-item">
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
        <li class="nav-item dropdown">
            <a class="nav-link px-2 dropdown-toggle active" data-toggle="dropdown" role="button" aria-expanded="false"><b>الإشعارات</b></a>
            <div class="dropdown-menu" style="direction:rtl;text-align:right;width: auto;">
                @if (count($notificates)>0)
                    <a class="dropdown-item" href="{{route('Clinic.readNotificateAll')}}" >تحديد الكل كمقروء</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('Clinic.destroyReadNotificateAll')}}" >حذف جميع إشعاراتي المقروءة</a>
                @else
                    <a class="dropdown-item" >لا يوجد أي إجراء</a>
                @endif
            </div>
        </li>
      </ul>

    <br>

    <div class="container-fluid pb-5 mb-5">
        @forelse ($notificates as $notificate)
            @if ($notificate->forUser_id == null || $notificate->forUser_id == auth()->user()->id)
                <div class=" card border-right-primary shadow h-100 py-1 mt-1 ">

                    <div class="card-body @if ($notificate->read_at == null) bg-gray-300 @endif p-2" >
                        <div class="row no-gutters align-items-center" style="direction:rtl;text-align:right" >
                            <div class="col-auto ml-2 icon-circle
                                @if ( $notificate->notify_type == 'newReview')
                                bg-warning
                                @elseif ($notificate->notify_type == 'newPatient' || $notificate->notify_type == 'newtask' || $notificate->notify_type == 'publictask' )
                                bg-info
                                @elseif ($notificate->notify_type == 'delete' || $notificate->notify_type == 'sureryDate')
                                bg-danger
                                @elseif ($notificate->notify_type == 'donetask' || $notificate->notify_type == 'reviewDate' )
                                bg-success
                                @elseif ($notificate->notify_type == 'newDevice' )
                                bg-secondary
                                @endif
                                ">
                                {!! $notificate->icon !!}
                            </div>
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    @if ($notificate->notify_type == 'newPatient')
                                        مريض جديد
                                    @elseif ($notificate->notify_type == 'newReview')
                                        زيارة جديدة
                                    @elseif ($notificate->notify_type == 'delete')
                                        <span class="text-danger" >حذف</span>
                                    @endif
                                    - {{$notificate->created_at->locale('ar')->diffForHumans()}}- {{$notificate->created_at->format('D m y h:i a')}}
                                </div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800"> {{$notificate->mainMassage}}</div>
                                {{-- <div class="text-xs text-center text-primary text-uppercase my-1"> @if ($message->mobile) <b>رقم الهاتف :</b> {{$message->mobile}} - @endif <b>الإيميل :</b> {{$message->email}} - <b>تاريخ الإرسال :</b> {{$message->created_at->format('D m y h:i a')}}</div> --}}
                            </div>

                        </div>
                    </div>
                    <div class="card-footer p-1" >
                        <div class="mx-4">
                            <small ><b style="text-align: right;direction: rtl;float:right"><a  type="button" class="text-primary" onclick="document.getElementById('notificate{{$notificate->id}}').submit();">تحديد الإشعار كمقروء &nbsp;</a></b></small>
                            <form id="notificate{{$notificate->id}}" action="{{route('Clinic.readNotificate',$notificate->id)}}" method="post" class="d-none">
                                @csrf
                            </form>
                            <small ><b style="text-align: right;direction: rtl;float:right"><a  type="button" class="text-dark" href="{{route('Clinic.unReadNotificate',$notificate->id)}}">&nbsp;- تحديد الإشعار كغير مقروء</a></b></small>
                        </div>
                    </div>

                </div>
            @endif
        @empty
            <div class="card border-right-primary shadow h-100 py-2 my-2">
                <div class="card-body" >
                    <div class="row no-gutters align-items-center" style="direction:rtl;text-align:right" >
                        <div class="col mr-2">
                            <div class="font-weight-bold text-primary text-uppercase mb-1 mx-4">فارغ !!</div><hr>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">لا يوجد لديك أي إشعار</div>
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
