<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
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
            'id' => $this->id,
            'name' => $this->name,
            'first_name' => $this->first_name,
            'family_name' => $this->family_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'mobile1' => $this->mobile1,
            'mobile2' => $this->mobile2,
            'avatar' => url('/').'/upload/users/'.$this->avatar,
        ];
    }
}
