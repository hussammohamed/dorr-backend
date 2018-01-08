<?php

namespace App\Http\Controllers;

use App\PropertyImage;
use App\Property;
use Illuminate\Http\Request;

class PropertyImagesController extends Controller
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
    public function store( $property_id, $files )
    {
        //
        foreach($files as $key=>$file){
            $extension = $file->getClientOriginalExtension();
            $fileName = $property_id."-".time()."-".str_random(6).".".$extension;
            $folderpath  = 'upload/properties/';
            $file->move($folderpath , $fileName);

            $img = new PropertyImage;
            $img->property_id = $property_id;
            $img->path = $fileName;
            $img->order = $key+1;
            $img->save();
        }
    }

    public function storeNew( $property_id, $files )
    {
        //
        foreach($files as $key=>$file){
            $extension = $file->getClientOriginalExtension();
            $fileName = $property_id."-".time()."-".str_random().".".$extension;
            $folderpath  = 'upload/properties/';
            $file->move($folderpath , $fileName);

            $img = new PropertyImage;
            $img->property_id = $property_id;
            $img->path = $fileName;
            $img->order = $key+1;
            $img->save();
        }

        return PropertyImageResource::collection(Property::fing($property_id)->images);
    }



    
    /**
     * Display the specified resource.
     *
     * @param  \App\PropertyImage  $propertyImage
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyImage $propertyImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PropertyImage  $propertyImage
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyImage $propertyImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PropertyImage  $propertyImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PropertyImage $propertyImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PropertyImage  $propertyImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyImage $propertyImage)
    {
        //
    }
}
