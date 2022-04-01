<?php

namespace App\Http\Controllers;

use App\Models\HistoryLog;
use App\Models\Jabatan;
use App\Models\Lamaran;
use App\Models\Promosi;
use App\Models\ProsesResmi;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PromosiController extends Controller
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
    public function create(Request $request)
    {
    	if($request->ajax()){
    		$result['code'] = '200';
    		$result['pegawai'] = Lamaran::find($request->pegawai_id);
    		return response()->json($result);
    	}
    	$data = Lamaran::where('status_lamaran','diterima')->whereNotNull('nip')->get();
    	$dataJabatan = Jabatan::get();
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
    	// Data ada di ProsesResmi

    	// $request->validate([
    	// 	'lamaran_id' => 'required',
    	// 	'jabatan_baru' => 'required',
    	// ]);
     //    // dd($request->all());
    	// DB::beginTransaction();
    	// try {
    	// 	$input['lamaran_id'] = $request->lamaran_id;
    	// 	$input['jabatan_awal'] = $request->jabatan_kini_id;
    	// 	$input['jabatan_baru'] = $request->jabatan_baru;
    	// 	$input['status'] = 'pending';
    	// 	$input['gaji'] = 'pending';
    	// 	$input['modul'] = 'promosi';


    	// 	Promosi::create($input);

    	// } catch (\Exception $e) {
    	// 	DB::rollback();
    	// 	toastr()->success($e->getMessage(), 'Error');
    	// 	return back();
    	// }catch (\Throwable $e) {
    	// 	DB::rollback();
    	// 	toastr()->success($e->getMessage(), 'Error');
    	// 	throw $e;
    	// }

    	// DB::commit();
    	// toastr()->success('Data telah ditambahkan', 'Berhasil');
    	// return redirect(action('ProsesResmiController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promosi  $promosi
     * @return \Illuminate\Http\Response
     */
    public function show(Promosi $promosi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promosi  $promosi
     * @return \Illuminate\Http\Response
     */
    public function edit(Promosi $promosi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promosi  $promosi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promosi $promosi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promosi  $promosi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promosi $promosi)
    {
        //
    }

    public function uploadForm($id)
    {

    	return view('admin.proses_resmi.promosi.upload_form', compact('id'));
    }

    public function upload(Request $request, $id)
    {

    	DB::beginTransaction();
    	try {

    		$request->validate([
    			'file' => 'required|max:550'
    		]);

    		if ($request->has('file')) {
    			$extension = $request->file('file')->extension();
    			$imgName = 'berkas_sk/promosi/' . date('dmh') . '-' .rand(1,10).'-'. $id . '.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('file'), $imgName);
    			$lamar['dokumen'] = $path;
    		}

    		$promosi = ProsesResmi::where('id', $id)->firstOrFail();
    		$lamar['status_verifikasi'] = 'verifikasi';
    		$promosi->update($lamar);

    		$history['pesan'] = 'Pengajuan Promosi Karyawan, Karyawan '. optional($promosi->getPegawai)->nama .' mengupload dokumen SK dan menunggu diverifikasi oleh '. optional($promosi->getDiajukanOleh)->nama ;

    		$history['user_id'] = $promosi->lamaran_id;
    		$history['modul_id'] = $promosi->id;
    		$history['modul'] = 'promosi';

    		HistoryLog::create($history);


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
    	toastr()->success('Data telah ditambahkan', 'Berhasil');
    	return back();

    	return view('admin.proses_resmi.promosi.upload_form', compact('id'));
    }

    public function verifikasiForm($id)
    {

    	return view('admin.proses_resmi.promosi.verifikasi_form', compact('id'));
    }

    public function verifikasi(Request $request, $id)
    {

    	DB::beginTransaction();
    	try {

    		$request->validate([
    			'status' => 'required'
    		]);

    		$promosi = ProsesResmi::where('id', $id)->firstOrFail();
    		$promosi->update([
    			'status_verifikasi' => $request->status,
    			'approved_by' => auth()->user()->id,
    			'approved_at' => now(),
    		]);

    		$history['pesan'] = 'Pengajuan Promosi Karyawan '.ucfirst($request->status).', Karyawan '. optional($promosi->getPegawai)->nama .' '.$request->status.' mendapat promosi dari jabatan '.optional($promosi->getJabatanAwal)->jabatan . ' menjadi jabatan '. optional($promosi->getJabatanBaru)->jabatan. ' oleh '. auth()->user()->getProfile->nama ;

    		$history['user_id'] = $promosi->lamaran_id;
    		$history['modul_id'] = $promosi->id;
    		$history['modul'] = 'promosi';

    		HistoryLog::create($history);
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

    public function downloadDraf($id){
    	$data  = ProsesResmi::find($id);
    	$data = $data->toArray();

    	$pdf = PDF::loadView('admin.proses_resmi.promosi.surat', compact('data'));
    	return $pdf->download('draft-sk-promosi.pdf');
    }
}
