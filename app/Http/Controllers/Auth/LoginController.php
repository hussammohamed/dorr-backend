<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
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
        //$this->middleware('guest')->except('logout');
    }

    public function userlogin(){
        if(filter_var(request()->email,FILTER_VALIDATE_EMAIL)){
            return 'email';
        }else{
            return 'mobile1';
        }
    } 
        
    public function login(){
        if(Auth::attempt([$this->userlogin() => request()->email , 'password' => request()->password])){
            return redirect()->intended('/');
        }else{
            return response()->json(["error"=>"Wrong Credentials"], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function setLogin(Request $request){
        $remember =  ($request->remember === 'true');
        if(Auth::attempt([$this->userlogin() => $request->email , 'password' => $request->password], $remember)){
            return Auth::User();
        }else{
            return response()->json(["error"=>"Wrong Credentials"], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
