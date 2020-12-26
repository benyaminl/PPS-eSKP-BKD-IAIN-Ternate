<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends User
{
 
    const CREATED_AT = 'insert_date';
    const UPDATED_AT = 'update_date';
    protected $primaryKey = 'id';
    protected $table = 'pegawai';   
    use HasFactory;
}
