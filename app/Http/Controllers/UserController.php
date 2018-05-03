<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App;
use App\User;
use Hash;
use App\Property;
use App\MProperty;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $modelname = "user";
    private $modelnames = "users";

    public function __construct()
    {
        $this->middleware('auth:api');//->except('index','show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [ $this->modelnames => UserResource::collection(User::get())];
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
    
    public function searchForUser(Request $request)
    {
        //
        if(Auth::user()){
            $user = User::where('email',$request->key)->orWhere('mobile1',$request->key)->first();
            if($user === null){
                return response()->json(["error"=>"there is no user for this email or mobile"]);
            }else{
                return [ $this->modelname => new UserResource($user)];
            }

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
        if (Auth::check()) {
            $user = new User;
            
            $user->name = $request->name;
            $user->first_name = $request->first_name;
            $user->family_name = $request->family_name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->phone = $request->phone;
            $user->mobile1 = $request->mobile1;
            $user->mobile2 = $request->mobile2;
            $user->api_token = str_random(60);

            

		    $user->nationality = $request->nationality;
		    $user->address = $request->address;
		    $user->id_type = $request->id_type;
		    $user->id_no = $request->id_no;
		    $user->id_issuer = $request->id_issuer;
		    $user->id_issued_date = $request->id_issued_date;
            $user->id_exp_date = $request->id_exp_date;
            $user->bank = $request->bank;
			$user->bank_iban = $request->bank_iban;

			$user->registered = $request->registered;

            //////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////

            if ($request->hasFile('id_image')) {
                $file = $request->file('id_image');
                $extension = $file->getClientOriginalExtension();
                $id_fileName = str_random(20).".".$extension;
                $folderpath  = 'upload/users/id/';
                $file->move($folderpath , $id_fileName);

                $user->id_image = $id_fileName;
            }

            //////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////

            $user->save();

            if($user->m_property_id != null){
                $m_property = MProperty::find($user->m_property_id);

                if($user->user_relation == 1){
                    $m_property->owner_id = $user->id;
                }else{
                    $m_property->agent_id = $user->id;
                }

                $m_property->save();
            }
            
            return response([ $this->modelname => new UserResource($user)],Response::HTTP_CREATED);
            
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
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
     
     
    public function update(Request $request, User $user)
    {
        //
        if (Auth::check()) {
                $user->update($request->all());
                return response([ $this->modelname => new UserResource($user)],Response::HTTP_OK);
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }



     public function update_old(Request $request)
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
    
    public function getAvatar()
    {

        if (Auth::check()) {
            $avatar = Auth::user()->avatar;
            if($avatar!=""){
                if(file_exists( public_path() . '/upload/users/'.$avatar)) {
                    return response()->json(["avatar"=> url('/').'/upload/users/'.$avatar]);
                }else{
                    return response()->json(["error"=>"This avatar is not exist"], Response::HTTP_NOT_FOUND);
                }
            }else{
                return response()->json(["error"=>"This avatar didn't set yet"], Response::HTTP_NOT_FOUND);
            }
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function getAvatarByUserID($id)
    {
        $user = User::find($id);
        if (count($user) < 1) {
            return response()->json(["error"=>"This user is not exists"], Response::HTTP_NOT_FOUND);
        }else{
            $avatar = $user->avatar;
            if($avatar!=""){
                if(file_exists( public_path() . '/upload/users/'.$avatar)) {
                    return response()->json(["avatar"=> '/upload/users/'.$avatar]);
                }else{
                    return response()->json(["error"=>"This avatar is not exist"], Response::HTTP_NOT_FOUND);
                }
            }else{
                return response()->json(["error"=>"This avatar didn't set yet"], Response::HTTP_NOT_FOUND);
            }
        }
    }

    

    public function uploadAvatar(Request $request){
        if (Auth::check()) {
            
            if ($request->hasFile('avatar')) {
                //return 1;
                $file = $request->file('avatar');
                $extension = $file->getClientOriginalExtension();
                $fileName = Auth::user()->id."-".time()."-".str_random(6).".".$extension;
                $folderpath  = 'upload/users/';
                $file->move($folderpath , $fileName);

                $user = User::find(Auth::user()->id);

                if($user->avatar != ""){
                    if(file_exists( public_path() . '/upload/users/'.$user->avatar)) {
                        unlink( public_path() . '/upload/users/'.$user->avatar);
                    }
                }

                $user->avatar = $fileName;
                $user->save();

            }else{
                return response()->json(["error"=>"You should select image to upload"], Response::HTTP_METHOD_NOT_ALLOWED);
            }

            return response()->json(["avatar"=> $folderpath . $fileName]);

        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

}
