<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Wildside\Userstamps\Userstamps;

class Sponsor extends Model
{
    	use HasFactory, SoftDeletes, LogsActivity, Userstamps;
    protected $fillable = ['lamaran_id', 'tanggal_mulai', 'tanggal_akhir', 'keterangan', 'sk','kantor_tugas', 'status', 'approved_by', 'created_by', 'updated_by', 'deleted_by', 'approved_at',];

    protected static $logAttributes = ['lamaran_id', 'tanggal_mulai', 'tanggal_akhir', 'keterangan', 'sk','kantor_tugas', 'status', 'approved_by', 'created_by', 'updated_by', 'deleted_by', 'approved_at'];

    protected $with = ['getPegawai','getKantorTugas','getDiajukanOleh'];

	public function getPegawai(){
		return $this->belongsTo(Lamaran::class, 'lamaran_id','id');
	}

    public function getKantorTugas(){
		return $this->belongsTo(kantor::class, 'kantor_tugas','id');
	}

	public function getDiajukanOleh(){
		return $this->belongsTo(Lamaran::class, 'created_by','user_id');
	}
}
