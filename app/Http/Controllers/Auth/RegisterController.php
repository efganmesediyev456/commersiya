<?php

namespace App\Http\Controllers\Auth;

use App\About;
use App\Rules\PhoneLengthRule;
use App\Rules\PhoneOperatorRule;
use App\Rules\PhoneRule;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'condition' => 'required|boolean',
            'country_code'=>['required',new PhoneRule],
            'phone'=>['required', 'unique:users', new PhoneLengthRule, new PhoneOperatorRule],
           ],
            [
            'condition.required' => __('site.condition'),
                'phone.regex' => __('site.phone regex'),
                'phone.unique'=>__('site.phone unique')
            ]
        );
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function getIp(){

        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    protected function create(array $data)
    {
        $ipaddress=$this->getIp();
        $user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'account_number' => User::generateAccountNumber(),
            'phone'=>$data['phone'],
            'ip_address'=>$ipaddress
        ]);
        Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password']]);
        $user->assignRole('user');
        return $user;
    }


    public function showRegistrationForm()
    {
        $conditions = About::where('key','conditions')->first();
        if(!$conditions) {
            $conditions = '';
        }
        return view('auth.register',compact('conditions'));

    }
}
