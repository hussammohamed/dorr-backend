<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{

    protected $fillable = [];

    public function contract_units()
    {
        return $this->hasMany('App\ContractUnit');
    }
}
