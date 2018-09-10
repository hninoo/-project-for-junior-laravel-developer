<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave_absent extends Model
{
    protected $table='leave_absents';
    protected $fillable=['start_date','end_date','reason','number_of_day','request_date','request_status','status_id','account_id'];

	public function account()
	{
		return $this->belongsTo('App\Models\Account','account_id');
	}
	public function status()
	{
		return $this->belongsTo('App\Models\Status','status_id');
	}
}