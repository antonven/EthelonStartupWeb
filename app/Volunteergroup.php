<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteergroup extends Model
{
    //
    protected $fillable = ['activity_groups_id','volunteer_id'];

   	public function activtygroup(){
   		return $this->belongsTo('App/Activitygroup','activity_groups_id','id');
   	}

}
