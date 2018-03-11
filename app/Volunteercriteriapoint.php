<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteercriteriapoint extends Model
{
    //

    protected $fillable = ['activity_id',
                'volunteer_id',
                'criteria_name',
                'total_points',
                'no_of_raters',
                'average_points'];

}
