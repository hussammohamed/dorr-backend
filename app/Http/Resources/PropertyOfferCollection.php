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
            'reply_on'=> $this->reply_on,
            'description' => $this->description,
            'price' => $this->price,
            'offerOwner' => [
                'id'=> ($this->api_token == null ) ? 'Unkowen' : $this->user_id,
                'name'=> ($this->api_token == null ) ? 'Unkowen' : User::find($this->user_id)->name,
                'phone'=> ($this->api_token == null ) ? 'Unkowen' : User::find($this->user_id)->mobile1,
            ],
        ];
    }
}
