<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSKP extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'detail_skp';
    
    public function Penilaian() {
        return $this->hasOne("App\Models\PenilaianSKP", "id_detail", "id");
    }
}
