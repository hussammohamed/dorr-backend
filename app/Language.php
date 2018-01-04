<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
    protected $fillable = [
        'name','short_name','code', 'order','active','deleted'
    ];
}
