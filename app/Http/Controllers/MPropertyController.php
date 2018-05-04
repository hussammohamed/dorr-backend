<?php

namespace App\Http\Controllers;

use Auth;
use App;
use App\MProperty;

//use App\Http\Requests\BankRequest;
use App\Http\Resources\MPropertyResource;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class MPropertyController extends Controller
{

    private $modelname = "mproperty";
    private $modelnames = "mpropertyies";

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
        return [ $this->modelnames => MPropertyResource::collection(MProperty::orWhere('owner_user_id',Auth::user()->id)->orWhere('agent_user_id',Auth::user()->id)->where('active',1)->where('deleted',0)->get())];
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
        if (Auth::check()) {
            $property = new MProperty;
            $property->name =$request->name;
            $property->type = $request->type;
            $property->district = $request->district;
            $property->address = $request->address;
            $property->lat = $request->lat;
            $property->long = $request->long;
            $property->floors = $request->floors;
            $property->units_no = $request->units_no;
            $property->elevators = $request->elevators;
            $property->parking = $request->parking;
            $property->year_of_construction = $request->year_of_construction;
            $property->property_instrument_no = $request->property_instrument_no;
            $property->property_instrument_issuer = $request->property_instrument_issuer;
            $property->property_instrument_date = $request->property_instrument_date;
            $property->property_instrument_place = $request->property_instrument_place;



//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////


            if ($request->hasFile('property_instrument_image')) {
                $file = $request->file('property_instrument_image');
                $extension = $file->getClientOriginalExtension();
                $property_instrument_fileName = str_random(20).".".$extension;
                $folderpath  = 'upload/mproperty/property_instrument/';
                $file->move($folderpath , $property_instrument_fileName);

                $property->agency_instrument_image = $property_instrument_fileName;
            }

//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////

            
		    $property->agency_instrument_no = $request->agency_instrument_no;
		    $property->agency_instrument_issuer = $request->agency_instrument_issuer;
		    $property->agency_instrument_date = $request->agency_instrument_date;
            $property->agency_instrument_exp_date = $request->agency_instrument_exp_date;
            
//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////


            if ($request->hasFile('agency_instrument_image')) {
                $file = $request->file('agency_instrument_image');
                $extension = $file->getClientOriginalExtension();
                $agency_instrument_fileName = str_random(20).".".$extension;
                $folderpath  = 'upload/mproperty/agency_instrument/';
                $file->move($folderpath , $agency_instrument_fileName);

                $property->agency_instrument_image = $agency_instrument_fileName;
            }

//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////

            if ($request->hasFile('property_management_contract_image')) {
                $file = $request->file('property_management_contract_image');
                $extension = $file->getClientOriginalExtension();
                $property_management_contract_fileName = str_random(20).".".$extension;
                $folderpath  = 'upload/mproperty/property_management_contract/';
                $file->move($folderpath , $property_management_contract_fileName);

                $property->property_management_contract_image = $property_management_contract_fileName;
            }

//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////

            if($request->user_relation == 1){
                $property->owner_user_id = Auth::user()->id;
                $property->agent_user_id = null;
            }else{
                $property->owner_user_id = null;
                $property->agent_user_id = Auth::user()->id;
            }

            $property->user_relation = $request->user_relation;

            $property->created_by = Auth::user()->id;

            $property->save();
            
            return [ $this->modelname => new MPropertyResource($property)];
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MProperty  $mProperty
     * @return \Illuminate\Http\Response
     */
    public function show(MProperty  $mproperty)
    {
        return [ $this->modelname => new MPropertyResource($mproperty)];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MProperty  $mProperty
     * @return \Illuminate\Http\Response
     */
    public function edit(MProperty $mProperty)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MProperty  $mProperty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MProperty $mproperty)
    {
        if (Auth::check()) {

            //////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////

            if ($request->hasFile('property_instrument_image')) {
                $file = $request->file('property_instrument_image');
                $extension = $file->getClientOriginalExtension();
                $property_instrument_fileName = str_random(20).".".$extension;
                $folderpath  = 'upload/mproperty/property_instrument/';
                $file->move($folderpath , $property_instrument_fileName);

                $property->agency_instrument_image = $property_instrument_fileName;
            }
            
            //////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////

            if ($request->hasFile('agency_instrument_image')) {
                $file = $request->file('agency_instrument_image');
                $extension = $file->getClientOriginalExtension();
                $agency_instrument_fileName = str_random(20).".".$extension;
                $folderpath  = 'upload/mproperty/agency_instrument/';
                $file->move($folderpath , $agency_instrument_fileName);

                $property->agency_instrument_image = $agency_instrument_fileName;
            }

            //////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////

            if ($request->hasFile('property_management_contract_image')) {
                $file = $request->file('property_management_contract_image');
                $extension = $file->getClientOriginalExtension();
                $property_management_contract_fileName = str_random(20).".".$extension;
                $folderpath  = 'upload/mproperty/property_management_contract/';
                $file->move($folderpath , $property_management_contract_fileName);

                $property->property_management_contract_image = $property_management_contract_fileName;
            }

            //////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////

            $mproperty->update($request->all());
            return response([ "$this->modelname" => new MPropertyResource($mproperty)],Response::HTTP_CREATED);
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MProperty  $mProperty
     * @return \Illuminate\Http\Response
     */
    public function destroy(MProperty $mproperty)
    {
        //
        $mproperty->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}
