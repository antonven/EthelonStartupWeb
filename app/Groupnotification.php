<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupnotification extends Model
{
    //

    protected $fillable=['volunteer_id','activity_id','date'];
    public $timestamps = false;
}
