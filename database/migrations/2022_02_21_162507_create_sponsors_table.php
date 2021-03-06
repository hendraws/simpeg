<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
        	$table->bigInteger('lamaran_id');
    		$table->date('tanggal_mulai')->nullable();
    		$table->date('tanggal_akhir')->nullable();
    		$table->unsignedBigInteger('kantor_tugas')->nullable();
    		$table->string('keterangan')->nullable();
    		$table->string('sk')->nullable();
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
        Schema::dropIfExists('sponsors');
    }
}
