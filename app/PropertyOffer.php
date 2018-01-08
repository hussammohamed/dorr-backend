<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyOffer extends Model
{
    //
    protected $fillable = [
        'property_id','description','price', 'user_id','active','deleted'
    ];
}
