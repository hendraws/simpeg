<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Wildside\Userstamps\Userstamps;

class SuratPeringatan extends Model
{

	use HasFactory, SoftDeletes, LogsActivity, Userstamps;
	
    protected $fillable = ['lamaran_id', 'sp', 'tanggal_akhir',  'jenis_pelanggaran', 'persus', 'sk', 'status', 'approved_by', 'created_by', 'updated_by', 'deleted_by', 'approved_at', ];

    protected static $logAttributes = ['lamaran_id', 'sp', 'tanggal_akhir',  'jenis_pelanggaran', 'persus', 'sk', 'status', 'approved_by', 'created_by', 'updated_by', 'deleted_by', 'approved_at', ];

    protected $with = ['getPegawai','getJenisPelanggaran','getPersus'];

	public function getPegawai(){
		return $this->belongsTo(Lamaran::class, 'lamaran_id','id');
	}

    public function getJenisPelanggaran(){
		return $this->belongsTo(JensiPelanggaran::class, 'jenis_pelanggaran','id');
	}    

	public function getPersus(){
		return $this->belongsTo(Persus::class, 'persus','id');
	}
}