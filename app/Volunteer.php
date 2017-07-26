<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    //
    protected $primaryKey = 'volunteer_id';
    public $incrementing = false;

    protected $fillable = ['volunteer_id','user_id','location','image_url','points'];

    public function activitiesJoined(){
    	return $this->hasMany(Volunteerafteractivity::class);
    }

    public function volunteerSkills(){
    	return $this->hasMany(Volunteerskills::class);
    }


}
