<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MProperty extends Model
{
    //
    protected $fillable = [
        'name','type','district','address','lat','long','floors','units_no','elevators','parking',
        'year_of_construction','property_instrument_no','property_instrument_issuer',
        'property_instrument_date','property_instrument_place','owner_user_id','agent_user_id','user_relation',
        'agency_instrument_no','agency_instrument_issuer','agency_instrument_date',
        'agency_instrument_exp_date','created_by','active','deleted'
    ];

    public function units()
    {
        return $this->hasMany('App\Unit');
    }
}
