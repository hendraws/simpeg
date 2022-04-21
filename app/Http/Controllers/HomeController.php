<?php

namespace App\Http\Controllers;

use App\Models\HistoryLog;
use App\Models\Lamaran;
use App\Models\Laporan;
use App\Models\Mutasi;
use App\Models\Pemberhentian;
use App\Models\Promosi;
use App\Models\ProsesResmi;
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
    	$lamaran = Lamaran::whereNotNull('nip')->count();
        $prosesResmi = ProsesResmi::where('status_verifikasi', 'sukses')->get();

        $spAktif = $prosesResmi->where('modul','surat-peringatan')->where('tanggal_akhir', '>', date('Y-m-d'))->count();
        $sponsor = $prosesResmi->where('modul','sponsor')->where('tanggal_mulai', '<=', date('Y-m-d'))->where('tanggal_akhir','>=',date('Y-m-d') )->count();

        $verifikasiLamaran = Lamaran::where('status_lamaran', 'menunggu-verifikasi')->count();
        $verifikasiLaporanPegawai = Laporan::where('status', 'pending')->count();
        $verifikasiAll = ProsesResmi::where('status_verifikasi','pending')->count();
        return view('home', compact('historyLog', 'lamaran', 'spAktif', 'sponsor','verifikasiLamaran','verifikasiLaporanPegawai','verifikasiAll'));
    }
}
