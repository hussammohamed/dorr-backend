<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App;
use App\User;
use Hash;
use App\Property;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     
    public function getUser()
    {
        //
        if(Auth::user()){
            return Auth::user();
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
        
    }
    
    public function getUserProperties(Request $request)
     {
         if (Auth::check()) {
             $Properties = Property::where('user_id',Auth::user()->id)->get();
             return view('myProperties',['name'=>'name_'.App::getLocale(), 'properties'=>$Properties]);
         }else{
             return redirect('/');
         }
         
     }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        if (Auth::check()) {
            $user = User::where('id',Auth::user()->id)->get();
            return view('myAccount',['user'=>$user]);
        }else{
            return redirect('/');
        }
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request)
     {
         //
         if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            $user->name = $request->name;
            $user->first_name = $request->first_name;
            $user->family_name = $request->family_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->mobile1 = $request->mobile1;
            $user->mobile2 = $request->mobile2;
            $user->save();
            return redirect('myAccount');
        }else{
            return "no logined user";
        }
 
     }


     public function updateUser(Request $request)
     {
         //
         if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            $user->name = $request->name;
            $user->first_name = $request->first_name;
            $user->family_name = $request->family_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->mobile1 = $request->mobile1;
            $user->mobile2 = $request->mobile2;
            $user->save();
            return $user;
        }else{
            return "no logined user";
        }
 
     }


     public function updatePassword(Request $request)
     {
        //
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            //return $request->oldPass;
            $realOldPass = Auth::user()->password;
            $oldPass = $request->oldPass;
            if(Hash::check($oldPass,$realOldPass)) {
                $user->password = bcrypt($request->newPass);
                $user->save();
                return redirect('myAccount');
            }else{
                return "your old password is wrong";
            }
        }else{
            return "no logined user";
        }

        //return bcrypt("123456")."<br><br><br>".bcrypt("123456")."<br><br><br>".bcrypt("123456");
         
 
     }

     public function updatePasswordAPI(Request $request)
     {
        //
        if (Auth::check()) {

            $user = User::find(Auth::user()->id);
            $realOldPass = Auth::user()->password;
            $oldPass = $request->oldPass;
            $newPass = $request->newPass;
            if(strlen($request->newPass)<6){
                return response()->json(["error"=>"Your new password should be more than 6 letters"], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            if(Hash::check($oldPass,$realOldPass)) {
                $user->password = bcrypt($newPass);
                $user->save();
                return Auth::user();
            }else{
                return response()->json(["error"=>"Your old password is wrong"], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
     }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
