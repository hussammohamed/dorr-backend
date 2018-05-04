<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    //
    protected $fillable = [
        'user_id','commercial_register_name','commercial_register_no','commercial_register_address','commercial_register_issuer',
        'commercial_register_date','commercial_register_exp_date','phone','fax'
    ];
}
