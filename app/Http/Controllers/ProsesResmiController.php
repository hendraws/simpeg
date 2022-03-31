<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Promosi;
use App\Models\Sponsor;
use App\Models\HistoryLog;
use App\Models\ProsesResmi;
use Illuminate\Http\Request;
use App\Models\Pemberhentian;
use App\Models\SuratPeringatan;
use Illuminate\Support\Facades\DB;

class ProsesResmiController extends Controller
{

    public function index(Request $request)
    {
    	$dataPromosi = Promosi::orderBy('updated_at', 'DESC')->get();
    	$dataMutasi = Mutasi::orderBy('updated_at', 'DESC')->get();
    	$dataSponsor = Sponsor::orderBy('updated_at', 'DESC')->get();
    	$dataSp = SuratPeringatan::orderBy('updated_at', 'DESC')->get();
    	$dataPemberhentian = Pemberhentian::orderBy('updated_at', 'DESC')->get();
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
    		$input['lamaran_id'] = $request->lamaran_id;
    		$input['lama'] = $request->jabatan_kini_id;
    		$input['baru'] = $request->jabatan_baru;
    		$input['status_verifikasi'] = 'pending'; //pending (upload dokumen)| verifikasi (sudah upload sk) | diterima | ditolak
    		$input['approved_at'] = now();

    		$data = ProsesResmi::create($input);

            if ($request->status == 'sukses') {
                $input['pesan'] = strtoupper($suratPeringatan->sp).' Karyawan ' . optional($suratPeringatan->getPegawai)->nama . ', Jenis Pelanggaran ' . optional($suratPeringatan->getJenisPelanggaran)->jenis_pelanggaran . ', Dikeluarkan oleh ' . optional($suratPeringatan->getApprovedBy)->name;
                $input['modul'] = 'App\Models\SuratPeringatan';

                HistoryLog::create($input);
            }

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
        dd($request->all());
    }
}
