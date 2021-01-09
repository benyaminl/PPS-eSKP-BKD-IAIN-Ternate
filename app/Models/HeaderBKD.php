<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderBKD extends Model
{
    use HasFactory;

    # const CREATED_AT = 'insert_date';
    # const UPDATED_AT = 'update_date';
    protected $primaryKey = 'id';
    protected $table = 'header_bkd';
    protected $casts = [
        'tanggal_validasi' => 'datetime',
        'tanggal_pengajuan' => 'datetime',
        'tanggal_pengesahan' => 'datetime',
        'tanggal_awal' => 'datetime',
        'tanggal_akhir' => 'datetime',
        'tanggal_draft' => 'datetime'
    ];

    public function Pegawai()
    {
        return $this->hasOne("App\Models\Pegawai", "id", "id_pegawai");
    }

    public function Atasan()
    {
        return $this->hasOneThrough(
            "App\Models\Pegawai",
            "App\Models\HubunganPegawai",
            "id_bawahan", // ID di HubunganPegawai / Tabel Penengah
            "id", // ID di Tabel Pegawai
            "id_pegawai", // ID Di Class HeaderSKP / tabel ini
            "id_atasan" // ID join nya, di join hubunganPegawai dan Pegawai on pegawai.id = hubungan_pegawai.id_atasan
        );
    }

    public function Validator()
    {
        return $this->hasOne("App\Models\Pegawai", "id", "divalidasi_oleh");
    }

    public function getStatusString()
    {
        switch ($this->status_bkd) {
            case 1:
                return "Pengecekan";
                break;
            case 2:
                return "Valid";
                break;
            case 3:
                return "Disahkan";
                break;
            default:
                if ($this->divalidasi_oleh != null)
                    return "Rejected";
                else
                    return "Draft";
                break;
        }
    }

    public function Detail()
    {
        return $this->hasMany("App\Models\DetailBKD", "id_header", "id");
    }


    public function getStatusPenilaian()
    {
        $jumlah = PenilaianBKD::whereIdHeader($this->id)->count();
        return $jumlah > 0;
    }

    /**
     * Fungsi untuk mengembalikan status penilaian dalam string
     * @return string
     */
    public function getStatusPenilaianString()
    {
        if ($this->getStatusPenilaian())
            return "Tugas Jabatan Sudah Dinilai";
        else
            return "Belum Dinilai";
    }
}
