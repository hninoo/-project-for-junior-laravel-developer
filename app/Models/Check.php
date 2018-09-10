<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
     protected $table='checks';
    protected $fillable=['date','check_in_time','check_out_time','manhour','account_id','time_plan_id'];
    
    public function account()
	{
	return $this->belongsTo('App\Models\Account','account_id');
	}
	
	public function check_status()
    {
    	return $this->hasmany('App\Models\Check_status');
    }
}


