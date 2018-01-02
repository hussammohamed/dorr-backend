<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    //
    protected $fillable = [
        'type','purpose','title','ownerID','address','region','lat','long','description','price',
        'pricePerMeter','dateOfConstruction','area','floor','finishType','overlooks','paymentMethods',
        'rooms','bathrooms','adID','hits','youtube','advertiserType','dateOfPublication','startDate',
        'endDate','featured','active','deleted'
    ];
}

