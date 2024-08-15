
<div style="position: fixed; bottom: 20px; left: 20px;direction:ltr;z-index: 2;text-align:right;width: 300px;">

    {{-- رسالة زيارة جديدة --}}
    @if (session('ReviewMassage'))
        <div class="toast border-bottom-{{session('alert_type_R')}} shadow"  role="alert" id="ReviewMassage" aria-live="assertive" aria-atomic="true" data-animation="true">
            <div class="toast-header ">
                {{-- <img src="..." class="rounded mr-2" alt="..."> --}}
                <i class="fa-regular fa-hospital" style="color: #4e73df;"></i>
                <strong class="mx-auto text-gray-900" style="direction:rtl">{{session('MainReviewMassage')}}</strong>
                <small class="text-muted">الآن</small>
                {{-- <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>
            <div class="toast-body text-gray-800" style="direction: rtl;text-align: right">
                <b>{{session('ReviewMassage')}}</b>
            </div>
        </div>
    @endif
    {{-- رسالة زيارة جديدة --}}

    {{-- رسالة زائر جديد --}}
    @if (session('PatientMassage'))
        <div class="toast border-bottom-{{session('alert_type_P')}}" role="alert" id="PatientMassage" aria-live="assertive" aria-atomic="true" data-animation="true">
            <div class="toast-header">
                {{-- <img src="..." class="rounded mr-2" alt="..."> --}}
                <i class="fa-regular fa-hospital" style="color: #4e73df;"></i>
                <strong class="mx-auto text-gray-900" style="direction:rtl">{{session('MainPatientMassage')}}</strong>
                <small class="text-muted">الآن</small>
                {{-- <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>
            <div class="toast-body text-gray-800" style="direction: rtl;text-align: right">
                <b><p>{{session('PatientMassage')}}</p>
                @if (session('PatientSlug'))
                    <a href="{{route('Clinic.patientProfile',session('PatientSlug'))}}">إضغط هنا للذهاب إلى ملف المريض</a>
                @endif</b>
            </div>
        </div>
    @endif
    {{-- رسالة زائر جديد --}}

    {{-- رسالة تنويه عن التكرار --}}
    @if (session('AlertMessage'))
        <div class="toast border-bottom-{{session('alert_type_A')}} border-top-{{session('alert_type_A')}} shadow" role="alert" id="AlertMessage" aria-live="assertive" aria-atomic="true" data-animation="true">
            <div class="toast-header ">
                {{-- <img src="..." class="rounded mr-2" alt="..."> --}}
                <i class="fa-regular fa-hospital" style="color: #4e73df;"></i>
                <strong class="mx-auto text-gray-900" style="direction:rtl">{{session('MainAlertMessage')}}</strong>
                <small class="text-muted">الآن</small>
                {{-- <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>
            <div class="toast-body text-gray-800" style="direction: rtl;text-align: right">
                <b>{{session('AlertMessage')}}</b>
            </div>
        </div>
    @endif
    {{-- رسالة تنويه عن التكرار --}}


</div>
