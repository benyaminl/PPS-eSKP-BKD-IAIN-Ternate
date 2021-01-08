<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBkd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identitas_dosen', function (Blueprint $table) {
            $table->id();
            $table->string('No_Sertifikat');
            $table->string('NIP');
            $table->string('NIDN');
            $table->string('Nama');
            $table->string('Nama_PT');
            $table->text('Alamat_PT');
            $table->string('Fak_Dept');
            $table->string('Prog_Studi');
            $table->string('Jab_Fungsional');
            $table->string('Golongan');
            $table->date('Tgl_Lahir');
            $table->string('Tempat_Lahir');
            $table->string('S1');
            $table->string('S2');
            $table->string('S3');
            $table->string('Jenis');
            $table->string('Bidang_Ilmu');
            $table->string('No_HP');
            $table->string('Tahun_Akademik');
            $table->string('Semester');
            $table->string('Asesor1');
            $table->string('Asesor2');
            $table->string('Email');
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
        Schema::dropIfExists('bkd');
    }
}
