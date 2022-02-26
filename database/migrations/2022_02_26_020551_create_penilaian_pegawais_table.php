<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianPegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_pegawais', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pegawai_id')->nullable();
            $table->bigInteger('kantor')->nullable();
            $table->bigInteger('jabatan')->nullable();
            $table->date('tanggal')->nullable();
            $table->bigInteger('penilai')->nullable();
            $table->string('nilai')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
    		$table->unsignedBigInteger('updated_by')->nullable();
    		$table->unsignedBigInteger('deleted_by')->nullable();
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
        Schema::dropIfExists('penilaian_pegawais');
    }
}
