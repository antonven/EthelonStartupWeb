<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    //
    protected $primaryKey = 'volunteer_id';
    public $incrementing = false;

    protected $fillable = ['volunteer_id','user_id','location','image_url','points','fcm_token','age'];

    public function activitiesJoined(){
    	return $this->hasMany('App\Volunteeractivity', 'volunteer_id', 'volunteer_id');
    }

    public function volunteerSkills(){
    	return $this->hasMany('App\Volunteerskill','volunteer_id','volunteer_id');
    }


}
