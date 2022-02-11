<?php

namespace App\Http\Controllers;

use App\Models\IndikatorPenilaian;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndikatorPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = IndikatorPenilaian::get();
    	return view('admin.indikator_penilaian.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$jabatan = Jabatan::pluck('jabatan','id');
        return view('admin.indikator_penilaian.create', compact('jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
    		'jabatan_id' => 'required|max:255',
    		'indikator' => 'required|max:255',
    	]);

    	DB::beginTransaction();
    	try {
    		IndikatorPenilaian::Create($data);

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
    	return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IndikatorPenilaian  $indikator_penilaian
     * @return \Illuminate\Http\Response
     */
    public function show(IndikatorPenilaian $indikator_penilaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IndikatorPenilaian  $indikator_penilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(IndikatorPenilaian $indikator_penilaian)
    {
    		$jabatan = Jabatan::pluck('jabatan','id');
        return view('admin.indikator_penilaian.edit', compact('indikator_penilaian','jabatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IndikatorPenilaian  $indikator_penilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IndikatorPenilaian $indikator_penilaian)
    {
        $data = $request->validate([
    		'jabatan_id' => 'required|max:255',
    		'indikator' => 'required|max:255',
    	]);

    	DB::beginTransaction();
    	try {
    		$indikator_penilaian->update($data);
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
    	toastr()->success('Data telah Diubah', 'Berhasil');
    	return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IndikatorPenilaian  $indikator_penilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(IndikatorPenilaian $indikator_penilaian)
    {
        $indikator_penilaian->delete();
    	$result['code'] = '200';
    	return response()->json($result);
    }
}
