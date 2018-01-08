<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\User;
class PropertyOfferCollection extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'offer_id' => $this->id,
            'description' => $this->description,
            'price' => $this->price,
            'offerOwner' => [
                'id'=> $this->user_id,
                'name'=> ($this->user_id == 0 ) ? 'Unkowen' : User::find(1)->name,
                'phone'=> ($this->user_id == 0 ) ? 'Unkowen' : User::find(1)->phone,
            ],
        ];
    }
}
