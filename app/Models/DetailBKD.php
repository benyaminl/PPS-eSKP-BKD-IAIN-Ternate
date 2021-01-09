<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBKD extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'detail_bkd';

    public function NilaiBKD() {
        return $this->hasOne("App\Models\PenilaianBKD", "id_detail", "id");
    }
}
