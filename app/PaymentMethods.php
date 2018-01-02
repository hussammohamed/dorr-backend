<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model
{
    //
    protected $fillable = [
        'name', 'order','active','deleted'
    ];
}
