<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_id',
        'code',
        'part',
        'title',
        'deadline',
        'hour',
        'responsable_id',
        'requester_id',
        'situation'
    ];

    protected $table = 'jobs';

    public function customer(){
        return $this->hasMany('App\Customer', 'id', 'customer_id');
    }

    public function responsableJob(){
        return $this->hasMany('App\User', 'id', 'responsable_id');
    }

    public function requesterJob(){
        return $this->hasMany('App\User', 'id', 'requester_id');
    }

    public function jobPart(){
        return $this->hasMany('App\JobPart', 'id', 'part_id');
    }

    public function jobSituation(){
        return $this->hasMany('App\JobSituation', 'id', 'situation_id');
    }

    public function jobBriefing(){
        return $this->hasMany('App\jobBriefing');
    }
}
