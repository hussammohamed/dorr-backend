<?php

namespace App\Http\Resources;

use App;
use App\Unit;
use App\Contract;
use App\Type;

use DB;
use App\ContractUnit;

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

        $contract = DB::table('contracts')
        ->select('contracts.id','contracts.renter_user_id')
        ->join('contract_units','contract_units.contract_id','=','contracts.id')
        ->where(['contract_units.unit_id' => $this->id])
        ->where('contracts.contract_end_date','>','2018-06-07')
        ->orderBy('contracts.id', 'DESC')
        ->first();

        if (count($contract) < 1) {
            $available = 1;
            $contract_id = null;
            $renter_user_id = null;
        }else{
            $available = 0;
            $contract_id = $contract->id;
            $renter_user_id = $contract->renter_user_id;
        }

        $name = 'name_'.App::getLocale();

        return [
            'id' => $this->id,
            'm_property_id' => $this->m_property_id,
            'no' => $this->no,
            'type'=> $this->type,
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
            'available' => $available,
            'contract_id' => $contract_id,
            'renter_user_id' => $renter_user_id
        ];
    }
}
