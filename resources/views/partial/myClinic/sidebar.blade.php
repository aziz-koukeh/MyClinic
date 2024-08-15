@php
    $current_page =Route::currentRouteName();
@endphp

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark mt-5 accordion toggled" id="accordionSidebar" style="z-index: 3;" >
    @auth
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline mt-4">
            <button class="rounded-circle border-0" id="sidebarToggle" autofocus></button>
        </div>

        <!-- Divider -->
        @php
             $Reviews = App\Models\PatientReview::where('doctor_id',auth()->user()->doctor_id)
            ->where('done',0)->where('leave_off',1)->orderBy('created_at')
            ->where(function ($query)
                {
                $query->whereDate('review_forDay',date('Y-m-d'))->orWhere(function ($query1)
                    {
                    $query1->whereNull('review_forDay')->whereDate('created_at',date('Y-m-d'));
                    });
                })->count();
        @endphp

        <!-- languages -->
            {{-- <li class="nav-item active d-flex">
                <a class="nav-link" href="{{route('Clinic.change_language' , 'en')}}">
                    <i class="fas fa-fw fa-person-circle-plus"></i>
                    <span>en</span></a>
                <a class="nav-link" href="{{route('Clinic.change_language' , 'ar')}}">
                    <i class="fas fa-fw fa-person-circle-plus"></i>
                    <span>ع</span></a>
            </li> --}}
        <!-- languages -->


        <hr class="sidebar-divider my-0">
        <!-- Nav Item -  -->
        <li class="nav-item
            @if ($current_page == 'Clinic.index')
                active
            @endif ">
            <a class="nav-link" href="{{route('Clinic.index')}}">
                @if ($Reviews > 0)
                <span class="badge badge-warning badge-counter text-dark rounded-circle" style="float:left;direction: ltr;font-size: large;margin-right: 60%;margin-bottom: 20%;">
                    {{$Reviews}}
                </span>
                @endif
                <i class="fa-solid fa-house-medical-flag"></i>
                <span>الصفحة الرئيسية</span></a>
        </li>
        @if (auth()->user()->id != auth()->user()->doctor_id )
            <li class="nav-item
                @if ($current_page == 'Clinic.newPatient')
                    active
                @endif ">
                <a class="nav-link" href="{{route('Clinic.newPatient')}}">
                    <i class="fas fa-fw fa-person-circle-plus"></i>
                    <span>إضافة مريض</span></a>
            </li>
        @endif
        <!-- Divider -->
        {{-- <hr class="sidebar-divider my-0"> --}}
        @if (auth()->user()->id == auth()->user()->doctor_id )
            
            <li class="nav-item @if ($current_page == 'Clinic.specialWithStar') active @endif ">
                <a class="nav-link" href="{{route('Clinic.specialWithStar')}}">
                    <i class="
                    @if ($current_page == 'Clinic.specialWithStar')
                    fa-solid 
                    @else
                    fa-regular
                    @endif
                    fa-star"></i>
                    <span>الزيارات المميزة</span>
                </a>
            </li>
            
        @endif
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
           <p class="font-weight-bold mb-0"> سجلات </p>
        </div>
        <li class="nav-item
            @if ($current_page == 'Clinic.patientInClinic')
                active
            @endif ">
            <a class="nav-link"  href="{{route('Clinic.patientInClinic')}}">
                <i class="fa-regular fa-address-card"></i>
                <span>سجلات العيادة</span></a>
        </li>
        @if (auth()->user()->id == auth()->user()->doctor_id )
            <li class="nav-item
                @if ( $current_page == 'Clinic.patientsArchive')
                    active
                @endif ">
                <a class="nav-link collapsed" href="{{route('Clinic.patientsArchive')}}">
                    <i class="fa-solid fa-users"></i>
                    <span>سجل الزوار</span>
                </a>
                
            </li>
            <li class="nav-item
                @if ( $current_page == 'Clinic.reviewsArchive')
                    active
                @endif ">
                <a class="nav-link" href="{{route('Clinic.reviewsArchive')}}" >
                    <i class="fa-solid fa-users-line"></i>
                    <span>سجل الزيارات</span>
                </a>
            </li>
        @endif
        <hr class="sidebar-divider">

      <!-- Nav Item - Dashboard -->
        <li class="nav-item
            @if ($current_page == 'Clinic.trashed')
              active
            @endif ">
            <a class="nav-link"  href="{{route('Clinic.trashed')}}">
                <i class="fas fa-fw fa-trash-alt fa-lg"></i>
                <span>سلة المحذوفات</span></a>
        </li>
       @endauth
</ul>
<!-- End of Sidebar -->
