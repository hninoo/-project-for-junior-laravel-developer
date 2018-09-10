<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Late extends Model
{
    protected $table='lates';
    protected $fillable=['reason','check_status_id'];

	public function check_status()
	{
		return $this->belongsTo('App\Models\Checkstatus','check_status_id');
	}
}