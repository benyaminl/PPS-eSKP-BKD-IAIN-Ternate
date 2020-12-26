<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSKP extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header_skp', function (Blueprint $table) {
            $table->id();
            $table->date("tanggal_awal");
            $table->date("tanggal_akhir");
            $table->timestamp("tanggal_draft")->default(DB::raw("current_timestamp"));
            $table->timestamp("tanggal_pengajuan")->nullable();
            $table->integer("disahkan_oleh")->nullable();
            $table->timestamp("tanggal_pengesahan")->nullable();
            $table->integer("divalidasi_oleh")->nullable();
            $table->integer("status_skp")->default(0);
            $table->integer("id_pegawai");
            $table->timestamps();
        });

        Schema::create('detail_skp', function (Blueprint $table) {
            $table->id();
            $table->integer("id_header");
            $table->string("tugas_jabatan");
            $table->integer("angka_kredit");
            $table->integer("kual_mutu");
            $table->string("kuant_output");
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
        Schema::dropIfExists('hedaer_skp');
        Schema::dropIfExists('detail_skp');
    }
}
