<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    //
	protected $fillable = ['nama', 'ruang_id', 'mode'];
	public function pendaftarans()
    {
        return $this->hasMany('App\Models\Pendaftaran');
    }
	public function ruang()
    {
        return $this->belongsTo('App\Models\Ruang');
    }
	public function transaksis()
    {
        return $this->hasMany('App\Models\Transaksi');
    }
	public function parkirs()
	{
		return $this->hasMany('App\Models\Parkir');
	}
}
