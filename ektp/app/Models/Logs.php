<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Logs extends Model
{
    //
	protected $fillable =['uid_kartu', 'hasil', 'nama', 'tipe_kartu', 'ruangan', 'mode', 'url_gambar'];
	
	public function showImage ()
    {
        if (Storage::exists($this->url_gambar)) {
            return "storage/$this->url_gambar";
        }
        return asset('static/admin/img/default.png');
    }
	
	public function logtransaksis()
	{
		return $this->hasMany('App\Models\Logtransaksi');
	}
}
