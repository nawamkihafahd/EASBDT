<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenggunaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggunas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_nik',16)->unique();
            $table->string('nama',50);
			$table->string('nrp',14)->unique();
			$table->string('jenis_kelamin',10);
            $table->string('alamat',100);
			$table->string('nohp',20)->unique();
			$table->string('email',75)->unique();
			$table->string('password',200);
            $table->string('uid_kartu', 100)->nullable();
			$table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengguna');
    }
}
