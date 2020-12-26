<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderSKP extends Model
{
    use HasFactory;

    const CREATED_AT = 'insert_date';
    const UPDATED_AT = 'update_date';
    protected $primaryKey = 'id';
    protected $table = 'header_skp';
    
    public function Pegawai() {
        return $this->hasOne("App\Models\Pegawai", "id", "id_pegawai");
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
}
