<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSituation extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'name'
    ];

    protected $table = 'job_situations';

    public function job(){
        return $this->belongsTo('App\Job');
    }
}
