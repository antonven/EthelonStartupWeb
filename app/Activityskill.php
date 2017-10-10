<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activityskill extends Model
{
    //
    protected $fillable = ['name','activity_id'];


    public function activity(){
    	return $this->belongsTo('\App\Activity','activity_id','activity_id');
    }

}
