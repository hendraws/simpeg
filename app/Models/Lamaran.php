<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Wildside\Userstamps\Userstamps;

class Lamaran extends Model
{
    use HasFactory, SoftDeletes, LogsActivity, Userstamps;

    protected $fillable = [ 'nip','no_tiket', 'nik','nama', 'tempat', 'tanggal_lahir', 'alamat', 'pendidikan_terakhir', 'agama', 'status', 'no_hp', 'no_hp_darurat', 'email', 'jabatan', 'usia', 'tekanan', 'tim', 'tempat_cabang', 'peraturan', 'surat_lamaran', 'surat_pernyataan', 'surat_tanggung_jawab', 'ijazah', 'cv', 'skck', 'foto', 'sim', 'ktp', 'ktp_orangtua', 'kk', 'status_karyawan', 'status_dokumen','status_lamaran','tanggal_interview','penempatan','cabang','user_id','tanggal_diterima','masa_kerja', 'verified_by','diterima_by','created_by','updated_by'
    ];

    protected static $logAttributes = ['nip','no_tiket', 'nik','nama', 'tempat', 'tanggal_lahir', 'alamat', 'pendidikan_terakhir', 'agama', 'status', 'no_hp', 'no_hp_darurat', 'email', 'jabatan', 'usia', 'tekanan', 'tim', 'tempat_cabang', 'peraturan', 'surat_lamaran', 'surat_pernyataan', 'surat_tanggung_jawab', 'ijazah', 'cv', 'skck', 'foto', 'sim', 'ktp', 'ktp_orangtua', 'kk', 'status_karyawan', 'status_dokumen','status_lamaran','tanggal_interview','penempatan','cabang','user_id','tanggal_diterima','masa_kerja', 'verified_by','diterima_by','created_by','updated_by'];

	// protected static $recordEvents = ['created','updated','deleted'];
    
    protected $with = [ 'getJabatan', 'getKantor','getUser'];
    
    public function getJabatan(){
    	return $this->belongsTo(Jabatan::class, 'jabatan','id');
    }

    public function getKantor(){
    	return $this->belongsTo(kantor::class, 'penempatan','id');
    }

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
