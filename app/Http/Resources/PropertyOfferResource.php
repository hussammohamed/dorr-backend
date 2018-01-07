<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\User;
class PropertyOfferResource extends Resource
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
        return [
            'offer_id' => $this->id,
            'description' => $this->description,
            'price' => $this->price,
            'offerOwner' => [
                "id"=> 1,
                "name"=> User::find(1)->name,
                "phone"=> User::find(1)->phone,
            ],
        ];
    }
}
