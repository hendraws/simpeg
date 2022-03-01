<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pegawai_id')->nullable();
            $table->bigInteger('atasan')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('nama_kegiatan')->nullable();
            $table->text('detail_kegiatan')->nullable();
            $table->text('tujuan_kegiatan')->nullable();
            $table->text('kendala')->nullable();
            $table->text('penyelesaian_masalah')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
    		$table->unsignedBigInteger('created_by')->nullable();
    		$table->unsignedBigInteger('updated_by')->nullable();
    		$table->unsignedBigInteger('deleted_by')->nullable();
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
        Schema::dropIfExists('laporans');
    }
}
