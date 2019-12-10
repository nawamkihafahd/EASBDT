<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logparkir extends Model
{
    //
	protected $fillable = ['parkir_id', 'pengguna_id', 'log_id', 'paid'];
}
