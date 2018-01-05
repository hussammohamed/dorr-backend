<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
    protected $fillable = [
        'user_id','type','purpose','title','address','region','lat','long','description','price',
        'year_of_construction','area','floor','finish_type','overlooks','payment_methods',
        'rooms','bathrooms','ad_id','hits','youtube','advertiser_type','startDate','endDate','featured',
        'active','deleted'
    ];
}

