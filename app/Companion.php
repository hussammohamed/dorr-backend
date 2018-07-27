<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companion extends Model
{
    //
    public function contract()
    {
        return $this->belongsTo('App\Contract');
    }

    protected $fillable = [
        'name','id_type','id_no','nationality','relation','mobile','email'
    ];
}
