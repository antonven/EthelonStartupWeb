<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification_user extends Model
{
    //
    protected $fillable = ['id','notification_id','sender_id','date'];

    public $timestamps = false;	
}
