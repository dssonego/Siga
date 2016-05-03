<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_id',
        'zipcode',
        'street',
        'complement',
        'neighborhood',
        'city',
        'state'
    ];

    public $timestamps = false;

    protected $table = 'customer_addresses';

    public function customer(){
        return $this->belongsTo('App\Customer');
    }
    
}
