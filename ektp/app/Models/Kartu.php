<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kartu extends Model
{
    //
	protected $fillable = ['pengguna_id', 'uid', 'tipe'];
	
	public function pengguna()
    {
        return $this->belongsTo('App\Models\Pengguna');
    }
}
