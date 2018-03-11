<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $primaryKey='activity_id';
    public $incrementing = false;

    protected $fillable=['activity_id','foundation_id','name','image_url','imageQr_url','description','location','start_time','end_time','startDate','group', 'long', 'lat', 'points_equivalent','status','created_at','endDate','registration_deadline','contact','contactperson','volunteersNeeded','group_type'
    ];

    public function foundation(){

    	return $this->belongsTo('App\Foundation','foundation_id','foundation_id');
            
    }

    public function skills(){
    	return $this->hasMany('App\Activityskill','activity_id','activity_id');
    }

    public function groups(){
        return $this->hasMany('App\Activitygroup','activity_id','activity_id');
    }

    public function criteria(){
        return $this->hasMany('App\Activitycriteria', 'activity_id', 'activity_id');
    }

    public function scopeInactive($query)
    {
        return $query->where('active', 1);
    }

}
