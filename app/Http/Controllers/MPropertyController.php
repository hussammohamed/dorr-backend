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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MPropertyResource::collection(MProperty::paginate(5));
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
            $property->units = $request->units;
            $property->elevators = $request->elevators;
            $property->parking = $request->parking;
            $property->year_of_construction = $request->year_of_construction;
            $property->property_instrument_no = $request->property_instrument_no;
            $property->property_instrument_issuer = $request->property_instrument_issuer;
            $property->property_instrument_date = $request->property_instrument_date;
            $property->property_instrument_place = $request->property_instrument_place;
            
            $property->owner_user_id = $request->owner_user_id;
            $property->owner_name = $request->owner_name;
            $property->owner_nationality = $request->owner_nationality;
            $property->owner_address = $request->owner_address;
            $property->owner_id_type = $request->owner_id_type;
            $property->owner_id_no = $request->owner_id_no;
            $property->owner_id_issuer = $request->owner_id_issuer;
            $property->owner_id_date = $request->owner_id_date;
            $property->owner_id_exp_date = $request->owner_id_exp_date;
            $property->owner_email = $request->owner_email;
            $property->owner_mobile = $request->owner_mobile;
            $property->owner_bank = $request->owner_bank;
            $property->owner_bank_iban = $request->owner_bank_iban;

            $property->agent_user_id = $request->agent_user_id;
            $property->agent_name = $request->agent_name;
            $property->agent_nationality = $request->agent_nationality;
            $property->agent_address = $request->agent_address;
            $property->agent_id_type = $request->agent_id_type;
            $property->agent_id_no = $request->agent_id_no;
            $property->agent_id_issuer = $request->agent_id_issuer;
            $property->agent_id_date = $request->agent_id_date;
            $property->agent_id_exp_date = $request->agent_id_exp_date;
            $property->agent_email = $request->agent_email;
            $property->agent_mobile = $request->agent_mobile;
            $property->agent_instrument_no = $request->agent_instrument_no;
            $property->agent_instrument_issuer = $request->agent_instrument_issuer;
            $property->agent_instrument_date = $request->agent_instrument_date;
            $property->agent_instrument_exp_date = $request->agent_instrument_exp_date;
            $property->agent_bank = $request->agent_bank;
            $property->agent_bank_iban = $request->agent_bank_iban;
            $property->commercial_register_name = $request->commercial_register_name;
            $property->commercial_register_no = $request->commercial_register_no;
            $property->commercial_register_issuer = $request->commercial_register_issuer;
            $property->commercial_register_date = $request->commercial_register_date;
            $property->commercial_register_exp_date = $request->commercial_register_exp_date;

            $property->created_by = Auth::user()->id;

            $property->save();
            
            return new MPropertyResource($property);
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
        return new MPropertyResource($mproperty);
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
            $mproperty->update($request->all());
            return response(['data' => new MPropertyResource($mproperty)],Response::HTTP_CREATED);
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
