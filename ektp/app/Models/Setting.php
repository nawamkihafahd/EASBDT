<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
	protected $primaryKey = null;
	protected $fillable = ['index_antrian', 'nomor_antrian', 'id_alat', 'rs_nama'];
}
