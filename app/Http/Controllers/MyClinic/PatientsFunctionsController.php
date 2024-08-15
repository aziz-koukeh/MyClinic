<?php

namespace App\Http\Controllers\MyClinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
//--------------------------
use App\Models\Patient;
use App\Models\Task;
use App\Models\PatientReview;
use App\Models\PatientReviewMedia;
use App\Models\Notificate;
//--------------------------
use Stevebauman\Purify\Facades\Purify;// مكتبة التنظيف من العوالق

class PatientsFunctionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
//-------------Patient--------------------
    public function storePatient(Request $request)
        {
             $this->validate($request,[
                'patient_name' => 'required',
                'age'=> 'nullable|numeric',
                'blood_type'=> 'nullable',
                'gender'=> 'nullable',
                'smoking'=> 'nullable',
                'relationship' => 'nullable',
                'child_count'=> 'nullable|numeric',
                'phone'=> 'nullable|numeric',

                'older_surgery' => 'nullable',
                'older_sicky' => 'nullable',
                'older_sensitive' => 'nullable',
                'permanent_medic'=> 'nullable',
                'patient_state'=> 'nullable',

                'patient_address' => 'nullable',
                'patient_job' => 'nullable',

                // ----------------PatientReview with first insert------------------
                'review_type' => 'nullable',
                'main_complaint'=> 'required',
                'pain_story'=> 'nullable',
                'medical_report'=> 'nullable',
                'treatment_plan'=> 'nullable',
                'wages'=> 'nullable|numeric',
                'review_forDay'=> 'nullable',
                'date_expecting'=> 'nullable',

            ]);
            // إدخال السريع
            $main_complaintS=$request->main_complaint;
            $review_forDay=$request->review_forDay;
            $main = '';
            $review_type = '';
            if (count($main_complaintS) == 1 && $main_complaintS['0'] == null ) {
                return redirect()->back()->with([
                    'MainReviewMassage'=>'إدخال فارغ !!',
                    'ReviewMassage'=>' لم يتم إدخال سبب للزيارة .',
                    'alert_type_R'   =>'danger',
                ]);

            }
            else{
                if ((count($main_complaintS) == 1 && $main_complaintS['0'] != null)  ){
                    $main=Purify::clean($main_complaintS['0']);
                    if      ($main_complaintS['0'] == "معاينة جديدة") {
                        $review_type= "معاينة";
                    }elseif ($main_complaintS['0'] == "اسعافية") {
                        $review_type= "اسعافية";
                    }elseif ($main_complaintS['0'] == "مراجعة") {
                        $review_type= "مراجعة";
                    }elseif ($main_complaintS['0'] =="تحديد عملية" || $main_complaintS['0'] == "مراجعة عملية") {
                        $review_type= "زيارة";
                    }
                    // echo " شرط 1 ";
                    // dd($review_type);
                }elseif (( count($main_complaintS) > 1 && $main_complaintS['0'] == null && ( $main_complaintS['1'] == "صورة" || $main_complaintS['1'] ==  "تحليل") )){
                    foreach ($main_complaintS as $key => $request1) {
                        if($key == 0){
                            continue;
                        }else{
                            $main.=' - '.Purify::clean($request1);
                        }

                    }
                    $review_type= "زيارة";

                    // echo " شرط 2 ";
                    // dd($main);
                }elseif (count($main_complaintS) > 1 && $main_complaintS['0'] != null){
                    foreach ($main_complaintS as $key => $request1) {
                        $main.=' - '.Purify::clean($request1);

                        if      ($request1 == "معاينة جديدة") {
                            $review_type= "معاينة";
                        }elseif ($request1 == "اسعافية") {
                            $review_type= "اسعافية";
                        }elseif ($request1 == "مراجعة") {
                            $review_type= "مراجعة";
                        }elseif ($request1 =="تحديد عملية" || $request1 == "مراجعة عملية") {
                            $review_type= "زيارة";
                        }
                    }
                    // echo " شرط 3 ";
                    // dd($review_type);
                }
            }
            // echo "ذهب إلى تسجيل جديد";
            // dd($request->patient_name);

            if ($review_forDay != null) {
                if (($review_type== "مراجعة" || $review_type== "معاينة")) {
                    $check_patient=Patient::where('patient_name',$request->patient_name)->where('user_id',auth()->user()->doctor_id)->first();// ->where('phone',$request->phone) لأن الإدخال ليس حصري فلن يحدث
                    if ($check_patient !=null) {
                        if ($review_type== "مراجعة" ) {
                            $patientReviewId=PatientReview::where('patient_id',$check_patient->id)->whereNull('patient_review_id')->orderBy('created_at','desc')->first();
                            if ($patientReviewId != null) {
                                $patientReview=  PatientReview::create([
                                    'doctor_id' => auth()->user()->doctor_id  ,
                                    'patient_review_id' => $patientReviewId->id ,
                                    'patient_id' => $check_patient->id ,
                                    'review_type' => Purify::clean($review_type  ),
                                    'main_complaint' => $main ,
                                    'review_forDay'=>  $request->review_forDay ,
                                ]);
                                // // ---------- Task ---------
                                //     $task = Task::create([
                                //         'slug'=> Str::uuid()->toString(),
                                //         'user_id' => auth()->user()->id  ,
                                //         'forUser_id' =>  auth()->user()->doctor_id  ,
                                //         'forDay' => $request->review_forDay  ,
                                //         'forGroup_id' => auth()->user()->doctor_id  ,
                                //         'contant' =>   'موعد للمريض '.Purify::clean($check_patient->patient_name ).' لتاريخ : '. Carbon::parse($request->review_forDay)->format('D d-m-Y')  ,
                                //     ]);
                                // // ---------- Task ---------
                                // // ---------- Notificate ---------
                                //     if (auth()->user()->id != auth()->user()->doctor_id ) {
                                //         $notificate=  Notificate::create([
                                //             'user_id' => auth()->user()->id  ,
                                //             'forUser_id' =>  auth()->user()->doctor_id  ,
                                //             'forGroup_id' =>  auth()->user()->doctor_id  ,
                                //             'notify_type' => 'reviewDate'  ,
                                //             'mainMassage' => 'تم حجز موعد للمريض '.Purify::clean($check_patient->patient_name ).' لتاريخ : '.$request->review_forDay  ,
                                //             'connect' => $check_patient->patient_slug ,
                                //             'icon' => '<i class="fa-solid fa-clock-rotate-left fa-xl text-white"></i> ' ,
                                //         ]);
                                //     }
                                // // ---------- Notificate ---------

                                return redirect()->back()->with([
                                    'MainPatientMassage'=>'نجح الحجز',
                                    'PatientMassage'=>' تم حجز موعد مراجعة للمريض '. $check_patient->patient_name.' لتاريخ : '.$request->review_forDay,
                                    'alert_type_P'=>'success',
                                ]);
                            }else{
                                $review_type= "معاينة";
                                $main="معاينة جديدة";
                                $patientReview=  PatientReview::create([
                                    'doctor_id' => auth()->user()->doctor_id  ,
                                    'patient_id' => $patient->id ,
                                    'review_type' => $review_type,
                                    'main_complaint' => $main ,
                                    'review_forDay'=>  $request->review_forDay ,
                                ]);
                                // // ---------- Task ---------
                                //     $task = Task::create([
                                //         'slug'=> Str::uuid()->toString(),
                                //         'user_id' => auth()->user()->id  ,
                                //         'forUser_id' =>  auth()->user()->doctor_id  ,
                                //         'forDay' => $request->review_forDay  ,
                                //         'forGroup_id' => auth()->user()->doctor_id  ,
                                //         'contant' =>   'موعد للمريض '.$check_patient->patient_name.' لتاريخ : '. Carbon::parse($request->review_forDay)->format('D d-m-Y')  ,
                                //     ]);
                                // // ---------- Task ---------
                                // // ---------- Notificate ---------
                                //     if (auth()->user()->id != auth()->user()->doctor_id ) {
                                //         $notificate=  Notificate::create([
                                //             'user_id' => auth()->user()->id  ,
                                //             'forUser_id' =>  auth()->user()->doctor_id  ,
                                //             'forGroup_id' =>  auth()->user()->doctor_id  ,
                                //             'notify_type' => 'reviewDate'  ,
                                //             'mainMassage' => 'تم حجز موعد للمريض '.$check_patient->patient_name .' لتاريخ : '.$request->review_forDay  ,
                                //             'connect' => $check_patient->patient_slug ,
                                //             'icon' => '<i class="fa-solid fa-clock-rotate-left fa-xl text-white"></i> ' ,
                                //         ]);
                                //     }
                                // // ---------- Notificate ---------
                                return redirect()->back()->with([
                                    'MainPatientMassage'=>'!! المريض بدون زيارات',
                                    'PatientMassage'=>' هذا المريض ليس له زيارة رئيسية في السجلات لذلك تم تحويل إختياركم إلى لمعاينة رئيسية',
                                    'alert_type_P'=>'success',
                                ]);
                            }
                        }else{
                            $review_type= "معاينة";
                            $main="معاينة جديدة";
                            $patientReview=  PatientReview::create([
                                'doctor_id' => auth()->user()->doctor_id  ,
                                'patient_id' => $check_patient->id ,
                                'review_type' => $review_type,
                                'main_complaint' => $main ,
                                'review_forDay'=>  $request->review_forDay ,
                            ]);
                            // // ---------- Task ---------
                            //     $task = Task::create([
                            //         'slug'=> Str::uuid()->toString(),
                            //         'user_id' => auth()->user()->id  ,
                            //         'forUser_id' =>  auth()->user()->doctor_id  ,
                            //         'forDay' => $request->review_forDay  ,
                            //         'forGroup_id' => auth()->user()->doctor_id  ,
                            //         'contant' =>   'موعد للمريض '.$check_patient->patient_name .' لتاريخ : '. Carbon::parse($request->review_forDay)->format('D d-m-Y')  ,
                            //     ]);
                            // // ---------- Task ---------
                            // // ---------- Notificate ---------
                            //     if (auth()->user()->id != auth()->user()->doctor_id ) {
                            //         $notificate=  Notificate::create([
                            //             'user_id' => auth()->user()->id  ,
                            //             'forUser_id' =>  auth()->user()->doctor_id  ,
                            //             'forGroup_id' =>  auth()->user()->doctor_id  ,
                            //             'notify_type' => 'reviewDate'  ,
                            //             'mainMassage' => 'تم حجز موعد للمريض '.$check_patient->patient_name .' لتاريخ : '.$request->review_forDay  ,
                            //             'connect' => $check_patient->patient_slug ,
                            //             'icon' => '<i class="fa-solid fa-clock-rotate-left fa-xl text-white"></i> ' ,
                            //         ]);
                            //     }
                            // // ---------- Notificate ---------
                            return redirect()->back()->with([
                                    'MainPatientMassage'=>'نجح الحجز',
                                    'PatientMassage'=>' تم حجز موعد معاينة للمريض '. $check_patient->patient_name.' لتاريخ : '.$request->review_forDay,
                                    'alert_type_P'=>'success',
                                ]);
                        }
                    }else{
                        $review_type= "معاينة";
                        $main="معاينة جديدة";
                        if ($request->age) {
                            $age=date('Y') - $request->age;
                        }else{
                            $age=null;
                        }
                        $patient=Patient::create([
                            'user_id' => auth()->user()->doctor_id ,
                            'patient_slug' => Str::uuid()->toString(),
                            'patient_name' =>  Purify::clean($request->patient_name ),
                            'age'=> $age ,
                            'blood_type' => Purify::clean($request->blood_type  ),
                            'gender'=> Purify::clean($request->gender  ),
                            'smoking' =>  Purify::clean($request->smoking ),
                            'relationship' =>  Purify::clean($request->relationship ),
                            'child_count' =>  $request->child_count ,
                            'phone'=> $request->phone ,

                            'older_surgery' =>  Purify::clean($request->older_surgery ),
                            'older_sicky' =>  Purify::clean($request->older_sicky ),
                            'older_sensitive' =>  Purify::clean($request->older_sensitive ),
                            'permanent_medic' =>  Purify::clean($request->permanent_medic ),
                            'patient_state'=>  Purify::clean($request->patient_state ),

                            'patient_address' =>  Purify::clean($request->patient_address ),
                            'patient_job' =>  Purify::clean($request->patient_job ),
                        ]);
                        if ($request->relationship == 'married') {
                            if ($request->child_count) {
                                $patient->child_count=  $request->child_count ;
                            }
                        }elseif ($request->relationship == 'single') {
                            $patient->child_count= null;
                        }
                        $patient->save();
                        $patientReview=  PatientReview::create([
                            'doctor_id' => auth()->user()->doctor_id  ,
                            'patient_id' => $patient->id ,
                            'review_type' => $review_type,
                            'main_complaint' => $main ,
                            'review_forDay'=>  $request->review_forDay ,
                        ]);
                        if ($request->hasFile('images') && count($request->images)>0) {
                            $i =1;
                            foreach ($request->images as $file) {
                                $filename = $patientReview->review_type.'-'.time().'-'.$patientReview->id.'-'.$i.'.'.$file->getClientOriginalExtension();
                                $file_size = $file->getSize();
                                $file_type = $file->getMimeType();
                                $path = public_path('assets/Clinic/'.auth()->user()->doctor_id.'/' . $filename);
                                Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                                    $constraint->aspectRatio();
                                })->save($path, 100);

                                $reviewMedia= PatientReviewMedia::create([
                                    'file_name'           => $filename  ,
                                    'patient_reviews_id'  =>  $patientReview->id  ,
                                    'file_type'           => $file_type  ,
                                    'file_size'           => $file_size  ,
                                ]);
                                $reviewMedia->save();
                                $i++;
                            }
                        }
                        // // ---------- Task ---------
                        //     $task = Task::create([
                        //         'slug'=> Str::uuid()->toString(),
                        //         'user_id' => auth()->user()->id  ,
                        //         'forUser_id' =>  auth()->user()->doctor_id  ,
                        //         'forDay' => $request->review_forDay  ,
                        //         'forGroup_id' => auth()->user()->doctor_id  ,
                        //         'contant' =>   'موعد للمريض '.Purify::clean($patient->patient_name ).' لتاريخ : '. Carbon::parse($request->review_forDay)->format('D d-m-Y')  ,
                        //     ]);
                        // // ---------- Task ---------
                        // // ---------- Notificate ---------
                        //     if (auth()->user()->id != auth()->user()->doctor_id ) {
                        //         $notificate=  Notificate::create([
                        //             'user_id' => auth()->user()->id  ,
                        //             'forUser_id' =>  auth()->user()->doctor_id  ,
                        //             'forGroup_id' =>  auth()->user()->doctor_id  ,
                        //             'notify_type' => 'reviewDate'  ,
                        //             'mainMassage' => 'تم حجز موعد للمريض '.Purify::clean($patient->patient_name ).' لتاريخ : '.$request->review_forDay  ,
                        //             'connect' => $patient->patient_slug ,
                        //             'icon' => '<i class="fa-solid fa-clock-rotate-left fa-xl text-white"></i> ' ,
                        //         ]);
                        //     }
                        // // ---------- Notificate ---------
                        return redirect()->back()->with([
                            'MainPatientMassage'=>'!! المريض غير موجود',
                            'PatientMassage'=>' هذا المريض زيارة جديدة و ليس له زيارة رئيسية في السجلات لذلك تم حفظ معلومات المريض وتحويل إختياركم إلى لمعاينة رئيسية',
                            'alert_type_P'=>'success',
                        ]);
                    }
                }else{
                    return redirect()->back()->with([
                        'MainPatientMassage'=>'!! عذراً ',
                        'PatientMassage'=>' غير متاح حجز موعد لمريض إلا بمعاينة أو مراجعة , تأكد من تحديدك لسبب الزيارة .',
                        'alert_type_P'=>'warning',
                    ]);
                }
            }else{
                $check_patient=Patient::where('patient_name',$request->patient_name)->where('user_id',auth()->user()->doctor_id)->first();// ->where('phone',$request->phone) لأن الإدخال ليس حصري فلن يحدث
                if ($check_patient !=null ) {
                    // if ($request->patient_name) {
                    //     $check_patient->patient_name=   Purify::clean($request->patient_name );
                    // }  // علق بسبب هو أصل تم التحقق على أساسه
                    if ($request->age) {
                        $check_patient->age= date('Y') - $request->age ;
                    }
                    if ($request->blood_type) {
                        $check_patient->blood_type=  Purify::clean($request->blood_type );
                    }
                    if ($request->gender) {
                        $check_patient->gender=  Purify::clean($request->gender );
                    }
                    if ($request->smoking) {
                        $check_patient->smoking=  Purify::clean($request->smoking );
                    }
                    if ($request->relationship) {
                        $check_patient->relationship= Purify::clean($request->relationship );
                    }
                    if ($request->relationship == 'married') {
                        if ($request->child_count) {
                            $check_patient->child_count=  $request->child_count ;
                        }
                    }elseif ($request->relationship == 'single') {
                        $check_patient->child_count= null;
                    }
                    // if ($request->phone) {
                            //     $check_patient->phone=  Purify::clean($request->phone );
                    // }// علق بسبب هو أصل تم التحقق على أساسه
                    if ($request->older_surgery) {
                        $check_patient->older_surgery=  Purify::clean($request->older_surgery );
                    }
                    if ($request->older_sicky) {
                        $check_patient->older_sicky=  Purify::clean($request->older_sicky );
                    }
                    if ($request->older_sensitive) {
                        $check_patient->older_sensitive=  Purify::clean($request->older_sensitive );
                    }
                    if ($request->permanent_medic) {
                        $check_patient->permanent_medic=  Purify::clean($request->permanent_medic );
                    }
                    if ($request->patient_state) {
                        $check_patient->patient_state=  Purify::clean($request->patient_state );
                    }
                    if ($request->patient_address) {
                        $check_patient->patient_address=  Purify::clean($request->patient_address );
                    }
                    if ($request->patient_job) {
                        $check_patient->patient_job=  Purify::clean($request->patient_job );
                    }
                    $check_patient->save();

                    if ( $review_type == 'معاينة' || $review_type == 'اسعافية') {
                        $patientReview=  PatientReview::create([
                            'doctor_id' => auth()->user()->doctor_id  ,
                            'patient_id' => $check_patient->id ,

                            'leave_off' => $request->leave_off,
                            'review_type' => $review_type,
                            'main_complaint' => $main ,
                            'med_analysis_T' => Purify::clean($request->med_analysis_T ),
                            'med_photo_T' => Purify::clean($request->med_photo_T ),
                            'pain_story' => Purify::clean($request->pain_story ),

                            'medical_report' => Purify::clean($request->medical_report ),
                            'treatment_plan' => Purify::clean($request->treatment_plan ),
                            'date_expecting'=>  $request->date_expecting ,
                            'wages' => $request->wages ,
                        ]);
                        if ($request->hasFile('images') && count($request->images)>0) {
                            $i =1;
                            foreach ($request->images as $file) {
                                $filename = $patientReview->review_type.'-'.time().'-'.$patientReview->id.'-'.$i.'.'.$file->getClientOriginalExtension();
                                $file_size = $file->getSize();
                                $file_type = $file->getMimeType();
                                $path = public_path('assets/Clinic/'.auth()->user()->doctor_id.'/' . $filename);
                                Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                                    $constraint->aspectRatio();
                                })->save($path, 100);

                                $reviewMedia= PatientReviewMedia::create([
                                    'file_name'           => $filename  ,
                                    'patient_reviews_id'  =>  $patientReview->id  ,
                                    'file_type'           => $file_type  ,
                                    'file_size'           => $file_size  ,
                                ]);
                                $reviewMedia->save();
                                $i++;
                            }
                        }
                        // // ---------- Notificate ---------
                        //     if (auth()->user()->id != auth()->user()->doctor_id ) {
                        //         $notificate=  Notificate::create([
                        //             'user_id' => auth()->user()->id  ,
                        //             'forUser_id' =>  auth()->user()->doctor_id  ,
                        //             'forGroup_id' =>  auth()->user()->doctor_id  ,
                        //             'notify_type' => 'newReview'  ,
                        //             'mainMassage' => 'تم حجز موعد للمريض '.Purify::clean($check_patient->patient_name ).' لتاريخ : '.$request->review_forDay  ,
                        //             'connect' => $check_patient->patient_slug ,
                        //             'icon' => '<i class="fas fa-file-alt fa-xl text-white"></i> ' ,
                        //         ]);
                        //     }
                        // // ---------- Notificate ---------
                        // نوع الزيارة
                            if ($patientReview->review_type == 'معاينة') {
                                $alert_type_R = 'success';
                            } elseif ($patientReview->review_type == 'اسعافية') {
                                $alert_type_R = 'danger';
                            }
                        // نوع الزيارة
                        return redirect()->back()->with([
                            'MainReviewMassage'=>$patientReview->review_type.' جديدة',
                            'ReviewMassage'=>'لديك '.$patientReview->review_type.' جديدة في العيادة .',
                            'alert_type_R'   =>$alert_type_R,
                        ]);

                    }else{
                        $patientReviewId=PatientReview::where('patient_id',$check_patient->id)->whereDone(1)->whereNull('patient_review_id')->orderBy('created_at','desc')->first();
                        if ($patientReviewId != null) {
                            $patientReview=  PatientReview::create([
                                'doctor_id' => auth()->user()->doctor_id  ,
                                'patient_id' => $check_patient->id ,
                                'patient_review_id' => $patientReviewId->id ,

                                'leave_off' => $request->leave_off,
                                'review_type' => $review_type,
                                'main_complaint' => $main ,
                                'med_analysis_T' => Purify::clean($request->med_analysis_T ),
                                'med_photo_T' => Purify::clean($request->med_photo_T ),
                                'pain_story' => Purify::clean($request->pain_story ),

                                'medical_report' => Purify::clean($request->medical_report ),
                                'treatment_plan' => Purify::clean($request->treatment_plan ),
                                'date_expecting'=>  $request->date_expecting ,
                                'wages' => $request->wages ,
                            ]);
                            if ($request->hasFile('images') && count($request->images)>0) {
                                $i =1;
                                foreach ($request->images as $file) {
                                    $filename = $patientReview->review_type.'-'.time().'-'.$patientReview->id.'-'.$i.'.'.$file->getClientOriginalExtension();
                                    $file_size = $file->getSize();
                                    $file_type = $file->getMimeType();
                                    $path = public_path('assets/Clinic/'.auth()->user()->doctor_id.'/' . $filename);
                                    Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                                        $constraint->aspectRatio();
                                    })->save($path, 100);

                                    $reviewMedia= PatientReviewMedia::create([
                                        'file_name'           => $filename  ,
                                        'patient_reviews_id'  =>  $patientReview->id  ,
                                        'file_type'           => $file_type  ,
                                        'file_size'           => $file_size  ,
                                    ]);
                                    $reviewMedia->save();
                                    $i++;
                                }
                            }
                            // نوع الزيارة
                                if ($patientReview->review_type == 'مراجعة') {
                                    $alert_type_R = 'warning';
                                } elseif ($patientReview->review_type == 'زيارة') {
                                    $alert_type_R = 'info';
                                }
                            // نوع الزيارة
                            return redirect()->back()->with([
                                'MainReviewMassage'=>$patientReview->review_type.' جديدة',
                                'ReviewMassage'=>'لديك '.$patientReview->review_type.' جديدة في العيادة .',
                                'alert_type_R'   =>$alert_type_R,
                            ]);
                        }else{
                            return redirect()->back()->with([
                                'MainPatientMassage'=>'!! المريض بدون زيارات',
                                'PatientMassage'=>' هذا المريض ليس له زيارة رئيسية في السجلات لذلك قم بإضافة المعاينة الرئيسية ثم أعد المحاولة',
                                'alert_type_P'=>'warning',
                            ]);

                        }

                    }
                }else{
                    if ( $review_type == 'معاينة' || $review_type == 'اسعافية') {
                        // مريض جديد----------------------
                        // $slug=auth()->user()->id.$request->age.time();
                        if ($request->age) {
                            $age=date('Y') - $request->age;
                        }else{
                            $age=null;
                        }
                        $patient=Patient::create([
                            'user_id' => auth()->user()->doctor_id ,
                            'patient_slug' => Str::uuid()->toString(),
                            'patient_name' =>  Purify::clean($request->patient_name ),
                            'age'=> $age  ,
                            'blood_type' => Purify::clean($request->blood_type  ),
                            'gender'=> Purify::clean($request->gender  ),
                            'smoking' =>  Purify::clean($request->smoking ),
                            'relationship' =>  Purify::clean($request->relationship ),
                            'child_count' =>  $request->child_count ,
                            'phone'=> $request->phone ,

                            'older_surgery' =>  Purify::clean($request->older_surgery ),
                            'older_sicky' =>  Purify::clean($request->older_sicky ),
                            'older_sensitive' =>  Purify::clean($request->older_sensitive ),
                            'permanent_medic' =>  Purify::clean($request->permanent_medic ),
                            'patient_state'=>  Purify::clean($request->patient_state ),

                            'patient_address' =>  Purify::clean($request->patient_address ),
                            'patient_job' =>  Purify::clean($request->patient_job ),
                        ]);
                        if ($request->relationship == 'married') {
                            if ($request->child_count) {
                                $patient->child_count=  $request->child_count ;
                            }
                        }elseif ($request->relationship == 'single') {
                            $patient->child_count= null;
                        }
                        $patient->save();
                        // مريض جديد----------------------

                        //  زيارة جديدة ----------------------
                        $patientReview=  PatientReview::create([

                            'doctor_id' => auth()->user()->doctor_id  ,
                            'patient_id' => $patient->id ,
                            'leave_off' =>$request->leave_off ,
                            // 'review_type' => Purify::clean($review_type), // سوف يتم التحديد ع حسب الإدخال المتعدد
                            // 'main_complaint' => Purify::clean($main_complaint ), // سوف يتم التحديد ع حسب الإدخال المتعدد
                            'review_type' => Purify::clean($review_type  ),
                            'main_complaint' => $main ,
                            'med_analysis_T' => Purify::clean($request->med_analysis_T ),
                            'med_photo_T' => Purify::clean($request->med_photo_T ),
                            'pain_story' => Purify::clean($request->pain_story ),

                            'medical_report' => Purify::clean($request->medical_report ),
                            'treatment_plan' => Purify::clean($request->treatment_plan ),
                            'date_expecting'=> $request->date_expecting ,
                            'wages' => $request->wages ,
                        ]);
                        if ($request->hasFile('images') && count($request->images)>0) {
                            $i =1;
                            foreach ($request->images as $file) {
                                $filename = $patientReview->review_type.'-'.time().'-'.$patientReview->id.'-'.$i.'.'.$file->getClientOriginalExtension();
                                $file_size = $file->getSize();
                                $file_type = $file->getMimeType();
                                $path = public_path('assets/Clinic/'.auth()->user()->doctor_id.'/' . $filename);
                                Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                                    $constraint->aspectRatio();
                                })->save($path, 100);

                                $reviewMedia= PatientReviewMedia::create([
                                    'file_name'           => $filename  ,
                                    'patient_reviews_id'  =>  $patientReview->id  ,
                                    'file_type'           => $file_type  ,
                                    'file_size'           => $file_size  ,
                                ]);
                                $reviewMedia->save();
                                $i++;
                            }
                        }
                        //  زيارة جديدة ----------------------
                        // نوع الزيارة
                            if ($patientReview->review_type == 'معاينة') {
                                $alert_type_R = 'success';
                            } elseif ($patientReview->review_type == 'اسعافية') {
                                $alert_type_R = 'danger';
                            }
                        // نوع الزيارة
                        return redirect()->back()->with([
                            'MainReviewMassage'=>$patientReview->review_type.' جديدة',
                            'ReviewMassage'=>'لديك '.$patientReview->review_type.' جديدة في العيادة .',
                            'alert_type_R'   =>$alert_type_R,

                            'PatientMassage'=>'تم إضافة ملف المريض '.$patient->patient_name.' إلى سجل العيادة .',
                            'MainPatientMassage'=>'مريض جديد',
                            'PatientSlug'=>$patient->patient_slug,
                            'alert_type_P'   =>'primary',
                        ]);

                    }else{
                        return redirect()->back()->with([
                            'MainPatientMassage'=>'!! عذراً ',
                            'PatientMassage'=>' هذا المريض غير موجود في السجلات لذلك قم بإعادة المحاولة وإضافة معاينة رئيسية كإدخال جديد',
                            'alert_type_P'=>'warning',
                        ]);
                    }
                }
            }
        }
    public function storePatientfully(Request $request)
        {
             $this->validate($request,[
                'patient_name' => 'required',
                'age'=> 'nullable|numeric',
                'blood_type'=> 'nullable',
                'gender'=> 'nullable',
                'smoking'=> 'nullable',
                'relationship' => 'nullable',
                'child_count'=> 'nullable|numeric',
                'phone'=> 'nullable|numeric',

                'older_surgery' => 'nullable',
                'older_sicky' => 'nullable',
                'older_sensitive' => 'nullable',
                'permanent_medic'=> 'nullable',
                'patient_state'=> 'nullable',

                'patient_address' => 'nullable',
                'patient_job' => 'nullable',

                // ----------------PatientReview with first insert------------------
                'review_type' => 'nullable',
                'main_complaint'=> 'required',
                'pain_story'=> 'nullable',
                'medical_report'=> 'nullable',
                'treatment_plan'=> 'nullable',
                'wages'=> 'nullable|numeric',
                'review_forDay'=> 'nullable',
                'date_expecting'=> 'nullable',

            ]);
            $patient=Patient::where('patient_name',$request->patient_name)->where('user_id',auth()->user()->doctor_id)->first();// ->where('phone',$request->phone) لأن الإدخال ليس حصري فلن يحدث

            if ($patient !=null ) {
                // if ($request->patient_name) {
                //     $patient->patient_name=   Purify::clean($request->patient_name );
                // }  // علق بسبب هو أصل تم التحقق على أساسه
                if ($request->age) {
                    $patient->age= date('Y') - $request->age ;
                }
                if ($request->blood_type) {
                    $patient->blood_type=  Purify::clean($request->blood_type );
                }
                if ($request->gender) {
                    $patient->gender=  Purify::clean($request->gender );
                }
                if ($request->smoking) {
                    $patient->smoking=  Purify::clean($request->smoking );
                }
                if ($request->relationship) {
                    $patient->relationship= Purify::clean($request->relationship );
                }
                if ($request->relationship == 'married') {
                    if ($request->child_count) {
                        $patient->child_count=  $request->child_count ;
                    }
                }elseif ($request->relationship == 'single') {
                    $patient->child_count= null;
                }
                if ($request->phone) {
                    $patient->phone=  $request->phone ;
                }// علق بسبب هو أصل تم التحقق على أساسه
                if ($request->older_surgery) {
                    $patient->older_surgery=  Purify::clean($request->older_surgery );
                }
                if ($request->older_sicky) {
                    $patient->older_sicky=  Purify::clean($request->older_sicky );
                }
                if ($request->older_sensitive) {
                    $patient->older_sensitive=  Purify::clean($request->older_sensitive );
                }
                if ($request->permanent_medic) {
                    $patient->permanent_medic=  Purify::clean($request->permanent_medic );
                }
                if ($request->patient_state) {
                    $patient->patient_state=  Purify::clean($request->patient_state );
                }
                if ($request->patient_address) {
                    $patient->patient_address=  Purify::clean($request->patient_address );
                }
                if ($request->patient_job) {
                    $patient->patient_job=  Purify::clean($request->patient_job );
                }
                $patient->save();
            }else{
                // مريض جديد----------------------
                    // $slug=auth()->user()->id.$request->age.time();
                    if ($request->age) {
                        $age=date('Y') - $request->age;
                    }else{
                        $age=null;
                    }
                    $patient=Patient::create([
                        'user_id' => auth()->user()->doctor_id ,
                        'patient_slug' => Str::uuid()->toString(),
                        'patient_name' =>  Purify::clean($request->patient_name ),
                        'age'=> $age  ,
                        'blood_type' => Purify::clean($request->blood_type  ),
                        'gender'=> Purify::clean($request->gender  ),
                        'smoking' =>  Purify::clean($request->smoking ),
                        'relationship' =>  Purify::clean($request->relationship ),
                        'child_count' =>  $request->child_count ,
                        'phone'=> $request->phone ,

                        'older_surgery' =>  Purify::clean($request->older_surgery ),
                        'older_sicky' =>  Purify::clean($request->older_sicky ),
                        'older_sensitive' =>  Purify::clean($request->older_sensitive ),
                        'permanent_medic' =>  Purify::clean($request->permanent_medic ),
                        'patient_state'=>  Purify::clean($request->patient_state ),

                        'patient_address' =>  Purify::clean($request->patient_address ),
                        'patient_job' =>  Purify::clean($request->patient_job ),
                        'created_at' => $request->created_at .Carbon::now()->format('h:m:s'),
                        'updated_at' => Carbon::now(),
                         ]);
                        if ($request->relationship == 'married') {
                            if ($request->child_count) {
                                $patient->child_count=  $request->child_count ;
                            }
                        }elseif ($request->relationship == 'single') {
                            $patient->child_count= null;
                        }
                    $patient->save();
                // مريض جديد----------------------
            }

            if ( $request->review_type == 'معاينة' || $request->review_type == 'اسعافية'|| $request->review_type == 'عمل جراحي') {
                $patientReview=  PatientReview::create([
                    'doctor_id' => auth()->user()->doctor_id  ,
                    'patient_id' => $patient->id ,

                    'leave_off' => 1,
                    'review_type' => $request->review_type,
                    'main_complaint' => Purify::clean($request->main_complaint ) ,
                    'medical_report' => Purify::clean($request->medical_report ),
                    'treatment_plan' => Purify::clean($request->treatment_plan ),

                    'med_analysis_T' => Purify::clean($request->med_analysis_T ),
                    'med_photo_T' => Purify::clean($request->med_photo_T ),
                    'pain_story' => Purify::clean($request->pain_story ),
                    'doctor_notes' => Purify::clean($request->doctor_notes ),

                    'date_expecting'=>  $request->date_expecting ,
                    'wages' => $request->wages ,
                    'created_at' => $request->created_at .Carbon::now()->format('h:m:s'),
                    'updated_at' =>  Carbon::now(),
                ]);
                if ($request->main_complaint == null || $request->medical_report == null) {
                    $patientReview->done=0;
                } else {
                    $patientReview->done=1;
                }
                $patientReview->save();
                $reviewKind= 1;
            }else{
                // $patientReviewId=PatientReview::where('patient_id',$patient->id)->whereNull('patient_review_id')->orderBy('created_at','desc')->first();
                $patientReviewId=PatientReview::where('patient_id',$patient->id)->whereNull('patient_review_id')->where('created_at','<',$request->created_at)->first();
                // dd( $patientReviewId);
                if ($patientReviewId != null) {
                    $patientReview=  PatientReview::create([
                        'doctor_id' => auth()->user()->doctor_id  ,
                        'patient_id' => $patient->id ,
                        'patient_review_id' => $patientReviewId->id ,

                        'leave_off' => 1,
                        'review_type' => $request->review_type,
                        'main_complaint' => Purify::clean($request->main_complaint ) ,
                        'medical_report' => Purify::clean($request->medical_report ),
                        'treatment_plan' => Purify::clean($request->treatment_plan ),

                        'med_analysis_T' => Purify::clean($request->med_analysis_T ),
                        'med_photo_T' => Purify::clean($request->med_photo_T ),
                        'pain_story' => Purify::clean($request->pain_story ),
                        'doctor_notes' => Purify::clean($request->doctor_notes ),

                        'date_expecting'=>  $request->date_expecting ,
                        'wages' => $request->wages ,
                        'created_at' => $request->created_at .Carbon::now()->format('h:m:s'),
                        'updated_at' =>  Carbon::now(),
                    ]);
                    if ($request->main_complaint == null || $request->medical_report == null) {
                        $patientReview->done=0;
                    } else {
                        $patientReview->done=1;
                    }
                    $patientReview->save();
                    $reviewKind= 1;
                }else{
                    $patientReview=  PatientReview::create([
                        'doctor_id' => auth()->user()->doctor_id  ,
                        'patient_id' => $patient->id ,

                        'leave_off' => 1,
                        'review_type' => 'معاينة',
                        'main_complaint' => Purify::clean($request->main_complaint ) ,
                        'medical_report' => Purify::clean($request->medical_report ),
                        'treatment_plan' => Purify::clean($request->treatment_plan ),

                        'med_analysis_T' => Purify::clean($request->med_analysis_T ),
                        'med_photo_T' => Purify::clean($request->med_photo_T ),
                        'pain_story' => Purify::clean($request->pain_story ),
                        'doctor_notes' => Purify::clean($request->doctor_notes ),

                        'date_expecting'=>  $request->date_expecting ,
                        'wages' => $request->wages ,
                        'created_at' => $request->created_at .Carbon::now()->format('h:m:s'),
                        'updated_at' =>  Carbon::now(),
                    ]);
                    if ($request->main_complaint == null || $request->medical_report == null) {
                        $patientReview->done=0;
                    } else {
                        $patientReview->done=1;
                    }
                    $patientReview->save();
                    $reviewKind= 'null';

                }
            }

            if ($request->hasFile('images') && count($request->images)>0) {
                $i =1;
                foreach ($request->images as $file) {
                    $filename = $patientReview->review_type.'-'.time().'-'.$patientReview->id.'-'.$i.'.'.$file->getClientOriginalExtension();
                    $file_size = $file->getSize();
                    $file_type = $file->getMimeType();
                    $path = public_path('assets/Clinic/'.auth()->user()->doctor_id.'/' . $filename);
                    Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path, 100);

                    $reviewMedia= PatientReviewMedia::create([
                        'file_name'           => $filename  ,
                        'patient_reviews_id'  => $patientReview->id  ,
                        'file_type'           => $file_type  ,
                        'file_size'           => $file_size  ,
                    ]);
                    $reviewMedia->save();
                    $i++;
                }
            }

            if ($reviewKind == 'null') {
                return redirect()->back()->with([
                    'MainReviewMassage'=>$patientReview->review_type,
                    'ReviewMassage'=>' تم تحويل هذه الزيارة إلى معاينة لعدم وجود أي زيارة سابقة لهذا المريض .',
                    'alert_type_R'   =>'warning',
                ]);
            } else {
                if ($request->main_complaint == null || $request->medical_report == null) {
                    return redirect()->back()->with([
                        'MainReviewMassage'=>$patientReview->review_type,
                        'ReviewMassage'=>'تم أرشفة '.$patientReview->review_type.' ولكنها غير مكتملة , ستجدها في صفحة سجل العيادة قسم بدون تشخيص لإتمام الأرشفة بشكل ناجح .',
                        'alert_type_R'   =>'info',
                    ]);
                } else {
                    return redirect()->back()->with([
                        'MainReviewMassage'=>$patientReview->review_type,
                        'ReviewMassage'=>'تم أرشفة '.$patientReview->review_type.' بنجاح.',
                        'alert_type_R'   =>'success',
                    ]);
                }
            }


        }
    public function updatePatient(Request $request, $patient_slug)
        {
            $patient = Patient::where('patient_slug',$patient_slug)->first();
            if ($request->patient_name) {
                $patient->patient_name=   Purify::clean($request->patient_name );
            }
            if ($request->age) {
                $patient->age= date('Y') - $request->age;
            }
            if ($request->blood_type) {
                $patient->blood_type=  Purify::clean($request->blood_type );
            }
            if ($request->gender) {
                $patient->gender=  Purify::clean($request->gender );
            }
            if ($request->smoking) {
                $patient->smoking=  Purify::clean($request->smoking );
            }
            if ($request->relationship) {
                $patient->relationship= Purify::clean($request->relationship );
            }
            if ($request->relationship == 'married') {
                if ($request->child_count) {
                    $patient->child_count=  $request->child_count ;
                }
            }elseif ($request->relationship == 'single') {
                $patient->child_count= null;
            }
            if ($request->phone) {
                $patient->phone=  $request->phone ;
            }
            if ($request->older_surgery) {
                $patient->older_surgery=  Purify::clean($request->older_surgery );
            }
            if ($request->older_sicky) {
                $patient->older_sicky=  Purify::clean($request->older_sicky );
            }
            if ($request->older_sensitive) {
                $patient->older_sensitive=  Purify::clean($request->older_sensitive );
            }
            if ($request->permanent_medic) {
                $patient->permanent_medic=  Purify::clean($request->permanent_medic );
            }
            if ($request->patient_state) {
                $patient->patient_state=  Purify::clean($request->patient_state );
            }
            if ($request->patient_address) {
                $patient->patient_address=  Purify::clean($request->patient_address );
            }
            if ($request->patient_job) {
                $patient->patient_job=  Purify::clean($request->patient_job );
            }
            $patient->save();
            return redirect()->route('Clinic.patientProfile', $patient->patient_slug)->with([
                'MainPatientMassage'=>'تعديل ملف المريض ',
                'PatientMassage'=>'تم تحديث معلومات المريض '. $patient->patient_name .' بنجاح .',
                'alert_type_P'   =>'success'
            ]);

        }
    public function softDeletes($patient_slug)
        {
            $patient = Patient::where('patient_slug',$patient_slug)->first();
            $patientReviews = PatientReview::where('patient_id',$patient->id)->get();
            $patient_name = $patient->patient_name;
            $patient->delete();
            foreach ($patientReviews as $patientReview) {
                $patientReview->delete($patientReview->id);
            }


            return  redirect()->back()->with([
                'MainPatientMassage'=>'نقل ملف',
                'PatientMassage'=>'تم إرسال ملف المريض '.$patient_name.' مع سجل زيارته إلى سلة المحذوفات .',
                'alert_type_P'   =>'warning'
            ]);
        }
    public function restore( $patient_slug)
        {
            $patient = Patient::onlyTrashed()->where('patient_slug',$patient_slug)->first();
            $patient_name =$patient->patient_name;
            $patientReviews = PatientReview::onlyTrashed()->where('patient_id',$patient->id)->get();
            foreach ($patientReviews as $patientReview) {
                $patientReview->restore();
            }
            $patient->restore();
            return redirect()->back()->with([
                'MainPatientMassage'=>'إستعادة ملف',
                'PatientMassage'=>'تم إستعادة ملف المريض '.$patient_name.' من سلة المحذوفات .',
                'PatientSlug'=>$patient->patient_slug,
                'alert_type_P'   =>'success',
            ]);
        }
    public function destroy( $patient_slug)
        {
            // حصر الحذف  بالطبيب
            if (auth()->user()->d_o_e == 1 )
                {
                    $patient = Patient::onlyTrashed()->where('patient_slug',$patient_slug)->where('user_id', auth()->user()->doctor_id)->first();
                    $patientReviews = PatientReview::where('patient_id',$patient->id)->get();
                    $patient_name =$patient->patient_name;
                    $patient->forceDelete();
                    foreach ($patientReviews as $patientReview) {
                        $patientReview->forceDelete();
                    }

                    // ---------- Notificate ---------
                    if (auth()->user()->id != auth()->user()->doctor_id ) {
                        $notificate=  Notificate::create([
                            'user_id' => auth()->user()->id  ,
                            'forUser_id' =>  auth()->user()->doctor_id  ,
                            'forGroup_id' =>  auth()->user()->doctor_id  ,
                            'notify_type' => 'delete'  ,
                            'mainMassage' => 'تم حذف ملف المريض " '.$patient->patient_name.' " بشكل نهائي بواسطة '.auth()->user()->name  ,
                            // 'connect' => $patient->patient_slug ,
                            'icon' => '<i class="fas fa-exclamation-triangle fa-xl text-white"></i>' ,
                        ]);
                    }
                    // ---------- Notificate ---------

                    return redirect()->back()->with([
                    'MainPatientMassage'=>'حذف نهائي',
                    'PatientMassage'=>'تم حذف الملف المريض '.$patient_name.' بشكل نهائي  .',
                    'alert_type_p'   =>'danger',
                     ]);
                }
            // else ........................لن يظهر للمستخدم رابط الحذف مالم يتحقق الشرط
            //     {
            //         return redirect()->back()->with([
            //         'MainPatientMassage'=>'!! عذراً يا عزيزي',
            //         'PatientMassage'=>'لا يمكنك حذف الملف , أنك لا تمتلك الصلاحية لفعل ذلك , راجع الطبيب بهذا الخصوص .',
            //         'alert_type_P'   =>'info',
            //         ]);
            //     }
        }

//-------------Patient--------------------

//-------------PatientReview--------------------
    // ------------ PatientReview controller-------------
        // public function StoreReview(Request $request , $id)// تحفظ بحساب أيدي المريض
        //     {
        //         $this->validate($request,[
        //             'patient_review_id' => 'nullable',
        //             'review_type' => 'nullable',
        //             'leave_off' => 'nullable',
        //             'main_complaint'=> 'required',
        //             'pain_story'=> 'nullable',
        //             'medical_report'=> 'nullable',
        //             'treatment_plan'=> 'nullable',
        //             'wages'=> 'nullable',
        //             'review_forDay'=> 'nullable',
        //             'date_expecting'=> 'nullable',

        //         ]);

        //         // if ($request->patient_review_id) {
        //         //     $patientReview->patient_review_id=  $request->patient_review_id ;
        //         // }


        //         // إدخال السريع

        //                 $main_complaintS=$request->main_complaint;
        //                 $main = '';
        //                 $review_type = '';
        //                 foreach ($main_complaintS as $key => $request1) {
        //                     $main.='- '.Purify::clean($request1);
        //                         if      ($request1 == "معاينة جديدة") {
        //                             $review_type= "معاينة";
        //                         }elseif ($request1 == "مراجعة") {
        //                             $review_type= "مراجعة";
        //                         }elseif ($request1 == "اسعافية") {
        //                             $review_type= "اسعافية";
        //                         }elseif ($request1 == "تحديد عملية") {
        //                             $review_type= "زيارة";
        //                         }elseif ($request1 == "مراجعة عملية") {
        //                             $review_type= "زيارة";
        //                         }
        //                     }
        //         // إدخال السريع

        //         $patientReview=  PatientReview::create([

        //             'doctor_id' => auth()->user()->doctor_id  ,
        //             'patient_id' => $id ,
        //             'patient_review_id' => $request->patient_review_id ,

        //             'leave_off' =>Purify::clean( $request->leave_off  ),
        //             // 'review_type' => Purify::clean($review_type), // سوف يتم التحديد ع حسب الإدخال المتعدد
        //             // 'main_complaint' => Purify::clean($main_complaint ), // سوف يتم التحديد ع حسب الإدخال المتعدد
        //             'review_type' => Purify::clean($review_type  ),
        //             'main_complaint' => $main ,
        //             'med_analysis_T' => Purify::clean($request->med_analysis_T ),
        //             'med_photo_T' => Purify::clean($request->med_photo_T ),
        //             'pain_story' => Purify::clean($request->pain_story ),

        //             'medical_report' => Purify::clean($request->medical_report ),
        //             'treatment_plan' => Purify::clean($request->treatment_plan ),
        //             'review_forDay'=> $request->review_forDay ,
        //             'date_expecting'=> $request->date_expecting ,
        //             'wages' => $request->wages ,
        //         ]);

        //         if ($request->review_forDay) {
        //             $task = Task::create([
        //                 'slug'=> Str::uuid()->toString(),
        //                 'user_id' => auth()->user()->id  ,
        //                 'forUser_id' =>  auth()->user()->doctor_id  ,
        //                 'forDay' => $request->review_forDay  ,
        //                 'forGroup_id' => auth()->user()->doctor_id  ,
        //                 'contant' =>   'موعد للمريض '.$patientReview->patient->patient_name .' لتاريخ : '. Carbon::parse($request->review_forDay)->format('D d-m-Y')  ,
        //             ]);
        //             // ---------- Notificate ---------
        //                 if (auth()->user()->id != auth()->user()->doctor_id ) {
        //                     $notificate=  Notificate::create([
        //                         'user_id' => auth()->user()->id  ,
        //                         'forUser_id' =>  auth()->user()->doctor_id  ,
        //                         'forGroup_id' =>  auth()->user()->doctor_id  ,
        //                         'notify_type' => 'newReview'  ,
        //                         'mainMassage' => 'تم حجز موعد للمريض '.$patientReview->patient->patient_name .' لتاريخ : '. Carbon::parse($request->review_forDay)->format('D d-m-Y')  ,
        //                         'connect' => $patientReview->patient->patient_slug ,
        //                         'icon' => '<i class="fas fa-file-alt fa-xl text-white"></i> ' ,
        //                     ]);
        //                 }
        //             // ---------- Notificate ---------
        //         }else{
        //             // ---------- Notificate ---------
        //                 if (auth()->user()->id != auth()->user()->doctor_id ) {
        //                     $notificate=  Notificate::create([
        //                         'user_id' => auth()->user()->id  ,
        //                         'forUser_id' =>  auth()->user()->doctor_id  ,
        //                         'forGroup_id' =>  auth()->user()->doctor_id  ,
        //                         'notify_type' => 'newReview'  ,
        //                         'mainMassage' => 'لديك '.$patientReview->review_type.' للمريض '.$patientReview->patient->patient_name  ,
        //                         'connect' => $patientReview->patient->patient_slug ,
        //                         'icon' => '<i class="fas fa-file-alt fa-xl text-white"></i> ' ,
        //                     ]);
        //                 }
        //             // ---------- Notificate ---------
        //         }
        //                 // ---------- Notificate ---------
        //         if (auth()->user()->id != auth()->user()->doctor_id ) {
        //             $notificate=  Notificate::create([
        //                 'user_id' => auth()->user()->id  ,
        //                 'forUser_id' =>  auth()->user()->doctor_id  ,
        //                 'forGroup_id' =>  auth()->user()->doctor_id  ,
        //                 'notify_type' => 'newReview'  ,
        //                 'mainMassage' => 'لديك '.$patientReview->review_type.' للمريض '.$patientReview->patient->patient_name  ,
        //                 'connect' => $patientReview->patient->patient_slug ,
        //                 'icon' => '<i class="fas fa-file-alt fa-xl text-white"></i> ' ,
        //             ]);
        //         }
        //                 // ---------- Notificate ---------

        //         if ($request->hasFile('images') && count($request->images)>0) {
        //             $i =1;
        //             foreach ($request->images as $file) {
        //                 $filename = $patientReview->review_type.'-'.time().'-'.$patientReview->id.'-'.$i.'.'.$file->getClientOriginalExtension();
        //                 $file_size = $file->getSize();
        //                 $file_type = $file->getMimeType();
        //                 $path = public_path('assets/Clinic/'.auth()->user()->doctor_id.'/' . $filename);
        //                 Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
        //                     $constraint->aspectRatio();
        //                 })->save($path, 100);

        //                 $reviewMedia= PatientReviewMedia::create([
        //                     'file_name'           => $filename  ,
        //                     'patient_reviews_id'  =>  $patientReview->id  ,
        //                     'file_type'           => $file_type  ,
        //                     'file_size'           => $file_size  ,
        //                 ]);
        //                 $reviewMedia->save();
        //                 $i++;


        //             }
        //         }
        //          // نوع الزيارة
        //          if ($patientReview->review_type == 'معاينة') {
        //             $alert_type_R = 'success';
        //         } elseif ($patientReview->review_type == 'مراجعة') {
        //             $alert_type_R = 'warning';
        //         } elseif ($patientReview->review_type == 'اسعافية') {
        //             $alert_type_R = 'danger';
        //         }else {
        //             $alert_type_R = 'info';
        //         }
        //         // نوع الزيارة
        //        return redirect()->route('Clinic.newPatient')
        //         ->with([
        //             'MainReviewMassage'=>$patientReview->review_type.' جديدة',
        //             'ReviewMassage'=>'لديك '.$patientReview->review_type.' جديدة في العيادة .',
        //             'alert_type_R'   =>$alert_type_R,
        //         ]);
        //     }
    // ------------ PatientReview controller-------------
    public function UpdateReview_doctor(Request $request, $id)// تحفظ بحساب أيدي الزيارة
        {
            // dd($request->all());
            $patientReview=PatientReview::find( $id );
             if ($request->medical_report !=null  ) {
                $patientReview->medical_report=   Purify::clean($request->medical_report );

            }
            if ($request->treatment_plan  !=null ) {
                $patientReview->treatment_plan=   Purify::clean($request->treatment_plan );
            }
            if ($request->med_analysis_T !=null ) {
                $patientReview->med_analysis_T=  Purify::clean($request->med_analysis_T );
            }
            if ($request->med_photo_T !=null ) {
                $patientReview->med_photo_T=  Purify::clean($request->med_photo_T );
            }
            if ($request->pain_story !=null ) {
                $patientReview->pain_story=  Purify::clean($request->pain_story );
            }
            if ($request->doctor_notes !=null ) {
                $patientReview->doctor_notes=  Purify::clean($request->doctor_notes );
            }
            if ($request->date_expecting) {
                $patientReview->date_expecting=  $request->date_expecting ;
            }
            if ($patientReview->treatment_plan && $patientReview->medical_report ) {
                $patientReview->done = 1;
            }
            $patientReview->save();

            if ($request->hasFile('images') && count($request->images)>0) {
                $i =1;
                foreach ($request->images as $file) {
                    $filename = $patientReview->review_type.'-'.time().'-'.$i.'.'.$file->getClientOriginalExtension();
                    $file_size = $file->getSize();
                    $file_type = $file->getMimeType();
                    $path = public_path('assets/Clinic/'.auth()->user()->doctor_id.'/' . $filename);
                    Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path, 100);

                    $reviewMedia= PatientReviewMedia::create([
                        'file_name'           => $filename  ,
                        'patient_reviews_id'  =>  $patientReview->id  ,
                        'file_type'           => $file_type  ,
                        'file_size'           => $file_size  ,
                    ]);
                    $reviewMedia->save();
                    $i++;
                }
            }
            if ($patientReview->main_complaint ==' - تحديد عملية - تحليل' || $patientReview->main_complaint =='تحديد عملية' || $patientReview->main_complaint ==' - تحديد عملية - صورة - تحليل' || $patientReview->main_complaint ==' - تحديد عملية - صورة') {
                if ($request->date_expecting) {
                $patientReview->date_expecting=  $request->date_expecting ;
                    $task = Task::create([
                    'slug'=> Str::uuid()->toString(),
                    'user_id' => auth()->user()->id  ,
                    'forUser_id' =>  auth()->user()->doctor_id  ,
                    'forDay' => $request->date_expecting  ,
                    'forGroup_id' => auth()->user()->doctor_id  ,
                    'contant' =>   'موعد عملية للمريض '.$patientReview->patient->patient_name .' لتاريخ : '. Carbon::parse($request->date_expecting)->format('D d-m-Y')  ,
                    ]);
                }
            }
            if ($patientReview->done == 1) {
                return redirect()->back()->with([
                    'MainReviewMassage'=>'تشخيص ال'.$patientReview->review_type,
                    'ReviewMassage'=>'تم تحديث معلومات ال'. $patientReview->review_type .' وإضافة التشخيص بنجاح .',
                    'alert_type_R'   =>'success',
                ]);
            } else {
                return redirect()->back()->with([
                    'MainReviewMassage'=>' تم التحديث ',
                    'ReviewMassage'=>'تم تحديث معلومات ال'. $patientReview->review_type .' بنجاح .',
                    'alert_type_R'   =>'success',
                ]);
            }



        }
    public function UpdateReview_insert(Request $request, $id)// تحفظ بحساب أيدي الزيارة
        {
            $patientReview=PatientReview::find( $id );
            // تحديث معلومات المريض في الزيارة
                if ($request->patient_name) {
                    $patientReview->patient->patient_name=  $request->patient_name ;
                }
                if ($request->age) {
                    $patientReview->patient->age= date('Y') -  $request->age ;
                }
                if ($request->blood_type) {
                    $patientReview->patient->blood_type=  $request->blood_type ;
                }
                if ($request->gender) {
                    $patientReview->patient->gender=  $request->gender ;
                }
                if ($request->smoking) {
                    $patientReview->patient->smoking=  $request->smoking ;
                }
                if ($request->relationship) {
                    $patientReview->patient->relationship=  $request->relationship ;
                }
                if ($request->relationship == 'married') {
                    if ($request->child_count) {
                        $patientReview->patient->child_count=  $request->child_count ;
                    }
                }elseif ($request->relationship == 'single') {
                    $patientReview->patient->child_count= null;
                }
                if ($request->phone) {
                    $patientReview->patient->phone=  $request->phone ;
                }

                if ($request->older_surgery) {
                    $patientReview->patient->older_surgery=  $request->older_surgery ;
                }
                if ($request->older_sicky) {
                    $patientReview->patient->older_sicky=  $request->older_sicky ;
                }
                if ($request->older_sensitive) {
                    $patientReview->patient->older_sensitive=  $request->older_sensitive ;
                }
                if ($request->permanent_medic) {
                    $patientReview->patient->permanent_medic=  $request->permanent_medic ;
                }
                if ($request->patient_state) {
                    $patientReview->patient->patient_state=  $request->patient_state ;
                }

                if ($request->patient_address) {
                    $patientReview->patient->patient_address=  $request->patient_address ;
                }
                if ($request->patient_job) {
                    $patientReview->patient->patient_job=  $request->patient_job ;
                }
                $patientReview->patient->save();
            // تحديث معلومات المريض في الزيارة
                // dd($request->all());
            $this->validate($request,[
                // 'patient_review_id' => 'nullable',
                // 'review_type' => 'nullable',
                // 'main_complaint'=> 'required',
                // 'pain_story'=> 'nullable',
                // 'medical_report'=> 'nullable',
                // 'treatment_plan'=> 'nullable',
                // 'wages'=> 'nullable',
                // 'date_expecting'=> 'nullable',
            ]);
            if ($request->patient_review_id) {
                $patientReview->patient_review_id=  $request->patient_review_id ;
            }
                // إدخال السريع
            if ($request->main_complaint) {
                $main_complaintS=$request->main_complaint;
                $main = '';
                $review_type = '';
                foreach ($main_complaintS as $key => $request1) {
                    $main.='- '.Purify::clean($request1);
                        if      ($request1 == "معاينة جديدة") {
                            $review_type= "معاينة";
                        }elseif ($request1 == "مراجعة") {
                            $review_type= "مراجعة";
                        }elseif ($request1 == "اسعافية") {
                            $review_type= "اسعافية";
                        }elseif ($request1 == "تحديد عملية") {
                            $review_type= "زيارة";
                        }elseif ($request1 == "مراجعة عملية") {
                            $review_type= "زيارة";
                        }
                    }
                // إدخال السريع
                if ($request->main_complaint == 'معاينة جديدة') {
                    $review_type= 'معاينة';
                }elseif ($request->main_complaint == 'مراجعة') {
                    $review_type= 'مراجعة';
                }elseif ($request->main_complaint == 'اسعافية') {
                    $review_type= 'اسعافية';
                }elseif ($request->main_complaint == 'تحديد عملية') {
                    $review_type= 'زيارة';
                }elseif ($request->main_complaint == 'مراجعة عملية') {
                    $review_type= 'زيارة';
                }elseif ($request->main_complaint == 'تحليل') {
                    $review_type= 'زيارة';
                }elseif ($request->main_complaint == 'صورة') {
                    $review_type= 'زيارة';
                }else{
                    $review_type=$request->review_type;
                }
            }
            // $review_type='';
            // $patientReview->review_type=  $review_type ;

            if ($request->medical_report && (auth()->user()->id == auth()->user()->doctor_id)) {
                $patientReview->medical_report=   Purify::clean($request->medical_report );
                $patientReview->done = 1;
            }elseif ($request->medical_report){
                $patientReview->medical_report=   Purify::clean($request->medical_report );
            }
            if ($request->treatment_plan  && (auth()->user()->id == auth()->user()->doctor_id)) {
                $patientReview->treatment_plan=   Purify::clean($request->treatment_plan );
                $patientReview->done = 1;
            }elseif ($request->treatment_plan){
                $patientReview->treatment_plan=   Purify::clean($request->treatment_plan );
            }

            if ($request->leave_off) {
                $patientReview->leave_off=  $request->leave_off ;
            }
            if ($request->main_complaint) {
                $patientReview->main_complaint=  $main ;
            }
            if ($request->med_analysis_T) {
                $patientReview->med_analysis_T=  Purify::clean($request->med_analysis_T );
            }
            if ($request->med_photo_T) {
                $patientReview->med_photo_T=  Purify::clean($request->med_photo_T );
            }
            if ($request->pain_story) {
                $patientReview->pain_story=  Purify::clean($request->pain_story );
            }
            if ($request->doctor_notes) {
                $patientReview->doctor_notes=  Purify::clean($request->doctor_notes );
            }
            if ($request->review_forDay) {
                $patientReview->review_forDay=  $request->review_forDay ;
            }
            if ($request->date_expecting) {
                $patientReview->date_expecting=  $request->date_expecting ;
            }
            $patientReview->save();

            if ($request->hasFile('images') && count($request->images)>0) {
                $i =1;
                foreach ($request->images as $file) {
                    $filename = $patientReview->review_type.'-'.time().'-'.$i.'.'.$file->getClientOriginalExtension();
                    $file_size = $file->getSize();
                    $file_type = $file->getMimeType();
                    $path = public_path('assets/Clinic/'.auth()->user()->doctor_id.'/' . $filename);
                    Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path, 100);

                    $reviewMedia= PatientReviewMedia::create([
                        'file_name'           => $filename  ,
                        'patient_reviews_id'  =>  $patientReview->id  ,
                        'file_type'           => $file_type  ,
                        'file_size'           => $file_size  ,
                    ]);
                    $reviewMedia->save();
                    $i++;
                }
            }
             // نوع الزيارة
            if ($patientReview->review_type == 'معاينة') {
                $alert_type_R = 'success';
            } elseif ($patientReview->review_type == 'مراجعة') {
                $alert_type_R = 'warning';
            } elseif ($patientReview->review_type == 'اسعافية') {
                $alert_type_R = 'danger';
            }else {
                $alert_type_R = 'info';
            }
            // نوع الزيارة
            return redirect()->back()->with([
                'MainReviewMassage'=>'تعديل ال'.$patientReview->review_type,
                'ReviewMassage'=>'تم تحديث معلومات ال'. $patientReview->review_type .' بنجاح .',
                'alert_type_R'   =>$alert_type_R,
            ]);
        }
    public function TasksReview(Request $request, $id)// لتحديد موجود ومفحوص
        {
            $patientReview=PatientReview::find( $id );
            $this->validate($request,[
                'done' => 'nullable',
                'leave_off' => 'nullable',
            ]);
            if ($request->leave_off != null) {
                $patientReview->leave_off = $request->leave_off ;
                if ($patientReview->leave_off == 0) {
                    $patientReview->save();
                    return redirect()->back()->with([
                        'MainAlertMessage'=>'حجز هاتفي',
                        'AlertMessage'=>'المريض '.$patientReview->patient->patient_name.' صاحب ال'. $patientReview->review_type .' في الدور .',
                        'alert_type_A'   =>'secondary',
                    ]);
                } else {
                    $patientReview->save();
                    return redirect()->back()->with([
                        'MainAlertMessage'=>'المريض موجود',
                        'AlertMessage'=>'المريض '.$patientReview->patient->patient_name.' صاحب ال'. $patientReview->review_type .' في العيادة  .',
                        'alert_type_A'   =>'success',
                    ]);
                }


            }
            if ($request->done != null) {
               $patientReview->done=  $request->done ;
               $patientReview->save();
               return redirect()->back()->with([
                'MainAlertMessage'=>'إكتمل العملية',
                'AlertMessage'=>'تم إكمال معلومات ال'. $patientReview->review_type .' في ملف المريض '.$patientReview->patient->patient_name.' بنجاح .',
                'alert_type_A'   =>'info'
            ]);
            }


        }
    public function SpecialWithStar_do(Request $request, $id)// تحفظ بحساب أيدي الزيارة
        {
            $patientReview=PatientReview::find( $id );
            $this->validate($request,[
                'special_with_star' => 'required',
            ]);
               $patientReview->special_with_star=  $request->special_with_star ;
               $patientReview->save();
               if ($patientReview->special_with_star == 1) {
                return redirect()->back()->with([
                    'MainAlertMessage'=>'إكتمل العملية',
                    'AlertMessage'=>'تم تمييز ال'. $patientReview->review_type .' بنجمة بنجاح .',
                    'alert_type_A'   =>'warning'
                ]);
               } else {
                return redirect()->back()->with([
                    'MainAlertMessage'=>'إكتمل العملية',
                    'AlertMessage'=>'تم إلغاء تمييز ال'. $patientReview->review_type .' بنجمة .',
                    'alert_type_A'   =>'danger'
                ]);
               }
        }
    public function SoftDeleteReview($id)
        {
            $patientReview = PatientReview::find($id);
            $patientInsideReviews = PatientReview::where('patient_review_id',$id)->get();
            if ( $patientInsideReviews) {
                foreach ($patientInsideReviews as $patientInsideReview) {
                    $patientInsideReview->delete();
                }
            }
            $review_type = $patientReview->review_type;
            $patientReview->delete($id);
            return redirect()->back()->with([
                'MainReviewMassage'=>'نقل الزيارة',
                'ReviewMassage'=>'تم نقل معلومات ال'. $review_type .' إلى سلة المحذوفات .',
                'alert_type_R'   =>'warning'
            ]);
        }
    public function RestoreReview($id)
        {
            $patientReview = PatientReview::withTrashed()->find($id);
            // dd($patientReview);
            $review_type = $patientReview->review_type;
            $patientReview->restore();
            if ($patientReview->patient->deleted_at != null) {
                $patient = Patient::onlyTrashed()->where('id',$patientReview->patient_id)->first();
                $patient->restore();
            }
            return redirect()->back()->with([
                'MainReviewMassage'=>'إستعادة الزيارة',
                'ReviewMassage'=>'تم إستعادة معلومات ال'. $review_type .' من سلة المحذوفات .',
                'alert_type_R'   =>'success'
            ]);
        }

    public function DestroyReview($id)
        {
            if (auth()->user()->d_o_e == 1)
            {
                $patientReview = PatientReview::withTrashed()->find($id);
                // dd($patientReview);
                $review_type = $patientReview->review_type;
                $patientReviews=PatientReview::withTrashed()->where('patient_id',$patientReview->patient->id)->count();
                if ($patientReviews <= 1) { // حذف معلومات المريض في حال لم يبقى أي زيارة للمريض
                    $patientReview->patient->forceDelete();
                }
                    // ---------- Notificate ---------
                if (auth()->user()->id != auth()->user()->doctor_id ) {
                    $notificate=  Notificate::create([
                        'user_id' => auth()->user()->id  ,
                        'forUser_id' =>  auth()->user()->doctor_id  ,
                        'forGroup_id' =>  auth()->user()->doctor_id  ,
                        'notify_type' => 'delete'  ,
                        'mainMassage' => 'تم حذف  الزيارة الخاصة بالمريض" '.$patientReview->patient->patient_name.' " بشكل نهائي بواسطة '.auth()->user()->name  ,
                        'icon' => '<i class="fas fa-file-alt fa-xl text-white"></i> ' ,
                    ]);
                }
                    // ---------- Notificate ---------

                $medias = PatientReviewMedia::where('patient_reviews_id',$id)->get();
                if ($medias) {
                    foreach ($medias as $media) {
                        if (File::exists('assets/Clinic/'.auth()->user()->doctor_id.'/' . $media->file_name)) {
                            unlink('assets/Clinic/' .auth()->user()->doctor_id.'/' . $media->file_name);
                        }
                         $media->delete($media->id);
                    }
                }
                $patientReview->forceDelete();
                return redirect()->back()->with([
                    'MainReviewMassage'=>'حذف نهائي',
                    'ReviewMassage'=>'تم حذف معلومات ال'. $review_type .' بشكل نهائي .',
                    'alert_type_R'   =>'danger'
                ]);
            }
            else
            {
                return redirect()->back()->with([
                    'ReviewMassage'=>'لا يمكنك حذف الزيارة , أنت لا تمتلك الصلاحية لفعل ذلك , راجع الطبيب بهذا الخصوص .',
                    'alert_type'   =>'danger',
                    ]);
            }

        }
    public function DestroyReviewEmployee($id)
        {

                $patientReview = PatientReview::withTrashed()->find($id);
                // dd($patientReview);
                $review_type = $patientReview->review_type;
                $patientReviews=PatientReview::withTrashed()->where('patient_id',$patientReview->patient->id)->count();
                if ($patientReviews <= 1) { // حذف معلومات المريض في حال لم يبقى أي زيارة للمريض
                    $patientReview->patient->forceDelete();
                }
                 

                $medias = PatientReviewMedia::where('patient_reviews_id',$id)->get();
                if ($medias) {
                    foreach ($medias as $media) {
                        if (File::exists('assets/Clinic/'.auth()->user()->doctor_id.'/' . $media->file_name)) {
                            unlink('assets/Clinic/' .auth()->user()->doctor_id.'/' . $media->file_name);
                        }
                         $media->delete($media->id);
                    }
                }
                $patientReview->forceDelete();
                return redirect()->back()->with([
                    'MainReviewMassage'=>'حذف نهائي',
                    'ReviewMassage'=>'تم حذف معلومات ال'. $review_type .' بشكل نهائي .',
                    'alert_type_R'   =>'danger'
                ]);

        }
    public function destroyReviewPhoneTurns()
        {

            $phoneTurns = PatientReview::where('doctor_id',auth()->user()->doctor_id)
            ->whereLeave_off(0)->whereNull('review_forDay')
            ->orWhere(function ($query1)
            {$query1->whereDate('review_forDay','<', Carbon::today()->format('Y-m-d'));}
            )
            ->get();
            // dd($phoneTurns);
            foreach ($phoneTurns as $phoneTurn) {
                $phoneTurn->forceDelete();
                if (count($phoneTurn->patient->patientReviews)== 0 ) {
                    $phoneTurn->patient->forceDelete();
                }
            }

            return redirect()->back()->with([
                'MainReviewMassage'=>'حذف نهائي',
                'ReviewMassage'=>'تم حذف جميع الحجوزات الهاتفية بشكل نهائي .',
                'alert_type_R'   =>'danger'
            ]);

        }
//-------------PatientReview--------------------

//-------------ReviewMedia--------------------
    public function DestroyReviewMedia($id)
        {
            $media = PatientReviewMedia::whereId($id)->first();
            if ($media) {
                if (File::exists('assets/Clinic/'.auth()->user()->doctor_id.'/' . $media->file_name)) {
                    unlink('assets/Clinic/' .auth()->user()->doctor_id.'/' . $media->file_name);
                }
                 $media->delete();
                return redirect()->back()->with([
                    'MainReviewMassage'=>'حذف نهائي',
                    'ReviewMassage'=>'تم حذف الصورة بشكل نهائي .',
                    'alert_type_R'   =>'danger'
                ]);
            }
            return redirect()->back();

        }
//-------------ReviewMedia--------------------


}

