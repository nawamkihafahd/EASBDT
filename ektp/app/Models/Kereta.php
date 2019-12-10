<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kereta extends Model
{
    //
	protected $fillable = ['nama', 'kapasitas'];
	
	public function tikets()
	{
		return $this->hasMany('App\Models\Tiket');
	}
	
}
