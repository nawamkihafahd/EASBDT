<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    //
	protected $fillable = ['nama', 'no_antri', 'index_antri'];
	
	public function pasien()
	{
		return $this->belongsTo('App\Models\Poli', 'poli');
	}
}
