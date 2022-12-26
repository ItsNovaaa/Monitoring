<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    use HasFactory;
    protected $table = 'pejabat';
    protected $fillable = ['nama_pejabat', 'jabatan', 'status', 'created_by', 'updated_by'];
    public $timestamps = true;
}
