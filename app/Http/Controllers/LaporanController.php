<?php

namespace App\Http\Controllers;

use App\Models\Lamaran;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Laporan::get();

    	return view('admin.laporan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = auth()->user()->getProfile;
        $dataPegawai = Lamaran::where('status_lamaran','diterima')->whereNotNull('nip')->get();
        return view('admin.laporan.create', compact('data', 'dataPegawai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
    		'atasan' => 'required',
    		'tanggal_mulai' => 'required',
    		'tanggal_selesai' => 'required',
    		'nama_kegiatan' => 'required',
    		'detail_kegiatan' => 'required',
    		'kendala' => 'required',
    		'penyelesaian_masalah' => 'required',
    	]);
        // dd($request->all());
    	DB::beginTransaction();
    	try {

			$input['pegawai_id'] = optional(optional(auth()->user())->getProfile)->id;
			$input['atasan'] = $request->atasan ;
			$input['tanggal_mulai'] = $request->tanggal_mulai;
			$input['tanggal_selesai'] = $request->tanggal_selesai;
			$input['nama_kegiatan'] = $request->nama_kegiatan;
			$input['detail_kegiatan'] = $request->detail_kegiatan;
			$input['tujuan_kegiatan'] = $request->tujuan_kegiatan;
			$input['kendala'] = $request->kendala ;
			$input['penyelesaian_masalah'] = $request->penyelesaian_masalah;
			$input['status'] = 'Pending';
    	
    		Laporan::create($input);

    	} catch (\Exception $e) {
    		DB::rollback();
    		toastr()->success($e->getMessage(), 'Error');
    		return back();
    	}catch (\Throwable $e) {
    		DB::rollback();
    		toastr()->success($e->getMessage(), 'Error');
    		throw $e;
    	}

    	DB::commit();
    	toastr()->success('Data telah ditambahkan', 'Berhasil');
    	return redirect(action('LaporanController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Laporan::find($id);
        $qrcode = QrCode::format('svg')->size(100)->generate(optional($data->getAtasan)->nama);
		return view('admin.laporan.detail', compact('data', 'qrcode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Laporan::find($id);
        $profile = auth()->user()->getProfile;
        $dataPegawai = Lamaran::where('status_lamaran','diterima')->whereNotNull('nip')->get();
		return view('admin.laporan.edit', compact('data','profile','dataPegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan $laporan)
    {
        //
    }

    public function verifikasiForm($id)
    {

    	return view('admin.laporan.verifikasi_form', compact('id'));
    }  

    public function verifikasi(Request $request, $id)
    {

    	DB::beginTransaction();
    	try {

    		$request->validate([
    			'status' => 'required'
    		]);

    		$promosi = Laporan::where('id', $id)->first();
    		$promosi->update([
    			'status' => $request->status,
    			'approved_by' => auth()->user()->id,
    			'approved_at' => now()
    		]);

    	} catch (\Exception $e) {
    		DB::rollback();
    		dd($e->getMessage());
    		toastr()->error($e->getMessage(), 'Error');

    		return back();
    	} catch (\Throwable $e) {
    		DB::rollback();
    		dd($e->getMessage());
    		toastr()->error($e->getMessage(), 'Error');
    		throw $e;
    	}
        // dd($request);
    	DB::commit();
    	toastr()->success('Verifikasi Berhasil', 'Berhasil');
    	return back();

    	return view('admin.proses_resmi.promosi.verifikasi_form', compact('id'));
    }
}
