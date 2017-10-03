<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foundation extends Model
{
    //
    protected $primaryKey = 'foundation_id';
    public $incrementing = false;

    protected $fillable=['foundation_id','user_id','description','location','email','long','lat','facebook_url','website_url','verified'];


    public function activities(){
    	return $this->hasMany('App\Activity','foundation_id','foundation_id');
    }
}
