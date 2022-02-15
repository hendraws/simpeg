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
            ['key'=>'belum-diverifikasi', 'option'=>'Belum Diverikasi', 'modul' => 'status_dokumen'],
            ['key'=>'terverifikasi', 'option'=>'Terverifikasi', 'modul' => 'status_dokumen'],
            ['key'=>'diterima', 'option'=>'diterima', 'modul' => 'status_lamaran'],
            ['key'=>'ditolak', 'option'=>'ditolak', 'modul' => 'status_lamaran'],
            ['key'=>'interview', 'option'=>'interview', 'modul' => 'status_lamaran'],
            ['key'=>'menunggu-verifikasi', 'option'=>'Sedang Di Verifikasi', 'modul' => 'status_lamaran'],
            ['key'=>'masuk-lamaran', 'option'=>'Masuk Lamaran', 'modul' => 'status_karyawan'],
            ['key'=>'calon-pdl', 'option'=>'Calon PDL', 'modul' => 'status_karyawan'],
            ['key'=>'PDL', 'option'=>'PDL', 'modul' => 'status_karyawan'],
            ['key'=>'mutasi', 'option'=>'Mutasi', 'modul' => 'status_karyawan'],
            ['key'=>'promosi', 'option'=>'Promosi', 'modul' => 'status_karyawan'],
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
