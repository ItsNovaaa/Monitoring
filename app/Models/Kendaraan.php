<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;
    protected $table = 'kendaraan';
    protected $fillable = ['id_perusahaan', 'nama_kendaraan', 'jenis_kendaraan', 'tipe_kendaraan', 'sewa', 'biaya', 'dari_tanggal', 'sampai_tanggal', 'status_unit', 'status', 'jadwal_service', 'bbm', 'created_by', 'updated_by'];
    public $timestamps = true;
}
