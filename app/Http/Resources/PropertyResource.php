<?php

namespace App\Http\Resources;

use App;
use App\User;
use App\Type;
use App\Purpose;
use App\FinishType;
use App\Region;
use App\Overlook;
use App\PaymentMethod;
use App\Advertiser;
use App\Http\Resources\PropertyImageResource;

use Illuminate\Http\Resources\Json\Resource;

class PropertyResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        $name = 'name_'.App::getLocale();
        return[
            'id' => $this->id,
            "title" => $this->title,
            "purpose" => Purpose::find($this->purpose)->$name,
            "user" =>  [
                "id"=> $this->user_id,
                "name"=> User::find($this->user_id)->name,
                "phone"=> User::find($this->user_id)->phone,
                "mobile1"=> User::find($this->user_id)->mobile1,
                "mobile2"=> User::find($this->user_id)->mobile2,
            ],
            "district" => [
                "id" => $this->region,
                "title" => Region::find($this->region)->$name,
            ],
            "region" => [
                "id" => Region::find($this->region)->parent,
                // "title" => Region::find(Region::find($this->region)->parent)->$name,
            ],
            "location" => [
                "lat" => $this->lat,
                "long" => $this->long
            ],
            "details" => [
                "type"=> Type::find($this->type)->$name,
                "description"=> $this->description,
                "price"=> $this->price,
                "price_per_meter"=> $this->price / $this->area,
                "year_of_construction"=> $this->year_of_construction,
                "date_of_publication"=> $this->created_at->format('Y-m-d'),
                "area"=> $this->area,
                "advertiser_type"=> Advertiser::find($this->advertiser_type)->$name,
                "floor"=> $this->floor, 
                "finish_type" => FinishType::find($this->finish_type)->$name,
                "bathrooms"=> $this->bathrooms,
                "rooms"=> $this->rooms,
                "ad_id"=> $this->ad_id,
                "youtube"=> $this->youtube,
                "address"=> $this->address,
                "featured"=> $this->featured, 
                "overlooks"=> Overlook::find($this->overlooks)->$name,
                "payment_methods"=> PaymentMethod::find($this->payment_methods)->$name,
            ],
            "pictures" => PropertyImageResource::collection($this->images),

            "offers" => PropertyOfferResource::collection($this->offers)
        ];
    }
}
