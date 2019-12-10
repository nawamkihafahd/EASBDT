<?php

use Illuminate\Database\Seeder;

class AlatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \App\Models\Alat::create([
            'id' => 1,
            'nama' => 'JusTap1',
			'ruang_id' => 1
        ]);
    }
}
