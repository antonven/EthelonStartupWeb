<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteeractivity extends Model
{
    //

    protected $fillable = ['volunteer_id','activity_id','status','volunteerTimedIn','timeIn'];
    
    public function activity(){

    	return $this->hasOne('App\Activity','activity_id','activity_id');
   
    }

    public function volunteer()
    {
    	return $this->hasOne('App\Volunteer','volunteer_id','volunteer_id');
    }
    
}
