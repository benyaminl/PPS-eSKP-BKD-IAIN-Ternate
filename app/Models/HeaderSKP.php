<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderSKP extends Model
{
    use HasFactory;

    # const CREATED_AT = 'insert_date';
    # const UPDATED_AT = 'update_date';
    protected $primaryKey = 'id';
    protected $table = 'header_skp';
    
    public function Pegawai() {
        return $this->hasOne("App\Models\Pegawai", "id", "id_pegawai");
    }    

    public function Atasan() {
        return $this->hasOneThrough("App\Models\Pegawai", "App\Models\HubunganPegawai", 
            "id_bawahan", // ID di HubunganPegawai / Tabel Penengah 
            "id", // ID di Tabel Pegawai 
            "id_pegawai", // ID Di Class HeaderSKP / tabel ini 
            "id_atasan" // ID join nya, di join hubunganPegawai dan Pegawai on pegawai.id = hubungan_pegawai.id_atasan 
        );
    }

    public function getStatusString() {
        switch($this->status_skp) {
            case 1: 
                return "Pengecekan";
                break;
            case 2:
                return "Valid";
                break;
            case 3:
                return "Disahkan";
                break;
            default :
                return "Draft";
                break;
        }
    }

    public function Detail() {
        return $this->hasMany("App\Models\DetailSKP", "id_header", "id");
    }
}
