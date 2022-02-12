<?php

namespace Database\Seeders;

use App\Models\RefOption;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['key'=>'SD', 'option'=>'SD', 'modul' => 'jenjang_pendidikan'],
            ['key'=>'SMP', 'option'=>'SMP', 'modul' => 'jenjang_pendidikan'],
            ['key'=>'SMA/SMK', 'option'=>'SMA/SMK', 'modul' => 'jenjang_pendidikan'],
            ['key'=>'D3', 'option'=>'D3', 'modul' => 'jenjang_pendidikan'],
            ['key'=>'S1', 'option'=>'S1', 'modul' => 'jenjang_pendidikan'],
            ['key'=>'S2', 'option'=>'S2', 'modul' => 'jenjang_pendidikan'],
            ['key'=>'S3', 'option'=>'S3', 'modul' => 'jenjang_pendidikan'],
            ['key'=>'ISLAM', 'option'=>'ISLAM', 'modul' => 'agama'],
            ['key'=>'PROTESTAN', 'option'=>'PROTESTAN', 'modul' => 'agama'],
            ['key'=>'KATOLIK', 'option'=>'KATOLIK', 'modul' => 'agama'],
            ['key'=>'HINDU', 'option'=>'HINDU', 'modul' => 'agama'],
            ['key'=>'BUDDHA', 'option'=>'BUDDHA', 'modul' => 'agama'],
            ['key'=>'KONGHUCU', 'option'=>'KONGHUCU', 'modul' => 'agama'],
            ['key'=>'Belum-Menikah', 'option'=>'Belum Menikah', 'modul' => 'status_pernikahan'],
            ['key'=>'Sudah-Menikah', 'option'=>'Sudah Menikah', 'modul' => 'status_pernikahan'],
            ['key'=>'Bercerai', 'option'=>'Bercerai', 'modul' => 'status_pernikahan'],
        ];

        foreach($data as $key => $value){
            RefOption::updateOrCreate([
                'key' => $value['key']
            ], 
            [
                'option' => $value['option'],
                'modul' => $value['modul'],
            ]);
        }        

    }
}
