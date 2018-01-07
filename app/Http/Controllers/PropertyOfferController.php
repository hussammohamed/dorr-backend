<?php

namespace App\Http\Controllers;

use App\PropertyOffer;
use Illuminate\Http\Request;
use App\Http\Resources\PropertyOfferResource;

class PropertyOfferController extends Controller
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

    public function getPropertyOffers($id){
        //

        $property_offers = PropertyOffer::all();
        return PropertyOfferResource::collection($property_offers);
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
     * @param  \App\PropertyOffer  $propertyOffer
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyOffer $propertyOffer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PropertyOffer  $propertyOffer
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyOffer $propertyOffer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PropertyOffer  $propertyOffer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PropertyOffer $propertyOffer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PropertyOffer  $propertyOffer
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyOffer $propertyOffer)
    {
        //
    }
}
