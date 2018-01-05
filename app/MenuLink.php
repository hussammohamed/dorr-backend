<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuLink extends Model
{
    //
    protected $fillable = [
        'menu_id','name_ar','name_en', 'link','target','order','active','deleted'
    ];

}
