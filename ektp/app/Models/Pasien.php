<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    //
	protected $fillable = ['diagnosa', 'rs_rujukan', 'faskes_tingkat1', 'pengguna_id', 'nomor_antrian', 'rs_perujuk', 'poli'];
	
	public function pengguna()
	{
		return $this->belongsTo('App\Models\Pengguna');
	}
	
	public function polipasien()
	{
		return $this->belongsTo('App\Models\Poli', 'poli');
	}
}
