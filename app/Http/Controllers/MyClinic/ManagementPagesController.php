<?php

namespace App\Http\Controllers\MyClinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
//--------------------------------
use App\Models\Task;
use App\Models\ContactUs;
use App\Models\Notificate;
use App\Models\User;
use App\Models\Patient;
use App\Models\PatientReview;
use App\Models\Doctor_info;
use App\Models\DeviceCheck;
//--------------------------------
use Stevebauman\Purify\Facades\Purify;// مكتبة التنظيف من العوالق
use Browser;

//--------------------------------
class ManagementPagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        // ---------------------------------------------------------------------------------

                $tasks = Task::where('forGroup_id',auth()->user()->doctor_id)->whereNull('read_at')->get();
                $patientReviews = PatientReview::with(['patient'])->where('doctor_id',auth()->user()->doctor_id)
                    ->where('done',0)->where('leave_off',1)->orderBy('created_at')
                    ->where(function ($query)
                        {
                        $query->whereDate('review_forDay',date('Y-m-d'))->orWhere(function ($query1)
                            {
                            $query1->whereNull('review_forDay')->whereDate('created_at',date('Y-m-d'));
                            });
                        })->get();
                $nextReviews = PatientReview::with(['patient'])->where('doctor_id',auth()->user()->doctor_id)->where('review_forDay','>',Carbon::today()->format('Y-m-d'))->orderBy('review_forDay', 'asc')->get();
                // dd($nextReviews);
                return view('myClinic.index')->with('patientReviews',$patientReviews)->with('nextReviews',$nextReviews)->with('tasks',$tasks);//

        // ---------------------------------------------------------------------------------



    }
    public function D_borad()
    {
        if (auth()->user()->d_o_e == 1) {
            if (session('allow') == 'ok') {
                $user=User::where('id',auth()->user()->id)->first();
                $user->a_d =1;
                $user->save();
                $deviceChecks=DeviceCheck::where('doctor_id',auth()->user()->doctor_id)
                // where('ip', $request->ip())->where('userName', $user->name)->where('userAgent', Browser::userAgent())
                // ->where('deviceType', Browser::deviceType())->where('deviceFamily',Browser::deviceFamily())
                // ->where('platformName', Browser::platformName())->where('browserName', Browser::browserName())
                // ->where('browserEngine', Browser::browserEngine())
                ->get();
                $notificates= Notificate::where('forGroup_id',auth()->user()->doctor_id)->orderBy('created_at','desc')->get();
                $messages= ContactUs::where('user_id',auth()->user()->doctor_id)->orderBy('created_at','desc')->get();
                $tasks = Task::where('forGroup_id',auth()->user()->doctor_id)->orderBy('created_at','desc')->get();
                $patients= Patient::where('user_id',auth()->user()->doctor_id)->orderBy('created_at','desc')->take(15)->get();
                $patientReviews = PatientReview::where('doctor_id',auth()->user()->doctor_id)->orderBy('created_at','desc')->take(15)->get();
                $employeeusers=User::where('doctor_id',auth()->user()->doctor_id)->where('id','<>',auth()->user()->doctor_id)->orderBy('d_o_e','desc')->get();

                //---------------------
                $allpatients=Patient::where('user_id',auth()->user()->doctor_id)->count();

                $allDonePatientReviews = PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('done', 1)->count();
                $allNotDonePatientReviews =PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('done', 0)->count();

                $doneViews = PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('review_type', 'معاينة')->where('done', 1)->count();
                $notDoneViews =PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('review_type', 'معاينة')->where('done', 0)->count();

                $doneReviews = PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('review_type', 'مراجعة')->where('done', 1)->count();
                $notDoneReviews =PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('review_type', 'مراجعة')->where('done', 0)->count();

                $doneEmengs = PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('review_type', 'اسعافية')->where('done', 1)->count();
                $notDoneEmengs =PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('review_type', 'اسعافية')->where('done', 0)->count();

                $doneVisits = PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('review_type', 'زيارة')->where('done', 1)->count();
                $notDoneVisits =PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('review_type', 'زيارة')->where('done', 0)->count();

                return view('myClinic.mangement.D_borad', compact('deviceChecks','notificates', 'messages', 'tasks', 'patients', 'patientReviews', 'employeeusers'
                , 'allpatients', 'allDonePatientReviews', 'allNotDonePatientReviews', 'doneViews', 'notDoneViews'
                , 'doneReviews', 'notDoneReviews', 'doneEmengs', 'notDoneEmengs', 'doneVisits', 'notDoneVisits'
                ));

            }elseif (auth()->user()->a_d ==1) {
                $deviceChecks=DeviceCheck::where('doctor_id',auth()->user()->doctor_id)
                // where('ip', $request->ip())->where('userName', $user->name)->where('userAgent', Browser::userAgent())
                // ->where('deviceType', Browser::deviceType())->where('deviceFamily',Browser::deviceFamily())
                // ->where('platformName', Browser::platformName())->where('browserName', Browser::browserName())
                // ->where('browserEngine', Browser::browserEngine())
                ->get();
                $notificates= Notificate::where('forGroup_id',auth()->user()->doctor_id)->orderBy('created_at','desc')->get();
                $messages= ContactUs::where('user_id',auth()->user()->doctor_id)->orderBy('created_at','desc')->get();
                $tasks = Task::where('forGroup_id',auth()->user()->doctor_id)->orderBy('created_at','desc')->get();
                $patients= Patient::where('user_id',auth()->user()->doctor_id)->orderBy('created_at','desc')->take(15)->get();
                $patientReviews = PatientReview::where('doctor_id',auth()->user()->doctor_id)->orderBy('created_at','desc')->take(15)->get();
                $employeeusers=User::where('doctor_id',auth()->user()->doctor_id)->where('id','<>',auth()->user()->doctor_id)->orderBy('d_o_e','desc')->get();

                //---------------------
                $allpatients=Patient::where('user_id',auth()->user()->doctor_id)->count();
                $allDonePatientReviews = PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('done', 1)->count();
                $allNotDonePatientReviews =PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('done', 0)->count();

                $doneViews = PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('review_type', 'معاينة')->where('done', 1)->count();
                $notDoneViews =PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('review_type', 'معاينة')->where('done', 0)->count();

                $doneReviews = PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('review_type', 'مراجعة')->where('done', 1)->count();
                $notDoneReviews =PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('review_type', 'مراجعة')->where('done', 0)->count();

                $doneEmengs = PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('review_type', 'اسعافية')->where('done', 1)->count();
                $notDoneEmengs =PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('review_type', 'اسعافية')->where('done', 0)->count();

                $doneVisits = PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('review_type', 'زيارة')->where('done', 1)->count();
                $notDoneVisits =PatientReview::where('doctor_id',auth()->user()->doctor_id)->where('review_type', 'زيارة')->where('done', 0)->count();

                return view('myClinic.mangement.D_borad', compact('deviceChecks','notificates', 'messages', 'tasks', 'patients', 'patientReviews', 'employeeusers'
                , 'allpatients', 'allDonePatientReviews', 'allNotDonePatientReviews', 'doneViews', 'notDoneViews'
                , 'doneReviews', 'notDoneReviews', 'doneEmengs', 'notDoneEmengs', 'doneVisits', 'notDoneVisits'
                ));

            }
            else{
                return redirect()->back()->with([
                    'MainAlertMessage'=>'عذراً',
                    'AlertMessage'=>'لايمكنك الوصول إلى لوحة القيادة بدون إدخال كلمة المرور.',
                    'alert_type_A'   =>'warning'
                ]);
            }
        }else{
            return redirect()->back()->with([
                'MainAlertMessage'=>'عذراً',
                'AlertMessage'=>'لا يمكنك الوصول إلى لوحة القيادة .',
                'alert_type_A'   =>'info'
            ]);
        }


    }
    public function Search(Request $request)
    {
        $keyword = isset($request->keyword) && $request->keyword !='' ? $request->keyword : null ;
        // إذا كان الطلب موضو وليس فارغ (؟) إذا تحقق ضع القيمة في المتغير (:) أو ضعها نول

        if ($keyword != null) {
            $patients = Patient::where('user_id', auth()->user()->doctor_id)->search($keyword, null, true ,true)->get();
            if (count($patients) > 0) {
                return view('myClinic.mangement.ResultSearchPatients')->with('patients',$patients);
            }else{
                $patientReviews = PatientReview::where('doctor_id', auth()->user()->doctor_id)->search($keyword, null, true ,true)->get();
                if (count($patientReviews) > 0) {
                    return view('myClinic.mangement.ResultSearchReviews')->with('patientReviews',$patientReviews);
                }else{
                    return view('myClinic.mangement.ResultSearchPatients')->with('patients',$patients);
                }
            }
        }
        return redirect()->back();
    }
    public function trashedFiles()
    {
        $patientReviews = PatientReview::with(['patient'=>function($query){$query->orderBy('created_at','desc')->where('user_id',auth()->user()->doctor_id)->withTrashed();}])->where('doctor_id',auth()->user()->doctor_id)->onlyTrashed()->orderBy('created_at','desc')->get()  ;
        $patients=Patient::onlyTrashed()->where('user_id',auth()->user()->doctor_id)->orderBy('created_at','desc')->get();


            return view('myClinic.mangement.trashed')->with('patientReviews',$patientReviews)->with('patients', $patients );

    }
    public function messagesPage()
    {
        $messages = ContactUs::where('user_id',auth()->user()->doctor_id)->orderBy('created_at','desc')->get();
        $tasks= Task::where('forGroup_id',auth()->user()->doctor_id)->where('forUser_id','<>',auth()->user()->doctor_id)->whereNull('read_at')->count();
        $notificates= Notificate::where('forGroup_id',auth()->user()->id)
        ->where(function ($query)
            {
             $query->whereNull('forUser_id')->orWhere('forUser_id', auth()->user()->id);
            })->whereNull('read_at')->count();
        return view('myClinic.mangement.messages')->with('messages',$messages)->with('tasks',$tasks)->with('notificates',$notificates);
    }
    public function mangementPage()
    {
        $doctor_info =  Doctor_info::where('user_id',auth()->user()->doctor_id)->first();
        if (auth()->user()->id == auth()->user()->doctor_id && $doctor_info == null) {
            $doctor_info =Doctor_info::create([
                'user_id' => auth()->user()->id ,
                'password' => bcrypt('123123123'),
                'lockWebSite' => 0 ,
            ]);
            $doctor_info->save();
        }
        $tasks= Task::where('forGroup_id',auth()->user()->doctor_id)
        ->where(function ($query)
            {
             $query->where('forUser_id','<>',auth()->user()->doctor_id)->orWhereNull('forUser_id');///////////////////////////
            })
        ->whereNull('read_at')->count();
        // dd($tasks);
        $messages= ContactUs::where('user_id',auth()->user()->doctor_id)->whereNull('read_at')->count();
        $notificates= Notificate::where('forGroup_id',auth()->user()->doctor_id)
        ->where(function ($query)
            {
             $query->whereNull('forUser_id')->orWhere('forUser_id', auth()->user()->id);
            })->whereNull('read_at')->count();
        $employeeusers = User::where('doctor_id',auth()->user()->doctor_id)->get();
        return view('myClinic.mangement.settings')->with('doctor_info',$doctor_info)
        ->with('tasks',$tasks)->with('messages',$messages)->with('notificates',$notificates)
        ->with('employeeusers',$employeeusers);
    }
    public function notificationsPage()
    {
        $notificates = Notificate::where('forGroup_id',auth()->user()->doctor_id)->where(function ($query)
            {
             $query->whereNull('forUser_id')->orWhere('forUser_id', auth()->user()->id);
            })
             ->orderBy('created_at','desc')->get();
        $tasks= Task::where('forGroup_id',auth()->user()->doctor_id)->where('forUser_id','<>',auth()->user()->doctor_id)->whereNull('read_at')->count();
        $messages= ContactUs::where('user_id',auth()->user()->doctor_id)->whereNull('read_at')->count();
        return view('myClinic.mangement.notifications')->with('notificates',$notificates)->with('tasks',$tasks)->with('messages',$messages);
    }
    public function tasksPage()
    {
        // $employeeusers = User::where('doctor_id',auth()->user()->doctor_id)->where('id', '<>' ,auth()->user()->doctor_id)->get(); كل الموظفين ماعدا الطبيب
        $employeeusers = User::where('doctor_id',auth()->user()->doctor_id)->get();
        $notificates= Notificate::where('forGroup_id',auth()->user()->doctor_id)
        ->where(function ($query)
            {
             $query->whereNull('forUser_id')->orWhere('forUser_id', auth()->user()->id);
            })
             ->orderBy('created_at','desc')->get()->whereNull('read_at')->count();
        $messages= ContactUs::where('user_id',auth()->user()->doctor_id)->whereNull('read_at')->count();
        $tasks = Task::where('forGroup_id',auth()->user()->doctor_id)->orderBy('created_at','desc')->get();
        return view('myClinic.mangement.tasks')->with('tasks',$tasks)->with('employeeusers',$employeeusers)->with('messages',$messages)->with('notificates',$notificates);
    }

//-------------Patient--------------------
    public function newPatient()
        {
            $patientReviews = PatientReview::with(['patient'])->where('doctor_id',auth()->user()->doctor_id)
                ->where('done',0)->orderBy('created_at' ,'desc')
                ->where(function ($query)
                {
                    $query->whereDate('review_forDay',date('Y-m-d'))->orWhere(function ($query1)
                        {
                        $query1->whereNull('review_forDay')->whereDate('created_at',date('Y-m-d'));
                        });
                })->get();
            $nextReviews = PatientReview::with(['patient'])->where('doctor_id',auth()->user()->doctor_id)->where('review_forDay','>',Carbon::today()->format('Y-m-d'))->orderBy('review_forDay', 'asc')->get();
            return view('myClinic.patients.newPatient')->with('patientReviews',$patientReviews)->with('nextReviews',$nextReviews);
        }
    public function newPatientFully()
        {
            return view('myClinic.patients.newPatient1');
        }
    public function patientProfile($patient_slug)
        {
            $patient = Patient::withTrashed()->where('user_id',auth()->user()->doctor_id)->wherePatient_slug($patient_slug)->first();
            // dd($patient);
            $patientReviews = PatientReview::with(['reviewMedias'])->where('doctor_id',auth()->user()->doctor_id)->where('patient_id',$patient->id)->orderBy('created_at','desc')->get();
            return view('myClinic.patients.patientProfile')->with('patient',$patient)->with('patientReviews', $patientReviews );
        }
    public function selectReview(Request $request, $patient_slug)
        {
            $patient = Patient::withTrashed()->where('user_id',auth()->user()->doctor_id)->wherePatient_slug($patient_slug)->first();
            $patientReviews = PatientReview::with(['reviewMedias'])->where('doctor_id',auth()->user()->doctor_id)->where('patient_id',$patient->id)->orderBy('created_at','desc')->get();
            return view('myClinic.patients.selectReview')->with('patient',$patient)->with('patientReviews', $patientReviews );
        }
    public function patientsInClinic()
        {
            // $patientReviews = PatientReview::with(['patient'])->where('doctor_id',auth()->user()->doctor_id)->whereDone(0)->whereLeave_off(0)->whereDate('created_at',date('Y-m-d'))->whereDate('created_at', '>',date('y-m-d'))->get();
            $unReporteds = PatientReview::where('doctor_id',auth()->user()->doctor_id)
            ->whereDone(0)->whereLeave_off(1)
            // ->whereDate('review_forDay','<', date('Y-m-d'))
            ->orderBy('created_at','desc')->get();
            $phoneTurns = PatientReview::where('doctor_id',auth()->user()->doctor_id)
            ->whereDate('review_forDay','<=', Carbon::today()->format('Y-m-d'))
            ->whereLeave_off(0)->orderBy('created_at','desc')->get();
            $patientReviews = PatientReview::where('doctor_id',auth()->user()->doctor_id)->whereDate('created_at', '>=', Carbon::now()->subMonth())->whereDone(1)->orderBy('created_at','desc')->get();
            return view('myClinic.patients.patientsInClinic')->with('patientReviews',$patientReviews)->with('unReporteds',$unReporteds)->with('phoneTurns',$phoneTurns);
        }
    public function specialWithStar()
        {
            $patientReviews = PatientReview::with(['patient'])->where('doctor_id',auth()->user()->doctor_id)->whereSpecial_with_star(1)->get();
            return view('myClinic.patients.specialWithStar',compact('patientReviews'));
        }
    public function patientsArchive()
        {
            $patients = Patient::with(['patientReviews'=>function($query){$query->where('doctor_id',auth()->user()->doctor_id)->orderBy('created_at','desc')->whereNull('deleted_at')->whereDone(1);}])->where('user_id',auth()->user()->doctor_id)->whereNull('deleted_at')->orderBy('created_at','desc')->get();
            return view('myClinic.patients.patientsArchive',compact('patients'));
        }
    public function reviewsArchive()
        {
            $patientReviews = PatientReview::with(['patient'])->where('doctor_id',auth()->user()->doctor_id)->whereDone(1)->orderBy('created_at','desc')->get();
            return view('myClinic.patients.reviewsArchive',compact('patientReviews'));
        }
    public function patientsArchiveNewer()
        {
            $currentYear = date('Y');
            $previousYear = $currentYear - 1;
            $patients = Patient::with(['patientReviews'=>function($query){$query->where('doctor_id',auth()->user()->doctor_id)->orderBy('created_at','desc')->whereNull('deleted_at')->whereDone(1);}])->whereYear('created_at', '>=', $previousYear)->where('user_id',auth()->user()->doctor_id)->whereNull('deleted_at')->orderBy('created_at','desc')->get();
            return view('myClinic.patients.patientsArchiveNewer',compact('patients'));
        }
    public function reviewsArchiveNewer()
        {
            $currentYear = date('Y');
            $previousYear = $currentYear - 1;
            $patientReviews = PatientReview::with(['patient'])->where('doctor_id',auth()->user()->doctor_id)->whereDone(1)->whereYear('created_at', '>=', $previousYear)->orderBy('created_at','desc')->get();
            return view('myClinic.patients.reviewsArchiveNewer',compact('patientReviews'));
        }
//-------------Patient--------------------

}
