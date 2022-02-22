<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMutasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('mutasis', function (Blueprint $table) {
    		$table->id();
    		$table->bigInteger('lamaran_id');
    		$table->string('kantor_awal')->nullable();
    		$table->string('kantor_baru')->nullable();
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
    	Schema::dropIfExists('mutasis');
    }
}
