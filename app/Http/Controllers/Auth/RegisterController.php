<?php

namespace App\Http\Controllers\Auth;
use App;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Http\Requests\UserValidator;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'mobile1' => 'required|string|max:255',
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'mobile1' => $data['mobile1'],
            'api_token' => str_random(60),
        ]);
    }

    
    public function newUser(Request $request)
    {   

        $userc = User::where('email','=', $request->email)->get();
        if (count($userc) > 0) {
            return response()->json(["error"=>"هذا البريد الالكترونى مستخدم من قبل"], Response::HTTP_BAD_REQUEST);
        }
        
        $userc = User::where('mobile1','=', $request->mobile1)->get();
        if (count($userc) > 0) {
            return response()->json(["error"=>"هذا الجوال مستخدم من قبل"], Response::HTTP_BAD_REQUEST);
        }


        $user = new User;
        $user->name =  $request->name;
        $user->email =  $request->email;
        $user->password =  bcrypt($request->password);
        $user->mobile1 =  $request->mobile1;
        $user->api_token =  str_random(60);
        $user->save();

        return $user;
    }
    
    
}
