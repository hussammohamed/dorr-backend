<?php

namespace App\Http\Controllers;


use Auth;
use App;
use App\Property;
use App\PropertyImage;
use App\Type;
use App\Purpose;
use App\FinishType;
use App\Region;
use App\Overlook;
use App\PaymentMethod;
use App\Advertiser;
use App\User;
use App\PropertyOffer;
use App\FilterMenu;

use App\Http\Resources\PropertyResource;
use App\Http\Resources\PropertyImageResource;
//use App\Http\Resources\PropertyCollection;

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

    public function getSearch(Request $request)
    {
        //
        //$purpose = $request->purpose;
        //$type = $request->type;
        $keyword = $request->keyword;
        $city = $request->city;
        $district = $request->district;
        ($request->priceFrom=="")? $priceFrom=0 :$priceFrom=$request->priceFrom ;
        ($request->priceTo=="")? $priceTo=99999999999 :$priceTo=$request->priceTo ;
        $q = Property::query();
        if($keyword!=""){$q->where('title','like', '%'.$keyword.'%');}
        if($city!=""){$q->where('region','=', $city);}
        if($district!=""){$q->where('region','=', $district);}
        $q->whereBetween('price', [$priceFrom, $priceTo]);
        $property = $q->where('active','=', 1)->where('deleted','=', 0)->get();

        return PropertyResource::collection($property);

    }
    public function porpertySearch(Request $request)
    {
        //
        //$purpose = $request->purpose;
        //$type = $request->type;
        $filterMenus = FilterMenu::all();
        $keyword = $request->keyword;
        $city = $request->city;
        $district = $request->district;
        ($request->priceFrom=="")? $priceFrom=0 :$priceFrom=$request->priceFrom ;
        ($request->priceTo=="")? $priceTo=99999999999 :$priceTo=$request->priceTo ;
        $q = Property::query();
        if($keyword!=""){$q->where('title','like', '%'.$keyword.'%');}
        if($city!=""){$q->where('region','=', $city);}
        if($district!=""){$q->where('region','=', $district);}
        $q->whereBetween('price', [$priceFrom, $priceTo]);
        $property = $q->where('active','=', 1)->where('deleted','=', 0)->get();

        return view('searchPage',['name'=>'name_'.App::getLocale(), 'filterMenus'=>$filterMenus, 'properties'=>PropertyResource::collection($property), ]); ;

    }


    public function getLatest(Request $request)
    {
        //
        $property = Property::where('active','=', 1)->where('deleted','=', 0)->orderBy('created_at', 'desc')->limit(4)->get();
        return $property;

    }

    public function getList(Request $request)
    {
        //
        $property = Property::where('active','=', 1)->where('deleted','=', 0)->get();
        return PropertyResource::collection($property);
    }

    public function getListByDistrict($id)
    {
        //
        $property = Property::where('region','=', $id)->where('active','=', 1)->where('deleted','=', 0)->get();
        return PropertyResource::collection($property);
    }

    public function getByUser()
    {
        //
        $property = Property::where('user_id','=', 2)->where('deleted','=', 0)->get();
        return PropertyResource::collection($property);
    }

    
    public function getFeatured()
    {
        //
        $property = Property::where('active','=', 1)->where('deleted','=', 0)->where('featured','=', 1)->limit(4)->get();
        return $property;
        
    }

    public function getSimilerProperties($id){
        //

        $similar_property = Property::where('region','=', Property::find($id)->region)->
        where('type','=', Property::find($id)->type)->
        where('active','=', 1)->where('deleted','=', 0)->limit(10)->get();
        return PropertyResource::collection($similar_property);
    }

    
    public function getProperty($id){
        //

        $property = Property::find($id);
        return new PropertyResource($property);
    }

    
    public function getImages($id){
        $images = App\Property::find($id)->images;
        return  $images;
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

            
            if ($request->hasFile('attachment')) {
                
                app('App\Http\Controllers\PropertyImagesController')->store($property->id, $request->file('attachment'));
                
            }

            return view('sucsess',['property'=>$property]);

        }else{
            return redirect('/');
        }

    }

    public function storeAPI(Request $request)
    {
        //
        
            $property = new Property;
            $property->user_id = Auth::user()->id;
            $property->type =  $request->type;
            $property->purpose =  $request->purpose;
            $property->title =  $request->title;
            $property->address = $request->address;
            $property->region =  $request->region;
            $property->lat =  $request->lat;
            $property->long =  $request->long;
            $property->description =  $request->description;
            $property->price = $request->price;
            $property->year_of_construction =  $request->year_of_construction;
            $property->advertiser_type =  $request->advertiser_type;
            $property->area =  $request->area;
            $property->floor =  $request->floor;
            $property->finish_type =  $request->finish_type;
            $property->overlooks =  $request->overlooks;
            $property->payment_methods =  $request->payment_methods;
            $property->rooms =  $request->rooms;
            $property->bathrooms =  $request->bathrooms;
            $property->ad_id = time();
            $property->youtube = $request->youtube;
            $property->startDate = date("Y-m-d h:i:s");

            $property->save();

            if ($request->hasFile('pictures')) {
                
                app('App\Http\Controllers\PropertyImagesController')->store($property->id, $request->file('attachment'));
                
            }

            $property = Property::find($property->id);
            return new PropertyResource($property);

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
        $similarProperties = Property::where('region','=', $property->region)->
        where('type','=', $property->type)->
        where('active','=', 1)->where('deleted','=', 0)->limit(4)->get();
        $propertyOffers = PropertyOffer::where('property_id', '=', $property->id)->get();
        $propertyImages = PropertyImage::where('property_id', '=', $property->id)->get();   
        return view('/property',['name'=>'name_'.App::getLocale(),'property'=>$property, 'similarProperties'=>$similarProperties, 'propertyOffers'=>$propertyOffers, 'propertyImages'=>$propertyImages]);
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

    public function updateAPI(Request $request)
    {
        //
        
            $property = Property::find($request->id);
            $property->type =  $request->type;
            $property->purpose =  $request->purpose;
            $property->title =  $request->title;
            $property->address = $request->address;
            $property->region =  $request->region;
            $property->lat =  $request->lat;
            $property->long =  $request->long;
            $property->description =  $request->description;
            $property->price = $request->price;
            $property->year_of_construction =  $request->year_of_construction;
            $property->advertiser_type =  $request->advertiser_type;
            $property->area =  $request->area;
            $property->floor =  $request->floor;
            $property->finish_type =  $request->finish_type;
            $property->overlooks =  $request->overlooks;
            $property->payment_methods =  $request->payment_methods;
            $property->rooms =  $request->rooms;
            $property->bathrooms =  $request->bathrooms;
            $property->ad_id = time();
            $property->youtube = $request->youtube;
            $property->startDate = date("Y-m-d h:i:s");

            $property->save();

            if ($request->hasFile('pictures')) {
                
                app('App\Http\Controllers\PropertyImagesController')->store($property->id, $request->file('attachment'));
                
            }

            $property = Property::find($property->id);
            return new PropertyResource($property);

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
        if (Auth::check()) {
            $property = Property::find($request->id);
            $property->type =  $request->type;
            $property->purpose =  $request->purpose;
            $property->title =  $request->title;
            $property->address = $request->address;
            $property->region =  $request->region;
            $property->lat =  $request->lat;
            $property->long =  $request->long;
            $property->description =  $request->description;
            $property->price = $request->price;
            $property->year_of_construction =  $request->year_of_construction;
            $property->advertiser_type =  $request->advertiser_type;
            $property->area =  $request->area;
            $property->floor =  $request->floor;
            $property->finish_type =  $request->finish_type;
            $property->overlooks =  $request->overlooks;
            $property->payment_methods =  $request->payment_methods;
            $property->rooms =  $request->rooms;
            $property->bathrooms =  $request->bathrooms;
            $property->ad_id = time();
            $property->youtube = $request->youtube;

            $property->save();

            if ($request->hasFile('attachment')) {
                
                app('App\Http\Controllers\PropertyImagesController')->store($property->id, $request->file('attachment'));
                
            }

            return redirect('/Properties/show/'.$property->id);
        }else{
            return redirect('/');
        }
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
