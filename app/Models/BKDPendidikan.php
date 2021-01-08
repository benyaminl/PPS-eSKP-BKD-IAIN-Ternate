<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BKDPendidikan extends Model
{
	protected $table = 'rbkd';

	//protected $primaryKey = 'No';
	protected $fillable = ['Bidang', 'Jenis_Kegiatan', 'Bukti_Penugasan', 'SKS_RBKD'];
	//use HasFactory;
}
