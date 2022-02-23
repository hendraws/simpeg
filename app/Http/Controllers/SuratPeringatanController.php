<?php

namespace App\Http\Controllers;

use App\Models\JenisPelanggaran;
use App\Models\SuratPeringatan;
use Illuminate\Http\Request;

class SuratPeringatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($request->ajax()){
    		$result['code'] = '200';
    		$result['pegawai'] = Lamaran::find($request->pegawai_id);
    		return response()->json($result);
    	}
    	$data = Lamaran::where('status_lamaran','diterima')->whereNotNull('nip')->get();
    	$dataJabatan = JenisPelanggaran::get('yyy');
    	return view('admin.proses_resmi.promosi.create', compact('data','dataJabatan'));
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
     * @param  \App\Models\SuratPeringatan  $suratPeringatan
     * @return \Illuminate\Http\Response
     */
    public function show(SuratPeringatan $suratPeringatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratPeringatan  $suratPeringatan
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratPeringatan $suratPeringatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratPeringatan  $suratPeringatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratPeringatan $suratPeringatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratPeringatan  $suratPeringatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratPeringatan $suratPeringatan)
    {
        //
    }
}
