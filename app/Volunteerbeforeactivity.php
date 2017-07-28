<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteerbeforeactivity extends Model
{
    //
    protected $fillable=['volunteer_id','activity_id'];
    public $timestamps = false;
}
