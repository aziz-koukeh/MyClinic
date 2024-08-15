<?php

namespace App\Http\Controllers\MyClinic\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;// مكتبة التنظيف من العوالق

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('MyClinic.auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'numeric', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_image' => ['nullable', 'image', 'max:20000', 'mimes:jpeg,jpg,png'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user= User::create([
            'name' =>Purify::clean( $data['name']),
            'username' => Purify::clean( $data['username']),
            'email' => Purify::clean( $data['email']),
            'mobile' => Purify::clean( $data['mobile']),
            'password' => Hash::make($data['password']),
        ]);
        if (isset($data['user_image'])) {
            if ($image =Purify::clean($data['user_image'])){
                $filename = Str::slug($data['username']) . '.' . $image->getClientOriginalExtension();
                $path = public_path('/assets/users/' . $filename);
                Image::make($image->getRealPath())->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $user->update(['user_image' => $filename]);
            }
        }

        return $user;
    }
    protected function registered(Request $request, $user)
    {
        return redirect()->route('Clinic.index')->with([
            'MainAlertMessage'=>'أهلا بك',
            'AlertMessage' => 'تم إنشاء حساب جديد , راجع بريدك الإلكتروني لتوثيق الحساب.',
            'alert_type_A' => 'info'
        ]);
    }
}
