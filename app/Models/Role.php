<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table='roles';
    protected $fillable=['role_name'];

	public function account()
		{
			return $this->belongsToMany('App\Models\Account','account_roles');
		}
}