<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToLamaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lamarans', function (Blueprint $table) {
            $table->string('status_lamaran')->nullable()->after('status_karyawan');
            $table->string('status_dokumen')->nullable()->after('status_karyawan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lamarans', function (Blueprint $table) {
            //
        });
    }
}
