<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Check_status extends Model
{
    protected $table='check_statuses';
    protected $fillable=['check_id','status_id'];
    
    public function check()
    {
    	return $this->belongsTo('App\Models\Check','check_id');
    }
   public function status()
	{
		return $this->belongsTo('App\Models\Status','status_id');
	}

	public function late()
	{
		return $this->hasmany('App\Models\Late');
	}

	public function leave_absent()
	{
		return $this->hasmany('App\Models\Leave_absent');
	}
}
