<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'pegawai';
    protected $fillable = ['nama_pegawai', 'tanggal_lahir', 'status', 'created_by', 'updated_by'];
    public $timestamps = true;
}
