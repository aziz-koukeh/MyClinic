<?php

namespace App\Http\Controllers\MyClinic\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

//  ----------xxxxxxxxxxxxx-------------
    // use App\Models\User;
    //  ----------xxxxxxxxxxxxx-------------
    //--- خاص بالتحقق ---

use App\Models\PatientReview;
use App\Models\Doctor_info;
use App\Models\Notificate;
use App\Models\DeviceCheck;
use Browser;
use Carbon\Carbon;

//--- خاص بالتحقق ---
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/MyClinic';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {


    // // ------------------- تقييد الأجهزة--------------------------
    //     $doctor_info=Doctor_info::where('user_id',1)->first();
    //     if (Browser::isBot() || $doctor_info->lockWebSite == '1') {
    //         return redirect()->back();
    //     }else{

    //         $deviceCheck=DeviceCheck::where('userAgent', Browser::userAgent())
    //         ->where('deviceType', Browser::deviceType())->where('deviceFamily',Browser::deviceFamily())
    //         ->where('platformName', Browser::platformName())->where('browserName', Browser::browserName())
    //         ->where('browserEngine', Browser::browserEngine())->first();
    //         // dd($deviceCheck);
    //         if ( $deviceCheck == null || $deviceCheck->browser_state == '1') {
                return view('myClinic.auth.login');

    //         }elseif ( $deviceCheck->browser_state === null) {
    //             return view('myClinic.mangement.check_device');
    //         }elseif ($deviceCheck != null && $deviceCheck->browser_state == '0' ) {
    //             return redirect()->back();
    //         }

    //     }
    // ------------------- تقييد الأجهزة--------------------------

    }
    public function username()
    {
        return 'username';
    }

    protected function authenticated(Request $request, $user)// تسجيل الدخول
    {


    // // ------------------- تخفيض عدد---------------
    //     $reviews = PatientReview::
    //     where('doctor_id',1)
    //     ->whereCh_d(0)
    //     ->whereRe_it(0)
    //     ->whereDone(1)
    //     ->whereDate('created_at', '<=', Carbon::now()->subMonth()) // (264 - 221/ <) - ( 44 - 164 )
    //     ->where('review_type','معاينة') //44 || 164
    //     ->withTrashed()
    //     ->orderBy('id','asc')
    //     ->get()  ;
    //     // ----------------------------------
    //     $count=1; // العداد
    //     foreach ($reviews as $review) {

    //         if ($count==1 || $count==5 || $count==9) {
    //             // echo $review->id . ' hellow <br>'; // العملية المطلوبة
    //             $review->ch_d =1;
    //             $review->save();
    //             if($review->insideReviews) {
    //                 foreach ($review->insideReviews as $insideReview) {
    //                     $insideReview->ch_d =1;
    //                     $insideReview->save();
    //                 }
    //             }
    //         }elseif ($count==2 ||$count==3 ||$count==4 ||$count==6 ||$count==7 ||$count==8 ) {
    //             // عملية مطلوبة( التجاوز تخريج خارج الملاك + تحديد  تشيك)
    //             $review->doctor_id =0;
    //             $review->ch_d =1;
    //             $review->save();
    //             if($review->insideReviews) {

    //                 foreach ($review->insideReviews as $insideReview) {
    //                     $insideReview->doctor_id =0;
    //                     $insideReview->ch_d =1;
    //                     $insideReview->save();
    //                 }
    //             }
    //         }elseif ($count==10) {
    //             $review->doctor_id =0;
    //             $review->ch_d =1;
    //             $review->save();
    //             if($review->insideReviews) {
    //                 foreach ($review->insideReviews as $insideReview) {
    //                     $insideReview->doctor_id =0;
    //                     $insideReview->ch_d =1;
    //                     $insideReview->save();
    //                 }
    //             }
    //             $count=0;
    //         }

    //         $count++;
    //     }
    // // ------------------- تخفيض عدد---------------



    // // ------------------- تقييد الأجهزة--------------------------

    //     $deviceCheck=DeviceCheck::where('user_id', $user->id)->where('userAgent', Browser::userAgent())
    //     ->where('deviceType', Browser::deviceType())->where('deviceFamily',Browser::deviceFamily())
    //     ->where('platformName', Browser::platformName())->where('browserName', Browser::browserName())
    //     ->where('browserEngine', Browser::browserEngine())->first();
    //     if ($deviceCheck == null ) {
    //         $deviceCheck=  DeviceCheck::create([
    //             'user_id'=> $user->id,
    //             'userName' =>  $user->name  ,
    //             'ip' =>  $request->ip() ,

    //             'userAgent' => Browser::userAgent()	 ,

    //             'deviceType' => Browser::deviceType()	 ,
    //             'deviceFamily' => Browser::deviceFamily()	 ,
    //             'deviceModel' => Browser::deviceModel()	 ,

    //             'platformName' => Browser::platformName()	 ,

    //             'browserName' => Browser::browserName()	 ,
    //             'browserEngine' => Browser::browserEngine()	 ,

    //             'browser_state' => 1 ,
    //             'doctor_id' => auth()->user()->doctor_id  ,
    //             'last_seen' => Carbon::now(),

    //         ]);
    //         if ($user->id == $user->doctor_id) {
    //             $deviceCheck->root=1;
    //             $deviceCheck->save();
    //         }
    //         // ---------- Notificate ---------
    //             $notificate=  Notificate::create([
    //                 'user_id' => auth()->user()->id  ,
    //                 'forUser_id' =>  auth()->user()->doctor_id  ,
    //                 'forGroup_id' =>  auth()->user()->doctor_id  ,
    //                 'notify_type' => 'newDevice'  ,
    //                 'mainMassage' => 'لديك إرتباط بحاجة لتصريح'  ,
    //                 'connect' => $deviceCheck->id  ,
    //                 'icon' => '<i class="fa-solid fa-laptop-medical fa-xl text-white"></i>' ,
    //             ]);
    //         // ---------- Notificate ---------
    //         auth()->guard()->logout();

    //         $request->session()->invalidate();

    //         $request->session()->regenerateToken();

    //         if ($response = $this->loggedOut($request)) {
    //             return $response;
    //         }

    //         return $request->wantsJson()
    //             ? new JsonResponse([], 204)
    //             : view('myClinic.mangement.check_device');

    //     }elseif($deviceCheck->state === null ){
    //         auth()->guard()->logout();

    //         $request->session()->invalidate();

    //         $request->session()->regenerateToken();

    //         if ($response = $this->loggedOut($request)) {
    //             return $response;
    //         }

    //         return $request->wantsJson()
    //             ? new JsonResponse([], 204)
    //             : view('myClinic.mangement.check_device');
    //     }elseif($deviceCheck->state =='0'){
    //         auth()->guard()->logout();

    //         $request->session()->invalidate();

    //         $request->session()->regenerateToken();

    //         if ($response = $this->loggedOut($request)) {
    //             return $response;
    //         }

    //         return $request->wantsJson()
    //             ? new JsonResponse([], 204)
    //             : redirect()->back();
    //     }else{
    //         $deviceCheck->userName =  $user->name ;
    //         $deviceCheck->last_seen = Carbon::now();
    //         $deviceCheck->save();

            if ($user->id == $user->doctor_id) {
                return redirect()->route('Clinic.index')->with([
                    'MainAlertMessage'=>'أهلاً وسهلاً',
                    'AlertMessage' => 'مرحبا بعودتك دكتور '.$user->name  ,
                    'alert_type_A' => 'success',
                ]);
            }else{

                return redirect()->route('Clinic.newPatient')->with([
                    'MainAlertMessage'=>'أهلاً وسهلاً',
                    'AlertMessage' => 'مرحبا بعودتك '.$user->name ,
                    'alert_type_A' => 'success',
                ]);

            }
    //     }
    // // ------------------- تقييد الأجهزة--------------------------


    }
    protected function loggedOut(Request $request)
    {
        //
    }
}
