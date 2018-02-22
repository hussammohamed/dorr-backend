<?php

namespace App\Http\Controllers;

use Auth;
use App\PropertyImage;
use App\Property;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\PropertyImageResource;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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
    public function store( $property_id, $files)
    {
        //
        foreach($files as $key=>$file){
            $extension = $file->getClientOriginalExtension();
            $fileName = $property_id."-".time()."-".str_random(6).".".$extension;
            $folderpath  = 'upload/properties/';
            $file->move($folderpath , $fileName);
            
            // - Add Watermark 
            $stamp = imagecreatefrompng('images/dorr_watermark.png');
            $im = imagecreatefromjpeg($folderpath ."/". $fileName);

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
            $fileName = $property_id."-".time()."-".str_random(6).".".$extension;
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
    public function destroy($id)
    {
        if (Auth::check()) {
            $image = PropertyImage::find($id);
            if (count($image) < 1) {
                return response()->json(["error"=>"This proberty's image is not exists"], Response::HTTP_NOT_FOUND);
            }else{
                if(file_exists( public_path() . '/upload/properties/'.$image->path)) {
                    unlink( public_path() . '/upload/properties/'.$image->path);
                }
                $image->delete();
                return response()->json(["message"=>"The image has been deleted"], Response::HTTP_OK);
            }
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function delete($id)
    {
        if (Auth::check()) {
            $image = PropertyImage::find($id);
            if (count($image) < 1) {
                return response()->json(["error"=>"This Proberty is not exists"], Response::HTTP_NOT_FOUND);
            }else{
                    if($image->deleted == 0 ){
                        $image->deleted = 1;
                        $image->save();
                        return new PropertyImageResource($image);
                    }else{
                        return response()->json(["error"=>"This Proberty is already deleted"], Response::HTTP_NOT_MODIFIED);
                    }
            }
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }
}
