<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLamaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table('lamarans', function (Blueprint $table) {
            $table->string('no_tiket')->nullable()->change();
            $table->string('nik')->nullable()->change();
            $table->string('nama')->nullable()->change();
            $table->string('tempat')->nullable()->change();
            $table->date('tanggal_lahir')->nullable()->change();
            $table->text('alamat')->nullable()->change();
            $table->string('pendidikan_terakhir')->nullable()->change();
            $table->string('agama')->nullable()->change();
            $table->string('status')->comment('status_pernikahan')->nullable()->change();
            $table->string('no_hp')->nullable()->change();
            $table->string('no_hp_darurat')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->bigInteger('jabatan')->nullable()->change();
            $table->string('usia')->nullable()->change()->comment('usia Pelamar');
            $table->string('tekanan')->nullable()->change()->comment('sanggup_bekerja_dalam_tekanan');
            $table->string('tim')->nullable()->change()->comment('sanggup_bekerja_dengan_tim');
            $table->string('tempat_cabang')->nullable()->change()->comment('sanggup_bekerja_dengan_cabang_manapun');
            $table->string('peraturan')->nullable()->change()->comment('sanggup_menaati_peraturn');
            $table->string('surat_lamaran')->nullable()->change();
            $table->string('surat_pernyataan')->nullable()->change();
            $table->string('surat_tanggung_jawab')->nullable()->change()->comment('surat penanggung jawab orang tua');
            $table->string('ijazah')->nullable()->change()->comment('Ijazah Terkahir');
            $table->string('cv')->nullable()->change()->comment('Daftar Riwayat Hidup / cv');
            $table->string('skck')->nullable()->change()->comment('Daftar Riwayat Hidup / cv');
            $table->string('foto')->nullable()->change()->comment('Foto 4x6');
            $table->string('sim')->nullable()->change()->nullable()->comment('Daftar Riwayat Hidup / cv');
            $table->string('ktp')->nullable()->change()->comment('Daftar Riwayat Hidup / cv');
            $table->string('ktp_orangtua')->nullable()->change()->comment('Daftar Riwayat Hidup / cv');
            $table->string('kk')->nullable()->change()->comment('Daftar Riwayat Hidup / cv');
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
