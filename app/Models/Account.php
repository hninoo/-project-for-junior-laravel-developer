<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table='accounts';
    protected $fillable=['account_name','email','password','phone','address','dob','nrc','active'];
    	
    	public function role()
		{
			return $this->belongsToMany('App\Models\Role','account_roles');
		}


		public function check()
		{
			return $this->hasMany('App\Models\Check');
		}

		public function leave_absent()
		{
			return $this->hasmany('App\Models\Leave_absent');
		}
}
