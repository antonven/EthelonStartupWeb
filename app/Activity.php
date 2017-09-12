<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $primaryKey='activity_id';
    public $incrementing = false;

    protected $fillable=['activity_id','foundation_id','name','image_url','imageQr_url','description','location','start_time','end_time','startDate','group', 'long', 'lat', 'points_equivalent','status','created_at','endDate','registration_deadline','contact','contactperson'
    ];

    public function foundation(){

    	return $this->belongsTo('App\Foundation','activity_id','activity_id');
            
    }

    public function skills(){
    	return $this->hasMany('App\Activityskill','activity_id','activity_id');
    }

    public function groups(){
        return $this->hasMany('App\Activitygroup','activity_id','activity_id');
    }

}
