<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    public function contract()
    {
        return $this->belongsToMany('App\Contract');
    }

    public function mproperty()
    {
        return $this->belongsTo('App\MProperty');
    }

    protected $fillable = [
        'id','m_property_id','no','type','floor','furnished','furnished_status','kitchen_cabinet',
        'bed_rooms','living_rooms','reception_rooms','bath_rooms','split_air_conditioner',
        'window_air_conditioner','electricity_meter','water_meter','gas_meter','created_by',
        'active','deleted'
    ];

    protected $casts = [
        'id' => 'integer', 'm_property_id' => 'integer', 'type' => 'integer', 'furnished' => 'integer',
        'furnished_status' => 'integer','kitchen_cabinet' => 'integer', 'bed_rooms' => 'integer',
        'living_rooms' => 'integer', 'bath_rooms' => 'integer', 'split_air_conditioner' => 'integer',
        'window_air_conditioner' => 'integer'
    ];
}
