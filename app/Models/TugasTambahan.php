<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasTambahan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'tugas_tambahan';
}
