<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteerskill extends Model
{
    //
    public $timestamps = false;

    protected $fillable=['name','volunteer_id'];
}
