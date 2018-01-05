<?php

namespace App\Http\Controllers;
use Auth;
use App\Property;
use App\Type;
use App\Purpose;
use App\FinishType;
use App\Region;
use App\Overlook;
use App\PaymentMethod;
use App;
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
            return view('add_add',['name'=>'name_'.App::getLocale(),'types'=>$types, 'purposes'=>$purposes, 'cities'=>$cities, 'finishTypes'=>$finishTypes, 'overlooks'=>$overlooks, 'paymentMethods'=>$paymentMethods]);

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
            $property = new Properties;
            $property->type = $request->type;
            $property->purpose = $request->purpose;
            $property->title = $request->title;
            $property->ownerID = Auth::user();
            $property->address = $request->address;
            $property->region = $request->region;
            $property->lat = $request->lat;
            $property->long = $request->long;
            $property->description = $request->description;
            $property->price = $request->price;
            $property->pricePerMeter = $request->pricePerMeter;
            $property->dateOfConstruction = $request->dateOfConstruction;
            $property->area = $request->area;
            $property->floor = $request->floor;
            $property->finishType = $request->finishType;
            $property->overlooks = $request->overlooks;
            $property->paymentMethods = $request->paymentMethods;
            $property->rooms = $request->rooms;
            $property->bathrooms = $request->bathrooms;
            $property->adID = $request->adID;
            $property->hits = $request->hits;
            $property->youtube = $request->youtube;
            $property->advertiserType = $request->advertiserType;
            $property->dateOfPublication = $request->dateOfPublication;
            $property->startDate = $request->startDate;
            $property->endDate = $request->endDate;

            $property->save();

            return show($property->id);
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
        $property = Properties::find($id);
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
