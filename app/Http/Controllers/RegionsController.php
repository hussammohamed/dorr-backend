<?php

namespace App\Http\Controllers;

use App;
use App\Region;
use App\Http\Resources\RegionResource;
use App\Http\Resources\RegionCollection;
use Illuminate\Http\Request;

class RegionsController extends Controller
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Regions  $regions
     * @return \Illuminate\Http\Response
     */
    public function show(Regions $regions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Regions  $regions
     * @return \Illuminate\Http\Response
     */
    public function edit(Regions $regions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Regions  $regions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Regions $regions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Regions  $regions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Regions $regions)
    {
        //
    }

    public function getDistrictsByCity($city)
    {
        $regions = Region::where('region_id','=', $city)
        ->where('active','=', 1)->where('deleted','=', 0)->orderby('order')->get();
        return RegionResource::collection($regions);
        
    }

    public function getDistricts()
    {
        $regions = Region::select('id', 'name_'.App::getLocale().' as name' )
        ->where('type','=', 2)
        ->where('active','=', 1)->where('deleted','=', 0)->orderby('name')->get();
        return $regions;
        
    }

    public function getDistrictsByPoint($lat, $long)
    {
        $range = 3.5;
        if( $lat != "" && $long != "" ){
            $regions = Region::where('type','=', 2)->whereBetween('lat', [$lat-$range, $lat+$range])
            ->whereBetween('long', [$long-$range, $long+$range])
            ->where('active','=', 1)->where('deleted','=', 0)->get();
        return RegionResource::collection($regions);
        }else{
            return 0;
        }
    }

    
    public function getCities()
    {
        $regions = Region::where('region_id','=', 0)->where('active','=', 1)->where('deleted','=', 0)->orderby('order')->get();
        return RegionResource::collection($regions);
    }

}
