<?php

namespace App\Http\Controllers;

use App\Models\kantor;
use App\Models\Jabatan;
use App\Models\Lamaran;
use App\Models\Sponsor;
use App\Models\HistoryLog;
use App\Models\ProsesResmi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SponsorController extends Controller
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
    	$dataKantor = kantor::get();
    	return view('admin.proses_resmi.sponsor.create', compact('data','dataKantor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
    	$request->validate([
    		'lamaran_id' => 'required',
    		'kantor_tugas' => 'required',
    		'tanggal_mulai' => 'required|date_format:Y/m/d',
    		'tanggal_akhir' => 'required|date_format:Y/m/d',
    		'kantor_tugas' => 'required',
    	]);
        // dd($request->all());
    	DB::beginTransaction();
    	try {

            // $input['lamaran_id'] = $request->lamaran_id;
    		// $input['tanggal_mulai'] = $request->tanggal_mulai;
    		// $input['tanggal_akhir'] = $request->tanggal_akhir;
    		// $input['keterangan'] = 'Tidak Aktif';
    		// $input['kantor_tugas'] = $request->kantor_tugas;
    		// $input['kantor_baru'] = $request->kantor_baru;
    		// $input['status'] = 'pending';
    		// // $input['approved_at'] = now();

    		// Sponsor::create($input);

            $noSurat =  ProsesResmi::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->max('no_surat') ?? 0;
			$input['lamaran_id'] = $request->lamaran_id;
			$input['lama'] = $request->kantor_kini_id;
			$input['baru'] =  $request->kantor_tugas;
			$input['tanggal_mulai'] =  $request->tanggal_mulai;
			$input['tanggal_akhir'] =  $request->tanggal_akhir;
    		$input['status_verifikasi'] = 'pending'; //pending (upload dokumen)| verifikasi (sudah upload sk) | diterima | ditolak
    		$input['modul'] = 'sponsor';
    		$input['approved_at'] = now();
    		$input['no_surat'] = $noSurat + 1;

    		$data = ProsesResmi::create($input);

    		$history['pesan'] = 'Pengajuan Sponsor Karyawan, Karyawan '. optional($data->getPegawai)->nama .' mendapat tugas dari '.optional($data->getKantorAwal)->kantor . ' ke '. optional($data->getKantorBaru)->kantor. ' oleh '. auth()->user()->getProfile->nama ;

    		$history['user_id'] = $request->lamaran_id;
    		$history['modul_id'] = $data->id;
    		$history['modul'] = 'sponsor';

    		HistoryLog::create($history);

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
    	return redirect(action('ProsesResmiController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsor $sponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsor $sponsor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsor $sponsor)
    {
        //
    }

    public function uploadForm($id)
    {

    	return view('admin.proses_resmi.sponsor.upload_form', compact('id'));
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
    			$imgName = 'berkas_sk/sponsor/' . date('dmh') . '-' .rand(1,10).'-'. $id . '.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('file'), $imgName);
    			$lamar['dokumen'] = $path;
    		}
    		$lamar['status_verifikasi'] = 'verifikasi';
    		$sponsor = ProsesResmi::where('id', $id)->first();
    		$sponsor->update($lamar);

            $history['pesan'] = 'Pengajuan Sponsor Karyawan, Karyawan '. optional($sponsor->getPegawai)->nama .' sudah mengupload dokumen SK dan menunggu diverifikasi oleh '. optional($sponsor->getDiajukanOleh)->nama ;

    		$history['user_id'] = $sponsor->lamaran_id;
    		$history['modul_id'] = $sponsor->id;
    		$history['modul'] = 'sponsor';

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

    	return view('admin.proses_resmi.sponsor.upload_form', compact('id'));
    }

    public function verifikasiForm($id)
    {

    	return view('admin.proses_resmi.sponsor.verifikasi_form', compact('id'));
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

            $history['pesan'] = 'Pengajuan Sponsor Karyawan '.ucfirst($request->status).' , Karyawan '. optional($data->getPegawai)->nama .' mendapat tugas ke '. optional($data->getKantorBaru)->kantor. ' mulai dari tanggal '.  Carbon::parse($data->tanggal_mulai)->translatedFormat('d F Y') . ' sampai tanggal '. Carbon::parse($data->tanggal_akhir)->translatedFormat('d F Y') .' oleh '. auth()->user()->getProfile->nama ;

    		$history['user_id'] = $data->lamaran_id;
    		$history['modul_id'] = $data->id;
    		$history['modul'] = 'sponsor';

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

    	return view('admin.proses_resmi.sponsor.verifikasi_form', compact('id'));
    }

    public function downloadDraf($id){
    	$data  = ProsesResmi::find($id);
    	$data = $data->toArray();
        // dd($data);
    	// dd($data);
    	$pdf = PDF::loadView('admin.proses_resmi.sponsor.surat', compact('data'));
    	return $pdf->download('draft-sk-sponsor.pdf');
    }
}
