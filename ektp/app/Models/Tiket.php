<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    //
	protected $fillable = ['kereta_id', 'kota_asal', 'kota_tujuan', 'tanggal_berangkat',  'check_in'];
	
	public function penggunas()
	{
		return $this->belongsToMany('App\Models\Pengguna')->withPivot('nomor_kursi', 'kelaskereta_id');
	}
	public function kereta()
	{
		return $this->belongsTo('App\Models\Kereta');
	}
	public function kelas()
	{
		return $this->belongsToMany('App\Models\Kelaskereta')->withPivot('nominal');
	}
	public function asal()
	{
		return $this->belongsTo('App\Models\Kota', 'kota_asal');
	}
	public function tujuan()
	{
		return $this->belongsTo('App\Models\Kota', 'kota_tujuan');
	}
}
