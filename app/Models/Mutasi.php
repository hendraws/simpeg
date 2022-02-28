<?php

namespace App\Models;

use App\Models\kantor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Wildside\Userstamps\Userstamps;

class Mutasi extends Model
{
	use HasFactory, SoftDeletes, LogsActivity, Userstamps;

    protected $fillable = [ 'lamaran_id', 'kantor_awal', 'kantor_baru', 'sk', 'status', 'approved_by', 'created_by', 'updated_by', 'deleted_by', 'approved_at',];

	protected static $logAttributes = [ 'lamaran_id', 'kantor_awal', 'kantor_baru', 'sk', 'status', 'approved_by', 'created_by', 'updated_by', 'deleted_by','approved_at'];

	protected $with = ['getPegawai', 'getKantorAwal','getKantorBaru'];


    public function getPegawai(){
		return $this->belongsTo(Lamaran::class, 'lamaran_id','id');
	}

	public function getKantorAwal(){
		return $this->belongsTo(kantor::class, 'kantor_awal','id');
	}

	public function getKantorBaru(){
		return $this->belongsTo(kantor::class, 'kantor_baru','id');
	}
}
