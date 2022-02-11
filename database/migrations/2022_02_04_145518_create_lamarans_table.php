<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLamaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lamarans', function (Blueprint $table) {
            $table->id();
            $table->string('no_tiket');
            $table->string('nama');
            $table->string('tempat');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('pendidikan_terakhir');
            $table->string('agama');
            $table->string('status');
            $table->string('no_hp');
            $table->string('no_hp_darurat');
            $table->string('email');
            $table->bigInteger('jabatan');
            $table->string('usia')->comment('usia Pelamar');
            $table->string('tekanan')->comment('sanggup_bekerja_dalam_tekanan');
            $table->string('tim')->comment('sanggup_bekerja_dengan_tim');
            $table->string('tempat_cabang')->comment('sanggup_bekerja_dengan_cabang_manapun');
            $table->string('peraturan')->comment('sanggup_menaati_peraturn');            
            $table->string('surat_lamaran');            
            $table->string('surat_pertanyaan');            
            $table->string('surat_tanggung_jawab')->comment('surat penanggung jawab orang tua');            
            $table->string('ijazah')->comment('Ijazah Terkahir');            
            $table->string('cv')->comment('Daftar Riwayat Hidup / cv');            
            $table->string('skck')->comment('Daftar Riwayat Hidup / cv');            
            $table->string('foto')->comment('Foto 4x6');            
            $table->string('sim')->nullable()->comment('Daftar Riwayat Hidup / cv');            
            $table->string('ktp')->comment('Daftar Riwayat Hidup / cv');            
            $table->string('ktp_orangtua')->comment('Daftar Riwayat Hidup / cv');            
            $table->string('kk')->comment('Daftar Riwayat Hidup / cv');            
            $table->string('status_karyawan')->nullable();            
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
        Schema::dropIfExists('lamarans');
    }
}
