<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractUnit extends Model
{
    
    public function contract()
    {
        return $this->belongsTo('App\Contract');
    }

    protected $fillable = [
        'id','contract_id','m_property_id','no','type','floor','furnished','furnished_status','kitchen_cabinet',
        'bed_rooms','living_rooms','reception_rooms','bath_rooms','split_air_conditioner',
        'window_air_conditioner','electricity_meter','water_meter','gas_meter',
        'electricity_measurement','water_measurement','gas_measurement',
        'active','deleted'
    ];
}
