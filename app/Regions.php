<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regions extends Model
{
    //
    protected $fillable = [
        'name_ar','name_en', 'parent', 'type', 'order','active','deleted'
    ];
}
