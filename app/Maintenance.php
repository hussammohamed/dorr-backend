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
        'm_property_id','unit_id','service_type','service','description','owner_response','min_fix_amount',
        'laborer_pay','matrials_price','invoice_image','status'
    ];

    protected $casts = [
        'm_property_id' => 'integer', 'unit_id' => 'integer', 
        'service_type' => 'integer', 'owner_response' => 'integer', 
        'min_fix_amount' => 'integer', 'laborer_pay' => 'integer', 
        'matrials_price' => 'integer', 'status' => 'integer'
    ];
}
