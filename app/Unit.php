<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //

    public function mproperty()
    {
        return $this->belongsTo('App\MProperty');
    }

    protected $fillable = [
        'id','m_property_id','name','type','floor','furnished','furnished_status','kitchen_cabinet','bed_rooms',
        'living_rooms','reception_rooms','bath_rooms','split_air_conditioner','window_air_conditioner',
        'electricity_meter','water_meter','gas_meter','created_by','active','deleted'
    ];
}
