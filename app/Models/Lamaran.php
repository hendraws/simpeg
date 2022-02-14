<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;

    protected $fillable = [ 'no_tiket', 'nama', 'tempat', 'tanggal_lahir', 'alamat', 'pendidikan_terakhir', 'agama', 'status', 'no_hp', 'no_hp_darurat', 'email', 'jabatan', 'usia', 'tekanan', 'tim', 'tempat_cabang', 'peraturan', 'surat_lamaran', 'surat_pernyataan', 'surat_tanggung_jawab', 'ijazah', 'cv', 'skck', 'foto', 'sim', 'ktp', 'ktp_orangtua', 'kk', 'status_karyawan', 'status_dokumen','status_lamaran'
    ];

    public function getJabatan(){
    	return $this->belongsTo(Jabatan::class, 'jabatan','id');
    }
}
