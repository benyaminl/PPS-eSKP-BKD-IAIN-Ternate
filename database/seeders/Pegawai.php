<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Pegawai extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Adding Data Pegawai dan Hubungan Pegawai 
        DB::insert("INSERT INTO pegawai(nama, email, jabatan, password, username, nip, pangkat, golongan) 
                    ('Benyamin','ben@stts.edu', 'Dosen', ".password_hash("123", PASSWORD_DEFAULT).", 
                    'ben', '123456789', 'Lektor', 'IIA')");

        DB::insert("INSERT INTO pegawai(nama, email, jabatan, password, username, nip, pangkat, golongan) 
                    ('Rahman','rahman@iain-ternate.ac.id', 'Kepala Jurusan', ".password_hash("123", PASSWORD_DEFAULT).", 
                    'rahman', '223456789', 'Lektor Kepala', 'IID')");
        
        DB::insert("INSERT INTO pegawai(nama, email, jabatan, password, username, nip, pangkat, golongan) 
                    ('Admin SKP','admin@iain-ternate.ac.id', 'Admin SKP', ".password_hash("123", PASSWORD_DEFAULT).", 
                    'adminskp', '223456789', '-', 'IA')");

        // Hubungan pegawai 
        DB::insert("INSERT INTO hubungan_pegawai(2,1)");
    }
}
