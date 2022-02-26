<?php

namespace App\Http\Controllers;

use App\Models\kantor;
use App\Models\Jabatan;
use App\Models\Lamaran;
use Illuminate\Http\Request;
use App\Models\PenilaianPegawai;
use Illuminate\Support\Facades\DB;

class PenilaianPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PenilaianPegawai::selectRaw('kantor, count(*) as jumlah')->groupBy('kantor')->get();
    	return view('admin.penilaian_pegawai.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$dataPegawai = Lamaran::where('status_lamaran','diterima')->whereNotNull('nip')->get();
    	$dataKantor = kantor::pluck('kantor','id');
    	$dataJabatan = Jabatan::pluck('jabatan', 'id');
    	return view('admin.penilaian_pegawai.create', compact('dataPegawai','dataKantor','dataJabatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $input = $request->validate([
            'pegawai_id' => 'required',
            'kantor' => 'required',
            'jabatan' => 'required',
            'tanggal' => 'required|date_format:Y/m/d',
            'penilai' => 'required',
        ]);
        DB::beginTransaction();
        try {
            PenilaianPegawai::create($input);
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->success($e->getMessage(), 'Error');
            return back();
        } catch (\Throwable $e) {
            DB::rollback();
            toastr()->success($e->getMessage(), 'Error');
            throw $e;
        }

        DB::commit();
        toastr()->success('Data telah ditambahkan', 'Berhasil');
        return redirect(action('ProsesResmiController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PenilaianPegawai  $penilaianPegawai
     * @return \Illuminate\Http\Response
     */
    public function show(PenilaianPegawai $penilaianPegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PenilaianPegawai  $penilaianPegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(PenilaianPegawai $penilaianPegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PenilaianPegawai  $penilaianPegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PenilaianPegawai $penilaianPegawai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PenilaianPegawai  $penilaianPegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(PenilaianPegawai $penilaianPegawai)
    {
        //
    }
}
