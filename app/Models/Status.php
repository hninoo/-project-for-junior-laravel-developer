<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table='statuses';
    protected $fillable=['status_name'];

	public function check()
	{
		return $this->belongsToMany('App\Models\Check','check_statuses');
	}

	public function check_status()
	{
		return $this->hasmany('App\Models\Check_status');
	}

	public function leave_absent()
	{
		return $this->hasmany('App\Models\Leave_absent');
	}
}
