<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logtransaksi extends Model
{
    //
	protected $fillable = ['log_id', 'nominal', 'usaha_id'];
	public function logs()
	{
		return $this->belongsTo('App\Models\Logs');
	}
}
