<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Wildside\Userstamps\Userstamps;

class Pemberhentian extends Model
{

	protected $fillable = ['lamaran_id', 'tanggal_phk', 'jenis_pelanggaran', 'persus', 'sk', 'status', 'approved_by', 'created_by', 'updated_by', 'deleted_by', 'approved_at',  ];

	protected static $logAttributes = ['lamaran_id', 'tanggal_phk', 'jenis_pelanggaran', 'persus', 'sk', 'status', 'approved_by', 'created_by', 'updated_by', 'deleted_by', 'approved_at',  ];

	protected $with = ['getPegawai','getJenisPelanggaran','getPersus','getDiajukanOleh'];

	public function getPegawai(){
		return $this->belongsTo(Lamaran::class, 'lamaran_id','id');
	}

	public function getJenisPelanggaran(){
		return $this->belongsTo(JenisPelanggaran::class, 'jenis_pelanggaran','id');
	}

	public function getPersus(){
		return $this->belongsTo(Persus::class, 'persus','id');
	}

	public function getDiajukanOleh(){
		return $this->belongsTo(Lamaran::class, 'created_by','user_id');
	}
}