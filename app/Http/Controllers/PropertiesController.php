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

use App\Http\Resources\TypesResource;
use App\Http\Resources\PurposesResource;
use App\Http\Resources\RegionResource;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\PropertyImageResource;
//use App\Http\Resources\PropertyCollection;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        $range = 0.2;

        $lat = $request->lat;
        $long = $request->long;
        $keyword = $request->keyword;
        $city = $request->city;
        $district = $request->district;
        ($request->priceFrom=="")? $priceFrom=0 :$priceFrom=$request->priceFrom ;
        ($request->priceTo=="")? $priceTo=99999999999 :$priceTo=$request->priceTo ;
        $q = Property::query();
        if( $lat != "" && $long != "" ){
            $q->whereBetween('lat', [$lat-$range, $lat+$range]);
            $q->whereBetween('long', [$long-$range, $long+$range]);
        }
        if($keyword!=""){$q->where('title','like', '%'.$keyword.'%');}
        if($district == "" ){
            if($city != ""){
                $districts = Region::where('region_id',$city)->get();
                $district = array();
                foreach($districts as $d){
                    array_push($district,$d->id);
                }
                $q->whereIn('region', $district)->get();                    
            }
        }else{
            $q->where('region','=', $district);
        }
        $q->whereBetween('price', [$priceFrom, $priceTo]);
        $property = $q->where('active','=', 1)->where('deleted','=', 0)->get();
        
        if (count($property) < 1) {
            return response()->json(["error"=>"There is no properties match this search"], Response::HTTP_NOT_FOUND);
        }else{
            return PropertyResource::collection($property);
        }
    }

    public function porpertySearch(Request $request)
    {
        //
        //$purpose = $request->purpose;
        //$type = $request->type;

        $range = 0.2;

        $filterMenus = FilterMenu::all();
        $lat = $request->lat;
        $long = $request->long;
        $keyword = $request->keyword;
        $city = $request->city;
        $district = $request->district;
        ($request->priceFrom=="")? $priceFrom=0 :$priceFrom=$request->priceFrom ;
        ($request->priceTo=="")? $priceTo=99999999999 :$priceTo=$request->priceTo ;

        $q = Property::query();
        if( $lat != "" && $long != "" ){
            $q->whereBetween('lat', [$lat-$range, $lat+$range]);
            $q->whereBetween('long', [$long-$range, $long+$range]);
        }
        if($keyword!=""){$q->where('title','like', '%'.$keyword.'%');}
        if($district == "" ){
            if($city != ""){
                $districts = Region::where('region_id',$city)->get();
                $district = array();
                foreach($districts as $d){
                    array_push($district,$d->id);
                }
                $q->whereIn('region', $district);                    
            }
        }else{
            $q->where('region','=', $district);
        }
        $q->whereBetween('price', [$priceFrom, $priceTo]);
        $property = $q->where('active','=', 1)->where('deleted','=', 0)->get();
        $cities = Region::where('type',1)->where('active',1)->where('deleted',0)->orderby('order')->get();
        return view('searchPage',['name'=>'name_'.App::getLocale(), 'filterMenus'=>$filterMenus, 'properties'=>PropertyResource::collection($property), "cities"=>$cities]);
    }

    public function porpertySearchByPoint(Request $request)
    {
    
        $lat = $request->lat;
        $long = $request->long;
        
        $property = Property::whereBetween('lat', [$lat-1, $lat+1])->whereBetween('long', [$long-1, $long+1])->get();
        return $property;
    }

    public function getLatest(Request $request)
    {
        //
        
        $property = Property::where('active','=', 1)->where('deleted','=', 0)->orderBy('id', 'desc')->limit(4)->get();
        if (count($property) < 1) {
            return response()->json(["error"=>"There is no properties"], Response::HTTP_NOT_FOUND);
        }else{
            return PropertyResource::collection($property);
        }
    }

    public function getList(Request $request)
    {
        $property = Property::where('active','=', 1)->where('deleted','=', 0)->get();
        if (count($property) < 1) {
            return response()->json(["error"=>"There is no properties"], Response::HTTP_NOT_FOUND);
        }else{
            return PropertyResource::collection($property);
        }
    }

    public function getListByRegion($region_id)
    {
        $region = Region::find($region_id);
        if (count($region) < 1) {
            return response()->json(["error"=>"This region is not exists"], Response::HTTP_NOT_FOUND);
        }else{
            $districts = Region::where('region_id',$region_id)->get();
            $district = array();
            foreach($districts as $d){
                array_push($district,$d->id);
            }
            array_push($district,$region_id);
            $property = Property::whereIn('region', $district)->where('active','=', 1)->where('deleted','=', 0)->get();
            if (count($property) < 1) {
                return response()->json(["error"=>"There is no properties is Region"], Response::HTTP_NOT_FOUND);
            }else{
                return PropertyResource::collection($property);
            }
        }
    }

    public function getByLoginedUser()
    {
        if (Auth::check()) {
            $property = Property::where('user_id','=', Auth::user()->id)->where('deleted','=', 0)->get();
            if (count($property) < 1) {
                return response()->json(["error"=>"There is no properties for you"], Response::HTTP_NOT_FOUND);
            }else{
                return PropertyResource::collection($property);
            }
            return PropertyResource::collection($property);
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function getByUser($user_id)
    {
        $user = User::find($user_id);
        if (count($user) < 1) {
            return response()->json(["error"=>"This user is not exists"], Response::HTTP_NOT_FOUND);
        }else{
            $property = Property::where('user_id','=', $user_id)->where('deleted','=', 0)->get();
            if (count($property) < 1) {
                return response()->json(["error"=>"There is no properties for this user"], Response::HTTP_NOT_FOUND);
            }else{
                return PropertyResource::collection($property);
            }
        }
    }


    
    public function getFeatured()
    {
        $property = Property::where('active','=', 1)->where('deleted','=', 0)->where('featured','=', 1)->limit(4)->get();
        if (count($property) < 1) {
            return response()->json(["error"=>"There is no featured properties"], Response::HTTP_NOT_FOUND);
        }else{
            return PropertyResource::collection($property);
        }
    }

    public function getSimilerProperties($id){
        //
        $property = Property::find($id);
        if (count($property) < 1) {
            return response()->json(["error"=>"This Proberty is not exists"], Response::HTTP_NOT_FOUND);
        }else{
            $similar_property = Property::where('region','=', Property::find($id)->region)->
            where('type','=', Property::find($id)->type)->
            where('id','!=', $id)->
            where('active','=', 1)->where('deleted','=', 0)->limit(10)->get();
            if (count($similar_property) < 1) {
                return response()->json(["error"=>"There is no similer properties"], Response::HTTP_NOT_FOUND);
            }else{
                return PropertyResource::collection($similar_property);
            }
        }
    }

    
    public function getProperty($id)
    {
        $property = Property::find($id);
        if (count($property) < 1) {
            return response()->json(["error"=>"This Proberty is not exists"], Response::HTTP_NOT_FOUND);
        }else{
            return new PropertyResource($property);
        }
    }

    
    public function getImages($id)
    {
        $property = Property::find($id);
        if (count($property) < 1) {
            return response()->json(["error"=>"This Proberty is not exists"], Response::HTTP_NOT_FOUND);
        }else{
            $images = Property::find($id)->images;
            if (count($images) < 1) {
                return response()->json(["error"=>"This Proberty has no images"], Response::HTTP_NOT_FOUND);
            }else{
                return  PropertyImageResource::collection($images);
            }
        }
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
            $property->startDate = date("Y-m-d h:i:s");

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
        if (Auth::check()) {

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
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
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

    public function getFormData ()
    {
        $types = Type::where('active',1)->where('deleted',0)->orderby('order')->get();
        $purposes = Purpose::where('active',1)->where('deleted',0)->orderby('order')->get();
        $regions = Region::where('type',1)->where('active',1)->where('deleted',0)->orderby('order')->get();
            
        return [
            "types" => TypesResource::collection($types),
            "purposes" => PurposesResource::collection($purposes),
            "regions" => RegionResource::collection($regions)
        ];
    }
}
