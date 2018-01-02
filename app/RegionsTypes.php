<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegionsTypes extends Model
{
    //
    protected $fillable = [
        'name', 'order','active','deleted'
    ];
}
