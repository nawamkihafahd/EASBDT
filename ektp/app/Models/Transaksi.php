<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
	protected $primaryKey = null;
	public $incrementing = false;
	protected $fillable = ['uid', 'alat_id', 'log_id'];
	public function alat()
    {
        return $this->belongsTo('App\Models\Alat');
    }
}
