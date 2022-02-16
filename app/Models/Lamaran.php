<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lamaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ 'nip','no_tiket', 'nik','nama', 'tempat', 'tanggal_lahir', 'alamat', 'pendidikan_terakhir', 'agama', 'status', 'no_hp', 'no_hp_darurat', 'email', 'jabatan', 'usia', 'tekanan', 'tim', 'tempat_cabang', 'peraturan', 'surat_lamaran', 'surat_pernyataan', 'surat_tanggung_jawab', 'ijazah', 'cv', 'skck', 'foto', 'sim', 'ktp', 'ktp_orangtua', 'kk', 'status_karyawan', 'status_dokumen','status_lamaran','tanggal_interview','penempatan','cabang'
    ];

    public function getJabatan(){
    	return $this->belongsTo(Jabatan::class, 'jabatan','id');
    }

    public function getKantor(){
    	return $this->belongsTo(Kantor::class, 'penempatan','id');
    }

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
