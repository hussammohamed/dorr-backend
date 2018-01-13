<?php

namespace App\Http\Resources;

use App\Region;

use Illuminate\Http\Resources\Json\Resource;

class RegionResource extends Resource
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
            'title' => $this::name(),
            'location' => [
                "lat"=> $this->lat,
                "long"=> $this->long,
            ],
            "districts" => ($this->districts)? RegionResource::collection($this->districts):""
            
            
        ];
    }
}
