<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    //

    public function mproperty()
    {
        return $this->belongsTo('App\MProperty');
    }
    
    protected $fillable = [
        'm_property_id','unit_id','service_type','service','description','owner_response','min_fix_amount','laborer_pay','matrials_price','invoice_image','status'
    ];
}
