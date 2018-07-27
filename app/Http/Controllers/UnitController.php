<?php

namespace App\Http\Controllers;

use Auth;
use App;
use App\Unit;

use App\MProperty;
use App\Http\Requests\UnitRequest;
use App\Http\Resources\UnitResource;

use App\Http\Resources\MPropertyResource;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UnitController extends Controller
{

    private $modelname = "unit";
    private $modelnames = "units";

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
        return [ $this->modelnames => UnitResource::collection(Unit::where('active',1)->where('deleted',0)->get())];
    }

    public function indexByMProperty($id)
    {
        return [ $this->modelnames => UnitResource::collection(Unit::Where('m_property_id',$id)->where('active',1)->where('deleted',0)->get())];
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

    

    
    public function store(Request $request)
    {
        //
        //$data = (array) json_decode($request->request->get('data'));

        
        //return $request->get('data');
        if (Auth::check()) {
            
            $units = $request->json()->all();

            foreach ($units as $unit) {
                //return $unit;
                //$unit = new Unit;
                $unit["created_by"] = Auth::user()->id;
                Unit::create($unit);
            }
            
            $mproperty = MProperty::find($unit["m_property_id"]);
            //return response([ $this->modelname => new UnitResource($unit)],Response::HTTP_CREATED);
            return response([ "mproperty" => new MPropertyResource($mproperty)],Response::HTTP_OK);

        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        return [ $this->modelname => new UnitResource($unit)];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        //
        if (Auth::check()) {
                $unit->update($request->all());
                return response([ $this->modelname => new UnitResource($unit)],Response::HTTP_OK);
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }

    public function delete(Request $request)
    {
        //
        if (Auth::check()) {
            $unit = Unit::find($request->id);
            if (count($unit) < 1) {
                return response()->json(["error"=>"This is not exists"], Response::HTTP_NO_CONTENT);
            }else{
                if(Auth::user()->id == 2){
                    if($unit->deleted == 0 ){
                        $unit->deleted = 1;
                        $unit->save();
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


    public function contractX()
    {
        $contract = Unit::find(70)->contract;
        return $contract;
    }

}