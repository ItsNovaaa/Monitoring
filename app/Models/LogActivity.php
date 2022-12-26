<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;
    protected $table = 'log_activity';
    protected $fillable = ['class', 'action', 'url', 'method', 'activity', 'created_by', 'created_at'];
    public $timestamps = false;
}
