<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyReport extends Model
{
    //
    protected $fillable = [
        'property_id','user_id','comment', 'active','deleted'
    ];
}
