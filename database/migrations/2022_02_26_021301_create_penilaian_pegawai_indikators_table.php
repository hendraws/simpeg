<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianPegawaiIndikatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_pegawai_indikators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penilaian_pegawai_id')->nullable();
            $table->unsignedBigInteger('indikator_id')->nullable();
            $table->string('nilai')->nullable();
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
        Schema::dropIfExists('penilaian_pegawai_indikators');
    }
}
