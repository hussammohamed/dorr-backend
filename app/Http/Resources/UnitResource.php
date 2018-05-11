<?php

namespace App\Http\Resources;

use App;
use App\Type;

use Illuminate\Http\Resources\Json\Resource;

class UnitResource extends Resource
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
            'm_property_id' => $this->m_property_id,
            'no' => $this->no,
            'type'=> [
                'id' => $this->type,
                'name' => Type::find($this->type)->$name
            ],
            'floor' => $this->floor,
            'furnished' => $this->furnished,
            'furnished_status' => $this->furnished_status,
            'kitchen_cabinet' => $this->kitchen_cabinet,
            'bed_rooms' => $this->bed_rooms,
            'living_rooms' => $this->living_rooms,
            'reception_rooms' => $this->reception_rooms,
            'bath_rooms' => $this->bath_rooms,
            'split_air_conditioner' => $this->split_air_conditioner,
            'window_air_conditioner' => $this->window_air_conditioner,
            'electricity_meter' => $this->electricity_meter,
            'water_meter' => $this->water_meter,
            'gas_meter' => $this->gas_meter,
        ];
    }
}
