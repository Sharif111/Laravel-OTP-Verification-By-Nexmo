Configuration:

Laravel OTP Verification By Nexmo
sharif

 
Via Composer Create-Project

Alternatively, you may also install Laravel by issuing the Composer create-project command in your terminal:

composer create-project --prefer-dist laravel/laravel blog "7.0*"

 

 After completely install laravel then install this package 

To install the PHP client library using Composer:

composer require nexmo/laravel

 

Add Nexmo\Laravel\NexmoServiceProvider to the providers array in your config/app.php:

'providers' => [
    // Other service providers...

    Nexmo\Laravel\NexmoServiceProvider::class,
],

 

And  add an alias in your
 config/app.php
: 

'aliases' => [
    ...
    'Nexmo' => Nexmo\Laravel\Facade\Nexmo::class,
],
 Configuration
You can use artisan vendor:publish to copy the distribution configuration file to your app's config directory:

php artisan vendor:publish 

Register Controller: 
<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\SendCode;
class RegisterController extends Controller
{  

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
public function register(Request $request)
{
    $this->validator($request->all())->validate();
    event(new Registered($user = $this->create($request->all())));
    return $this->registered($request,$user) ?: redirect('/verify?phone='.$request->phone);
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
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone'=>$data['phone'],
            'active'=>0,
        ]);
        if($user){
            $user->code=SendCode::sendCode($user->phone);
            $user->save();
        }
    }
}

VerifyController:
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class VerifyController extends Controller
{
    public function getVerify(){
        return view('verify');
    }
    public function postVerify(Request $request){
        if($user=User::where('code',$request->code)->first()){
            $user->active=1;
            $user->code=null;
            $user->save();
            return redirect()->route('login')->withMessage('Your account is active');
        }
        else{
            return back()->withMessage('verify code is not correct. Please try again');
        }
    }
}
 
LoginController:
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\SendCode;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if($this->hasTooManyLoginAttempts($request)){
            $this->fireLockoutResponse($request);
        }
         //-------------------

               if($this->guard()->validate($this->credentials($request))){
                $user=$this->guard()->getLastAttempted();
                if($user->active && $this->attemptLogin($request)){
                    return $this->sendLoginResponse($request);
                }
              
               else{
                $this->incrementLoginAttempts($request);
                $user->code=SendCode::sendCode($user->phone);
                if($user->save()){
                    return redirect('/verify?phone='.$user->phone);
                }
               }
               }
        //-----------
       $this->incrementLoginAttempts($request);
       return $this->sendFailedLoginResponse($request);



    }
}
 
Sendcode.php

<?php
namespace App;
class SendCode
{
    public static function sendCode($phone){
        $code=rand(1111,9999);
        $nexmo=app('Nexmo\Client');
        $nexmo->message()->send([
            'to'=>'+880'.(int) $phone,
            'from'=> '+8801832258644',
            'text'=>'Verify code: '.$code,
        ]);
        return $code;
    }

}

Verify.blade.php

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Please verify code from your phone number to active account') }}</div>

                <div class="card-body">
                     @if(Session::has('message'))
                    <div class="alert alert-danger">{{Session::get('message')}}</div>
                    @endif
                    <form method="POST" action="{{ route('verify') }}">
                        @csrf


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('code') }}</label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" required>

                                @if ($errors->has('code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Verify') }}
                                </button>

                           
                            </div>
                        </div>

                     

                       
                    </form>
                </div>
                <div class="card-footer">
                    <a href="">Reduest new code</a>
                    <input type="hidden" name="phone" value="{{request()->phone}}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 
Route:
<?php
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/verify','VerifyController@getVerify')->name('getverify');
Route::post('/verify','VerifyController@postVerify')->name('verify');
 

