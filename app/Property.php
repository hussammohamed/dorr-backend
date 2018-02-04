<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
    protected $fillable = [
        'user_id','type','purpose','title','address','region','lat','long','description','price','price_view',
        'bid_price','income_period','income','year_of_construction','area','floor','finish_type','overlooks',
        'payment_methods','rooms','bathrooms','ad_id','hits','youtube','advertiser_type','startDate','endDate',
        'featured','active','deleted'
    ];
    
    
    public function images()
    {
        return $this->hasMany('App\PropertyImage');
    }
    
    public function offers()
    {
        return $this->hasMany('App\PropertyOffer');
    }
    
    public function reports()
    {
        return $this->hasMany('App\PropertyReport');
    }
}

