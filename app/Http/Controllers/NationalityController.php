<?php

namespace App\Http\Controllers;

use Auth;
use App;
use App\Nationality;

use App\Http\Requests\NationalityRequest;
use App\Http\Resources\NationalityResource;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class NationalityController extends Controller
{

    private $modelname = "nationality";
    private $modelnames = "nationalities";


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
        return [ $this->modelnames => NationalityResource::collection(Nationality::where('active',1)->where('deleted',0)->paginate(5))];
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
    public function store(NationalityRequest $request)
    {
        //
        if (Auth::check()) {
            $nationality = new Nationality;
            $nationality->name_ar =$request->name_ar;
            $nationality->name_en =$request->name_en;
            $nationality->order =1;
            
            $nationality->save();
            
            return response([ $this->modelname => new NationalityResource($nationality)],Response::HTTP_CREATED);

        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function show(Nationality $nationality)
    {
        return [ $this->modelname => new NationalityResource($nationality )];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function edit(Nationality $nationality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nationality $nationality)
    {
        //
        if (Auth::check()) {
                $nationality->update($request->all());
                return response([ $this->modelname => new NationalityResource($nationality)],Response::HTTP_OK);
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nationality $nationality)
    {
        $nationality->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }

    public function delete(Request $request)
    {
        //
        if (Auth::check()) {
            $nationality = Nationality::find($request->id);
            if (count($nationality) < 1) {
                return response()->json(["error"=>"This is not exists"], Response::HTTP_NO_CONTENT);
            }else{
                if(Auth::user()->id == 2){
                    if($nationality->deleted == 0 ){
                        $nationality->deleted = 1;
                        $nationality->save();
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
