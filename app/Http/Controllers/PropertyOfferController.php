<?php

namespace App\Http\Controllers;

use App\PropertyOffer;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Resources\PropertyOfferCollection;

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
        return PropertyOfferCollection::collection($property_offers);
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
        
            $offer = new PropertyOffer;
            $offer->property_id = $request->property_id;
            $offer->description = $request->description;
            $offer->price = $request->price;
            (Auth::check())? $offer->user_id = Auth::user()->id : $offer->user_id = 0 ;
            
            $offer->save();

            return redirect('/Properties/show/'.$property_id);
        
    }


    public function storeAPI(Request $request)
    {
        //
        $offer = new PropertyOffer;
        $offer->property_id = $request->property_id;
        $offer->description = $request->description;
        $offer->price = $request->price;
        (Auth::check())? $offer->user_id = Auth::user()->id : $offer->user_id = 0 ;
        
        $offer->save();

        return [
            'offer_id' => $offer->id,
            'description' => $offer->description,
            'price' => $offer->price,
            'offerOwner' =>[
                'id'=> $offer->user_id,
                'name'=> ($offer->user_id == 0 ) ? 'Unkowen' : User::find(1)->name,
                'phone'=> ($offer->user_id == 0 ) ? 'Unkowen' : User::find(1)->phone,
            ],
        ];
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
