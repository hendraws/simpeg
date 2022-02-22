<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Wildside\Userstamps\Userstamps;

class Promosi extends Model
{
	use HasFactory, SoftDeletes, LogsActivity, Userstamps;

	protected $fillable = [ 'lamaran_id', 'jabatan_awal', 'jabatan_baru', 'sk', 'status', 'approved_by', 'created_by', 'updated_by', 'deleted_by','approved_at' ];

	protected static $logAttributes = [ 'lamaran_id', 'jabatan_awal', 'jabatan_baru', 'sk', 'status', 'approved_by', 'created_by', 'updated_by', 'deleted_by','approved_at' ];

	protected $with = ['getPegawai', 'getJabatanAwal','getJabatanBaru'];

	public function getPegawai(){
		return $this->belongsTo(Lamaran::class, 'lamaran_id','id');
	}

	public function getJabatanAwal(){
		return $this->belongsTo(Jabatan::class, 'jabatan_awal','id');
	}

	public function getJabatanBaru(){
		return $this->belongsTo(Jabatan::class, 'jabatan_baru','id');
	}

}
