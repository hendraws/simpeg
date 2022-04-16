<?php

namespace App\Http\Controllers;

use App\Models\kantor;
use App\Models\Mutasi;
use App\Models\Jabatan;
use App\Models\Lamaran;
use App\Models\HistoryLog;
use App\Models\ProsesResmi;
use Illuminate\Http\Request;
use App\Models\HistoryPegawai;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MutasiController extends Controller
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
    	return view('admin.proses_resmi.mutasi.create', compact('data','dataKantor'));
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
    		'kantor_baru' => 'required',
    	]);
        // dd($request->all());
    	DB::beginTransaction();
    	try {
    		// dd($request->all());
    		// $input['lamaran_id'] = $request->lamaran_id;
    		// $input['kantor_awal'] = $request->kantor_kini_id;
    		// $input['kantor_baru'] = $request->kantor_baru;
    		// // $input['sk'] = ;
    		// $input['status'] = 'pending';
    		// // $input['approved_by'] = ;
    		// // $input['created_by'] = ;
    		// // $input['updated_by'] = ;
    		// // $input['deleted_by'] = ;
    		// // $input['approved_at'] = now();

    		// Mutasi::create($input);

    		$noSurat =  ProsesResmi::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->max('no_surat') ?? 0;
			$input['lamaran_id'] = $request->lamaran_id;
			$input['lama'] = $request->kantor_kini_id;
			$input['baru'] =  $request->kantor_baru;
    		$input['status_verifikasi'] = 'pending'; //pending (upload dokumen)| verifikasi (sudah upload sk) | diterima | ditolak
    		$input['modul'] = 'mutasi';
    		$input['approved_at'] = now();
    		$input['no_surat'] = $noSurat + 1;

    		$data = ProsesResmi::create($input);

    		$history['pesan'] = 'Pengajuan Mutasi Karyawan, Karyawan '. optional($data->getPegawai)->nama .' dipindah tugaskan dari '.optional($data->getKantorAwal)->kantor . ' ke '. optional($data->getKantorBaru)->kantor. ' oleh '. auth()->user()->getProfile->nama ;

    		$history['user_id'] = $request->lamaran_id;
    		$history['modul_id'] = $data->id;
    		$history['modul'] = 'promosi';

    		HistoryLog::create($history);

            HistoryPegawai::create([
                'pesan' => 'Pengajuan Mutasi ',
                'user_id' => $data->lamaran_id,
                'dokumen' => '',
                'cabang' => optional($data->getKantorBaru)->kantor,
                'created_by' => optional(optional(auth()->user())->getProfile)->id,
            ]);

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
     * @param  \App\Models\Mutasi  $mutasi
     * @return \Illuminate\Http\Response
     */
    public function show(Mutasi $mutasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mutasi  $mutasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    	$data = ProsesResmi::find($id);
    	$dataKantor = kantor::get();
        // dd($data);
    	return view('admin.proses_resmi.mutasi.edit', compact('data','dataKantor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mutasi  $mutasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

    	DB::beginTransaction();
    	try {
    		
    		$input['baru'] = $request->kantor_baru;

    		$data = ProsesResmi::where('id', $id)->first();
    		
    		$kantor_baru = kantor::find($request->kantor_baru);

    		$pesan = 'Ubah Pengajuan Mutasi ';
    		if($data->status_verifikasi == 'sukses'){
				$pegawai = Lamaran::find($data->lamaran_id);
    			if($request->status == $data->status_verifikasi){
    				$pegawai->update([
    					'penempatan' => $request->kantor_baru
    				]);

    				$input['status_verifikasi'] = $request->status;
    			}else{
    				$pegawai->update([
    					'penempatan' => $data->lama
    				]);

    				$input['status_verifikasi'] = $request->status;
    				$pesan = 'Ubah Pengajuan Mutasi & status menjadi '. $request->status;
    			}
    		}

    		$data->update($input);

			$history['pesan'] = 'Edit Pengajuan Mutasi Karyawan, Karyawan '. optional($data->getPegawai)->nama .' dipindah tugaskan dari '.optional($data->getKantorAwal)->kantor . ' ke '. optional($data->getKantorBaru)->kantor. ' oleh '. auth()->user()->getProfile->nama ;

    		$history['user_id'] = $data->lamaran_id;
    		$history['modul_id'] = $data->id;
    		$history['modul'] = 'mutasi';

    		HistoryLog::create($history);

    		HistoryPegawai::create([
    			'pesan' => $pesan,
    			'user_id' => $data->lamaran_id,
    			'dokumen' => '',
    			'cabang' => '',
    			'created_by' => optional(optional(auth()->user())->getProfile)->id,
    		]);

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
    	toastr()->success('Data Mutasi telah diubah', 'Berhasil');
    	return redirect(action('ProsesResmiController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mutasi  $mutasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mutasi $mutasi)
    {
        //
    }

    public function uploadForm($id)
    {

    	return view('admin.proses_resmi.mutasi.upload_form', compact('id'));
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
    			$imgName = 'berkas_sk/mutasi/' . date('dmh') . '-' .rand(1,10).'-'. $id . '.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('file'), $imgName);
    			$lamar['dokumen'] = $path;
    		}
    		$lamar['status_verifikasi'] = 'verifikasi';
    		$mutasi = ProsesResmi::where('id', $id)->first();
    		$mutasi->update($lamar);

            $history['pesan'] = 'Pengajuan Mutasi Karyawan, Karyawan '. optional($mutasi->getPegawai)->nama .' sudah mengupload dokumen SK dan menunggu diverifikasi oleh '. optional($mutasi->getDiajukanOleh)->nama ;

    		$history['user_id'] = $mutasi->lamaran_id;
    		$history['modul_id'] = $mutasi->id;
    		$history['modul'] = 'mutasi';

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

    	return view('admin.proses_resmi.mutasi.upload_form', compact('id'));
    }

    public function verifikasiForm($id)
    {

    	return view('admin.proses_resmi.mutasi.verifikasi_form', compact('id'));
    }

    public function verifikasi(Request $request, $id)
    {

    	DB::beginTransaction();
    	try {

    		$request->validate([
    			'status' => 'required'
    		]);

    		$mutasi = ProsesResmi::where('id', $id)->first();

    		$mutasi->update([
    			'status_verifikasi' => $request->status,
    			'approved_by' => auth()->user()->id,
    			'approved_at' => now(),
    		]);

            $history['pesan'] = 'Pengajuan Mutasi Karyawan '.ucfirst($request->status).', Karyawan '. optional($mutasi->getPegawai)->nama .' '.$request->status.' dipindah tugaskan dari kantor '.optional($mutasi->getKantorLama)->kantor . ' ke '. optional($mutasi->getKantorBaru)->kantor. ' oleh '. auth()->user()->getProfile->nama ;

    		$history['user_id'] = $mutasi->lamaran_id;
    		$history['modul_id'] = $mutasi->id;
    		$history['modul'] = 'mutasi';

    		HistoryLog::create($history);

            HistoryPegawai::create([
                'pesan' => 'Pengajuan Mutasi '.ucfirst($request->status),
                'user_id' => $mutasi->lamaran_id,
                'dokumen' => $mutasi->dokumen,
                'cabang' => optional($mutasi->getKantorBaru)->kantor,
                'created_by' => optional(optional(auth()->user())->getProfile)->id,
            ]);

              if($request->status == 'sukses'){
            	$pegawai = Lamaran::find($mutasi->lamaran_id);
            	$pegawai->update([
            		'penempatan' => $mutasi->baru
            	]);
            }


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

    	return view('admin.proses_resmi.mutasi.verifikasi_form', compact('id'));
    }

    public function downloadDraf($id){
    	$data  = ProsesResmi::find($id);
    	$data = $data->toArray();
    	$pdf = PDF::loadView('admin.proses_resmi.mutasi.surat', compact('data'));
    	return $pdf->download('draft-sk-mutasi.pdf');
    }
}
