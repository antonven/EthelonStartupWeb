<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteercriteria extends Model
{
    //
     protected $fillable = ['activitygroups_id','volunteer_id','average_rating','activity_id','criteria_name','no_of_raters','sum_of_rating'];
}
