<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'cnpj',
        'image',
        'active'
    ];

    protected $table = 'customers';

    public function address(){
        return $this->hasMany('App\CustomerAddress');
    }

    public function contact(){
        return $this->hasMany('App\CustomerContact');
    }
}
