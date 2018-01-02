<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Overlooks extends Model
{
    //
    protected $fillable = [
        'name', 'order','active','deleted'
    ];
}
