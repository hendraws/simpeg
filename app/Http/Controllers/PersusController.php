<?php

namespace App\Http\Controllers;

use App\Models\Persus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$data = Persus::get();
    	return view('admin.persus.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.persus.create');
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
    		'judul' => 'required|max:255',
    	]);

    	DB::beginTransaction();
    	try {
    		Persus::Create(
    			[
    				'judul' => $request->judul,
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
     * @param  \App\Models\Persus  $persu
     * @return \Illuminate\Http\Response
     */
    public function show(Persus $persu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persus  $persu
     * @return \Illuminate\Http\Response
     */
    public function edit(Persus $persu)
    {

      	return view('admin.persus.edit', compact('persu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persus  $persu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persus $persu)
    {
        $request->validate([
    		'judul' => 'required|max:255',
    	]);

    	DB::beginTransaction();
    	try {
    		$persu->update([
    			'judul' => $request->judul,
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
     * @param  \App\Models\Persus  $persu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persus $persu)
    {
        $persu->delete();
    	$result['code'] = '200';
    	return response()->json($result);
    }
}
