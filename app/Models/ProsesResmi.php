<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProsesResmi extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [ 'lamaran_id', 'lama', 'baru', 'tanggal_mulai', 'tanggal_akhir', 'status_verifikasi', 'dokumen', 'no_surat', 'sp', 'jenis_pelanggaran', 'persus', 'gaji', 'modul', 'approved_by', 'created_by', 'updated_by', 'deleted_by', 'approved_at' ];


}
