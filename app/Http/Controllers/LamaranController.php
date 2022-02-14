<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Lamaran;
use App\Models\RefOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

            $lamar = $request->validate([
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
                'kk' => 'required|max:550'
            ]);

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
            Lamaran::create($lamar);
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
    	$detail = Lamaran::where('no_tiket', $no_tiket)->first();
    	return view('frontend.detail', compact('detail'));

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
    public function destroy(Lamaran $lamaran)
    {
        //
    }

    public function calonKaryawan()
    {
    	$data = Lamaran::get();

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
}
