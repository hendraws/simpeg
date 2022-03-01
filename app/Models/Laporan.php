<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laporan extends Model
{

    use HasFactory, SoftDeletes, LogsActivity, Userstamps;

    protected $fillable = [ 'pegawai_id', 'atasan', 'tanggal_mulai', 'tanggal_selesai', 'nama_kegiatan', 'detail_kegiatan', 'tujuan_kegiatan', 'kendala', 'penyelesaian_masalah', 'status', 'approved_by', 'created_by', 'updated_by', 'deleted_by', 'approved_at',      ];

	protected static $logAttributes = [ 'pegawai_id', 'atasan', 'tanggal_mulai', 'tanggal_selesai', 'nama_kegiatan', 'detail_kegiatan', 'tujuan_kegiatan', 'kendala', 'penyelesaian_masalah', 'status', 'approved_by', 'created_by', 'updated_by', 'deleted_by', 'approved_at',  ];

	public function getPegawai(){
		return $this->belongsTo(Lamaran::class, 'pegawai_id','id');
	}

	public function getAtasan(){
		return $this->belongsTo(Lamaran::class, 'atasan','id');
	}



}
