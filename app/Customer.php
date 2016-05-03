<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'cnpj'
    ];

    protected $table = 'customers';

    public function address(){
        return $this->hasMany('App\CustomerAddress');
    }
}
