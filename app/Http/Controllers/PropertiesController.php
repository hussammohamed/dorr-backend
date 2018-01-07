<?php

namespace App\Http\Controllers;


use Auth;
use App;
use App\Property;
use App\Type;
use App\Purpose;
use App\FinishType;
use App\Region;
use App\Overlook;
use App\PaymentMethod;
use App\Advertiser;
use Illuminate\Http\Request;

class PropertiesController extends Controller
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
    public function create()
    {
        //
        if (Auth::check()) {

            $types = Type::where('active',1)->where('deleted',0)->orderby('order')->get();
            $purposes = Purpose::where('active',1)->where('deleted',0)->orderby('order')->get();
            $cities = Region::where('type',1)->where('active',1)->where('deleted',0)->orderby('order')->get();
            $finishTypes = FinishType::where('active',1)->where('deleted',0)->orderby('order')->get();
            $overlooks = Overlook::where('active',1)->where('deleted',0)->orderby('order')->get();
            $paymentMethods = PaymentMethod::where('active',1)->where('deleted',0)->orderby('order')->get();
            $advertiserTypes = Advertiser::where('active',1)->where('deleted',0)->orderby('order')->get();
            return view('add_add',['name'=>'name_'.App::getLocale(),'types'=>$types, 'purposes'=>$purposes, 'cities'=>$cities, 'finishTypes'=>$finishTypes, 'overlooks'=>$overlooks, 'paymentMethods'=>$paymentMethods, 'advertiserTypes'=>$advertiserTypes]);

        }else{
            return redirect('/');
        }
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

            $property = new Property;
            $property->user_id = Auth::user()->id;
            $property->type = $request->type;
            $property->purpose = $request->purpose;
            $property->title = $request->title;
            $property->address = $request->address;
            $property->region = $request->region;
            $property->lat = $request->lat;
            $property->long = $request->long;
            $property->description = $request->description;
            $property->price = $request->price;
            $property->year_of_construction = $request->year_of_construction;
            $property->advertiser_type = $request->advertiser_type;
            $property->area = $request->area;
            $property->floor = $request->floor;
            $property->finish_type = $request->finish_type;
            $property->overlooks = $request->overlooks;
            $property->payment_methods = $request->payment_methods;
            $property->rooms = $request->rooms;
            $property->bathrooms = $request->bathrooms;
            $property->ad_id = time();
            $property->youtube = $request->youtube;
            $property->startDate = $request->startDate;

            $property->save();

            //$this->show($property->id);
            return redirect('/Properties/'.$property->id);
        }else{
            return redirect('/');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $property = Property::find($id);
        return view('/property',['property'=>$property]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        //
    }
}
