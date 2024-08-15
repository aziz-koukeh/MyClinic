<?php

namespace App\Http\Controllers\MyClinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
// -------- use App\Mail\WelcomeEmail;
// -------- use Illuminate\Support\Facades\Mail;

//  ----------xxxxxxxxxxxxx-------------
    // use Auth;
//  ----------xxxxxxxxxxxxx-------------

use App\Models\User;
use App\Models\Doctor_info;
use Carbon\Carbon;
use Stevebauman\Purify\Facades\Purify;// مكتبة التنظيف من العوالق

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function userStore(Request $request)
    {
        $this->validate($request,[
            'name' => ['nullable', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'mobile' => ['nullable', 'numeric'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'gender' => ['nullable', 'string'],
            'user_image' => ['nullable', 'image', 'max:20000', 'mimes:jpeg,jpg,png'],// حجم الصورة 2 ميغا

        ]);
        $user=  User::create([
            'doctor_id' => auth()->user()->doctor_id  ,
            'name' =>Purify::clean($request->name ),
            'username' =>Purify::clean($request->username ),
            'email' =>Purify::clean($request->email ),
            'mobile' =>Purify::clean($request->mobile ),
            'gender' =>Purify::clean($request->gender ),
            'd_o_e' =>Purify::clean($request->d_o_e ),
            'password' => Hash::make($request->password) ,

        ]);
        if ($request->has('user_image')) {
            $image = $request->user_image;
            $filename = Str::slug($request->username) . '.' . $image->getClientOriginalExtension();
            $path = public_path('/assets/users/' . $filename);
            Image::make($image->getRealPath())->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $user->update(['user_image' => $filename]);

        }
        // Mail::to($request->email)->send(new WelcomeEmail());

        return  redirect()->back()->with([
            'MainAlertMessage'=>'نجحت العملية',
            'AlertMessage'=>'تم إنشاء الحساب الجديد للمستخدم '.$user->name.'.',
            'alert_type_A'   =>'success'
        ]);

    }
    public function usersProfile($username)
    {
        if (auth()->user()->username == $username) {
            $user=  User::where('doctor_id',auth()->user()->doctor_id)->where('username',$username)->first();
            return view('myClinic.mangement.usersProfile',compact('user'));
        }elseif (auth()->user()->d_o_e == 1) {
            $user=  User::where('doctor_id',auth()->user()->doctor_id)->where('username',$username)->first();
            return view('myClinic.mangement.usersProfile',compact('user'));
        }else{
            return  redirect()->back()->with([
                'MainAlertMessage'=>'عذراً',
                'AlertMessage'=>'لا يمكنك الولوج إلى معلومات هذا الحساب.',
                'alert_type_A'   =>'warning'
            ]);
        }
    }
    public function userUpdate(Request $request, $id)
    {
        $user=  User::find($id);
        if (($user->id == $user->doctor_id && auth()->user()->id == $id) || ($user->id != $user->doctor_id && auth()->user()->d_o_e == 0)) {
            $this->validate($request,[
                'name' => ['nullable', 'string', 'max:255'],
                'username' => ['nullable', 'string', 'max:255'],
                'email' => ['nullable', 'string', 'email', 'max:255'],
                'mobile' => ['nullable', 'numeric'],
                'password' => ['nullable', 'string', 'min:8', 'confirmed'],
                'old_password' => ['required', 'string'],
                'gender' => ['nullable', 'string'],
                'user_image' => ['nullable', 'image', 'max:20000', 'mimes:jpeg,jpg,png'],// حجم الصورة 2 ميغا

            ]);
            $hashedValue = $user->password;
            $originalValue = $request->old_password;
            if (Hash::check($originalValue, $hashedValue)) {
                $user->name= Purify::clean($request->name) ;
                $user->username= Purify::clean($request->username) ;
                $user->email= Purify::clean($request->email) ;
                $user->mobile=$request->mobile ;
                $user->d_o_e= $request->d_o_e ;
                if ($request->password) {
                    $user->password= Hash::make($request->password) ;
                }

                $user->gender= Purify::clean($request->gender) ;
                $user->save() ;

                if ($request->has('user_image')) {
                    $image = $request->user_image;
                    $filename = Str::slug($request->username) . '.' . $image->getClientOriginalExtension();
                    $path = public_path('/assets/users/' . $filename);
                    Image::make($image->getRealPath())->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path, 100);
                    $user->update(['user_image' => $filename]);
                }
                return redirect()->route('mang.usersProfile', $user->username)
                ->with([
                    'MainAlertMessage'=>'نجحت العملية',
                    'AlertMessage'=>'تم تحديث الحساب .',
                    'alert_type_A'   =>'success'
                ]);
            }else{
                return redirect()->back()->with([
                    'MainAlertMessage'=>'عذراً',
                    'AlertMessage'=>'كلمة المرور السابقة ليست صحيحة لا يمكنك التعديل .',
                    'alert_type_A'   =>'danger'
                ]);
            }
        }


        elseif ($user->id != $user->doctor_id && auth()->user()->d_o_e == 1) {
            $this->validate($request,[
                'name' => ['nullable', 'string', 'max:255'],
                'username' => ['nullable', 'string', 'max:255'],
                'email' => ['nullable', 'string', 'email', 'max:255'],
                'mobile' => ['nullable', 'numeric'],
                'password' => ['nullable', 'string', 'min:8', 'confirmed'],
                'old_password' => ['nullable', 'string'],
                'gender' => ['nullable', 'string'],
                'user_image' => ['nullable', 'image', 'max:20000', 'mimes:jpeg,jpg,png'],// حجم الصورة 2 ميغا

            ]);
            $user->name= Purify::clean($request->name) ;
            if ($request->username) {
                $user->username= Purify::clean($request->username) ;
            }
            if ($request->email) {
                $user->email= Purify::clean($request->email) ;
            }
            if ($request->mobile) {
                $user->mobile= $request->mobile ;
            }
            if ($request->d_o_e != null) {
                $user->d_o_e= $request->d_o_e ;
            }
            if ($request->password) {
                $user->password= Hash::make($request->password) ;
            }
            $user->gender= Purify::clean($request->gender) ;
            $user->update() ;

            if ($request->has('user_image')) {
                $image = $request->user_image;
                $filename = Str::slug($request->username) . '.' . $image->getClientOriginalExtension();
                $path = public_path('/assets/users/' . $filename);
                Image::make($image->getRealPath())->resize(600, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $user->update(['user_image' => $filename]);
            }
            return redirect()->route('mang.usersProfile', $user->username)
            ->with([
                'MainAlertMessage'=>'نجحت العملية',
                'AlertMessage'=>'تم تحديث الحساب .',
                'alert_type_A'   =>'success'
            ]);
        }
                // Mail::to($request->email)->send(new WelcomeEmail());
    }
    public function userDestroy($username)
    {
        if (auth()->user()->d_o_e == 1)
        {
            $user = User::where('username',$username )->first();
            if ($user) {
                if ($user->user_image != null) {
                    if (File::exists('assets/users/'. $user->user_image)) {
                        unlink('assets/users/' . $user->user_image);
                    }
                }
            }
            $usern = $user->name;
            $user->forceDelete();

            return redirect()->back()->with([
                'MainAlertMessage'=>'نجحت العملية',
                'AlertMessage'=>'تم حذف حساب الموظف '.$usern.' بشكل نهائي  .',
                'alert_type_A'   =>'danger'
             ]);
        }
    }
}
