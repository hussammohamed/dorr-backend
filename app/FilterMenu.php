<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilterMenu extends Model
{
    //
    protected $fillable = [
        'name_ar','name_en','purpose','type','order','active','deleted'
    ];
}
