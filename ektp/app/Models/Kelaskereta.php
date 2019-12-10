<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelaskereta extends Model
{
    //
	protected $fillable = ['nama'];
	
	public function tikets()
	{
		return $this->belongsToMany('App\Models\Tiket')->withPivot('nominal');
	}
}
