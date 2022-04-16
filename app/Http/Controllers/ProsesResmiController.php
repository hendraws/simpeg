<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Promosi;
use App\Models\Sponsor;
use App\Models\HistoryLog;
use App\Models\ProsesResmi;
use Illuminate\Http\Request;
use App\Models\Pemberhentian;
use App\Models\HistoryPegawai;
use App\Models\SuratPeringatan;
use Illuminate\Support\Facades\DB;

class ProsesResmiController extends Controller
{

	public function index(Request $request)
	{
		$dataPromosi = ProsesResmi::where('modul', 'promosi')->orderBy('updated_at', 'DESC')->get();
		$dataMutasi = ProsesResmi::where('modul', 'mutasi')->orderBy('updated_at', 'DESC')->get();
		$dataSponsor = ProsesResmi::where('modul', 'sponsor')->orderBy('updated_at', 'DESC')->get();
		$dataSp = ProsesResmi::where('modul', 'surat-peringatan')->orderBy('updated_at', 'DESC')->get();
		$dataPemberhentian = ProsesResmi::where('modul', 'pemberhentian')->orderBy('updated_at', 'DESC')->get();
		// $dataSponsor = Sponsor::orderBy('updated_at', 'DESC')->get();
		// $dataSp = SuratPeringatan::orderBy('updated_at', 'DESC')->get();
		// $dataPemberhentian = Pemberhentian::orderBy('updated_at', 'DESC')->get();
		return view('admin.proses_resmi.index', compact('dataPromosi', 'dataMutasi', 'dataSponsor','dataSp','dataPemberhentian'));
	}

	public function storePromosi(Request $request)
	{
		$request->validate([
			'lamaran_id' => 'required',
			'jabatan_baru' => 'required',
		]);
        // dd($request->all());
		DB::beginTransaction();
		try {
			$noSurat =  ProsesResmi::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->max('no_surat') ?? 0;
			$input['lamaran_id'] = $request->lamaran_id;
			$input['lama'] = $request->jabatan_kini_id;
			$input['baru'] = $request->jabatan_baru;
    		$input['status_verifikasi'] = 'pending'; //pending (upload dokumen)| verifikasi (sudah upload sk) | diterima | ditolak
    		$input['modul'] = 'promosi';
    		$input['gaji'] = $request->gaji;
    		$input['approved_at'] = now();
    		$input['no_surat'] = $noSurat + 1;

    		$data = ProsesResmi::create($input);

    		$history['pesan'] = 'Pengajuan Promosi Karyawan, Karyawan '. optional($data->getPegawai)->nama .' mendapat promosi dari jabatan '.optional($data->getJabatanAwal)->jabatan . ' menjadi jabatan '. optional($data->getJabatanBaru)->jabatan. ' oleh '. auth()->user()->getProfile->nama ;

    		$history['user_id'] = $request->lamaran_id;
    		$history['modul_id'] = $data->id;
    		$history['modul'] = 'promosi';

    		HistoryLog::create($history);

            HistoryPegawai::create([
                'pesan' => 'Pengajuan Promosi '. optional($data->getJabatanBaru)->jabatan,
                'user_id' => $request->lamaran_id,
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
    	toastr()->success('Data telah ditambahkan', 'Berhasil');
    	return redirect(action('ProsesResmiController@index'));

    }
}
