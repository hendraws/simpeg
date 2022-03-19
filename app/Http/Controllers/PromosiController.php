<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Lamaran;
use App\Models\Promosi;
use App\Models\HistoryLog;
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
    	$request->validate([
    		'lamaran_id' => 'required',
    		'jabatan_baru' => 'required',
    	]);
        // dd($request->all());
    	DB::beginTransaction();
    	try {
    		$input['lamaran_id'] = $request->lamaran_id;
    		$input['jabatan_awal'] = $request->jabatan_kini_id;
    		$input['jabatan_baru'] = $request->jabatan_baru;
    		// $input['sk'] = ;
    		$input['status'] = 'pending';
    		// $input['approved_by'] = ;
    		// $input['created_by'] = ;
    		// $input['updated_by'] = ;
    		// $input['deleted_by'] = ;
    		$input['approved_at'] = now();

    		Promosi::create($input);

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
    			$lamar['sk'] = $path;
    		}

    		$promosi = Promosi::where('id', $id)->first();
            $lamar['status'] = 'proses-verifikasi';
    		$promosi->update($lamar);

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

    		$promosi = Promosi::where('id', $id)->first();
    		$promosi->update([
                'status' => $request->status,
                'approved_by' => auth()->user()->id,
                'approved_at' => now(),
            ]);

        //     if($request->status == 'sukses'){
        //         $input['pesan'] = 'Promosi Karyawan, Karyawan '. optional($mutasi->getPegawai)->nama .' mutasi dari kantor/cabang '.optional($mutasi->getKantorAwal)->kantor . ' ke kantor/cabang '. optional($mutasi->getKantorBaru)->kantor. ' oleh '. auth()->user()->getProfile->nama ;
        //        $input['modul'] = 'App\Models\Mutasi';

        //        HistoryLog::create($input);
        //    }

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
