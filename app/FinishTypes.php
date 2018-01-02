<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinishTypes extends Model
{
    //
    protected $fillable = [
        'name', 'order','active','deleted'
    ];
}
