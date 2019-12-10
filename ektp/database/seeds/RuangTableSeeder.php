<?php

use Illuminate\Database\Seeder;

class RuangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \App\Models\Ruang::create([
            'id' => 1,
            'nama' => 'LAB MI'
        ]);
    }
}
