<?php

namespace App\Http\Controllers;

use App\Models\HistoryLog;
use App\Models\Lamaran;
use App\Models\Laporan;
use App\Models\Mutasi;
use App\Models\Pemberhentian;
use App\Models\Promosi;
use App\Models\Sponsor;
use App\Models\SuratPeringatan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	$historyLog  = HistoryLog::orderBy('created_at','desc')->take(15)->get();
    	$lamaran = Lamaran::whereNotNull('nip')->get();
    	$spAktif = SuratPeringatan::where('status','sukses')->where('tanggal_akhir', '>', date('Y-m-d'))->get();
    	$sponsor = Sponsor::where('keterangan','Aktif')->where('tanggal_mulai', '<=', date('Y-m-d'))->where('tanggal_akhir','>=',date('Y-m-d') )->get();
        $verifikasiLamaran = Lamaran::where('status_lamaran', 'menunggu-verifikasi')->get();
        $verifikasiLaporanPegawai = Laporan::where('status', 'pending')->get()->count();
        $verifikasiMutasi = Mutasi::where('status', 'pending')->get()->count();
        $verifikasiPromosi = Promosi::where('status', 'pending')->get()->count();
        $verifikasiSponsor = Sponsor::where('status', 'pending')->get()->count();
        $verifikasiSuratPeringatan = SuratPeringatan::where('status', 'pending')->get()->count();
        $verifikasiPemberhentian = Pemberhentian::where('status', 'pending')->get()->count();
        
 $verifikasiAll =  $verifikasiLaporanPegawai + $verifikasiMutasi + $verifikasiPromosi + $verifikasiSponsor + $verifikasiSuratPeringatan + $verifikasiPemberhentian;
        return view('home', compact('historyLog', 'lamaran', 'spAktif', 'sponsor','verifikasiLamaran','verifikasiLaporanPegawai','verifikasiAll'));
    }
}
