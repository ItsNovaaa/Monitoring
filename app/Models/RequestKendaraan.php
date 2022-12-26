<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RequestKendaraan extends Model
{
    use HasFactory;
    protected $table = 'request_kendaraan';
    protected $fillable = ['id_kendaraan', 'id_pegawai', 'tujuan_pemesanan', 'status', 'id_approval', 'id_approval2', 'created_by', 'updated_by'];
    public $timestamps = true;

    public function scopeRequestKendaraan() {
        return $this->select('request_kendaraan.*', 'pegawai.nama_pegawai', 'pejabat.nama_pejabat', 'kendaraan.nama_kendaraan', 'kendaraan.status AS status_kendaraan', 'kendaraan.status_unit', 'kendaraan.bbm', 'kendaraan.jadwal_service')
            ->join('kendaraan', 'kendaraan.id', 'request_kendaraan.id_kendaraan')
            ->join('pegawai', 'pegawai.id', 'request_kendaraan.id_pegawai')
            ->leftjoin('pejabat', 'pejabat.id', 'request_kendaraan.id_approval');
    }

    public function scopeDashboardRequestKendaraan() {
        return $this->select(
                'request_kendaraan.*',
                'kendaraan.nama_kendaraan',
                DB::raw('count(kendaraan.id) AS jumlah')
            )
            ->join('kendaraan', 'kendaraan.id', 'request_kendaraan.id_kendaraan')
            ->join('pegawai', 'pegawai.id', 'request_kendaraan.id_pegawai')
            ->join('pejabat', 'pejabat.id', 'request_kendaraan.id_approval')
            ->groupBy('request_kendaraan.id_kendaraan');
    }
}
