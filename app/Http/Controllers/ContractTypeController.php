<?php

namespace App\Http\Controllers;

use Auth;
use App;
use App\ContractType;

use App\Http\Requests\ContractTypeRequest;
use App\Http\Resources\ContractTypeResource;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ContractTypeController extends Controller
{

    private $modelname = "contract_type";
    private $modelnames = "contract_typies";

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
        return [ $this->modelnames => ContractTypeResource::collection(ContractType::where('active',1)->where('deleted',0)->get())];
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
    public function store(ContractTypeRequest $request)
    {
        //
        if (Auth::check()) {
            $contract_type = new ContractType;
            $contract_type->name_ar =$request->name_ar;
            $contract_type->name_en =$request->name_en;
            $contract_type->order =1;
            
            $contract_type->save();
            
            return response([ $this->modelname => new ContractTypeResource($contract_type)],Response::HTTP_CREATED);

        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContractType  $contract_type
     * @return \Illuminate\Http\Response
     */
    public function show(ContractType $contract_type)
    {
        return [ $this->modelname => new ContractTypeResource($contract_type)];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContractType  $contract_type
     * @return \Illuminate\Http\Response
     */
    public function edit(ContractType $contract_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContractType  $contract_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContractType $contract_type)
    {
        //
        if (Auth::check()) {
                $contract_type->update($request->all());
                return response([ $this->modelname => new ContractTypeResource($contract_type)],Response::HTTP_OK);
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContractType  $contract_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContractType $contract_type)
    {
        $contract_type->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }

    public function delete(Request $request)
    {
        //
        if (Auth::check()) {
            $contract_type = ContractType::find($request->id);
            if (count($contract_type) < 1) {
                return response()->json(["error"=>"This is not exists"], Response::HTTP_NO_CONTENT);
            }else{
                if(Auth::user()->id == 2){
                    if($contract_type->deleted == 0 ){
                        $contract_type->deleted = 1;
                        $contract_type->save();
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
