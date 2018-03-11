<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $primary = 'id';
    protected $table = 'templates';
    protected $guarded = ['id'];

}
