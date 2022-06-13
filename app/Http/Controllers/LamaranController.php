<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\kantor;
use App\Models\Jabatan;
use App\Models\Lamaran;
use App\Mail\CustomEmail;
use App\Models\RefOption;
use App\Mail\LamaranEmail;
use App\Models\HistoryLog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\HistoryPegawai;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class LamaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$jabatan = Jabatan::where('open', 'Y')->pluck('jabatan', 'id');
    	$pendidikanAkhir = RefOption::where('modul', 'jenjang_pendidikan')->pluck('option', 'key');
    	$agama = RefOption::where('modul', 'agama')->pluck('option', 'key');
    	$statusPernikahan = RefOption::where('modul', 'status_pernikahan')->pluck('option', 'key');
    	return view('frontend.karir', compact('jabatan', 'pendidikanAkhir', 'agama', 'statusPernikahan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    		$lamar = $this->validate($request, [
    			'jabatan' => 'required',
    			'nik' => 'required',
    			'usia' => 'required',
    			'tekanan' => 'required',
    			'tim' => 'required',
    			'tempat_cabang' => 'required',
    			'peraturan' => 'required',
    			'nama' => 'required',
    			'tempat' => 'required',
    			'tanggal_lahir' => 'required',
    			'alamat' => 'required',
    			'pendidikan_terakhir' => 'required',
    			'agama' => 'required',
    			'status' => 'required',
    			'no_hp' => 'required',
    			'no_hp_darurat' => 'required',
    			'email' => 'required',
    			'surat_lamaran' => 'required|max:500',
    			'surat_pernyataan' => 'required|max:550',
    			'surat_tanggung_jawab' => 'required|max:550',
    			'ijazah' => 'required|max:550',
    			'cv' => 'required|max:550',
    			'skck' => 'required|max:550',
    			'foto' => 'required|max:550',
    			'sim' => 'required|max:550',
    			'ktp' => 'required|max:550',
    			'ktp_orangtua' => 'required|max:550',
    			'kk' => 'required|max:550',
    			'jenis_ijazah' => 'required',

    		], [   'required' => 'inputan :attribute wajib diisi.' ]);


    		if ($request->has('surat_lamaran')) {

    			$extension = $request->file('surat_lamaran')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' .rand(1,10).'-'. Str::slug($request->nama) . '1.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('surat_lamaran'), $imgName);
    			$lamar['surat_lamaran'] = $path;
    		}
    		if ($request->has('surat_pernyataan')) {

    			$extension = $request->file('surat_pernyataan')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' .rand(1,10).'-'. Str::slug($request->nama) . '2.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('surat_pernyataan'), $imgName);
    			$lamar['surat_pernyataan'] = $path;
    		}
    		if ($request->has('surat_tanggung_jawab')) {

    			$extension = $request->file('surat_tanggung_jawab')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' .rand(1,10).'-'. Str::slug($request->nama) . '3.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('surat_tanggung_jawab'), $imgName);
    			$lamar['surat_tanggung_jawab'] = $path;
    		}
    		if ($request->has('ijazah')) {

    			$extension = $request->file('ijazah')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' .rand(1,10).'-'. Str::slug($request->nama) . '4.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('ijazah'), $imgName);
    			$lamar['ijazah'] = $path;
    		}
    		if ($request->has('cv')) {

    			$extension = $request->file('cv')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' .rand(1,10).'-'. Str::slug($request->nama) . '5.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('cv'), $imgName);
    			$lamar['cv'] = $path;
    		}
    		if ($request->has('skck')) {

    			$extension = $request->file('skck')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' .rand(1,10).'-'. Str::slug($request->nama) . '6.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('skck'), $imgName);
    			$lamar['skck'] = $path;
    		}
    		if ($request->has('foto')) {

    			$extension = $request->file('foto')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' .rand(1,10).'-'. Str::slug($request->nama) . '7.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('foto'), $imgName);
    			$lamar['foto'] = $path;
    		}
    		if ($request->has('sim')) {

    			$extension = $request->file('sim')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' .rand(1,10).'-'. Str::slug($request->nama) . '8.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('sim'), $imgName);
    			$lamar['sim'] = $path;
    		}
    		if ($request->has('ktp')) {

    			$extension = $request->file('ktp')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' .rand(1,10).'-'. Str::slug($request->nama) . '9.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('ktp'), $imgName);
    			$lamar['ktp'] = $path;
    		}
    		if ($request->has('ktp_orangtua')) {

    			$extension = $request->file('ktp_orangtua')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' .rand(1,10).'-'. Str::slug($request->nama) . '10.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('ktp_orangtua'), $imgName);
    			$lamar['ktp_orangtua'] = $path;
    		}
    		if ($request->has('kk')) {

    			$extension = $request->file('kk')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' .rand(1,10).'-'. Str::slug($request->nama) . '11.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('kk'), $imgName);
    			$lamar['kk'] = $path;
    		}
    		do {
    			$no_tiket = date('Ymd').rand(1,100);
    		} while (Lamaran::where('no_tiket', $no_tiket)->exists());
    		$lamar['no_tiket'] = $no_tiket;
    		$lamar['status_karyawan'] = 'masuk-lamaran';
    		$lamar['status_dokumen'] = 'belum-diverifikasi';
    		$lamar['status_lamaran'] = 'menunggu-verifikasi';
    		$lamar['no_tiket'] = $no_tiket;
            // dd($lamar);
    		$lamar = Lamaran::create($lamar);
    		$details = [
    			'nama' => request()->nama,
    			'no_tiket' => $no_tiket
    		];
    		HistoryLog::create([
    			'pesan' => $request->nama.' mengajukan lamaran pekerjaan',
    			'modul' => 'App\Models\Lamaran',
    			'user_id' => $lamar->id,
    		]);
    		Mail::to(request()->email)->send(new LamaranEmail($details));

            HistoryPegawai::create([
                'pesan' => 'Masuk Lamaran',
                'user_id' => $lamar->id,
                'dokumen' => $lamar['surat_lamaran'],
                'cabang' => '',
                'created_by' => $lamar->id,
            ]);
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
    	return redirect(action('LamaranController@show', compact('no_tiket')));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function show($no_tiket)
    {
    	$data = Lamaran::where('no_tiket', $no_tiket)->first();
    	return view('frontend.detail', compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Lamaran $lamaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lamaran $lamaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$data = Lamaran::where('id',$id)->first();

    	HistoryLog::create([
    			'pesan' => 'data lamaran '. $data->nama.' dihapus',
    			'modul' => 'App\Models\Lamaran',
    			'user_id' => $data->id,
    		]);

    	$data->delete();
    	$result['code'] = '200';
    	return response()->json($result);
    }

    public function calonKaryawan()
    {
    	$data = Lamaran::where('status_lamaran', '!=', 'diterima')->orderBy('created_at', 'desc')->get();

    	return view('admin.verifikasi_tugas.index', compact('data'));
    }

    public function detailPelamar($id)
    {
    	// dd($id);

    	$data = Lamaran::find($id);

    	return view('admin.verifikasi_tugas.detail_pelamar', compact('data'));
    }

    public function verifikasiLamaran($id)
    {
    	// dd($id);

    	$data = Lamaran::find($id);

    	return view('admin.verifikasi_tugas.verifikasi_pelamar', compact('data'));
    }

    public function tolakLamaran($id)
    {

    	$data = Lamaran::find($id);
    	$data->update([
    		'status_lamaran' => 'ditolak'
    	]);

    	HistoryLog::create([
    			'pesan' => 'lamaran '. $data->nama.' ditolak',
    			'modul' => 'App\Models\Lamaran',
    			'user_id' => $data->id,
    		]);

        HistoryPegawai::create([
            'pesan' => 'Lamaran Ditolak',
            'user_id' => $data->id,
            'dokumen' => '',
            'cabang' => '',
            'created_by' => optional(optional(auth()->user())->getProfile)->id,
        ]);

        $details = [
            'nama' => $data->nama,
            'pesan' => 'Terima kasih atas ketertarikan Anda untuk melamar di KSP SATRIA MULIA ARTHOMORO. Kami telah membaca resume Anda, namun tidak dapat meneruskannya ke seleksi tahap selanjutnya. Saat ini kami sedang mencari kandidat dengan pengalaman dan keterampilan yang tepat untuk posisi tersebut.'
        ];

        Mail::to($data->email)->send(new CustomEmail($details));

    	toastr()->success('Data Berhasil Di Update', 'Berhasil');
    	return redirect(action('LamaranController@calonKaryawan'));
    }

    public function interviewLamaran(Request $request, $id)
    {
    	// dd($request, $id);

    	DB::beginTransaction();
    	try {
    		$lamaran = Lamaran::where('id', $id)->first();
    		$lamaran->update([
    			'status_lamaran' => 'interview',
    			'tanggal_interview' => $request->tanggal_interview,
    			'status_dokumen' => 'terverifikasi',
    			'verified_by' => auth()->user()->id,
    		]);

    		HistoryLog::create([
    			'pesan' => $lamaran->nama.' akan interview pada tanggal '. $request->tanggal_interview,
    			'modul' => 'App\Models\Lamaran',
    			'user_id' => $lamaran->id,
    		]);

            HistoryPegawai::create([
                'pesan' => 'Interview',
                'user_id' => $lamaran->id,
                'dokumen' => '',
                'cabang' => '',
                'created_by' => optional(optional(auth()->user())->getProfile)->id,
            ]);

            $details = [
                'nama' => $lamaran->nama,
                'pesan' => 'Menanggapi surat lamaran kerja Saudara di KSP SATRIA MULIA ARTHOMORO, maka dengan ini kami mengharap kedatangan Saudara pada jam dan tanggal '. $request->tanggal_interview. ' untuk keperluan wawancara kerja.',
            ];

            Mail::to($lamaran->email)->send(new CustomEmail($details));


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
    	return redirect(action('LamaranController@calonKaryawan'));
    }

    public function terimaLamaran($id)
    {
    	$data = Lamaran::where('id',$id)->first();
    	$jabatan = Jabatan::pluck('jabatan','id');
    	$kantor = kantor::pluck('kantor','id');

    	return view('admin.verifikasi_tugas.penempatan', compact('data', 'kantor','jabatan'));
    }

    public function penempatanLamaran(Request $request,$id)
    {
    	DB::beginTransaction();
    	try {
    		$no = 1;
    		do {
    			$nip = 'SMART/'.date('ymd'). $no++;
    		} while (Lamaran::where('nip', $nip)->exists());

    		$dataKaryawan = Lamaran::where('id', $id)->first();

    		// $user = User::create([
    		// 	'name' => $dataKaryawan->nama,
    		// 	'email' => $dataKaryawan->email,
    		// 	'password' => Hash::make(date('ymd', strtotime($dataKaryawan->tanggal_lahir))),
    		// ]);
			// dd($user);

    		$dataKaryawan->update([
    			'nip' => $nip,
    			'penempatan' => $request->penempatan,
    			'jabatan' => $request->jabatan,
    			'status_lamaran' => 'diterima',
			    'status_karyawan' => 'aktif',
    			'tanggal_diterima' => date('Y-m-d'),
    			'diterima_by' => auth()->user()->id,
    		]);

    		$kantor = kantor::find($request->penempatan);
    		$jabatan = Jabatan::find($request->jabatan);
    		HistoryLog::create([
    			'pesan' => $dataKaryawan->nama.' telah diterima menjadi karyawan baru akan ditempatkan di '. $kantor->kantor. ' sebagai '. $jabatan->jabatan,
    			'modul' => 'App\Models\Lamaran',
    			'user_id' => $dataKaryawan->id,
    		]);

            HistoryPegawai::create([
                'pesan' => 'Diterima Karyawan',
                'user_id' => $dataKaryawan->id,
                'dokumen' => '',
                'cabang' => $kantor->kantor,
                'created_by' => optional(optional(auth()->user())->getProfile)->id,
            ]);

            $details = [
                'nama' => $dataKaryawan->nama,
                'pesan' => 'Selamat Anda Diterima di KSP SATRIA MULIA ARTHOMORO sebagai ' .$jabatan->jabatan. ' dan akan ditempatkan di '. $kantor->kantor,
            ];

            Mail::to($dataKaryawan->email)->send(new CustomEmail($details));

            // dd($dataKaryawan);
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
    	toastr()->success('Penempatan Berhasil', 'Berhasil');
    	return redirect(action('LamaranController@calonKaryawan'));
    }

    public function testEmail(){
    	Mail::to("testings@malasngoding.com")->send(new LamaranEmail());

    	return "Email telah dikirim";

    }
}
