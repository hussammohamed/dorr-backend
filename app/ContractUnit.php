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
        'id','contract_id','m_property_id','unit_id','no','type','floor','furnished','furnished_status','kitchen_cabinet',
        'bed_rooms','living_rooms','reception_rooms','bath_rooms','split_air_conditioner',
        'window_air_conditioner','electricity_meter','water_meter','gas_meter',
        'electricity_measurement','water_measurement','gas_measurement',
        'active','deleted'
    ];
    
    protected $casts = [
        'id' => 'integer','contract_id' => 'integer','m_property_id' => 'integer','unit_id' => 'integer',
        'type' => 'integer','furnished' => 'integer','furnished_status' => 'integer','kitchen_cabinet' => 'integer',
        'bed_rooms' => 'integer','living_rooms' => 'integer','reception_rooms' => 'integer','bath_rooms' => 'integer',
        'split_air_conditioner' => 'integer','window_air_conditioner' => 'integer',
        'active' => 'integer','deleted' => 'integer'
    ];


}
