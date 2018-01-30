<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteerbadge extends Model
{
    //
	protected $fillable = ['badge','volunteer_id','gaugeExp','star','skill','points'];

	public $timestamps = false;
	

}
