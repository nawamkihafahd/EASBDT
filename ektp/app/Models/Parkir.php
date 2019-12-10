<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parkir extends Model
{
    //
	protected $fillable = ['nama', 'alat_id', 'kapasitas', 'open', 'isi', 'harga_dasar', 'harga_tambahan'];
	
	public function penggunas()
	{
		return $this->belingsToMany('App\Models\Pengguna')->withPivot('waktu_masuk');
	}
	public function alat()
	{
		return $this->hasMany('App\Models\Alat');
	}
}
