<?php

namespace App\Http\Controllers;

use App\Property;
use App\PropertyOffer;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    public function getPropertyOffers($id)
    {
        $property_offers = PropertyOffer::where('property_id',$id)->where('active',1)->where('deleted',0)->get();
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
        if (Auth::check()) {
            $offer = new PropertyOffer;
            $offer->property_id = $request->property_id;
            $offer->description = $request->description;
            $offer->price = $request->price;
            $offer->user_id = Auth::user()->id;
            
            $offer->save();

            return [
                'offer_id' => $offer->id,
                'description' => $offer->description,
                'price' => $offer->price,
                'offerOwner' =>[
                    'id'=> $offer->user_id,
                    'name'=> ($offer->user_id == 0 ) ? 'Unkowen' : Auth::user()->name,
                    'phone'=> ($offer->user_id == 0 ) ? 'Unkowen' : Auth::user()->mobile1,
                ],
            ];
            
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
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
    public function destroy($id)
    {
        if (Auth::check()) {
            $offer = PropertyOffer::find($id);

            //if($offer->user_id == Auth::user()->id || $property->user_id == Auth::user()->id ){
                
                if (count($offer) < 1) {
                    return response()->json(["error"=>"This Offer is not exists"], Response::HTTP_NOT_FOUND);
                }else{
                    $offer->delete();
                    return response()->json(["message"=>"This Offer has been destroied successfully"], Response::HTTP_OK);
                }

            //}else{
            //    return response()->json(["error"=>"You are not allowd to delete this offer"], Response::HTTP_METHOD_NOT_ALLOWED);
            //}
            
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
        
        
        
        
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
            $offer = PropertyOffer::find($id);
            $property = Property::find($offer->property_id);

            if($offer->user_id == Auth::user()->id || $property->user_id == Auth::user()->id ){
                
                if (count($offer) < 1) {
                    return response()->json(["error"=>"This Offer is not exists"], Response::HTTP_NOT_FOUND);
                }else{
                        if($offer->deleted == 0 ){
                            $offer->deleted = 1;
                            $offer->save();
                            return response()->json(["message"=>"This Offer has been deleted successfully"], Response::HTTP_OK);
                        }else{
                            return response()->json(["message"=>"This Offer is already deleted"], Response::HTTP_OK);
                        }
                }

            }else{
                return response()->json(["error"=>"You are not allowd to delete this offer"], Response::HTTP_METHOD_NOT_ALLOWED);
            }

        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }
}
