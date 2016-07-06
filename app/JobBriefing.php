<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobBriefing extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'job_id',
        'briefing'
    ];

    protected $table = 'job_briefings';

    public function job(){
        return $this->belongsTo('App\Job');
    }

}
