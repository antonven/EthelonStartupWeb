<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foundation extends Model
{
    //
    protected $primaryKey = 'foundation_id';
    public $incrementing = false;

    protected $fillable=['foundation_id','user_id','description','location','email','long','lat','facebook_url','website_url','verified','image_url'];

    public function user()
    {
    	return $this->hasOne('App\User', 'user_id', 'user_id');
    }

    public function activities(){
    	return $this->hasMany('App\Activity','foundation_id','foundation_id');
    }

    public function portfolio()
    {
        return $this->hasOne('App\Portfolio', 'foundation_id', 'foundation_id');
    }

}
