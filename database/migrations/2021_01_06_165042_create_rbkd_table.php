<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRbkdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rbkd', function (Blueprint $table) {
            $table->bigIncrements('No');
            $table->string('Bidang');
            $table->text('Jenis_Kegiatan');
            $table->text('Bukti_Penugasan');
            $table->integer('SKS_RBKD');
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
        Schema::dropIfExists('rbkd');
    }
}
