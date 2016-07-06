<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobPart extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'name'
    ];

    protected $table = 'job_parts';

    public function job(){
        return $this->belongsTo('App\Job');
    }
}
