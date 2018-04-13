<?php

namespace App\Http\Controllers;

use Auth;
use App;
use App\IdType;

use App\Http\Requests\IdTypeRequest;
use App\Http\Resources\IdTypeResource;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class IdTypeController extends Controller
{

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
        return IdTypeResource::collection(IdType::paginate(5));
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
    public function store(IdTypeRequest $request)
    {
        //
        if (Auth::check()) {
            $idType = new IdType;
            $bank->name_ar =$request->name_ar;
            $bank->name_en =$request->name_en;
            $idType->order =1;
            
            $idType->save();
            
            return response(['data' => new IdTypeResource($idType)],Response::HTTP_CREATED);

        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IdType  $idType
     * @return \Illuminate\Http\Response
     */
    public function show(IdType $idType)
    {
        return new IdTypeResource($idType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IdType  $idType
     * @return \Illuminate\Http\Response
     */
    public function edit(IdType $idType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IdType  $idType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IdType $idType)
    {
        //
        if (Auth::check()) {
                $idType->update($request->all());
                return response(['data' => new IdTypeResource($idType)],Response::HTTP_CREATED);
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IdType  $idType
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdType $idType)
    {
        $idType->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }

    public function delete($id)
    {
        //
        if (Auth::check()) {
            $idType = IdType::find($id);
            if (count($idType) < 1) {
                return response()->json(["error"=>"This is not exists"], Response::HTTP_NO_CONTENT);
            }else{
                if(Auth::user()->id == 2){
                    if($idType->deleted == 0 ){
                        $idType->deleted = 1;
                        $idType->save();
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
