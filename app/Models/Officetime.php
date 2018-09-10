<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Officetime extends Model
{
    protected $table='office_times';
    protected $fillable=['start_time','end_time','allow_time'];

	public function day()
	{
		return $this->hasMany('App\Models\Day');
	}
}