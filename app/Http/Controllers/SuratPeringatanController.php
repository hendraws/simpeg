<?php

namespace App\Http\Controllers;

use App\Models\Persus;
use App\Models\Lamaran;
use Illuminate\Http\Request;
use App\Models\SuratPeringatan;
use App\Models\JenisPelanggaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SuratPeringatanController extends Controller
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
        $sp = ['sp1', 'sp2', 'sp3'];
        return view('admin.proses_resmi.surat_peringatan.create', compact('data', 'jenisPelanggaran', 'persus', 'sp'));
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
            'sp' => 'required',
            'jenis_pelanggaran' => 'required',
            'persus' => 'required',
            'tanggal_akhir' => 'required|date_format:Y/m/d',
        ]);

        DB::beginTransaction();
        try {
            $input['lamaran_id'] = $request->lamaran_id;
            $input['sp'] = $request->sp;
            $input['jenis_pelanggaran'] = $request->jenis_pelanggaran;
            $input['tanggal_akhir'] = $request->tanggal_akhir;
            $input['persus'] = $request->persus;
            $input['status'] = 'pending';
            // $input['approved_at'] = now();

            SuratPeringatan::create($input);
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
     * @param  \App\Models\SuratPeringatan  $suratPeringatan
     * @return \Illuminate\Http\Response
     */
    public function show(SuratPeringatan $suratPeringatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratPeringatan  $suratPeringatan
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratPeringatan $suratPeringatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratPeringatan  $suratPeringatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratPeringatan $suratPeringatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratPeringatan  $suratPeringatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratPeringatan $suratPeringatan)
    {
        //
    }

    public function uploadForm($id)
    {

        return view('admin.proses_resmi.surat_peringatan.upload_form', compact('id'));
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
                $imgName = 'berkas_sk/surat_peringatan/' . date('dmh') . '-' . rand(1, 10) . '-' . $id . '.' . $extension;
                $path = Storage::putFileAs('public', $request->file('file'), $imgName);
                $lamar['sk'] = $path;
            }
            $suratPeringatan = SuratPeringatan::where('id', $id)->first();
            $suratPeringatan->update($lamar);
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

        return view('admin.proses_resmi.surat_peringatan.upload_form', compact('id'));
    }

    public function verifikasiForm($id)
    {

        return view('admin.proses_resmi.surat_peringatan.verifikasi_form', compact('id'));
    }

    public function verifikasi(Request $request, $id)
    {

        DB::beginTransaction();
        try {

            $request->validate([
                'status' => 'required'
            ]);

            $suratPeringatan = SuratPeringatan::where('id', $id)->first();
            $suratPeringatan->update([
                'status' => $request->status,
                'approved_by' => auth()->user()->id,
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

        return view('admin.proses_resmi.surat_peringatan.verifikasi_form', compact('id'));
    }
}
