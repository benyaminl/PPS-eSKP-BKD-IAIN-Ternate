<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HubunganPegawai extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'hubungan_pegawai';
}
