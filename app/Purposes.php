<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purposes extends Model
{
    //
    protected $fillable = [
        'name', 'order','active','deleted'
    ];
}
