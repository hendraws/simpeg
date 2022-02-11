<?php

namespace App\Http\Controllers;

use App\Models\JenisPelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisPelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$data = JenisPelanggaran::get();
    	return view('admin.jenis_pelanggaran.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('admin.jenis_pelanggaran.create');
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
    		'jenis_pelanggaran' => 'required|max:255',
    	]);

    	DB::beginTransaction();
    	try {
    		JenisPelanggaran::Create(
    			[
    				'jenis_pelanggaran' => $request->jenis_pelanggaran,
    			]
    		);

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
     * @param  \App\Models\jenis_pelanggaran  $jenis_pelanggaran
     * @return \Illuminate\Http\Response
     */
    public function show(JenisPelanggaran $jenis_pelanggaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jenis_pelanggaran  $jenis_pelanggaran
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisPelanggaran $jenis_pelanggaran)
    {
    	return view('admin.jenis_pelanggaran.edit', compact('jenis_pelanggaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jenis_pelanggaran  $jenis_pelanggaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisPelanggaran $jenis_pelanggaran)
    {
    	$request->validate([
    		'jenis_pelanggaran' => 'required|max:255',
    	]);

    	DB::beginTransaction();
    	try {
    		$jenis_pelanggaran->update([
    			'jenis_pelanggaran' => $request->jenis_pelanggaran,
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
    	toastr()->success('Data telah Diubah', 'Berhasil');
    	return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jenis_pelanggaran  $jenis_pelanggaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisPelanggaran $jenis_pelanggaran)
    {
    	$jenis_pelanggaran->delete();
    	$result['code'] = '200';
    	return response()->json($result);
    }
}
