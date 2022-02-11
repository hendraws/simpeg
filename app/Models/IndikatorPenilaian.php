<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorPenilaian extends Model
{
    use HasFactory;

    protected $fillable = ['jabatan_id','indikator'];
    protected $with = ['getJabatan'];


    public function getJabatan(){
    	return $this->belongsTo(Jabatan::class,'jabatan_id', 'id');
    }
}
