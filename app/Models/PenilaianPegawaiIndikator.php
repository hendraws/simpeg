<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PenilaianPegawaiIndikator extends Model
{
    use HasFactory,  LogsActivity;

    protected $fillable = [ 'penilaian_pegawai_id', 'indikator_id', 'nilai' ];
 	
 	protected static $logAttributes = [ 'penilaian_pegawai_id', 'indikator_id', 'nilai' ];

 	public function getIndikator(){
		return $this->belongsTo(IndikatorPenilaian::class, 'indikator_id','id');
	}
}
