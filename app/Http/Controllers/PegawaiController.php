<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PromosiController;
use App\Models\HistoryLog;
use App\Models\HistoryPegawai;
use App\Models\Lamaran;
use App\Models\ProsesResmi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Lamaran::where('status_lamaran','diterima')->whereNotNull('nip')->get();

        return view('admin.pegawai.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Lamaran::find($id);
        $history = HistoryPegawai::where('user_id', $id)->get();
        // $history = HistoryLog::where('user_id', $id)->get();
        $sp = 	ProsesResmi::where('modul', 'surat-peringatan')
        		->where('status_verifikasi','sukses')
        		->where('tanggal_akhir', '>=' , date('Y-m-d'))
        		->latest()
        		->first();
        
        $masaKerja =  Carbon::parse($data->tanggal_diterima)->diff(Carbon::now())->format('%y Tahun, %m Bulan, %d Hari');
       
        return view('admin.pegawai.detail', compact('data', 'history','masaKerja','sp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
