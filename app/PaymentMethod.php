<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    //
    protected $fillable = [
        'name_ar','name_en', 'order','active','deleted'
    ];
}
