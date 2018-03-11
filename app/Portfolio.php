<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
	protected $primary = 'id';
    protected $guarded = ['id'];
    protected $table = 'portfolio';

    public function templates()
    {
    	return $this->hasMany('App\Template','portfolio_id','id');
    }

}
