<?php

namespace App\Http\Resources;

use App;
use App\Advertiser;

use Illuminate\Http\Resources\Json\Resource;

class AdvertiserResource extends Resource
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
        return [
            'name' => $this->$name,
            'value' => $this->id
        ];
    }
}
