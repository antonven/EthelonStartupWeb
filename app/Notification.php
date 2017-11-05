<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $fillable = ['id','title','body','data','major_type','sub_type'];
}
