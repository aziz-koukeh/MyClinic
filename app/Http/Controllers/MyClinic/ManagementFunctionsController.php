<?php

namespace App\Http\Controllers\MyClinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
//-----------------------------------
use App\Models\User;
use App\Models\Task;
use App\Models\ContactUs;
use App\Models\Notificate;
use App\Models\Doctor_info;
use App\Models\Patient;
use App\Models\PatientReview;
// ------------------Exports Excel -----------
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PatientsAllExport;
use App\Exports\PatientsExportMonthly;
use App\Exports\PatientReviewsAllExport;
use App\Exports\PatientReviewsExportMonthly;
// ------------------Exports Excel -----------
use Stevebauman\Purify\Facades\Purify;// مكتبة التنظيف من العوالق


//-----------------------------------
class ManagementFunctionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function D_boradCheck(Request $request)
        {

            $doctor_info=Doctor_info::where('user_id',auth()->user()->doctor_id)->first();
                $this->validate($request,[
                    'password' => 'required',
                ]);
            $hashedValue = $doctor_info->password;
            $originalValue = $request->password;

            if (Hash::check($originalValue, $hashedValue)) {
                $user=User::where('id',auth()->user()->id)->first();
                $user->a_d =1;
                $user->save();


                return redirect()->route('Clinic.D_borad')->with('allow','ok');
            } else {
                $user=User::where('id',auth()->user()->id)->first();

                if ($user->a_d <= 1 ) {
                    $user->a_d =3;
                    $user->save();

                    return redirect()->back()->with([
                        'MainAlertMessage'=>'عذراً',
                        'AlertMessage'=>'كلمة المرور ليست صحيحة .',
                        'alert_type_A'   =>'danger'
                    ]);
                }elseif ($user->a_d == 3 || $user->a_d < 6 )  {
                    $user->a_d = $user->a_d+1;
                    $user->save();

                    return redirect()->back()->with([
                        'MainAlertMessage'=>'عذراً',
                        'AlertMessage'=>'كلمة المرور ليست صحيحة .',
                        'alert_type_A'   =>'danger'
                    ]);
                }elseif ($user->a_d == 6 ){
                    auth()->guard()->logout();

                    $request->session()->invalidate();

                    $request->session()->regenerateToken();

                    if ($response = $this->loggedOut($request)) {
                        return $response;
                    }

                    return $request->wantsJson()
                        ? new JsonResponse([], 204)
                        : redirect('/');
                }

            }
        }
    protected function loggedOut(Request $request)
        {
            //
        }
    public function changeLanguage($locale)
        {
            try {

                if (array_key_exists($locale , config('locale.languages'))) {
                    Session::put('locale' , $locale);
                    App::setlocale($locale);
                    return redirect()->back();
                }

                return redirect()->back();




            } catch (\Exception $exception) {
                return redirect()->back();
            }
        }
    public function editDoctorInfo(Request $request)
        {

            $this->validate($request,[
                'university'=> ['nullable', 'string'] ,
                'med_specialty'=> ['nullable', 'string'] ,
                'bio'=> ['nullable', 'string'] ,
                'exp_work_year'=> ['nullable', 'string'] ,
                'exp_about'=> ['nullable', 'string'] ,

                'v_wages'=> ['nullable', 'numeric'] ,
                'rev_wages'=> ['nullable', 'numeric'] ,
                'em_wages'=> ['nullable', 'numeric'] ,

                'facepage'=> ['nullable', 'string'] ,
                'whatsapp'=> ['nullable', 'string'] ,
                'telegram'=> ['nullable', 'string'] ,
                'instagram'=> ['nullable', 'string'] ,
                'youtube'=> ['nullable', 'string'] ,
                'twitter'=> ['nullable', 'string'] ,
                'linked_in'=> ['nullable', 'string'] ,
                'address'=> ['nullable', 'string'] ,
                'map_emb'=> ['nullable', 'string'] ,

                'opentime'=> ['nullable'] ,
                'closetime'=> ['nullable'] ,
            ]);
            $id= auth()->user()->doctor_id;
            $doctor_info=  Doctor_info::where('user_id',$id)->first();
            if ($request->university) {
                $doctor_info->university= Purify::clean($request->university) ;
            }
            if ($request->med_specialty) {
                $doctor_info->med_specialty= Purify::clean($request->med_specialty) ;
            }
            if ($request->bio) {
                $doctor_info->bio= Purify::clean($request->bio) ;
            }
            if ($request->exp_work_year) {
                $doctor_info->exp_work_year= Purify::clean($request->exp_work_year) ;
            }
            if ($request->exp_about) {
                $doctor_info->exp_about= Purify::clean($request->exp_about) ;
            }
            if ($request->v_wages) {
                $doctor_info->v_wages= $request->v_wages ;
            }
            if ($request->rev_wages) {
                $doctor_info->rev_wages= $request->rev_wages ;
            }
            if ($request->em_wages) {
                $doctor_info->em_wages= $request->em_wages ;
            }
            if ($request->facepage) {
                $doctor_info->facepage= Purify::clean($request->facepage) ;
            }
            if ($request->whatsapp) {
                $doctor_info->whatsapp= Purify::clean($request->whatsapp) ;
            }
            if ($request->telegram) {
                $doctor_info->telegram= Purify::clean($request->telegram) ;
            }
            if ($request->instagram) {
                $doctor_info->instagram= Purify::clean($request->instagram) ;
            }
            if ($request->youtube) {
                $doctor_info->youtube= Purify::clean($request->youtube) ;
            }
            if ($request->twitter) {
                $doctor_info->twitter= Purify::clean($request->twitter) ;
            }
            if ($request->linked_in) {
                $doctor_info->linked_in= Purify::clean($request->linked_in) ;
            }
            if ($request->address) {
                $doctor_info->address= Purify::clean($request->address) ;
            }
            if ($request->map_emb) {
                $doctor_info->map_emb=$request->map_emb ;
            }
            if ($request->password) {
                $doctor_info->password= Hash::make($request->password);
            }
            if ($request->opentime) {
                $formattedopentime =  Carbon::parse($request->opentime);
                $doctor_info->opentime=$formattedopentime;
            }
            if ($request->closetime) {
                $formattedClosetime =  Carbon::parse($request->closetime);
                $doctor_info->closetime=$formattedClosetime;
            }
            $doctor_info->save();
            return  redirect()->back()->with([

                'MainAlertMessage'=>'نجحت العملية',
                'AlertMessage'=>'تم تحديث معلومات الطبيب .',
                'alert_type_A'   =>'success'

            ]);

        }

    public function printReview($id)
        {
            $patientReview = PatientReview::find($id);
            return view('myClinic.patients.printReview')->with('patientReview', $patientReview );
        }
    public function printPatientProfile($patient_slug)
        {
            $patient = Patient::where('patient_slug',$patient_slug)->first();
            $patientReviews = PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('patient_id',$patient->id)->orderBy('created_at','desc')->get();
            return view('myClinic.patients.printPatientProfile')->with('patient', $patient )->with('patientReviews', $patientReviews );
        }

// Tasks --------------------------------
    public function storetask(Request $request)// تحفظ بحساب أيدي الاشعار
        {
            $this->validate($request,[
                'forUser_id' => 'nullable',
                'forDay' => 'nullable',
                'contant'=> 'required',
            ]);
            $task = Task::create([
                'slug'=> Str::uuid()->toString(),
                'user_id' => auth()->user()->id  ,
                'forDay' => $request->forDay  ,
                'forGroup_id' => auth()->user()->doctor_id  ,
                'contant' =>  Purify::clean($request->contant) ,
            ]);

            $task->save();
            if ($request->for == 'all') {
                // ---------Notificate---------
                $notificate=  Notificate::create([
                    'user_id' => auth()->user()->id  ,
                    'forGroup_id' =>  auth()->user()->doctor_id  ,
                    'notify_type' => 'publictask',
                    'mainMassage' => 'لدينا مهمة عامة .'  ,
                    'connect' => $task->slug ,
                    'icon' => '<i class="fas fa-clipboard-list fa-xl text-white"></i>' ,
                ]);
                $notificate->save();
                // ---------Notificate---------
                return redirect()->back()->with([
                    'MainAlertMessage'=>'نجح الإنشاء',
                    'AlertMessage'=>'تم إنشاء مهمة عامة بنجاح .',
                    'alert_type_A'   =>'success'
                ]);

            }else{
                $user= User::where('doctor_id',auth()->user()->doctor_id)->where('name',$request->for)->first();
                if ($user) {
                    $task->forUser_id = $user->id;
                    $task->save();

                    if ($task->forUser_id == auth()->user()->doctor_id) {
                        // ---------Notificate---------
                        $notificate=  Notificate::create([
                            'user_id' => auth()->user()->id  ,
                            'forUser_id' =>  $user->id  ,
                            'forGroup_id' =>  auth()->user()->doctor_id  ,
                            'notify_type' => 'newtask',
                            'mainMassage' => 'تم إنشاء المهمة : '.$task->contant,
                            'connect' => $task->slug ,
                            'icon' => '<i class="fas fa-clipboard-list fa-xl text-white"></i>' ,
                        ]);
                        $notificate->save();
                        // ---------Notificate---------

                        return redirect()->back()->with([
                        'MainAlertMessage'=>'نجح الإنشاء',
                        'AlertMessage'=>'تم إنشاء المهمة الشخصية بنجاح .',
                        'alert_type_A'   =>'info'
                    ]);
                    } else {
                        // ---------NotificateForUser---------
                        $notificate=  Notificate::create([
                            'user_id' => auth()->user()->id  ,
                            'forUser_id' =>  $user->id  ,
                            'forGroup_id' =>  auth()->user()->doctor_id  ,
                            'notify_type' => 'newtask',
                            'mainMassage' => 'تم تسليمكم مهمة : '.$task->contant,
                            'connect' => $task->slug ,
                            'icon' => '<i class="fas fa-clipboard-list fa-xl text-white"></i>' ,
                        ]);
                        $notificate->save();
                        // ---------NotificateForUser---------
                        // ---------NotificateForDoctor---------
                        $notificate1=  Notificate::create([
                            'user_id' => auth()->user()->id  ,
                            'forUser_id' =>  $user->doctor_id  ,
                            'forGroup_id' =>  auth()->user()->doctor_id  ,
                            'notify_type' => 'newtask',
                            'mainMassage' => 'تم تسليم المهمة '.$task->contant.' ل'.$user->name.' بنجاح .',
                            'connect' => $task->slug ,
                            'icon' => '<i class="fas fa-clipboard-list fa-xl text-white"></i>' ,
                        ]);
                        $notificate1->save();
                        // ---------NotificateForDoctor---------

                        return redirect()->back()->with([
                        'MainAlertMessage'=>'نجح التسليم',
                        'AlertMessage'=>'تم تسليم المهمة ل'.$user->name.' بنجاح .',
                        'alert_type_A'   =>'info'
                    ]);
                    }

                }

                else{
                    return redirect()->back()->with([
                        'MainAlertMessage'=>'فشل',
                        'AlertMessage'=>'فشل إنشاء المهمة .',
                        'alert_type_A'   =>'danger'
                    ]);
                }
            }
        }
    public function taskDone(Request $request, $slug)// تحفظ بحساب أيدي الاشعار
        {
            $task = Task::where('slug',$slug)->first();
            if($task->read_at == null){
                $task->read_at = Carbon::now();
                $task->doneByUser_id = auth()->user()->id;
                $task->save();
                if (auth()->user()->id != auth()->user()->doctor_id ) {
                    $notificate=  Notificate::create([
                        'user_id' => auth()->user()->id  ,
                        'forUser_id' =>  auth()->user()->doctor_id  ,
                        'forGroup_id' =>  auth()->user()->doctor_id  ,
                        'notify_type' => 'donetask'  ,
                        'mainMassage' => 'تم إنجاز المهمة '.Str::limit($task->contant, 10 , '...') .' بواسطة '.auth()->user()->name,
                        'connect' => $task->slug ,
                        'icon' => '<i class="fas fa-clipboard-list fa-xl text-white"></i>' ,
                    ]);
                    $notificate->save();
                }
                $notificate=Notificate::where('connect', $task->slug)
                ->where(function ($query)
                {
                $query->where('notify_type','newtask')->orWhere('notify_type','publictask');
                })
                ->first();
                if ($notificate) {
                    $notificate->read_at =Carbon::now();
                    $notificate->save();
                }

                return redirect()->back()->with([
                    'MainAlertMessage'=>'نجاح المهمة',
                    'AlertMessage'=>'تم إنجاز المهمة بنجاح .',
                    'alert_type_A'   =>'primary'
                ]);
            }else{
                $user =User::find($task->doneByUser_id);
                return redirect()->back()->with([
                    'MainAlertMessage'=>'عذراَ',
                    'AlertMessage'=>' المهمة منجزة  ',
                    'alert_type_A'   =>'info'
                ]);
            }

        }
    public function unDoneTask($slug)// تحفظ بحساب أيدي الاشعار
        {
            $task = Task::where('slug',$slug)->whereNotNull('read_at')->first();
            if($task){
                $task->read_at = null;
                $task->doneByUser_id = null;
                $task->save();
                $notificate=Notificate::where('connect', $task->slug)
                ->where(function ($query)
                {
                $query->where('notify_type','newtask')->orWhere('notify_type','publictask');
                })
                ->first();
                if ($notificate) {
                    $notificate->read_at = null;
                    $notificate->save();
                }

                return redirect()->back()->with([
                    'MainAlertMessage'=>'تراجع',
                    'AlertMessage'=>'تم التراجع عن إنجاز المهمة .',
                    'alert_type_A'   =>'warning'
                ]);
            }else{
                return redirect()->back();
            }
        }
    public function doneAllTasks()// تحفظ بحساب أيدي الاشعار
        {
            $tasks = Task::where('forGroup_id',auth()->user()->doctor_id)
            ->where('forUser_id','<>',auth()->user()->doctor_id)
            ->whereNull('read_at')->get();
            $publicTasks = Task::where('forGroup_id',auth()->user()->doctor_id)
            ->whereNull('forUser_id')
            ->whereNull('read_at')->get();
            if($tasks){
                foreach ($tasks as $task) {
                    $task->read_at = Carbon::now();
                    $task->doneByUser_id = auth()->user()->id;
                    $task->save();
                    $notificate=Notificate::where('connect', $task->slug)->where('notify_type','newtask')->first();
                    if ($notificate) {
                        $notificate->read_at = Carbon::now();
                        $notificate->save();
                    }
                }
                foreach ($publicTasks as $publicTask) {
                    $publicTask->read_at = Carbon::now();
                    $publicTask->doneByUser_id = auth()->user()->id;
                    $publicTask->save();
                    $notificate=Notificate::where('connect', $publicTask->slug)->where('notify_type','newtask')->first();
                    if ($notificate) {
                        $notificate->read_at = Carbon::now();
                        $notificate->save();
                    }
                }
                if (auth()->user()->id != auth()->user()->doctor_id ) {
                    $notificate=  Notificate::create([
                        'user_id' => auth()->user()->id  ,
                        'forUser_id' =>  auth()->user()->doctor_id  ,
                        'forGroup_id' =>  auth()->user()->doctor_id  ,
                        'notify_type' => 'donetask'  ,
                        'mainMassage' => 'تم إنجاز جميع المهام بواسطة '.auth()->user()->name,
                        'connect' => 'doneAllTasks By'. auth()->user()->name,
                        'icon' => '<i class="fas fa-clipboard-list fa-xl text-white"></i>' ,
                    ]);
                    $notificate->save();
                }

                return redirect()->back()->with([
                    'MainAlertMessage'=>'نجاح ',
                    'AlertMessage'=>'تم إنجاز المهام بشكل كامل .',
                    'alert_type_A'   =>'primary'
                ]);
            }else{
                return redirect()->back();
            }

        }
    public function destroyAllTasks()// تحفظ بحساب أيدي الاشعار
        {
            $tasks = Task::where('forGroup_id',auth()->user()->doctor_id)->get();
            foreach ($tasks as $task) {
                if ($task->forUser_id == auth()->user()->doctor_id) {
                    continue;
                }else{
                    $task->delete();
                }
            }
            if (auth()->user()->id != auth()->user()->doctor_id ) {
                $notificate=  Notificate::create([
                    'user_id' => auth()->user()->id  ,
                    'forUser_id' =>  auth()->user()->doctor_id  ,
                    'forGroup_id' =>  auth()->user()->doctor_id  ,
                    'notify_type' => 'delete'  ,
                    'mainMassage' => 'تم حذف جميع المهام بواسطة '.auth()->user()->name,
                    'connect' => $task->slug ,
                    'icon' => '<i class="fas fa-clipboard-list fa-xl text-white"></i>' ,
                ]);
                $notificate->save();
            }

            return redirect()->back()->with([
                'MainAlertMessage'=>'حذف',
                'AlertMessage'=>'تم حذف جميع المهام بنجاح .',
                'alert_type_A'   =>'warning'
            ]);

        }
    public function destroyAllDoneTasks()// تحفظ بحساب أيدي الاشعار
        {
            $tasks = Task::where('forGroup_id',auth()->user()->doctor_id)->whereNotNull('read_at')->get();
            foreach ($tasks as $task) {
                if ($task->forUser_id == auth()->user()->doctor_id) {
                    continue;
                }else{
                    $task->delete();
                }
            }
            if (auth()->user()->id != auth()->user()->doctor_id ) {
                $notificate=  Notificate::create([
                    'user_id' => auth()->user()->id  ,
                    'forUser_id' =>  auth()->user()->doctor_id  ,
                    'forGroup_id' =>  auth()->user()->doctor_id  ,
                    'notify_type' => 'delete'  ,
                    'mainMassage' => 'تم حذف جميع المهام المنفذة بواسطة '.auth()->user()->name,
                    'connect' => $task->slug ,
                    'icon' => '<i class="fas fa-clipboard-list fa-xl text-white"></i>' ,
                ]);
                $notificate->save();
            }

            return redirect()->back()->with([
                'MainAlertMessage'=>'حذف',
                'AlertMessage'=>'تم حذف جميع المهام المنفذة بنجاح .',
                'alert_type_A'   =>'warning'
            ]);

        }
    public function destroyDoctorNotesTasks($slug)// تحفظ بحساب أيدي الاشعار
        {
            $task = Task::where('slug',$slug)->first();
            $task->delete();
            return redirect()->back()->with([
                'MainAlertMessage'=>'حذف',
                'AlertMessage'=>'تم حذف الملاحظة بنجاح .',
                'alert_type_A'   =>'warning'
            ]);

        }
// Tasks --------------------------------
// Notificate ---------------------------
    public function readNotificateAll()
        {
            $notificates=Notificate::where('forGroup_id',auth()->user()->doctor_id)->where(function ($query)
            {
            $query->whereNull('forUser_id')->orWhere('forUser_id', auth()->user()->id);
            })->get();
            foreach ($notificates as $notificate) {
                if($notificate->notify_type == 'publictask'){
                    $task = Task::where('slug',$notificate->connect)->first();
                    if($task != null){
                        if ($task->read_at != null){
                            $notificate->read_at = Carbon::now();
                            $notificate->save();
                        }
                    }else{
                        $notificate->read_at = Carbon::now();
                        $notificate->save();
                    }
                }else{
                    $notificate->read_at = Carbon::now();
                    $notificate->save();
                }
            }
            return redirect()->back();

        }
    public function readNotificate(Request $request, $id)// تحفظ بحساب أيدي الاشعار
        {
            $notificate=Notificate::find( $id );
            if($notificate->notify_type == 'publictask'){
                $task = Task::where('slug',$notificate->connect)->first();
                if($task){
                    if ($task->read_at == null){
                        return redirect()->back()->with([
                            'MainAlertMessage'=>'عذراً',
                            'AlertMessage'=>'لا يمكنك تحديد الإشعار كمقروء لأن المهمة لم تنفذ بعد .',
                            'alert_type_A'   =>'warning'
                        ]);
                    }
                }

            }
            $notificate->read_at = Carbon::now();
            $notificate->save();
            if ($notificate->notify_type == 'newPatient' ||  $notificate->notify_type == 'newReview'){
                if ($notificate->created_at->diffInHours() <= 6) {
                    return redirect()->route('Clinic.patientInClinic');
                }else {
                    return redirect()->route('Clinic.patientProfile',$notificate->connect);
                }
            }
            return redirect()->back();

        }

    public function unReadNotificate($id)// تحفظ بحساب أيدي الاشعار
        {
            $notificate=Notificate::find( $id );
            $notificate->read_at = null;
            $notificate->save();
            return redirect()->back()->with([
                'MainAlertMassage'=>'غير مقروء',
                'AlertMassage'=>'تم تحديد الإشعار كغير مقروء بنجاح .',
                'alert_type_A'   =>'danger'
            ]);

        }
    public function destroyReadNotificateAll()
        {
            $notificates=Notificate::where(function ($query) {
                $query->whereNull('forUser_id')->orWhere('forUser_id', auth()->user()->id);
            })->whereNotNull('read_at')->get();
            foreach ($notificates as $notificate) {
                $notificate->delete();
            }
            return redirect()->back()->with([
                'MainReviewMassage'=>'حذف',
                'ReviewMassage'=>'تم حذف جميع الإشعارات المقروءة بنجاح .',
                'alert_type_R'   =>'danger'
            ]);

        }
// Notificate ---------------------------
// Message---------------------------------
    public function readMessagesAll()
        {
            $messages=ContactUs::all();
            foreach ($messages as $message) {
                $message->read_at = Carbon::now();
                $message->save();
            }
            return redirect()->back();

        }
    public function readMessage($id)// تحفظ بحساب أيدي الاشعار
        {
            $messages=ContactUs::find( $id );
            $messages->read_at = Carbon::now();
            $messages->save();
            return redirect()->back();

        }
    public function destroyMessage($id)
        {
            $message = ContactUs::whereId($id)->first();

            $message->delete();
            return redirect()->back()->with([
                'MainReviewMassage'=>'حذف',
                'ReviewMassage'=>'تم حذف الرسالة بنجاح .',
                'alert_type_R'   =>'danger'
            ]);

        }
    public function destroyMessagesAll()
        {
            $messages = ContactUs::all();
            foreach ($messages as $message) {
                $message->delete();
            }
            return redirect()->back()->with([
                'MainReviewMassage'=>'حذف',
                'ReviewMassage'=>'تم حذف جميع الرسائل بنجاح .',
                'alert_type_R'   =>'danger'
            ]);

        }
// Message---------------------------------
// Export_Excel ---------------------------
    public function export_excel_patients()
        {
            return Excel::download(new PatientsAllExport(), 'آخر تحديث سجل المرضى'.date('Y-m-d').'('.date('h:i a').').xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }
    public function export_excel_patients_monthly(Request $request)
        {
            $this->validate($request,[
                'month' => 'required',
            ]);
            $month =$request->month;
            $date = \Carbon\Carbon::createFromFormat('Y-m', $month);
            $formattedMonth = $date->format('m');
            $formattedYear = $date->format('Y');
            return (new PatientsExportMonthly())->forMonth( $month )->download('سجل المرضى لشهر '. $formattedMonth .' لسنة '. $formattedYear .'.xlsx');
        }
    public function export_excel_reviews()
        {
            return Excel::download(new PatientReviewsAllExport(), 'آخر تحديث سجل الزيارات'.date('Y-m-d').'('.date('h:i a').').xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }
    public function export_excel_reviews_monthly(Request $request)
        {
            $this->validate($request,[
                'month' => 'required',
            ]);
            $month =$request->month;
            $date = \Carbon\Carbon::createFromFormat('Y-m', $month);
            $formattedMonth = $date->format('m');
            $formattedYear = $date->format('Y');
            return (new PatientReviewsExportMonthly())->forMonth( $month )->download('سجل الزيارات لشهر '. $formattedMonth .' لسنة '. $formattedYear .'.xlsx');
        }
// Export_Excel ---------------------------



}
