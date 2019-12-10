<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class Pengguna extends Authenticatable
{
	use Notifiable;
	protected $guard = 'pendaftar';
    protected $fillable = ['id_nik', 'name', 'nrp', 'nohp', 'jenis_kelamin', 'alamat', 'email',
    'password', 'uid_kartu', 'status', 'active'];
	/*
	public function showKtp ()
    {
        if (Storage::exists($this->foto_ktp)) {
            return "storage/$this->foto_ktp";
        }
        return asset('static/admin/img/default.png');
    }
	
	public function showBersamaKtp ()
    {
        if (Storage::exists($this->foto_bersamaktp)) {
            return "storage/$this->foto_bersamaktp";
        }
        return asset('static/admin/img/default.png');
    }
	*/
	public function kartus()
    {
        return $this->hasMany('App\Models\Kartu');
    }
	public function pendaftarans()
    {
        return $this->hasMany('App\Models\Pendaftaran');
    }
	public function ruangs()
    {
        return $this->belongsToMany('App\Models\Ruang');
    }
	public function bpjs()
	{
		return $this->hasMany('App\Models\Bpjs');
	}
	public function pasiens()
	{
		return $this->hasMany('App\Models\Pasien');
	}
	public function tikets()
	{
		return $this->belongstoMany('App\Models\Tiket')->withPivot('nomor_kursi', 'kelaskereta_id', 'check_in');
	}
	public function parkirs()
	{
		return $this->belongstoMany('App\Models\Tiket')->withPivot('waktu_masuk');
	}
	
}
