<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    //
    protected $fillable = ['url','skill','badge'];
    public $timestamps = false;
    
}
