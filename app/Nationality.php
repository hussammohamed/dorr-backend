<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    //
    protected $fillable = [
        'name_ar','name_en', 'order','active','deleted'
    ];
}
