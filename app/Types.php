<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    //
    protected $fillable = [
        'name_ar','name_en', 'order', 'password', 'phone','active','deleted'
    ];
}
