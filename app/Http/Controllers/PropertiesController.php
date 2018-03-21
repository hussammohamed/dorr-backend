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
use App\Period;
use App\MapView;
use App\ReportingReason;

use App\Http\Resources\TypesResource;
use App\Http\Resources\PurposesResource;
use App\Http\Resources\RegionResource;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\PropertyImageResource;
use App\Http\Resources\AdvertiserResource;
use App\Http\Resources\FinishTypeResource;
use App\Http\Resources\OverlookResource;
use App\Http\Resources\PaymentMethodResource;
use App\Http\Resources\PeriodResource;
use App\Http\Resources\MapViewResource;
use App\Http\Resources\ReportingReasonResource;
//use App\Http\Resources\PropertyCollection;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyVaildator;

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

        $range = 0.5;

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
            //return response()->json(["error"=>"There is no properties match this search"], Response::HTTP_NOT_FOUND);
            //return "[]";
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
        return view('searchPage',['name'=>'name_'.App::getLocale(), 'filtermenus'=>$filterMenus, 'properties'=>PropertyResource::collection($property), "cities"=>$cities, 'request'=>['keyword'=>$request->keyword, 'city'=>$request->city, 'district'=>$request->district, 'priceFrom'=>$request->priceFrom, 'priceTo'=>$request->priceTo,] ]);
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
            //return response()->json(["error"=>"There is no properties"], Response::HTTP_NOT_FOUND);
            //return "[]";
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
            //return response()->json(["error"=>"This region is not exists"], Response::HTTP_NOT_FOUND);
        }else{
            $districts = Region::where('region_id',$region_id)->get();
            $district = array();
            foreach($districts as $d){
                array_push($district,$d->id);
            }
            array_push($district,$region_id);
            $property = Property::whereIn('region', $district)->where('active','=', 1)->where('deleted','=', 0)->get();
            if (count($property) < 1) {
                //return response()->json(["error"=>"There is no properties is Region"], Response::HTTP_NOT_FOUND);
            }else{
                return PropertyResource::collection($property);
            }
        }
    }

    public function getByLoginedUser()
    {
        if (Auth::check()) {
            $property = Property::where('user_id','=', Auth::user()->id)->where('deleted','=', 0)->orderBy('id', 'desc')->get();
            if (count($property) < 1) {
                //return response()->json(["error"=>"There is no properties for you"], Response::HTTP_NOT_FOUND);
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
            //return response()->json(["error"=>"This user is not exists"], Response::HTTP_NOT_FOUND);
        }else{
            $property = Property::where('user_id','=', $user_id)->where('deleted','=', 0)->orderBy('id', 'desc')->get();
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
            //return response()->json(["error"=>"There is no featured properties"], Response::HTTP_NOT_FOUND);
        }else{
            return PropertyResource::collection($property);
        }
    }

    public function getSimilerProperties($id){
        //
        $property = Property::find($id);
        if (count($property) < 1) {
            //return response()->json(["error"=>"This Proberty is not exists"], Response::HTTP_NOT_FOUND);
        }else{
            $similar_property = Property::where('region','=', Property::find($id)->region)->
            where('type','=', Property::find($id)->type)->
            where('id','!=', $id)->
            where('active','=', 1)->where('deleted','=', 0)->limit(10)->get();
            if (count($similar_property) < 1) {
                //return response()->json(["message"=>"There is no similer properties"], Response::HTTP_NO_CONTENT);
            }else{
                return PropertyResource::collection($similar_property);
            }
        }
    }

    
    public function getProperty($id)
    {
        $property = Property::find($id);
        if (count($property) < 1) {
            //return response()->json(["error"=>"This Proberty is not exists"], Response::HTTP_NOT_FOUND);
        }else{
            $property->hits =  $property->hits+1;
            $property->save();
            return new PropertyResource($property);
        }
    }

    
    public function getImages($id)
    {
        $property = Property::find($id);
        if (count($property) < 1) {
            //return response()->json(["error"=>"This Proberty is not exists"], Response::HTTP_NOT_FOUND);
        }else{
            $images = Property::find($id)->images;
            if (count($images) < 1) {
                //return response()->json(["error"=>"This Proberty has no images"], Response::HTTP_NOT_FOUND);
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
            $incomePeriods = Period::where('active',1)->where('deleted',0)->orderby('order')->get();
            $mapViews = MapView::where('active',1)->where('deleted',0)->orderby('order')->get();
            return view('add_add',['name'=>'name_'.App::getLocale(),'types'=>$types, 'mapViews'=>$mapViews, 'purposes'=>$purposes, 'cities'=>$cities, 'finishTypes'=>$finishTypes, 'overlooks'=>$overlooks, 'incomePeriods'=>$incomePeriods, 'paymentMethods'=>$paymentMethods, 'advertiserTypes'=>$advertiserTypes]);
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
    public function store(PropertyVaildator $request)
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
            $property->price_view = $request->price_view;
            //$property->bid_price = $request->bid_price;
            if(isset($request->bid_price) && $request->bid_price!=""){ $property->bid_price = $request->bid_price; }else{ $property->bid_price = null;};
            if(isset($request->period) && $request->period!=""){ $property->period = $request->period; }else{ $property->period = null;};
            if(isset($request->income) && $request->income!=""){ $property->income = $request->income; }else{ $property->income = null;};
            if(isset($request->year_of_construction) && $request->year_of_construction!=""){ $property->year_of_construction = $request->year_of_construction; }else{ $property->year_of_construction = null;};
            if(isset($request->advertiser_type) && $request->advertiser_type!=""){ $property->advertiser_type = $request->advertiser_type; }else{ $property->advertiser_type = null;};
            $property->area = $request->area;
            if(isset($request->floor) && $request->floor!=""){ $property->floor = $request->floor; }else{ $property->floor = null;};
            if(isset($request->overlooks) && $request->overlooks!=""){ $property->overlooks = $request->overlooks; }else{ $property->overlooks = null;};
            if(isset($request->rooms) && $request->rooms!=""){ $property->rooms = $request->rooms; }else{ $property->rooms = null;};
            if(isset($request->bathrooms) && $request->bathrooms!=""){ $property->bathrooms = $request->bathrooms; }else{ $property->bathrooms = null;};
            if(isset($request->map_view) && $request->map_view!=""){ $property->map_view = $request->map_view; }else{ $property->map_view = null;};
            
            $property->ad_id = time();
            //$property->youtube = $request->youtube;
            if(isset($request->youtube)){ 
                $rx = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?([^&]{11})?/";
                $match;
                    $url = $request->youtube;
                if(preg_match($rx, $url, $match)){
                    parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
                    $property->youtube = $my_array_of_vars['v'];
                }
            }else{
                $property->youtube = null;
            }


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

            $data = (array) json_decode($request->request->get('data'));

            $property = new Property;
            $property->user_id = Auth::user()->id;
            
            $property->type =  $data['type'];
            $property->purpose =  $data['purpose'];
            $property->title =  $data['title'];
            $property->address = $data['address'];
            $property->region =  $data['district'];
            $property->lat =  $data['lat'];
            $property->long =  $data['long'];
            if(isset($data['description'])){ $property->description = $data['description']; }else{ $property->description = null;};
            $property->price = $data['price'];
            $property->price_view = $data['price_view'];
            if(isset($data['bid_price']) || $data['bid_price']==""){ $property->bid_price = $data['bid_price']; }else{ $property->bid_price = null;};
            if(isset($data['period'])){ $property->period = $data['period']; }else{ $property->period = null;};
            //if(isset($data['income'])){ $property->income = $data['income']; }else{ $property->income = null;};
            if(isset($data['year_of_construction'])){ $property->year_of_construction = $data['year_of_construction']; }else{ $property->year_of_construction = null;};
            if(isset($data['advertiser_type'])){ $property->advertiser_type = $data['advertiser_type']; }else{ $property->advertiser_type = null;};
            if(isset($data['area'])){ $property->area = $data['area']; }else{ $property->area = null;};
            if(isset($data['floor'])){ $property->floor = $data['floor']; }else{ $property->floor = null;};
            //$property->finish_type =  $data['finish_type'];
            if(isset($data['overlooks'])){ $property->overlooks = $data['overlooks']; }else{ $property->overlooks = null;};
            //$property->payment_methods =  $data['payment_methods'];
            if(isset($data['rooms'])){ $property->rooms = $data['rooms']; }else{ $property->rooms = null;};
            if(isset($data['bathrooms'])){ $property->bathrooms = $data['bathrooms']; }else{ $property->bathrooms = null;};
            if(isset($data['youtube'])){ 
                $rx = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?([^&]{11})?/";
                $match;
                    $url = $data['youtube'];
                if(preg_match($rx, $url, $match)){
                    parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
                    $property->youtube = $my_array_of_vars['v'];
                }
            }else{
                $property->youtube = null;
            }
            if(isset($data['map_view'])){ $property->map_view = $data['map_view']; }else{ $property->map_view = null;};
            $property->ad_id = time();
            $property->startDate = date("Y-m-d h:i:s");

            $property->save();

            for($x=1;$x<11;$x++){

                if ($request->hasFile('picture'.$x)) {
                    //return 1;
                    $file = $request->file('picture'.$x);
                    $extension = $file->getClientOriginalExtension();

                    $allowed =  array('jpg' ,'jpeg' ,'png');
                    if(in_array($extension,$allowed) ) {

                        $fileName = $property->id."-".time()."-".str_random(6).".".$extension;
                        $folderpath  = 'upload/properties/';
                        $file->move($folderpath , $fileName);
                        
                        // - Add Watermark 
                        $stamp = imagecreatefrompng('images/dorr_watermark.png');
                        if($extension=="png"){
                            $im = imagecreatefrompng($folderpath ."/". $fileName);
                        }else{
                            $im = imagecreatefromjpeg($folderpath ."/". $fileName);
                        }
        
                        //$marge_right = 20;
                        //$marge_bottom = 20;
                        $sx = imagesx($stamp);
                        $sy = imagesy($stamp);
            
                        $tmp_w = imagesx($im)/2;
                        //return $tmp_w;
                        $tmp_h = (imagesx($im)/2)*imagesy($stamp)/ imagesx($stamp);
                        //return $sx." - ".$sy;
                        $tmp = imagecreatetruecolor($tmp_w, $tmp_h);
                        imagealphablending( $tmp, false );
                        imagesavealpha( $tmp, true );
                        imagecopyresampled($tmp, $stamp, 0, 0, 0, 0, $tmp_w, $tmp_h, $sx, $sy);
                        
                        
                        //imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
                        imagecopy($im, $tmp, (imagesx($im) - $tmp_w)/2, (imagesy($im) - $tmp_h)/2, 0, 0, $tmp_w, $tmp_h);
                        imagejpeg($im, $folderpath ."/". $fileName, 100);
                        imagedestroy($stamp);
                        imagedestroy($im);
                        // ---------------------------------------------------------
                        
                        $img = new PropertyImage;
                        $img->property_id = $property->id;
                        $img->path = $fileName;
                        $img->order = 1;
                        $img->save();
                    }else{
                        return response()->json(["error"=>"The image type should be JPG or PNG"], Response::HTTP_BAD_REQUEST);
                    }





                }
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
        
        $property = Property::find($id);
        if (count($property) < 1) {
            return response()->json(["message"=>"This Proberty is not exists"], Response::HTTP_NO_CONTENT);
        }else{
            $similarProperties = Property::where('region','=', $property->region)->
            where('type','=', $property->type)->where('id','!=', $id)->
            where('active','=', 1)->where('deleted','=', 0)->limit(4)->get();
            $propertyOffers = PropertyOffer::where('property_id', '=', $property->id)->get();
            $propertyImages = PropertyImage::where('property_id', '=', $property->id)->where('deleted',0)->get();

            $property->hits =  $property->hits+1;
            $property->save();
            
            return view('property.show',['name'=>'name_'.App::getLocale(),'property'=>$property, 'similarProperties'=>$similarProperties, 'propertyOffers'=>$propertyOffers, 'propertyImages'=>$propertyImages]);
        }
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $types = Type::where('active',1)->where('deleted',0)->orderby('order')->get();
        $purposes = Purpose::where('active',1)->where('deleted',0)->orderby('order')->get();
        $cities = Region::where('type',1)->where('active',1)->where('deleted',0)->orderby('order')->get();
        $finishTypes = FinishType::where('active',1)->where('deleted',0)->orderby('order')->get();
        $overlooks = Overlook::where('active',1)->where('deleted',0)->orderby('order')->get();
        $paymentMethods = PaymentMethod::where('active',1)->where('deleted',0)->orderby('order')->get();
        $advertiserTypes = Advertiser::where('active',1)->where('deleted',0)->orderby('order')->get();
        $property = Property::find($id);
        $incomePeriods = Period::where('active',1)->where('deleted',0)->orderby('order')->get();
        $propertyImages = PropertyImage::where('property_id', '=', $property->id)->where('deleted',0)->get();   
        $mapViews = MapView::where('active',1)->where('deleted',0)->orderby('order')->get();
        return view('property.edit',['name'=>'name_'.App::getLocale(),'property'=>$property, 'types'=>$types, 'mapViews'=>$mapViews, 'incomePeriods'=>$incomePeriods, 'purposes'=>$purposes, 'cities'=>$cities, 'finishTypes'=>$finishTypes, 'overlooks'=>$overlooks, 'paymentMethods'=>$paymentMethods, 'advertiserTypes'=>$advertiserTypes,'propertyImages'=>$propertyImages]);
        
    }

    public function updateAPI(Request $request, $id)
    {
        //
        if (Auth::check()) {
            $property = Property::find($id);
            if (count($property) < 1) {
                return response()->json(["error"=>"This Proberty is not exists"], Response::HTTP_NO_CONTENT);
            }else{
                if($property->user_id == Auth::user()->id){
                    
                    $data = (array) json_decode($request->request->get('data'));

                    $property = Property::find($id);
                    $property->type =  $data['type'];
                    $property->purpose =  $data['purpose'];
                    $property->title =  $data['title'];
                    $property->address = $data['address'];
                    $property->region =  $data['district'];
                    $property->lat =  $data['lat'];
                    $property->long =  $data['long'];
                    if(isset($data['description'])){ $property->description = $data['description']; }else{ $property->description = null;};
                    $property->price = $data['price'];
                    $property->price_view = $data['price_view'];
                    if(isset($data['bid_price']) || $data['bid_price']==""){ $property->bid_price = $data['bid_price']; }else{ $property->bid_price = null;};
                    if(isset($data['period'])){ $property->period = $data['period']; }else{ $property->period = null;};
                    //if(isset($data['income'])){ $property->income = $data['income']; }else{ $property->income = null;};
                    if(isset($data['year_of_construction'])){ $property->year_of_construction = $data['year_of_construction']; }else{ $property->year_of_construction = null;};
                    if(isset($data['advertiser_type'])){ $property->advertiser_type = $data['advertiser_type']; }else{ $property->advertiser_type = null;};
                    if(isset($data['area'])){ $property->area = $data['area']; }else{ $property->area = null;};
                    if(isset($data['floor'])){ $property->floor = $data['floor']; }else{ $property->floor = null;};
                    //$property->finish_type =  $data['finish_type'];
                    if(isset($data['overlooks'])){ $property->overlooks = $data['overlooks']; }else{ $property->overlooks = null;};
                    //$property->payment_methods =  $data['payment_methods'];
                    if(isset($data['rooms'])){ $property->rooms = $data['rooms']; }else{ $property->rooms = null;};
                    if(isset($data['bathrooms'])){ $property->bathrooms = $data['bathrooms']; }else{ $property->bathrooms = null;};
                    //if(isset($data['youtube'])){ $property->youtube = $data['youtube']; }else{ $property->youtube = null;};
                    if(isset($data['youtube'])){ 
                        $rx = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?([^&]{11})?/";
                        $match;
                            $url = $data['youtube'];
                        if(preg_match($rx, $url, $match)){
                            parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
                            $property->youtube = $my_array_of_vars['v'];
                        }
                    }else{
                        $property->youtube = null;
                    }
                    if(isset($data['map_view'])){ $property->map_view = $data['map_view']; }else{ $property->map_view = null;};
                    
                    $property->save();

                    for($x=1;$x<11;$x++){

                        if ($request->hasFile('picture'.$x)) {
                            //return 1;
                            $file = $request->file('picture'.$x);
                            $extension = $file->getClientOriginalExtension();
                            
                            $allowed =  array('jpg' ,'jpeg' ,'png');
                            if(in_array($extension,$allowed) ) {
                            
                                $fileName = $property->id."-".time()."-".str_random(6).".".$extension;
                                $folderpath  = 'upload/properties/';
                                $file->move($folderpath , $fileName);
                                
                                // - Add Watermark 
                                $stamp = imagecreatefrompng('images/dorr_watermark.png');
                                if($extension=="png"){
                                    $im = imagecreatefrompng($folderpath ."/". $fileName);
                                }else{
                                    $im = imagecreatefromjpeg($folderpath ."/". $fileName);
                                }
                
                                //$marge_right = 20;
                                //$marge_bottom = 20;
                                $sx = imagesx($stamp);
                                $sy = imagesy($stamp);
                                
                                $tmp_w = imagesx($im)/2;
                                //return $tmp_w;
                                $tmp_h = (imagesx($im)/2)*imagesy($stamp)/ imagesx($stamp);
                                //return $sx." - ".$sy;
                                $tmp = imagecreatetruecolor($tmp_w, $tmp_h);
                                imagealphablending( $tmp, false );
                                imagesavealpha( $tmp, true );
                                imagecopyresampled($tmp, $stamp, 0, 0, 0, 0, $tmp_w, $tmp_h, $sx, $sy);
                                
                                
                                //imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
                                imagecopy($im, $tmp, (imagesx($im) - $tmp_w)/2, (imagesy($im) - $tmp_h)/2, 0, 0, $tmp_w, $tmp_h);
                                imagejpeg($im, $folderpath ."/". $fileName, 100);
                                imagedestroy($stamp);
                                imagedestroy($im);
                                // ---------------------------------------------------------
                            
                                $img = Image::make($file->getRealPath());
                                $watermark = Image::make(public_path('images/dorr_watermark.png'));                
                                $img->insert($watermark, 'bottom-right', 50, 50);
                                $img->save($folderpath.'/'.$fileName);
                                

                                $img = new PropertyImage;
                                $img->property_id = $property->id;
                                $img->path = $fileName;
                                $img->order = 1;
                                $img->save();

                            }else{
                                return response()->json(["error"=>"The image type should be JPG or PNG"], Response::HTTP_BAD_REQUEST);
                            }
                            
                        }
                    }
                    /*
                    $existingImages = (array) json_decode($request->request->get('existingImages'));

                    $images = PropertyImageResource::collection(Property::find($id)->images);
                    

                    //$result = $images->diff($existingImages);

                    //$result=array_diff($images,$existingImages);
                    return $existingImages;
                    */
                    $property = Property::find($property->id);
                    return new PropertyResource($property);

                }else{
                    return response()->json(["error"=>"You are not allowd to feature this property"], Response::HTTP_METHOD_NOT_ALLOWED);
                }
            }
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
            
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyVaildator $request)
    {
        if (Auth::check()) {
            $property = Property::find($request->id);
            if (count($property) < 1) {
                return response()->json(["error"=>"This Proberty is not exists"], Response::HTTP_NO_CONTENT);
            }else{
                if($property->user_id == Auth::user()->id){
                    
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
                    $property->price_view = $request->price_view;
                    if(isset($request->bid_price) && $request->bid_price!=""){ $property->bid_price = $request->bid_price; }else{ $property->bid_price = null;};
                    if(isset($request->period) && $request->period!=""){ $property->period = $request->period; }else{ $property->period = null;};
                    if(isset($request->income) && $request->income!=""){ $property->income = $request->income; }else{ $property->income = null;};
                    if(isset($request->year_of_construction) && $request->year_of_construction!=""){ $property->year_of_construction = $request->year_of_construction; }else{ $property->year_of_construction = null;};
                    if(isset($request->advertiser_type) && $request->advertiser_type!=""){ $property->advertiser_type = $request->advertiser_type; }else{ $property->advertiser_type = null;};
                    $property->area = $request->area;
                    if(isset($request->floor) && $request->floor!=""){ $property->floor = $request->floor; }else{ $property->floor = null;};
                    if(isset($request->overlooks) && $request->overlooks!=""){ $property->overlooks = $request->overlooks; }else{ $property->overlooks = null;};
                    if(isset($request->rooms) && $request->rooms!=""){ $property->rooms = $request->rooms; }else{ $property->rooms = null;};
                    if(isset($request->bathrooms) && $request->bathrooms!=""){ $property->bathrooms = $request->bathrooms; }else{ $property->bathrooms = null;};
                    if(isset($request->map_view) && $request->map_view!=""){ $property->map_view = $request->map_view; }else{ $property->map_view = null;};
            
                    //$property->youtube = $request->youtube;
                    
                    if(isset($request->youtube)){ 
                        $rx = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?([^&]{11})?/";
                        $match;
                            $url = $request->youtube;
                        if(preg_match($rx, $url, $match)){
                            parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
                            $property->youtube = $my_array_of_vars['v'];
                        }
                    }else{
                        $property->youtube = null;
                    }
                    
                    
                    
                    $property->save();

                    if ($request->hasFile('attachment')) {
                        //app('App\Http\Controllers\PropertyImagesController')->store($property->id, $request->file('attachment'));


                        foreach($request->file('attachment') as $key=>$file){
                            $extension = $file->getClientOriginalExtension();
                            
                            $allowed =  array('jpg' ,'jpeg' ,'png');
                            if(in_array($extension,$allowed) ) {
                            
                            $fileName = $request->id."-".time()."-".str_random(6).".".$extension;
                            $folderpath  = 'upload/properties/';
                            $file->move($folderpath , $fileName);
                            
                            // - Add Watermark 
                            $stamp = imagecreatefrompng('images/dorr_watermark.png');
                            if($extension=="png"){
                                $im = imagecreatefrompng($folderpath ."/". $fileName);
                            }else{
                                $im = imagecreatefromjpeg($folderpath ."/". $fileName);
                            }
            
                            //$marge_right = 20;
                            //$marge_bottom = 20;
                            $sx = imagesx($stamp);
                            $sy = imagesy($stamp);
                
                            $tmp_w = imagesx($im)/2;
                            //return $tmp_w;
                            $tmp_h = (imagesx($im)/2)*imagesy($stamp)/ imagesx($stamp);
                            //return $sx." - ".$sy;
                            $tmp = imagecreatetruecolor($tmp_w, $tmp_h);
                            imagealphablending( $tmp, false );
                            imagesavealpha( $tmp, true );
                            imagecopyresampled($tmp, $stamp, 0, 0, 0, 0, $tmp_w, $tmp_h, $sx, $sy);
                            
                            
                            //imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
                            imagecopy($im, $tmp, (imagesx($im) - $tmp_w)/2, (imagesy($im) - $tmp_h)/2, 0, 0, $tmp_w, $tmp_h);
                            imagejpeg($im, $folderpath ."/". $fileName, 100);
                            imagedestroy($stamp);
                            imagedestroy($im);
                            // ---------------------------------------------------------
                
                            $img = new PropertyImage;
                            $img->property_id = $request->id;
                            $img->path = $fileName;
                            $img->order = $key+1;
                            $img->save();

                        }else{
                            return response()->json(["error"=>"The image type should be JPG or PNG"], Response::HTTP_BAD_REQUEST);
                        }
                        }
                    }

                    return redirect('/properties/show/'.$property->id);

                }else{
                    return response()->json(["error"=>"You are not allowd to feature this property"], Response::HTTP_METHOD_NOT_ALLOWED);
                }
            }
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check()) {
            $property = Property::find($id);
            if (count($property) < 1) {
                return response()->json(["error"=>"This Proberty is not exists"], Response::HTTP_NO_CONTENT);
            }else{
                if($property->user_id == Auth::user()->id){
                    $property->delete();
                    return response()->json(["message"=>"The property has been deleted"], Response::HTTP_ACCEPTED);
                }else{
                    return response()->json(["error"=>"You are not allowd to delete this property"], Response::HTTP_METHOD_NOT_ALLOWED);
                }
            }
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function delete($id)
    {
        if (Auth::check()) {
            $property = Property::find($id);
            if (count($property) < 1) {
                return response()->json(["error"=>"This Proberty is not exists"], Response::HTTP_NO_CONTENT);
            }else{
                if($property->user_id == Auth::user()->id){
                    if($property->deleted == 0 ){
                        $property->deleted = 1;
                        $property->save();
                        return new PropertyResource($property);
                    }else{
                        return response()->json(["error"=>"This Proberty is already deleted"], Response::HTTP_NOT_MODIFIED);
                    }
                }else{
                    return response()->json(["error"=>"You are not allowd to delete this property"], Response::HTTP_METHOD_NOT_ALLOWED);
                }
            }
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function setFeatured($id)
    {
        if (Auth::check()) {
            $property = Property::find($id);
            if (count($property) < 1) {
                return response()->json(["error"=>"This Proberty is not exists"], Response::HTTP_NO_CONTENT);
            }else{
                if($property->user_id == Auth::user()->id){
                    if($property->featured == 0 ){
                        $property->featured = 1;
                        $property->save();
                        return new PropertyResource($property);
                    }else{
                        //return response()->json(["error"=>"This Proberty is already featured"], Response::HTTP_NOT_MODIFIED);
                        $property->featured = 0;
                        $property->save();
                        return new PropertyResource($property);
                    }
                }else{
                    return response()->json(["error"=>"You are not allowd to feature this property"], Response::HTTP_METHOD_NOT_ALLOWED);
                }
            }
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function getFormData ()
    {
        $types = Type::where('active',1)->where('deleted',0)->orderby('order')->get();
        $purposes = Purpose::where('active',1)->where('deleted',0)->orderby('order')->get();
        $regions = Region::where('type',1)->where('active',1)->where('deleted',0)->orderby('order')->get();
        $advertisers = Advertiser::where('active',1)->where('deleted',0)->orderby('order')->get();
        //$finish_types = FinishType::where('active',1)->where('deleted',0)->orderby('order')->get();
        $overlooks = Overlook::where('active',1)->where('deleted',0)->orderby('order')->get();
        //$payment_methods = PaymentMethod::where('active',1)->where('deleted',0)->orderby('order')->get();
        $periods = Period::where('active',1)->where('deleted',0)->orderby('order')->get();
        $map_views = MapView::where('active',1)->where('deleted',0)->orderby('order')->get();
        $reporting_reasons = ReportingReason::where('active',1)->where('deleted',0)->orderby('order')->get();

        return [
            "types" => TypesResource::collection($types),
            "purposes" => PurposesResource::collection($purposes),
            "regions" => RegionResource::collection($regions),
            "advertisers" => AdvertiserResource::collection($advertisers),
            //"finish_types" => FinishTypeResource::collection($finish_types),
            "overlooks" => OverlookResource::collection($overlooks),
            //"payment_methods" => PaymentMethodResource::collection($payment_methods),
            "periods" => PeriodResource::collection($periods),
            "map_views" => MapViewResource::collection($map_views),
            "reporting_reasons" => ReportingReasonResource::collection($reporting_reasons),
        ];
    }
}
