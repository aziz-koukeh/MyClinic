<?php

namespace App\Http\Controllers\MyClinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeviceCheck;

//  ----------xxxxxxxxxxxxx-------------
    // use App\Models\User;
    // use Auth;
//  ----------xxxxxxxxxxxxx-------------

class DeviceCheckController extends Controller
{
    public function index()
    {
        //
    }

    public function deleteDevice(Request $request , $id)
    {
        $deviceCheck=DeviceCheck::find($id);
        if ($deviceCheck->root == '1') {
            $deviceChecks=DeviceCheck::where('doctor_id',auth()->user()->doctor_id)->get();
            if (count($deviceChecks)>=2) {
                $deviceCheck->forceDelete() ;
                return redirect()->back()->with([
                    'MainAlertMessage'=>'نجحت العملية',
                    'AlertMessage' => 'تم حذف الإرتباط بنجاح .',
                    'alert_type_A' => 'success',
                ]);
            } else {
                return redirect()->back()->with([
                    'MainAlertMessage'=>'فشلت العملية',
                    'AlertMessage' => 'لا يمكنك حذف التصريح , هذا التصريح الأخير',
                    'alert_type_A' => 'warning',
                ]);
            }
        }


    }
    public function allowed_blocked_device(Request $request , $id)
    {
        $deviceCheck=DeviceCheck::find($id);
        if ($deviceCheck->root == '1') {
            $deviceChecks=DeviceCheck::where('doctor_id',auth()->user()->doctor_id)->get();
            if (count($deviceChecks)>=2) {
                $deviceCheck->state = $request->state ;
                $deviceCheck->save() ;
                if ($request->state == '1') {
                $text= 'تم التصريح للإرتباط .' . $deviceCheck->userName. ' - '. $deviceCheck->deviceType. ' - '.$deviceCheck->platformName.' - '. $deviceCheck->browserName;
                $color= 'success';
                } elseif ($request->state == '0') {
                $text= 'تم حظر الإرتباط .'. $deviceCheck->userName. ' - '. $deviceCheck->deviceType. ' - '.$deviceCheck->platformName.' - '. $deviceCheck->browserName;
                $color= 'danger';
                } elseif ($request->state === null) {
                $text= 'تم تعليق الإرتباط .'. $deviceCheck->userName. ' - '. $deviceCheck->deviceType. ' - '.$deviceCheck->platformName.' - '. $deviceCheck->browserName;
                $color= 'warning';
                }
                return redirect()->back()->with([
                    'MainAlertMessage'=>'نجحت العملية',
                    'AlertMessage' => $text,
                    'alert_type_A' => $color,
                ]);
            } else {
                return redirect()->back()->with([
                    'MainAlertMessage'=>'فشلت العملية',
                    'AlertMessage' => 'لا يمكنك تعديل التصريح , هذا التصريح الأخير',
                    'alert_type_A' => 'warning',
                ]);
            }
        }

    }
    // public function allowed_blocked_user(Request $request , $user)
    //     {
    //         $deviceChecks=DeviceCheck::where('userName',$user)->where('doctor_id',auth()->user()->doctor_id)->get();
    //         foreach ($deviceChecks as  $deviceCheck) {

    //             $deviceCheck->state = $request->state ;
    //             $deviceCheck->save() ;
    //         }
    //         // if ($request->state !== null) {
    //         // }
    //         return redirect()->back();

    //     }

    public function allowed_blocked_browser(Request $request , $browser)
    {
        $deviceChecks=DeviceCheck::where('browserName',$browser)->where('doctor_id',auth()->user()->doctor_id)->get();
        foreach ($deviceChecks as  $deviceCheck) {
            $deviceCheck->browser_state = $request->state ;
            $deviceCheck->save() ;
        }
        if ($request->state == '1') {
            $text= 'تم التصريح للمستعرض '.  $browser;
            $color= 'success';
        } elseif ($request->state == '0') {
            $text= 'تم حظر المستعرض '. $browser;
            $color= 'danger';
        } elseif ($request->state === null) {
            $text= 'تم تعليق المستعرض '. $browser;
            $color= 'warning';

        }

         return redirect()->back()->with([
             'MainAlertMessage'=>'نجحت العملية',
             'AlertMessage' => $text,
             'alert_type_A' => $color,
         ]);

    }


    // public function lock_device(Request $request,$id)
    // {
    //     $deviceCheck=DeviceCheck::find($id);
    //     $deviceCheck->root= 1;
    //     $deviceCheck->save();
    //     return redirect()->back()->with([
    //         'MainAlertMessage'=>'نجحت العملية',
    //         'AlertMessage' => 'تم قفل التصريح',
    //         'alert_type_A' => 'success',
    //     ]);
    // }
    // public function un_Lock_device(Request $request,$id)
    // {
    //     $deviceChecks=DeviceCheck::where('doctor_id',auth()->user()->doctor_id)->get();
    //     if (count($deviceChecks)>=2) {
    //         $deviceCheck=DeviceCheck::find($id);
    //         $deviceCheck->root= 0;
    //         $deviceCheck->save();
    //         return redirect()->back()->with([
    //             'MainAlertMessage'=>'نجحت العملية',
    //             'AlertMessage' => 'تم إلغاء قفل التصريح',
    //             'alert_type_A' => 'success',
    //         ]);
    //     } else {
    //         return redirect()->back()->with([
    //             'MainAlertMessage'=>'فشلت العملية',
    //             'AlertMessage' => 'لا يمكنك إلغاء قفل التصريح , عليك قفل تصريح آخر لإلغاء قفل هذا التصريح',
    //             'alert_type_A' => 'warning',
    //         ]);
    //     }
    // }

}
