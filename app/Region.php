<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //

    protected $fillable = [
        'name_ar','name_en', 'region_id', 'type', 'lat', 'long', 'order','active','deleted'
    ];

    public function districts()
    {
        return $this->hasMany('App\Region');
    }
}
