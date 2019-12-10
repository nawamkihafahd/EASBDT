<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    //
	protected $fillable = ['nama'];
	public function alats()
    {
        return $this->hasMany('App\Models\Alat');
    }
	public function penggunas()
    {
        return $this->belongsToMany('App\Models\Pengguna');
    }
}
