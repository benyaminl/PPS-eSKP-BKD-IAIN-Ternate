<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianBKD extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'penilaian_bkd';
}
