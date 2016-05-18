<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerContact extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_id',
        'name_contact',
        'phone',
        'cell'
    ];

    protected $table = 'customer_contacts';

    public function customer(){
        return $this->belongsTo('App\Customer');
    }
}
