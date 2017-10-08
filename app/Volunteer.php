<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    //
    protected $primaryKey = 'volunteer_id';
    public $incrementing = false;

    protected $fillable = ['volunteer_id','user_id','location','image_url','points','fcm_token'];

    public function activitiesJoined(){
    	return $this->hasMany('App\Volunteer', 'volunteer_id', 'activity_id');
    }

    public function volunteerSkills(){
    	return $this->hasMany(Volunteerskills::class);
    }


}
