<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    //
	protected $fillable = ['uid', 'tipe', 'alat_id', 'pengguna_id'];
	
	public function pengguna()
    {
        return $this->belongsTo('App\Models\Pengguna');
    }
	public function alat()
    {
        return $this->belongsTo('App\Models\Alat');
    }
	public function ruangs()
    {
        return $this->belongsToMany('App\Models\Ruang');
    }
}
