<?php

namespace App\Http\Resources;

use App;
use App\UsageType;

use Illuminate\Http\Resources\Json\Resource;

class UsageTypeResource extends Resource
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
            'id' => $this->id,
            'name' => $this->$name
        ];
    }
}
