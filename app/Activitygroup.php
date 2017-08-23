<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activitygroup extends Model
{
    //
    protected $fillable=['id','activity_id','numOfVolunteers'];
    public $incrementing = false; 
    public $timestamps = false;

    public function volunteergroups(){
    	return $this->hasMany('App\Volunteergroup','activity_groups_id','id');			
    }

    public function activity(){
    	return $this>belongsTo('App\Activity','activity_id','activity_id');
    }

}
