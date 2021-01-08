<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianSKP extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // tabel penilaian SKP
        Schema::create('penilaian_skp', function (Blueprint $table) {
            $table->id();
            $table->integer("id_header");
            $table->integer("id_detail");
            $table->integer("angka_kredit");
            $table->integer("kual_mutu");
            $table->string("kuant_output");
            $table->integer("biaya");
            $table->string("waktu");
            $table->integer("perhitungan")->nullable();
            $table->integer("nilai_capaian")->nullable();
            $table->timestamps();
        });
        
        // tabel penilaian�perilaku kerja
        Schema::create('penilaian_perilaku_kerja', function (Blueprint $table) {
            $table->id();
            $table->integer("id_header");
            $table->integer("id_detail");
            $table->integer("pelayanan");
            $table->integer("intergritas");
            $table->integer("komitmen");
            $table->integer("disiplin");
            $table->integer("kerjasama");
            // Jumlah pakek sum()
            // rata-rata average(sum())
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
        Schema::dropIfExists('penilaian_skp');
        Schema::dropIfExists('penilaian_perilaku_kerja');
    }
}
