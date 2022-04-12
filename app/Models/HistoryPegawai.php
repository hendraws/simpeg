<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesan',
        'user_id',
        'dokumen',
        'created_by',
        'cabang',
    ];
}
