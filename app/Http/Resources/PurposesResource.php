<?php

namespace App\Http\Resources;

use App\Purpose;

use Illuminate\Http\Resources\Json\Resource;

class PurposesResource extends Resource
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
            'name' => $this->name(),
            'value' => $this->id
        ];
    }
}
