<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $table='days';
    protected $fillable=['day_name','office_time_id','time_plan_id'];

	public function timeplan()
	{
		return $this->belongsTo('App\Models\Timeplan','time_plan_id');
	}
	public function office_time()
	{
		return $this->belongsTo('App\Models\Officetime','office_time_id');
	}
}