<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteerafteractivity extends Model
{
    //
    protected $fillable=['volunteer_id','activity_id'];
    public $timestamps = false;
}
