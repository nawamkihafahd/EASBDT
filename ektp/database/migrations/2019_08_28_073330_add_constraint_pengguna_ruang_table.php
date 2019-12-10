<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstraintPenggunaRuangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::table('pengguna_ruang', function (Blueprint $table) {

			$table->foreign('pengguna_id')->references('id')->on('penggunas')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('ruang_id')->references('id')->on('ruangs')->onUpdate('cascade')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
