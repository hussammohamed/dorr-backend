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
        $name = 'name_'.App::getLocale();
        return[
            'id' => $this->id,
            "title" => $this->title,
            "purpose" => [
                "id" => $this->purpose,
                "name" => Purpose::find($this->purpose)->$name
            ],
            "user" =>  [
                "id"=> $this->user_id,
                "name"=> User::find($this->user_id)->name,
                "phone"=> User::find($this->user_id)->phone,
                "mobile1"=> User::find($this->user_id)->mobile1,
                "mobile2"=> User::find($this->user_id)->mobile2
            ],
            "district" => [
                "id" => $this->region,
                "title" => Region::find($this->region)->$name
            ],
            "region" => [
                "id" => Region::find($this->region)->region_id,
                "title" => Region::find(Region::find($this->region)->region_id)->$name
            ],
            "location" => [
                "lat" => $this->lat,
                "long" => $this->long
            ],
            "details" => [
                "type"=> [
                    "id" => $this->type,
                    "name" => Type::find($this->type)->$name
                ],
                "description"=> $this->description,
                "price"=> $this->price,
                "price_per_meter"=> $this->price / $this->area,
                "year_of_construction"=> $this->year_of_construction,
                "date_of_publication"=> $this->created_at->format('Y-m-d'),
                "area"=> $this->area,
                "advertiser_type"=> [
                    "id" => $this->advertiser_type,
                    "name" => Advertiser::find($this->advertiser_type)->$name
                ],
                "floor"=> $this->floor, 
                "finish_type" => [
                    "id" => $this->finish_type,
                    "name" => FinishType::find($this->finish_type)->$name
                ],
                "bathrooms"=> $this->bathrooms,
                "rooms"=> $this->rooms,
                "ad_id"=> $this->ad_id,
                "youtube"=> $this->youtube,
                "address"=> $this->address, 
                "overlooks"=> [
                    "id" => $this->overlooks,
                    "name" => Overlook::find($this->overlooks)->$name
                ],
                "payment_methods"=> [
                    "id" => $this->payment_methods,
                    "name" => PaymentMethod::find($this->payment_methods)->$name
                ],
                "featured"=> $this->featured,
            ],
            "pictures" => PropertyImageResource::collection($this->images)
            ,
            "offers" => PropertyOfferResource::collection($this->offers)
        ];
    }
}
