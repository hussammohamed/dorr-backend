<?php

namespace App\Http\Resources;

use App;
use App\Type;
use App\Purpose;

use Illuminate\Http\Resources\Json\Resource;

class FilterMenuResource extends Resource
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
            'key' => Type::find($this->type)->$name.Purpose::find($this->purpose)->$name,
            'value' => $this->$name
        ];
    }
}
