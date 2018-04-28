<?php

namespace App\Http\Controllers;

use Auth;
use App;
use App\UsageType;

use App\Http\Requests\UsageTypeRequest;
use App\Http\Resources\UsageTypeResource;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UsageTypeController extends Controller
{

    private $modelname = "usage_type";
    private $modelnames = "usage_typies";

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
        return [ $this->modelnames => UsageTypeResource::collection(UsageType::where('active',1)->where('deleted',0)->get())];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(UsageTypeRequest $request)
    {
        //
        if (Auth::check()) {
            $usage_type = new UsageType;
            $usage_type->name_ar =$request->name_ar;
            $usage_type->name_en =$request->name_en;
            $usage_type->order =1;
            
            $usage_type->save();
            
            return response([ $this->modelname => new UsageTypeResource($usage_type)],Response::HTTP_CREATED);

        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UsageType  $usage_type
     * @return \Illuminate\Http\Response
     */
    public function show(UsageType $usage_type)
    {
        return [ $this->modelname => new UsageTypeResource($usage_type)];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UsageType  $usage_type
     * @return \Illuminate\Http\Response
     */
    public function edit(UsageType $usage_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UsageType  $usage_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsageType $usage_type)
    {
        //
        if (Auth::check()) {
                $usage_type->update($request->all());
                return response([ $this->modelname => new UsageTypeResource($usage_type)],Response::HTTP_OK);
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UsageType  $usage_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsageType $usage_type)
    {
        $usage_type->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }

    public function delete(Request $request)
    {
        //
        if (Auth::check()) {
            $usage_type = UsageType::find($request->id);
            if (count($usage_type) < 1) {
                return response()->json(["error"=>"This is not exists"], Response::HTTP_NO_CONTENT);
            }else{
                if(Auth::user()->id == 2){
                    if($usage_type->deleted == 0 ){
                        $usage_type->deleted = 1;
                        $usage_type->save();
                        return response(null,Response::HTTP_NO_CONTENT);
                    }else{
                        return response()->json(["error"=>"This is already deleted"], Response::HTTP_BAD_REQUEST);
                    }
                }else{
                    return response()->json(["error"=>"You are not allowd to delete this"], Response::HTTP_METHOD_NOT_ALLOWED);
                }
            }
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

}
