<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LKDadd extends Model
{
	protected $table = 'lkd';
	protected $primaryKey = 'No';
	protected $fillable = ['Masa_Penugasan', 'Bukti_Dokumen', 'SKS_LKD'];
	//use HasFactory;
}
