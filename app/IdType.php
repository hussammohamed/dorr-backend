<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdType extends Model
{
    //
    protected $fillable = [
        'name', 'order','active','deleted'
    ];
}
