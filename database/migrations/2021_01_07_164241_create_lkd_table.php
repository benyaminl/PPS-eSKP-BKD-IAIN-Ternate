<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLkdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lkd', function (Blueprint $table) {
            $table->bigIncrements('No');
            $table->string('Masa_Penugasan');
            $table->binary('Bukti_Dokumen');
            $table->integer('SKS_LKD');
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
        Schema::dropIfExists('lkd');
    }
}
