<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bpjs extends Model
{
    //
	protected $fillable = ['pengguna_id', 'batas_pembayaran'];
	
	public function pengguna()
	{
		return $this->belongsTo('App\Models\Pengguna');
	}
}
