<?php

namespace App\Http\Controllers;

use App\Models\Persus;
use App\Models\Lamaran;
use App\Models\HistoryLog;
use App\Models\ProsesResmi;
use Illuminate\Http\Request;
use App\Models\Pemberhentian;
use App\Models\JenisPelanggaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;

class PemberhentianController extends Controller
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
    	if ($request->ajax()) {
    		$result['code'] = '200';
    		$result['pegawai'] = Lamaran::find($request->pegawai_id);
    		return response()->json($result);
    	}
    	$data = Lamaran::where('status_lamaran', 'diterima')->whereNotNull('nip')->get();
    	$jenisPelanggaran = JenisPelanggaran::pluck('jenis_pelanggaran', 'id');
    	$persus = Persus::pluck('judul', 'id');
    	return view('admin.proses_resmi.pemberhentian.create', compact('data', 'jenisPelanggaran', 'persus', ));
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
    		'lamaran_id' => 'required',
    		'jenis_pelanggaran' => 'required',
    		'persus' => 'required',
    		'tanggal_phk' => 'required|date_format:Y/m/d',
    	]);

    	DB::beginTransaction();
    	try {

            // dd($request->all());
    		// $input['lamaran_id'] = $request->lamaran_id;
    		// $input['jenis_pelanggaran'] = $request->jenis_pelanggaran;
    		// $input['tanggal_phk'] = $request->tanggal_phk;
    		// $input['persus'] = $request->persus;
    		// $input['status'] = 'pending';
            // // $input['approved_at'] = now();

    		// Pemberhentian::create($input);

            $noSurat =  ProsesResmi::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->max('no_surat') ?? 0;
			$input['lamaran_id'] = $request->lamaran_id;
            $input['jenis_pelanggaran'] = $request->jenis_pelanggaran;
            $input['tanggal_akhir'] = $request->tanggal_phk;
            $input['persus'] = $request->persus;
    		$input['status_verifikasi'] = 'pending'; //pending (upload dokumen)| verifikasi (sudah upload sk) | diterima | ditolak
    		$input['modul'] = 'pemberhentian';
    		$input['approved_at'] = now();
    		$input['no_surat'] = $noSurat + 1;

    		$data = ProsesResmi::create($input);

    		$history['pesan'] = 'Pemberhentian Karyawan, Karyawan '. optional($data->getPegawai)->nama .' akan di berhentikan ';

    		$history['user_id'] = $request->lamaran_id;
    		$history['modul_id'] = $data->id;
    		$history['modul'] = 'pemberhentian';

    		HistoryLog::create($history);

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
     * @param  \App\Models\Pemberhentian  $pemberhentian
     * @return \Illuminate\Http\Response
     */
    public function show(Pemberhentian $pemberhentian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemberhentian  $pemberhentian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemberhentian $pemberhentian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemberhentian  $pemberhentian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemberhentian $pemberhentian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemberhentian  $pemberhentian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemberhentian $pemberhentian)
    {
        //
    }

    public function uploadForm($id)
    {

    	return view('admin.proses_resmi.pemberhentian.upload_form', compact('id'));
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
    			$imgName = 'berkas_sk/pemberhentian/' . date('dmh') . '-' . rand(1, 10) . '-' . $id . '.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('file'), $imgName);
    			$lamar['dokumen'] = $path;
    		}

            $lamar['status_verifikasi'] = 'verifikasi';
    		$pemberhentian = ProsesResmi::where('id', $id)->first();
    		$pemberhentian->update($lamar);

            $history['pesan'] = 'Pemberhentian Karyawan, Karyawan '. optional($pemberhentian->getPegawai)->nama .' sudah mengupload dokumen SK dan menunggu diverifikasi oleh '. optional($pemberhentian->getDiajukanOleh)->nama ;

    		$history['user_id'] = $pemberhentian->lamaran_id;
    		$history['modul_id'] = $pemberhentian->id;
    		$history['modul'] = 'pemberhentian';

    		HistoryLog::create($history);

    	} catch (\Exception $e) {
    		DB::rollback();
    		dd($e->errors());
    		toastr()->error($e->getErors(), 'Error');

    		return back();
    	} catch (\Throwable $e) {
    		DB::rollback();
    		dd($e->errors());
    		toastr()->error($e->getErors(), 'Error');
    		throw $e;
    	}
        // dd($request);
    	DB::commit();
    	toastr()->success('Data telah ditambahkan', 'Berhasil');
    	return back();

    	return view('admin.proses_resmi.pemberhentian.upload_form', compact('id'));
    }

    public function verifikasiForm($id)
    {

    	return view('admin.proses_resmi.pemberhentian.verifikasi_form', compact('id'));
    }

    public function verifikasi(Request $request, $id)
    {

    	DB::beginTransaction();
    	try {

            $request->validate([
    			'status' => 'required'
    		]);

    		$data = ProsesResmi::where('id', $id)->first();

    		$data->update([
    			'status_verifikasi' => $request->status,
    			'approved_by' => auth()->user()->id,
    			'approved_at' => now(),
    		]);

            $history['pesan'] = 'Pemberhentian Kayawan '.ucfirst($request->status).', Karyawan '. optional($data->getPegawai)->nama .' '.$request->status.' Diberhentikan oleh '. auth()->user()->getProfile->nama ;

    		$history['user_id'] = $data->lamaran_id;
    		$history['modul_id'] = $data->id;
    		$history['modul'] = 'pemberhentian';

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

    	return view('admin.proses_resmi.pemberhentian.verifikasi_form', compact('id'));
    }

    public function downloadDraf($id){
    	$data  = ProsesResmi::find($id);
    	$data = $data->toArray();

    	$pdf = PDF::loadView('admin.proses_resmi.pemberhentian.surat', compact('data'));
    	return $pdf->download('draft-sk-phk.pdf');
    }
}
