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

    protected $with = ['getPegawai', 'getDiajukanOleh','getJabatanAwal','getJabatanBaru', 'getKantorAwal','getKantorBaru'];

    public function getPegawai(){
		return $this->belongsTo(Lamaran::class, 'lamaran_id','id');
	}

	public function getDiajukanOleh(){
		return $this->belongsTo(Lamaran::class, 'created_by','user_id');
	}

	public function getJabatanAwal(){
		return $this->belongsTo(Jabatan::class, 'lama','id');
	}

	public function getJabatanBaru(){
		return $this->belongsTo(Jabatan::class, 'baru','id');
	}


	public function getKantorAwal(){
		return $this->belongsTo(kantor::class, 'lama','id');
	}

	public function getKantorBaru(){
		return $this->belongsTo(kantor::class, 'baru','id');
	}
}
