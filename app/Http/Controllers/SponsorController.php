<?php

namespace App\Http\Controllers;

use App\Models\kantor;
use App\Models\Jabatan;
use App\Models\Lamaran;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;

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
    		$input['lamaran_id'] = $request->lamaran_id;
    		$input['tanggal_mulai'] = $request->tanggal_mulai;
    		$input['tanggal_akhir'] = $request->tanggal_akhir;
    		$input['keterangan'] = 'Tidak Aktif';
    		$input['kantor_tugas'] = $request->kantor_tugas;
    		$input['kantor_baru'] = $request->kantor_baru;
    		$input['status'] = 'pending';
    		// $input['approved_at'] = now();

    		Sponsor::create($input);

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
    			$lamar['sk'] = $path;
    		}
    		$lamar['status'] = 'proses-verifikasi';
    		$sponsor = Sponsor::where('id', $id)->first();
    		$sponsor->update($lamar);

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

    		$keterangan = 'Tidak Aktif';
    		if($request->status == 'sukses'){
    			$keterangan = 'Aktif';
    		}
    		$sponsor = Sponsor::where('id', $id)->first();
    		$sponsor->update([
    			'status' => $request->status,
    			'keterangan' => $keterangan,
    			'approved_by' => auth()->user()->id,
    			'approved_at' => now(),
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

    	return view('admin.proses_resmi.sponsor.verifikasi_form', compact('id'));
    }

    public function downloadDraf($id){
    	$data  = Sponsor::find($id);
    	$data = $data->toArray();
    	// dd($data);
    	$pdf = PDF::loadView('admin.proses_resmi.sponsor.surat', compact('data'));
    	return $pdf->download('draft-sk-sponsor.pdf');
    }
}
