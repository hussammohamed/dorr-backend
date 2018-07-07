<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App;
use App\User;
use Hash;
use App\Property;
use App\MProperty;;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\MPropertyResource;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $modelname = "user";
    private $modelnames = "users";

    public function __construct()
    {
        $this->middleware('auth');//->except('index','show');
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
                return response()->json(["error"=>"there is no user for this email or mobile"], Response::HTTP_BAD_REQUEST);
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
        
        //return $request;

        $data = (array) json_decode($request->request->get('data'));

        if (Auth::check()) {

            $userc = User::where('email','=', $data["email"])->get();
            if (count($userc) > 0) {
                return response()->json(["error"=>"هذا البريد الالكترونى مستخدم من قبل"], Response::HTTP_CONFLICT);
            }
            
            $userc = User::where('mobile1','=', $data["mobile1"])->get();
            if (count($userc) > 0) {
                return response()->json(["error"=>"هذا الجوال مستخدم من قبل"], Response::HTTP_CONFLICT);
            }
            
            //$data['password'] = bcrypt($data['password']);
            //$data['api_token'] = str_random(60);
            
            $user = User::create($data);

            /*$user->name = $request->name;
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
            */
            
            
           // $user->api_token = str_random(60);

            //$user->save();

            //////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////

            if ($request->hasFile('id_image')) {
                $file = $request->file('id_image');
                $extension = $file->getClientOriginalExtension();
                $id_fileName = str_random(20).".".$extension;
                $folderpath  = 'upload/users/id/';
                $file->move($folderpath , $id_fileName);

                $user->id_image = $id_fileName;
            $user->save();
            }

            //////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////

            if($data["mproperty_id"] != null){
                $mproperty = MProperty::find($data["mproperty_id"]);

                if($request->user_relation == 1){
                    $mproperty->owner_user_id = $user->id;
                }else{
                    $mproperty->agent_user_id = $user->id;
                }

                $mproperty->save();
                
                return response([ "mproperty" => new MPropertyResource($mproperty)],Response::HTTP_CREATED);

            }else{
                return response([ $this->modelname => new UserResource($user)],Response::HTTP_CREATED);
            }
            
            
            
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
        return response([ $this->modelname => new UserResource($user)]);
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
     
     
    public function update(Request $request, $id)
    {
        //
        $data = (array) json_decode($request->request->get('data'));
        //return (array) $request->json()->all();
        //return $data;
        $user = User::find($id);            
        
        //return  $data["name"];
        if (Auth::check()) {

                if($user->id == Auth::user()->id || $user->registered == 0){
                    $userc = User::where('email','=', $data["email"])->where('id','!=', $user->id)->get();
                    if (count($userc) > 0) {
                        return response()->json(["error"=>"هذا البريد الالكترونى مستخدم من قبل"], Response::HTTP_CONFLICT);
                    }
                    
                    $userc = User::where('mobile1','=', $data["mobile1"])->where('id','!=', $user->id)->get();
                    if (count($userc) > 0) {
                        return response()->json(["error"=>"هذا الجوال مستخدم من قبل"], Response::HTTP_CONFLICT);
                    }

                    $user->update($data);

                    if ($request->hasFile('id_image')) {
                        $file = $request->file('id_image');
                        $extension = $file->getClientOriginalExtension();
                        $id_fileName = str_random(20).".".$extension;
                        $folderpath  = 'upload/users/id/';
                        $file->move($folderpath , $id_fileName);
        
                        $user->id_image = $id_fileName;
                        $user->save();
                    }

                    if($data["mproperty_id"] != null){
                        $mproperty = MProperty::find($data["mproperty_id"]);
        
                        if($data["user_relation"] == 1){
                            $mproperty->owner_user_id = $user->id;
                        }else{
                            $mproperty->agent_user_id = $user->id;
                        }
        
                        $mproperty->save();
                        
                        return response([ "mproperty" => new MPropertyResource($mproperty)],Response::HTTP_OK);
        
                    }else{
                        return response([ $this->modelname => new UserResource($user)],Response::HTTP_OK);
                    }
                    

                }else{
                    
                    return response()->json(["error"=>"You can't update this user"], Response::HTTP_UNAUTHORIZED);
                    
                }

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
