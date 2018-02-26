<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteeractivity extends Model
{
    //

    protected $fillable = ['volunteer_id','activity_id','status','volunteerTimedIn'];
    
    public function activity(){

    	return $this->hasOne('App\Activity','activity_id','activity_id');
   
    }
    
}
