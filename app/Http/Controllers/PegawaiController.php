<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\kantor;
use App\Models\Jabatan;
use App\Models\Lamaran;
use App\Models\RefOption;
use App\Models\HistoryLog;
use App\Models\ProsesResmi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\HistoryPegawai;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PromosiController;
use Barryvdh\DomPDF\Facade as PDF;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$data = Lamaran::where('status_lamaran', 'diterima')->whereNotNull('nip')->get();

    	return view('admin.pegawai.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$jabatan = Jabatan::pluck('jabatan', 'id');
    	$pendidikanAkhir = RefOption::where('modul', 'jenjang_pendidikan')->pluck('option', 'key');
    	$agama = RefOption::where('modul', 'agama')->pluck('option', 'key');
    	$statusPernikahan = RefOption::where('modul', 'status_pernikahan')->pluck('option', 'key');
    	$penempatan = kantor::pluck('kantor', 'id');

    	return view('admin.pegawai.create', compact('jabatan', 'pendidikanAkhir', 'agama', 'statusPernikahan', 'penempatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	DB::beginTransaction();
    	try {
        	// dd($request);
    		$lamar = $this->validate($request, [
    			'nik' => 'required',
    			'nama' => 'required',
    			'tempat' => 'required',
    			'tanggal_lahir' => 'required',
    			'alamat' => 'required',
    			'pendidikan_terakhir' => 'required',
    			'agama' => 'required',
    			'status' => 'required',
    			'no_hp' => 'required',
    			'no_hp_darurat' => 'required',
    			'tanggal_diterima' => 'required',
    			'jabatan' => 'required',
    			'penempatan' => 'required',
    			'email' => 'required',
    			'surat_lamaran' => 'max:500',
    			'surat_pernyataan' => 'max:550',
    			'surat_tanggung_jawab' => 'max:550',
    			'ijazah' => 'max:550',
    			'cv' => 'max:550',
    			'skck' => 'max:550',
    			'foto' => 'max:550',
    			'sim' => 'max:550',
    			'ktp' => 'max:550',
    			'ktp_orangtua' => 'max:550',
    			'kk' => 'max:550'

    		], ['required' => 'inputan :attribute wajib diisi.']);


    		if ($request->has('surat_lamaran')) {

    			$extension = $request->file('surat_lamaran')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '1.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('surat_lamaran'), $imgName);
    			$lamar['surat_lamaran'] = $path;
    		}
    		if ($request->has('surat_pernyataan')) {

    			$extension = $request->file('surat_pernyataan')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '2.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('surat_pernyataan'), $imgName);
    			$lamar['surat_pernyataan'] = $path;
    		}
    		if ($request->has('surat_tanggung_jawab')) {

    			$extension = $request->file('surat_tanggung_jawab')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '3.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('surat_tanggung_jawab'), $imgName);
    			$lamar['surat_tanggung_jawab'] = $path;
    		}
    		if ($request->has('ijazah')) {

    			$extension = $request->file('ijazah')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '4.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('ijazah'), $imgName);
    			$lamar['ijazah'] = $path;
    		}
    		if ($request->has('cv')) {

    			$extension = $request->file('cv')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '5.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('cv'), $imgName);
    			$lamar['cv'] = $path;
    		}
    		if ($request->has('skck')) {

    			$extension = $request->file('skck')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '6.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('skck'), $imgName);
    			$lamar['skck'] = $path;
    		}
    		if ($request->has('foto')) {

    			$extension = $request->file('foto')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '7.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('foto'), $imgName);
    			$lamar['foto'] = $path;
    		}
    		if ($request->has('sim')) {

    			$extension = $request->file('sim')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '8.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('sim'), $imgName);
    			$lamar['sim'] = $path;
    		}
    		if ($request->has('ktp')) {

    			$extension = $request->file('ktp')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '9.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('ktp'), $imgName);
    			$lamar['ktp'] = $path;
    		}
    		if ($request->has('ktp_orangtua')) {

    			$extension = $request->file('ktp_orangtua')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '10.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('ktp_orangtua'), $imgName);
    			$lamar['ktp_orangtua'] = $path;
    		}
    		if ($request->has('kk')) {

    			$extension = $request->file('kk')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '11.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('kk'), $imgName);
    			$lamar['kk'] = $path;
    		}
    		do {
    			$no_tiket = date('Ymd') . rand(1, 100);
    		} while (Lamaran::where('no_tiket', $no_tiket)->exists());

    		$no = 1;
    		do {
    			$nip = 'SMART/' . date('ymd') . $no++;
    		} while (Lamaran::where('nip', $nip)->exists());

    		$lamar['nip'] = $nip;
    		$lamar['no_tiket'] = $no_tiket;
    		$lamar['status_karyawan'] = 'aktif';
    		$lamar['status_dokumen'] = 'belum-diverifikasi';
    		$lamar['status_lamaran'] = 'diterima';
    		$lamar['no_tiket'] = $no_tiket;
            // dd($lamar);
    		$lamar = Lamaran::create($lamar);
    	} catch (\ValidationException $e) {
    		DB::rollback();
    		dd($e->getErrors());
            // dd($e->validator->messages(), $e);
            // toastr()->error($e->getMessage()->all(), 'Error');

    		return back();
    	}
        // dd($request);
    	DB::commit();
    	toastr()->success('Data telah ditambahkan', 'Berhasil');
    	return redirect(action('PegawaiController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$data = Lamaran::find($id);
    	$history = HistoryPegawai::where('user_id', $id)->get();
        // $history = HistoryLog::where('user_id', $id)->get();
    	$sp =     ProsesResmi::where('modul', 'surat-peringatan')
    	->where('status_verifikasi', 'sukses')
    	->where('tanggal_akhir', '>=', date('Y-m-d'))
    	->where('lamaran_id', $id)
    	->latest()
    	->first();

    	$masaKerja =  Carbon::parse($data->tanggal_diterima)->diff(Carbon::now())->format('%y Tahun, %m Bulan, %d Hari');

    	return view('admin.pegawai.detail', compact('data', 'history', 'masaKerja', 'sp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$jabatan = Jabatan::pluck('jabatan', 'id');
    	$pendidikanAkhir = RefOption::where('modul', 'jenjang_pendidikan')->pluck('option', 'key');
    	$agama = RefOption::where('modul', 'agama')->pluck('option', 'key');
    	$statusPernikahan = RefOption::where('modul', 'status_pernikahan')->pluck('option', 'key');
    	$penempatan = kantor::pluck('kantor', 'id');

    	$data = Lamaran::find($id);

    	return view('admin.pegawai.edit', compact('data','jabatan','pendidikanAkhir','agama','statusPernikahan','penempatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    	DB::beginTransaction();
    	try {
        	// dd($request);
    		$lamar = $this->validate($request, [
    			'nik' => 'required',
    			'nama' => 'required',
    			'tempat' => 'required',
    			'tanggal_lahir' => 'required',
    			'alamat' => 'required',
    			'pendidikan_terakhir' => 'required',
    			'agama' => 'required',
    			'status' => 'required',
    			'no_hp' => 'required',
    			'no_hp_darurat' => 'required',
    			'tanggal_diterima' => 'required',
    			'jabatan' => 'required',
    			'penempatan' => 'required',
    			'email' => 'required',
    			'surat_lamaran' => 'max:500',
    			'surat_pernyataan' => 'max:550',
    			'surat_tanggung_jawab' => 'max:550',
    			'ijazah' => 'max:550',
    			'cv' => 'max:550',
    			'skck' => 'max:550',
    			'foto' => 'max:550',
    			'sim' => 'max:550',
    			'ktp' => 'max:550',
    			'ktp_orangtua' => 'max:550',
    			'kk' => 'max:550'

    		], ['required' => 'inputan :attribute wajib diisi.']);


    		if ($request->has('surat_lamaran')) {

    			$extension = $request->file('surat_lamaran')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '1.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('surat_lamaran'), $imgName);
    			$lamar['surat_lamaran'] = $path;
    		}
    		if ($request->has('surat_pernyataan')) {

    			$extension = $request->file('surat_pernyataan')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '2.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('surat_pernyataan'), $imgName);
    			$lamar['surat_pernyataan'] = $path;
    		}
    		if ($request->has('surat_tanggung_jawab')) {

    			$extension = $request->file('surat_tanggung_jawab')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '3.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('surat_tanggung_jawab'), $imgName);
    			$lamar['surat_tanggung_jawab'] = $path;
    		}
    		if ($request->has('ijazah')) {

    			$extension = $request->file('ijazah')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '4.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('ijazah'), $imgName);
    			$lamar['ijazah'] = $path;
    		}
    		if ($request->has('cv')) {

    			$extension = $request->file('cv')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '5.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('cv'), $imgName);
    			$lamar['cv'] = $path;
    		}
    		if ($request->has('skck')) {

    			$extension = $request->file('skck')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '6.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('skck'), $imgName);
    			$lamar['skck'] = $path;
    		}
    		if ($request->has('foto')) {

    			$extension = $request->file('foto')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '7.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('foto'), $imgName);
    			$lamar['foto'] = $path;
    		}
    		if ($request->has('sim')) {

    			$extension = $request->file('sim')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '8.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('sim'), $imgName);
    			$lamar['sim'] = $path;
    		}
    		if ($request->has('ktp')) {

    			$extension = $request->file('ktp')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '9.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('ktp'), $imgName);
    			$lamar['ktp'] = $path;
    		}
    		if ($request->has('ktp_orangtua')) {

    			$extension = $request->file('ktp_orangtua')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '10.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('ktp_orangtua'), $imgName);
    			$lamar['ktp_orangtua'] = $path;
    		}
    		if ($request->has('kk')) {

    			$extension = $request->file('kk')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' . rand(1, 10) . '-' . Str::slug($request->nama) . '11.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('kk'), $imgName);
    			$lamar['kk'] = $path;
    		}

    		$dataProfile = Lamaran::find($id);
    		$dataProfile->update($lamar);
    	} catch (\ValidationException $e) {
    		DB::rollback();
    		dd($e->getErrors());
            // dd($e->validator->messages(), $e);
            // toastr()->error($e->getMessage()->all(), 'Error');

    		return back();
    	}
        // dd($request);
    	DB::commit();
    	toastr()->success('Data telah diupdate', 'Berhasil');
    	return redirect(action('PegawaiController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function suratPernjanjianKerja($id)
    {
    	$data = Lamaran::find($id);
    	$title = 'Surat Perjanjian Kerja - ' . $data->nama; 
    	$user = auth()->user();
    	// return view('admin.pegawai.surat.surat_perjanjian_kerja', compact('data','user'));
    	$pdf = PDF::loadView('admin.pegawai.surat.surat_perjanjian_kerja', compact('data','user'));

    	return $pdf->download($title.'.pdf');
    } 

    public function suratPernyataanSim($id)
    {
    	$data = Lamaran::find($id);
    	$title = 'Surat Pernyataan SIM - ' . $data->nama; 
    	$user = auth()->user();
    	$pdf = PDF::loadView('admin.pegawai.surat.surat_pernyataan_sim', compact('data','user'));

    	return $pdf->download($title.'.pdf');
    } 

    public function suratPenitipanIjazah($id)
    {
    	$data = Lamaran::find($id);
    	$title = 'Surat Penitipan Ijazah - ' . $data->nama; 
    	$user = auth()->user();
    	$pdf = PDF::loadView('admin.pegawai.surat.surat_penitipan_ijazah', compact('data','user'));

    	return $pdf->download($title.'.pdf');
    }
}
