<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account_role extends Model
{
    protected $table='account_roles';
    protected $fillable=['account_id','role_id','time_plan_id'];

     public function time_plan()
	{
	return $this->belongsTo('App\Models\Timeplan','time_plan_id');
	}
    
}
