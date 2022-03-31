<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProsesResmisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proses_resmis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lamaran_id')->nullable();
            $table->string('lama')->nullable();
            $table->string('baru')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_akhir')->nullable();
            $table->string('status_verifikasi')->nullable();
            $table->string('dokumen')->nullable();
            $table->string('no_surat')->nullable();
            $table->string('sp')->nullable();
            $table->unsignedBigInteger('jenis_pelanggaran')->nullable();
    		$table->unsignedBigInteger('persus')->nullable();
            $table->string('gaji')->nullable();
            $table->string('modul')->nullable();
            $table->bigInteger('approved_by')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proses_resmis');
    }
}
