<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Wildside\Userstamps\Userstamps;

class PenilaianPegawai extends Model
{
    
    use HasFactory, SoftDeletes, LogsActivity, Userstamps;

    protected $fillable = [ 'pegawai_id', 'kantor', 'jabatan', 'tanggal', 'penilai', 'nilai', 'created_by', 'updated_by', 'deleted_by', ];

	protected static $logAttributes = [ 'pegawai_id', 'kantor', 'jabatan', 'tanggal', 'penilai', 'nilai', 'created_by', 'updated_by', 'deleted_by', ];

	protected $with = ['getKantor','getPegawai','getPenilai','getJabatan','getNilai'];

	public function getKantor(){
		return $this->belongsTo(kantor::class, 'kantor','id');
	}

	public function getPegawai(){
		return $this->belongsTo(Lamaran::class, 'pegawai_id','id');
	}	

	public function getPenilai(){
		return $this->belongsTo(Lamaran::class, 'penilai','id');
	}
	
	public function getJabatan(){
		return $this->belongsTo(Jabatan::class, 'jabatan','id');
	}

	public function getNilai(){
		return $this->hasMany(PenilaianPegawaiIndikator::class, 'penilaian_pegawai_id','id');
	}
}
