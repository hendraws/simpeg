<?php

namespace App\Http\Controllers;

use App\Models\kantor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KantorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kantor::get();
    	return view('admin.kantor.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kantor.create');
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
    		'kantor' => 'required|max:255',
    	]);

    	DB::beginTransaction();
    	try {
    		Kantor::Create(
    			[
    				'kantor' => $request->kantor,
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
     * @param  \App\Models\kantor  $kantor
     * @return \Illuminate\Http\Response
     */
    public function show(kantor $kantor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kantor  $kantor
     * @return \Illuminate\Http\Response
     */
    public function edit(kantor $kantor)
    {
        return view('admin.kantor.edit', compact('kantor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kantor  $kantor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kantor $kantor)
    {
        $request->validate([
    		'kantor' => 'required|max:255',
    	]);

    	DB::beginTransaction();
    	try {
    		$kantor->update([
    			'kantor' => $request->kantor,
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
     * @param  \App\Models\kantor  $kantor
     * @return \Illuminate\Http\Response
     */
    public function destroy(kantor $kantor)
    {
        $kantor->delete();
    	$result['code'] = '200';
    	return response()->json($result);
    }
}
