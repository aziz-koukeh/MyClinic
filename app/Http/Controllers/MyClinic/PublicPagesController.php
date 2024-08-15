<?php

namespace App\Http\Controllers\MyClinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//-----------------------------------
use App\Models\ContactUs;
use App\Models\Doctor_info;
//-----------------------------------
use Stevebauman\Purify\Facades\Purify;// مكتبة التنظيف من العوالق

class PublicPagesController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function welcome()
        {
            $doctor_info =  Doctor_info::where('user_id',1)->first();
            return view('myClinic.welcome',compact('doctor_info'));
        }
    public function AboutUs()
        {
            $doctor_info =  Doctor_info::where('user_id',auth()->user()->doctor_id)->first(); // لدراسة أحقية الإنشاء الجديد
            if ($doctor_info == null) {
                $doctor_info =Doctor_info::create([
                    'user_id' => auth()->user()->doctor_id ,
                    'password' => bcrypt('123123123'),
                    'lockWebSite' => 0 ,
                ]);
                $doctor_info->save();
            }
            return view('myClinic.about',compact('doctor_info'));
        }
    public function ContantUs()
        {
            return view('myClinic.contantUs');
        }
    public function do_ContantUs(Request $request)
        {
            $this->validate($request,[
                'name' => 'required',
                'email' => 'required|email',
                'mobile'=> 'nullable|numeric',
                'title'=> 'required|min:4',
                'message'=> 'required|min:10',
            ]);
            $contactUs=  ContactUs::create([
                'user_id' => 1 ,
                'name' =>  Purify::clean($request->name) ,
                'email' => Purify::clean($request->email ) ,
                'mobile'=> Purify::clean($request->mobile ) ,
                'title'=> Purify::clean($request->title ) ,
                'message'=> Purify::clean($request->message ) ,
            ]);

            $contactUs->save();

            return redirect()->back()->with([
                'MainAlertMessage'=>'شكراً لكم',
                'AlertMessage'=>'تم إرسال الرسالة وهي قيد المعالجة , سوف يتم التواصل بكم لاحقاً.',
                'alert_type_A'   =>'primary'
            ]);
        }

}
