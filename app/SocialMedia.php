<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    //
    protected $fillable = [
        'name','alias','link','target','order','active','deleted'
    ];
}
