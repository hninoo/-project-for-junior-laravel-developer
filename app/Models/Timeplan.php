<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeplan extends Model
{
	protected $table='time_plans';
    protected $fillable=['time_plan_name'];

	// public function check_in_out()
	// {
	// 	return $this->hasMany('App\Models\Check_in_out');
	// }
	// public function day()
	// {
	// 	return $this->hasMany('App\Models\Day');
	// }
	public function account_role()
	{
		return $this->hasMany('App\Models\Account_role');
	}
}