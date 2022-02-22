<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Wildside\Userstamps\Userstamps;

class PegawaiLog extends Model
{
    use HasFactory, LogsActivity, Userstamps;

    protected $fillable = [ 'lamaran_id', 'name', 'status_karyawan', 'keterangan', 'cabang', 'created_by', 'updated_by', ]; 

    protected $logAttributes = [ 'lamaran_id', 'name', 'status_karyawan', 'keterangan', 'cabang', 'created_by', 'updated_by', ];
}
